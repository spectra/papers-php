<?

require 'include/mysmarty.inc.php';
$smarty = new Smarty;
$smarty->compile_check = true;

include('include/mysql.inc.php');
include('include/basic.inc.php');
include('include/propostas.inc.php');
include('include/macrotemas.inc.php');
include('include/grade.inc.php');
include('include/pessoas.inc.php');
include('include/dias.inc.php');
include('include/horarios.inc.php');
include('include/salas.inc.php');


expires(0);

$smarty->assign('title', 'Alocação de Espaços');

$cod = str_replace('/', '', $_SERVER['PATH_INFO']);

$mysql = new Mysql;
$force = $_GET['force'];

if ($cod) {
  // Alocar uma proposta
  if (Grade::estahAlocada($mysql,$cod) && (! $force)) {
    // já alocada, mostrar informações
    $proposta = Propostas::encontrar($mysql,$cod);
    $smarty->assign('proposta', $proposta);
    $smarty->assign('macrotema', Macrotemas::encontrar($mysql,$proposta['tema']));
    $smarty->assign('pessoa', Pessoas::encontrar($mysql,$proposta['pessoa']));
    $celulas = Grade::celulas($mysql,$proposta['cod']);
    $smarty->assign('celulas', $celulas);
    $smarty->assign('linkup', 'alocacao');
    $smarty->assign('central', 'alocacao_ver.tpl');
    $smarty->display('index.tpl');
    
  } else {
    //escolher onde alocar    
    $proposta = Propostas::encontrar($mysql,$cod);
    $smarty->assign('proposta', $proposta);
    $macrotema = Macrotemas::encontrar($mysql,$proposta['tema']);
    $smarty->assign('macrotema', $macrotema);
    $pessoa = Pessoas::encontrar($mysql, $proposta['pessoa']);
    $smarty->assign('pessoa',$pessoa);

    $dias = Dias::carregar($mysql);
    $smarty->assign('dias', $dias);
    
    $horarios = Horarios::carregar($mysql);
    $smarty->assign('horarios', $horarios);
    
    $salas = Salas::carregar($mysql);
    $smarty->assign('salas', $salas);
    
    $grade = Grade::carregar($mysql);
    $smarty->assign('grade', $grade);
    
    $smarty->assign('central', 'grade.tpl');
    $smarty->assign('insert', TRUE);
    $smarty->assign('linkup','alocacao');
    $smarty->assign('urlBase', 'proposta');
    $smarty->display('index.tpl');
  }
} else {
  // Listar propostas para alocar

  $macrotemas = Macrotemas::carregar($mysql);
  $propostas = Propostas::carregarPorMacrotemaParaAlocacao($mysql);

  $alocadas = Grade::alocadas($mysql);

  $confirmacoes = Propostas::confirmacoesPorMacrotema($mysql);

  $smarty->assign('macrotemas', $macrotemas);
  $smarty->assign('propostas', $propostas);
  $smarty->assign('alocadas', $alocadas);
  $smarty->assign('confirmacoes', $confirmacoes);

  $smarty->assign('central', 'alocacao.tpl');
  $smarty->assign('linkup', '.');
  $smarty->display('index.tpl');
}

?>

