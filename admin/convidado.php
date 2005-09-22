<?

require 'Smarty.class.php';
$smarty = new Smarty;
$smarty->assign('central','convidado.tpl');
$smarty->assign('linkup','.');
$smarty->display('index.tpl');

?>
