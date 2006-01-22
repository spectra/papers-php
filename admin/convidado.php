<?

require 'Smarty.class.php';
require 'include/mysql.inc.php';
require 'include/macrotemas.inc.php';

$smarty = new Smarty;
$mysql = new Mysql;

$smarty->assign('macrotemas', Macrotemas::carregar($mysql));
$smarty->assign('central','convidado.tpl');
$smarty->assign('linkup','.');

$smarty->display('index.tpl');

?>
