<?

require 'include/mysmarty.inc.php';
$smarty = new Smarty;
$smarty->compile_check = true;

include('include/mysql.inc.php');
include('include/basic.inc.php');
include('include/grade.inc.php');

expires(0);

$mysql = new Mysql;

$conflitos = Grade::conflitos($mysql);

$smarty->assign('central', 'relatorioConflitos.tpl');
$smarty->assign('conflitos', $conflitos);

$smarty->assign('linkup', '.');

$smarty->display('index.tpl');

?>
