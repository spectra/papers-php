<?

include('include/mysql.inc.php');
include('include/basic.inc.php');

require 'include/mysmarty.inc.php';
$smarty = new Smarty;
$smarty->compile_check = true;
# $smarty->debugging = true;

$smarty->config_load('papers.conf');

expires(0);
header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
header('Content-Type: text/plain');

$mysql = new Mysql;
# $mysql->conn->debug = 1;

$cod = $_POST['cod'];

# Pega a situacao atual
$sql = "SELECT * from propostas
        WHERE cod = $cod";
$rs = $mysql->conn->Execute($sql);

# 0 nao pode ser salvo. substitui para null
if ($_POST['espaco'] == 0)
  $_POST['espaco'] = null;

# Verifica se o espaco na grade foi mudado e entao verifica se o novo espaco
# esta' disponivel
if (($rs->fields['espaco'] != $_POST['espaco']) and ($_POST['espaco'] > 0))
{
  $sql = "SELECT cod, titulo FROM propostas
          WHERE espaco = " . $_POST['espaco'];
  $rs_es = $mysql->conn->Execute($sql);

  if ($rs_es->RecordCount() > 0)
  {
    print "O espaço " . $_POST['espaco'] . " não está disponível\n";
    print "Ele está sendo usado pela proposta " . $rs_es->fields['cod'] . ' - ' . $rs_es->fields['titulo'] . "\n\n";

    exit;
  }
}

# Se a proposta nao estiver (pre)aprovada, retira da grade
switch ($_POST['status'])
{
  case 'r':
  case 'd':
  case 'i':
    $_POST['espaco'] = null;
}

$updateSQL = $mysql->conn->GetUpdateSQL($rs, $_POST);

if ($updateSQL)
{
  if ($mysql->conn->Execute($updateSQL))
  {
    writeLog('propostas.log', "Registro " . $_POST['cod'] . " alterado SQL: $updateSQL");

    header('Location: propostas');
    exit;
  }
  else
  {
    print "Erro atualizando banco de dados.\n\n";
    $erro = $mysql->conn->ErrorNo() . ' - ' . $mysql->conn->ErrorMsg();
    print "$erro\n";
    
    writeLog('propostas.log', 'Erro atualizando banco de dados - registro ' . $_POST['cod'] . " - erro $erro");
  }
}
else
{
  header('Location: propostas');
  exit;
}

?>
