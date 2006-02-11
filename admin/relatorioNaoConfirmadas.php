<?

require 'Smarty.class.php';
$smarty = new Smarty;
$smarty->compile_check = true;

include('include/mysql.inc.php');
include('include/basic.inc.php');
include('include/propostas.inc.php');

expires(0);

$mysql = new Mysql;

$smarty->assign('central', 'relatorioNaoConfirmadas.tpl');
$smarty->assign('propostas', Propostas::naoConfirmadas($mysql) );

$smarty->assign('linkup', '.');

$smarty->display('index.tpl');

?>
