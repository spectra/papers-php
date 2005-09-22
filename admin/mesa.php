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
    Propostas::removerMesa($mysql, $cod, $pessoa);
    header('Location: ' . $cod);
    exit;
  }
  if ($acao == 'incluir') {
    Propostas::incluirMesa($mysql, $cod, $pessoa);
    header('Location: ' . $cod);
    exit;
  }

} else {

  $proposta = Propostas::encontrar($mysql, $cod);
  $smarty->assign('proposta', $proposta);

  if ($acao == 'adicionar') {
    $smarty->assign('title', 'Incluir coordenador de mesa para"' . $proposta['titulo'] . '"');
    $smarty->assign('linkup', 'mesa/'. $cod);
    $smarty->assign('central', 'mesa_adicionar.tpl');
    $smarty->display('index.tpl');
    exit;
  }

  if ($acao == 'escolher') {
    $smarty->assign('pessoas', Pessoas::carregar($mysql));
  
    $smarty->assign('title', 'Adicionar coordenador de mesa a "' . $proposta['titulo'] . '"');
    $smarty->assign('linkup', 'mesa/'. $cod);
    $smarty->assign('central', 'mesa_escolher.tpl');
    $smarty->display('index.tpl');
    exit;
  }

  $mesa = Propostas::mesa($mysql, $cod);
  $smarty->assign('mesa', $mesa);

  $smarty->assign('title', 'Coordenação de mesa de "' . $proposta['titulo'] . '"');
  $smarty->assign('central','mesa.tpl');
  $smarty->assign('linkup', 'proposta/' . $cod);
  $smarty->display('index.tpl');
}

?>
