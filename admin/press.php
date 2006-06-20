<?

require 'include/mysmarty.inc.php';
$smarty = new Smarty;
$smarty->compile_check = true;

include('include/mysql.inc.php');
include('include/basic.inc.php');
include('include/press.inc.php');

expires(0);

$mysql = new Mysql;
$press = Press::loadUnmoderated($mysql);
$pressModerated = Press::loadModerated($mysql);#mach

$acao = $_GET['acao'];
$cod = $_GET['cod'];

if ($acao == "aprovar") {
  Press::moderate($mysql, $cod);
  header('Location: press');
  exit;
}
if ($acao == "reprovar") {
  Press::unmoderate($mysql, $cod);
  header('Location: press');
  exit;
}
if ($acao == "remover") {
  Press::remove($mysql, $cod);
  header('Location: press');
  exit;
}
if ($acao == "editar") {

  $pressPerson = Press::find($mysql, $cod);
  $smarty->assign('title', 'Editar imprensa');
  $smarty->assign('central', 'press-edit.tpl');
  $smarty->assign('pressPerson', $pressPerson);
  $smarty->assign('linkup', 'press');
  $smarty->display('index.tpl');
  exit;
}

$smarty->assign('title','Moderar imprensa');
$smarty->assign('press', $press);
$smarty->assign('pressModerated', $pressModerated);
$smarty->assign('central', 'press.tpl');
$smarty->assign('linkup', '.');
$smarty->display('index.tpl');

?>
