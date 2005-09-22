<?

include('include/mysql.inc.php');
include('include/basic.inc.php');
include('include/pessoas.inc.php');
include('include/propostas.inc.php');

require 'Smarty.class.php';
$smarty = new Smarty;
$smarty->compile_check = true;
# $smarty->debugging = true;

expires(0);
header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');

$mysql = new Mysql;

$cod = str_replace('/','',$_SERVER['PATH_INFO']);

if (preg_match('/([0-9]+),([0-9]+)/',$cod,$matches)) {
  $cod = $matches[1];
  $pessoa = $matches[2];
}
$acao = $_GET['acao'];

if ($pessoa) {

  if ($acao == 'remover') {
    Propostas::removerCopalestrante($mysql, $cod, $pessoa);
    header('Location: ' . $cod);
    exit;
  }
  if ($acao == 'incluir') {
    Propostas::incluirCopalestrante($mysql, $cod, $pessoa);
    header('Location: ' . $cod);
    exit;
  }


} else {

  $proposta = Propostas::encontrar($mysql, $cod);
  $smarty->assign('proposta', $proposta);

  if ($acao == 'adicionar') {
    $smarty->assign('title', 'Incluir copalestrante para "' . $proposta['titulo'] . '"');
    $smarty->assign('linkup', 'copalestrantes/'. $cod);
    $smarty->assign('central', 'copalestrante.tpl');
    $smarty->display('index.tpl');
    exit;
  }

  if ($acao == 'escolher') {
    $smarty->assign('pessoas', Pessoas::carregar($mysql));
  
    $smarty->assign('title', 'Adicionar copalestrantes a "' . $proposta['titulo'] . '"');
    $smarty->assign('linkup', 'copalestrantes/'. $cod);
    $smarty->assign('central', 'copalestrantes_escolher.tpl');
    $smarty->display('index.tpl');
    exit;
  }

  $copalestrantes = Propostas::copalestrantes($mysql,$cod);
  $smarty->assign('copalestrantes', $copalestrantes);

  $smarty->assign('title', 'Copalestrantes de "' . $proposta['titulo'] . '"');
  $smarty->assign('central','copalestrantes.tpl');
  $smarty->assign('linkup', 'proposta/' . $cod);
  $smarty->display('index.tpl');
}

?>
