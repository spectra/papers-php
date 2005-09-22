<?

require 'Smarty.class.php';
$smarty = new Smarty;
$smarty->compile_check = true;

include('include/mysql.inc.php');
include('include/basic.inc.php');
include('include/notificacoes.inc.php');
include('include/pessoas.inc.php');

expires(0);

$smarty->assign('title', 'Notificação de proponentes');

$confim = $_GET['confirm'];
$tipo = $_GET['tipo'];

function tipo2template($tipo,$language) {
  if ($tipo == 'a') {
    return "acceptedNotification.$language.tpl";
  } elseif ($tipo == 's') {
    return "standByNotification.$language.tpl";
  } elseif ($tipo == 'r') {
    return "rejectedNotification.$language.tpl";
  } elseif ($tipo == 'p') {
    return "prorrogatedNotification.$language.tpl";
  } elseif ($tipo == 'd') {
    return "giveupNotification.$language.tpl";
  } elseif ($tipo == 'n') {
    return "newlyApprovedNotification.$language.tpl";
  } elseif ($tipo == 'c') {
    return "inviteesNotification.$language.tpl";
  } elseif ($tipo == 'm') {
    return "chairNotification.pt-br.tpl";
  }
}

function tipo2propostas($tipo) {
  $mysql = new Mysql;
  if ($tipo == 'a') {
    return Notificacoes::aprovadas($mysql);
  } elseif ($tipo == 's') {
    return Notificacoes::recusadas($mysql);
  } elseif ($tipo == 'r') {
    return Notificacoes::recusadas($mysql);
  } elseif ($tipo == 'p') {
    return Notificacoes::prorrogadas($mysql);
  } elseif ($tipo == 'd') {
    return Notificacoes::desistencias($mysql);
  } elseif ($tipo == 'n') {
    return Notificacoes::novas_aprovadas($mysql);
  } elseif ($tipo == 'c') {
    return Notificacoes::convidados($mysql);
  } elseif ($tipo == 'm') {
    return Notificacoes::coordenadoresDeMesa($mysql);
  }
}

function tipo2subject($tipo,$cod) {
  if ($tipo == 'm') {
    return "Coordenação de mesa no FISL";
  } else {
    return ($language=='pt')?"Sua proposta de palestra no FISL ($cod)":"Your lecture proposal for FISL ($cod)";
  }
}

if ($confim && $tipo) {

  $headers = "Content-type: text/plain; charset=iso-8859-1\nFrom: temario@softwarelivre.org";

  $propostas = tipo2propostas($tipo);

  $mysql2 = new Mysql;
  $smarty2 = new Smarty;

  foreach ($propostas as $pr => $proposta) {
    $to = $proposta['email'];
    $cod = $proposta['cod'];
    $name = $proposta['name'];
    $title = $proposta['title'];

    $language = ($proposta['language']=='pt')?'pt':'en';
    $subject = tipo2subject($tipo,$cod);
    
    $smarty2->assign('name', $name);
    $smarty2->assign('title', $title);
    $smarty2->assign('cod', $cod);

    // gerar uma senha para os convidados
    if ($tipo == 'c') {
      $passwd = Pessoas::newPassword($mysql2, $proposta['pcod']);
      $smarty2->assign('senha', $passwd);
    }

    $propostas[$pr]['notificacaoOk'] = mail($to, $subject, $smarty2->fetch(tipo2template($tipo,$language)), $headers);
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
