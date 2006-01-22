<?

require 'Smarty.class.php';
$smarty = new Smarty;
$smarty->compile_check = true;

include('include/mysql.inc.php');
include('include/basic.inc.php');
include('include/notificacoes.inc.php');
include('include/pessoas.inc.php');
include('include/config.inc.php');

expires(0);

$smarty->assign('title', 'Notificação de proponentes');

$confim = $_POST['confirm'];
$tipo = $_POST['tipo'];
$texto = $_POST['texto'];

function tipo2propostas($tipo) {
  $mysql = new Mysql;
  if ($tipo == 'aceitas') {
    return Notificacoes::aprovadas($mysql);
  } elseif ($tipo == 'recusadas') {
    return Notificacoes::recusadas($mysql);
  } elseif ($tipo == 'nao_confirmadas') {
    return Notificacoes::aceitas_nao_confirmadas($mysql);
  }
}

function tipo2subject($tipo,$cod,$language) {
  global $papers;
  return $papers['event']['codename'] . (($language=='pt')?": sua proposta de palestra ($cod)":": your lecture proposal ($cod)");
}

function gerarMensagem($cod,$titulo,$nome,$template) {
  $msg = stripslashes($template);
  $msg = preg_replace('/\$cod/',$cod,$msg);
  $msg = preg_replace('/\$titulo/',$titulo,$msg);
  $msg = preg_replace('/\$nome/',$nome,$msg);
  return $msg;
}

if ($confim && $tipo && $texto) {

  $headers = "Content-type: text/plain; charset=iso-8859-1\nFrom: temario@softwarelivre.org";

  $propostas = tipo2propostas($tipo);

  $mysql2 = new Mysql;

  foreach ($propostas as $pr => $proposta) {
    $to = $proposta['email'];
    $cod = $proposta['cod'];
    $name = $proposta['name'];
    $title = $proposta['title'];

    $language = ($proposta['language']=='pt')?'pt':'en';
    $subject = tipo2subject($tipo,$cod,$language);
    

    $propostas[$pr]['notificacaoOk'] = mail($to, $subject, gerarMensagem($cod,$title,$name,$texto), $headers);
  }
  
  $smarty->assign('tipo', $tipo);
  $smarty->assign('propostas', $propostas);


  $smarty->assign('central', 'notificacaoEnviada.tpl');
  $smarty->assign('linkup', 'notificacao');
} else {
  $smarty->assign('central', 'confirmarNotificacao.tpl');
  $smarty->assign('linkup', '.');
}

$smarty->display('index.tpl');

?>
