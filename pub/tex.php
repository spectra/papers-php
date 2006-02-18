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
$mysql = new Mysql;
$dias = Dias::carregar($mysql);
$horarios = Horarios::carregar($mysql);
$salas = Salas::carregarNaoVazias($mysql);
$grade = Grade::carregar($mysql);

header('Content-Type: text/plain');

echo "% be sure to include the multirow LaTeX package!\n";

foreach ($dias as $dia) {
  echo '\startday{' . $dia['descricao'] . '}' . "\n";
  echo '\begin{tabular}{' . str_repeat('|c',count($salas) + 1) . "|}\n";
  echo 'Horário';
  foreach ($salas as $sala) {
    echo ' & ';
    echo $sala['descricao'];
  }
  echo '\\\\' . "\n";
  
  foreach ($horarios as $horario) {
    echo $horario['inicio'];
    foreach ($salas as $sala) {
      $celula = $grade[$dia['numero']][$sala['numero']][$horario['numero']];
      echo ' & ' . $celula['titulo'];
    }
    echo "\\\\\n";
  }
  echo '\end{tabular}' . "\n";
}

?>

