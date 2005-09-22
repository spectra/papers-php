<?

require 'Smarty.class.php';
$smarty = new Smarty;
$smarty->compile_check = true;

include('include/mysql.inc.php');
include('include/basic.inc.php');
include('include/press.inc.php');

expires(0);

$mysql = new Mysql;
$press = Press::loadUnmoderated($mysql);

$acao = $_GET['acao'];
$cod = $_GET['cod'];

if ($acao == "aprovar") {
  Press::moderate($mysql, $cod);
  header('Location: press');
  exit;
}
if ($acao == "remover") {
  Press::remove($mysql, $cod);
  header('Location: press');
  exit;
}

$smarty->assign('title','Moderar imprensa');
$smarty->assign('press', $press);
$smarty->assign('central', 'press.tpl');
$smarty->display('index.tpl');

?>
