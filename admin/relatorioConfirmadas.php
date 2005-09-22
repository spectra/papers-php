<?

require 'Smarty.class.php';
$smarty = new Smarty;
$smarty->compile_check = true;

include('include/mysql.inc.php');
include('include/basic.inc.php');
include('include/avaliacoes.inc.php');
include('include/macrotemas.inc.php');

expires(0);

$mysql = new Mysql;

$n_confirmadas = 0;

$macrotemas = Macrotemas::carregar($mysql);
foreach ($macrotemas as $macrotema) {
  $mt = $macrotema['cod'];
  $confirmadas[$mt] = Avaliacoes::confirmadas($mysql, $mt);
  $n_confirmadas += count($confirmadas[$mt]);
}

$smarty->assign('n_confirmadas', $n_confirmadas);
$smarty->assign('macrotemas', $macrotemas);
$smarty->assign('confirmadas', $confirmadas);
$smarty->assign('central', 'relatorioConfirmadas.tpl');
$smarty->assign('linkup', '.');

$smarty->display('index.tpl');

?>
