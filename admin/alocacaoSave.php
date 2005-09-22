<?

include('include/mysql.inc.php');
include('include/basic.inc.php');
include('include/grade.inc.php');

expires(0);
$mysql = new Mysql;

$acao = $_GET['acao'];

if ($acao == 'remover') {
  $cods = split(',', $_GET['celula']);
  Grade::limpar($mysql, $cods[0],$cods[1],$cods[2]);
}

if ($acao == 'incluir') {
  $cods = split(',', $_GET['celula']);
  $proposta = $_GET['proposta'];
  Grade::alocar($mysql, $cods[0], $cods[1], $cods[2], $proposta);
}

if ($acao == 'mover') {
  $cods = split(',', $_GET['celula']);
  $proposta = $_GET['proposta'];
  Grade::limpar($mysql, $cods[0],$cods[1],$cods[2]);
  header("Location: alocacao/$proposta?force=1");
  exit;
}

header("Location: alocacao");

?>
