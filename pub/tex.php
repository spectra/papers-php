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


$columns = count($salas);
$colwidth = 0.80 / $columns; // 20% reserved
$colwidthtext = 'p{' . $colwidth . '\textwidth}';

echo "% be sure to include the multirow LaTeX package!\n";

foreach ($dias as $dia) {
  echo '\startday{' . $dia['descricao'] . '}' . "\n";
  echo '\begin{tabular}{|c' . str_repeat('|' . $colwidthtext , $columns) . "|}\n";
  //echo 'Horário';
  foreach ($salas as $sala) {
    echo ' & ';
    echo $sala['descricao'];
  }
  echo "\\\\\n";
  echo "\\hline\\\\\n";
  
  foreach ($horarios as $horario) {
    echo '\talktime{' . $horario['inicio'] . '}';
    foreach ($salas as $sala) {
      $celula = $grade[$dia['numero']][$sala['numero']][$horario['numero']];
      echo ' & ';
      if ($celula['macrotema']) { 
        echo '\track{' . $celula['macrotema'] . '}';
      }
      echo ' \talk{' . preg_replace('/&/', '\&', $celula['titulo']) . '}';
      if ($celula['nome']) {
        echo '\person{' . $celula['nome'] . '}';
      }
      foreach ($celula['copalestrantes'] as $person) {
        echo '\person{' . $person['nome'] . '}';
      }
    }
    echo "\\\\\n";
    echo "\\hline\\\\\n";
  }
  echo '\end{tabular}' . "\n";
}

?>

