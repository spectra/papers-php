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
$colwidthtext = 'p{\programcolwidth}';

echo "% be sure to include the multirow LaTeX package!\n";

foreach ($dias as $dia) {
  echo '\startday{' . $dia['descricao'] . '}' . "\n";
  echo '\begin{tabular}{|c' . str_repeat('|' . $colwidthtext , $columns) . "|}\n";
  //echo 'Horário';
  echo "\\hline\n";
  foreach ($salas as $sala) {
    echo ' & ';
    echo $sala['descricao'];
  }
  echo "\\\\\n";
  echo "\\hline\n";

  foreach ($horarios as $horario) {

    // check if there are talks at that time.
    $found = 0;
    foreach ($salas as $sala) {
      if ($grade[$dia['numero']][$sala['numero']][$horario['numero']]) {
        $found = 1;
        break;
      }
    }
    if (! $found) {
      continue;
    }
  
    echo '\talktime{' . $horario['inicio'] . '}';
    foreach ($salas as $sala) {
      $celula = $grade[$dia['numero']][$sala['numero']][$horario['numero']];
      echo ' & ';
      echo '\begin{center}';
      if ($celula['macrotema']) { 
        echo '\track{' . $celula['macrotema'] . '}';
      }

      $title = preg_replace('/&/', '\&', $celula['titulo']);
      $title = preg_replace('/%/', '\%', $title);
      
      echo ' \talk{' . $title . '}';
      
      if ($celula['nome']) {
        echo '\person{' . $celula['nome'] . '}';
      }
      foreach ($celula['copalestrantes'] as $person) {
        echo '\person{' . $person['nome'] . '}';
      }
      echo '\end{center}';
    }
    echo "\\\\\n";
    echo "\\hline\n";
  }
  echo '\end{tabular}' . "\n";
}

?>

