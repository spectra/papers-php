<?

include('include/mysmarty.inc.php');

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

$smarty = new MySmarty;
$smarty->assign('title', 'Alocação de Espaços');

$cod = str_replace('/', '', $_SERVER['PATH_INFO']);
if (! preg_match('/^[0-9]+$/',$cod)) {
  $cod = null;
}

$smarty = new MySmarty;
$mysql = new Mysql;

if ($cod) {
  $proposta = Propostas::encontrar($mysql,$cod);
  if ($proposta['status'] != 'a' &&
      $proposta['status'] != 'p' &&
      $proposta['status'] != 'c') {
    echo "Código inválido.";
    exit;
  }

  
  $smarty->assign('proposta', $proposta);
  $smarty->assign('macrotema', Macrotemas::encontrar($mysql,$proposta['tema']));
  $smarty->assign('pessoa', Pessoas::encontrar($mysql,$proposta['pessoa']));
  $smarty->assign('copalestrantes', Propostas::copalestrantes($mysql,$cod));
  $smarty->assign('mesa', Propostas::mesa($mysql,$cod));
  
  $celulas = Grade::celulas($mysql,$proposta['cod']);
  $smarty->assign('celulas', $celulas);
  
  $smarty->assign('central', 'palestra.tpl');
  $smarty->assign('linkup', 'programacao');
  
  $smarty->display('index.tpl');
} else {
  $dias = Dias::carregar($mysql);
  $smarty->assign('dias', $dias);
  
  $horarios = Horarios::carregar($mysql);
  $smarty->assign('horarios', $horarios);
  
  $salas = Salas::carregarNaoVazias($mysql);
  $smarty->assign('salas', $salas);
  
  $grade = Grade::carregar($mysql);
  $smarty->assign('grade', $grade);
  
  $smarty->assign('urlBase', 'programacao');
  $smarty->assign('admin', null);

  $macrotemas = Macrotemas::carregar($mysql);
  foreach (array_keys($macrotemas) as $tema) {
    $macrotemas[$tema]['cor'] = Grade::cor($macrotemas[$tema]['cod']);
  }
  $smarty->assign('macrotemas', $macrotemas);

  $print = $_GET['print'];
  $nocoord = $_GET['nocoord'];

  $smarty->assign('print',$print);
  $smarty->assign('nocoord',$nocoord);
  
  if ($print) {
    $smarty->display('print.tpl');
  } else {
    $smarty->assign('central', "program.tpl");
    $smarty->display('index.tpl');
  }
  
}
    

?>

