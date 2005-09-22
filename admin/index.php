<?

# $Id$

require 'Smarty.class.php';
$smarty = new Smarty;
$smarty->compile_check = true;
$smarty->debugging = false;

include('include/mysql.inc.php');
include('include/basic.inc.php');

expires(0);

$smarty->assign('central', 'menu.tpl');

$smarty->display('index.tpl');

?>
