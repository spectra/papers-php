<?

require 'include/mysmarty.inc.php';
require 'include/mysql.inc.php';
require 'include/macrotemas.inc.php';
require 'include/pessoas.inc.php';

$smarty = new Smarty;
$mysql = new Mysql;

$smarty->assign('macrotemas', Macrotemas::carregar($mysql));
$smarty->assign('linkup','.');

$select = $_GET['select'];
if ($select =='yes') {
  $smarty->assign('central', 'convidado_escolher.tpl');
  $smarty->assign('pessoas', Pessoas::carregar($mysql));
}
if ($select == 'no') {
  $smarty->assign('central','convidado.tpl');
  if ($_GET['cod']) {
    $smarty->assign('pessoa', Pessoas::encontrar($mysql, $_GET['cod']));
  }
}
if (!$select) {
  $smarty->assign('central', 'convidado_escolher_ou_nao.tpl');
}

$smarty->display('index.tpl');

?>
