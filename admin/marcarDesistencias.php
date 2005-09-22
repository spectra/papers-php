<?

require 'Smarty.class.php';
$smarty = new Smarty;
$smarty->compile_check = true;

include('include/mysql.inc.php');
include('include/basic.inc.php');
include('include/notificacoes.inc.php');

expires(0);

$mysql = new Mysql;

$desistencias = Notificacoes::desistencias($mysql);

$smarty->assign('macrotemas', $macrotemas);
$smarty->assign('desistencias', $desistencias);
$smarty->assign('central', 'marcarDesistencias.tpl');
$smarty->assign('linkup', '.');

$smarty->display('index.tpl');

?>
