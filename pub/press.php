<?

require 'include/mysmarty.inc.php';
$smarty = new Smarty;
$smarty->compile_check = true;
include('include/mysql.inc.php');
include('include/basic.inc.php');
include('include/press.inc.php');

$mysql = new Mysql;
$press = Press::loadForPublish($mysql);

$smarty->assign('central', 'press.tpl');
$smarty->assign('press', $press);
$smarty->assign('linkup','/');
$smarty->display('index.tpl');


?>
