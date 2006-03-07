<?
  require 'include/mysmarty.inc.php';
  $smarty = new MySmarty;
  $smarty->assign('central','pressRegistration.tpl');
  $smarty->display('index.tpl');
?>
