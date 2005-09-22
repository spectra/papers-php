<?

include('include/mysql.inc.php');
include('include/basic.inc.php');

require 'Smarty.class.php';
$smarty = new Smarty;
$smarty->compile_check = true;
# $smarty->debugging = true;

$smarty->config_load('papers.conf');

expires(0);
header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
header('Content-Type: text/plain');

$mysql = new Mysql;

$cod = $_POST['cod'];

# Pega a situacao atual
$sql = "SELECT * from pessoas
        WHERE cod = $cod";
$rs = $mysql->conn->Execute($sql);

# Gera uma nova senha caso solicitado
if ($_POST['newpass'])
{
  $senha = str_replace("\n", '', `makepasswd --chars=8`);
  $_POST['passwd'] = md5($senha);
}

# Se o campo 'pago' estiver vazio, zera todos os valores
if (! $_POST['pago'])
{
  $_POST['vl_viagem'] = 0;
  $_POST['vl_hotel']  = 0;
  $_POST['vl_alimen'] = 0;
  $_POST['vl_outros'] = 0;
  $_POST['pago'] = 0;
}

$updateSQL = $mysql->conn->GetUpdateSQL($rs, $_POST);

if ($updateSQL)
{
  if ($mysql->conn->Execute($updateSQL))
  {
    writeLog('pessoas.log', "Registro " . $_POST['cod'] . " alterado SQL: $updateSQL");

    # # Se o status for i,r,d, coloca o mesmo status em todas as palestras desta
    # # pessoa
    # switch($_POST['status'])
    # {
    #   case 'i':
    #   case 'r':
    #   case 'd':
    #     $status = $_POST['status'];
    #     $sql = "UPDATE propostas SET status = '$status'
    #             WHERE pessoa = $cod";
    #     if ($mysql->conn->Execute($sql))
    #     {
    #       writeLog('pessoas.log', "Atualizando status de palestras da pessoa $cod para $status: $sql");
    #     }
    #     else
    #     {
    #       print "Os dados da pessoa foram salvos, mas houve um erro no banco\n"
    #        . "de dados ao atualizar o status das palestras\n\n";
    #       $erro = $mysql->conn->ErrorNo() . ' - ' . $mysql->conn->ErrorMsg();
    #       print "$erro\n";
    #       
    #       writeLog('pessoas.log', 'Erro atualizando banco de dados no status de palestras - registro ' . $_POST['cod'] . " - erro $erro");

    #       exit;
    #     }
    # }
    
    # Enviar nova senha para a pessoa por e-mail, caso solicitado
    if ($_POST['newpass'])
    {
      $base = $smarty->get_config_vars('txtemails');

      $txt = `cat $base/novasenha.txt`;

      $txt = str_replace('%%NOME%%', $_POST['nome'], $txt);
      $txt = str_replace('%%SENHA%%', $senha, $txt);
      $txt = str_replace('%%URL%%', 'http://papers.softwarelivre.org/', $txt);

      $subject = "FISL - Nova senha - New password";

      if (! mail($_POST['email'], $subject, $txt, "From: FISL 2004 <papers@softwarelivre.org>\nContent-Type: text/plain; charset=iso-8859-1"))
      {
        print "Os dados foram salvos com sucesso, mas houve um problema ao\n" .
          "enviar o e-mail para " . $_POST['email'] . ".\n\n" .
          "Entre em contato com o administrador informando o problema.\n";

        writeLog('pessoas.log', 'Falha ao enviar e-mail para ' . $_POST['email'] . ' - registro ' . $_POST['cod']);

        exit;
      }
      writeLog('pessoas.log', 'Enviado e-mail para ' . $_POST['email'] . ' com nova senha');
    }

    header('Location: proponentes');
    exit;
  }
  else
  {
    print "Erro atualizando banco de dados.\n\n";
    $erro = $mysql->conn->ErrorNo() . ' - ' . $mysql->conn->ErrorMsg();
    print "$erro\n";
    
    writeLog('pessoas.log', 'Erro atualizando banco de dados - registro ' . $_POST['cod'] . " - erro $erro");
  }
}
else
{
  header('Location: proponentes');
  exit;
}

?>
