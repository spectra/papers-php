<?

require 'Smarty.class.php';
$smarty = new Smarty;
$smarty->compile_check = true;

include('include/mysql.inc.php');
include('include/basic.inc.php');
include('include/avaliacoes.inc.php');
include('include/macrotemas.inc.php');
include('include/propostas.inc.php');

expires(0);

$mysql = new Mysql;

$macrotemas = Macrotemas::carregar($mysql);
foreach ($macrotemas as $macrotema) {
  $mt = $macrotema['cod'];
  $propostas[$mt] = Avaliacoes::ranking($mysql, $mt);

  $aprovadas[$mt] = Avaliacoes::aprovadas($mysql, $mt);
  $recusadas[$mt] = Avaliacoes::recusadas($mysql, $mt);

  $numeroDeAprovadas[$mt] = Propostas::aprovadasPorMacrotema($mysql, $mt);

  $ranking[$mt] = Avaliacoes::ranking_todas($mysql, $mt);
}

$smarty->assign('macrotemas', $macrotemas);
$smarty->assign('propostas', $propostas);
$smarty->assign('aprovadas', $aprovadas);
$smarty->assign('recusadas', $recusadas);
$smarty->assign('numeroDeAprovadas', $numeroDeAprovadas);
$smarty->assign('central', 'fecharAvaliacao.tpl');
$smarty->assign('linkup', '.');

$smarty->assign('status', $STATUS_DESCRIPTIONS);

$smarty->assign('ranking', $ranking);
$smarty->register_function('ranking_position', 'ranking_position_smarty');

function ranking_position_smarty($params) {
  extract($params);
  return Avaliacoes::ranking_position($ranking_array, $proposta);
}

$smarty->display('index.tpl');

?>
