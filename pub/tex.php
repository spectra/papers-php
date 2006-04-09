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

function cline($col) {
  echo '\cline{' . $col . '-' . $col . '}' . "\n";
}

function comment($text) {
  echo '% ' . $text . "\n";
}

function hline() {
  echo "\\hline\n";
}

function linebreak() {
  echo "\\\\\n";
}

header('Content-Type: text/plain');

$columns = count($salas);
$colwidthtext = 'p{\programcolwidth}';

echo "% be sure to include the multirow LaTeX package!\n";

foreach ($dias as $dia) {
  echo '\startday{' . $dia['descricao'] . '}' . "\n";
  echo '\begin{tabular}{|c' . str_repeat('|' . $colwidthtext , $columns) . "|}\n";
  //echo 'Horário';
  hline();
  foreach ($salas as $sala) {
    echo ' & ';
    echo '\room{' . $sala['descricao'] . '}';
  }
  linebreak();
  hline();

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

    echo '\talktime{' . $horario['inicio'] . '}' . "\n";
    
    $last = array();
    $col = 1;
    $last[$col] = 'true'; // column one is the time column

    foreach ($salas as $sala) {
      $col++;
    
      $celula = $grade[$dia['numero']][$sala['numero']][$horario['numero']];
      echo '&' . "\n";

      // empty cells:
      if (! $celula) {
        $last[$col] = true; // draw a line below
      } else {
        if ($celula['dumb']) {

          if (isset($grade[$dia['numero']][$sala['numero']][$horario['numero'] + 1]) && $grade[$dia['numero']][$sala['numero']][$horario['numero']+1]['cod'] == $celula['cod']) {
            $last[$col] = false; // don't draw a line, next row is the same thing
          } else {
            $last[$col] = true; // draw a line, next row is another thing
          }
        
        } else {
          if ($celula['num'] > 1) {
            // start of a multirow cell
            echo '\multirow{' . $celula['num'] . '}{*}{\parbox{\programcolwidth}{\vspace{1em}' . "\n";
            $last[$col] = false;
          } else {
            // not a multirow cell, draw a line below
            $last[$col] = true;
          }
        }
      }

      if ($last[$col]) {
        comment("Col $col has a line below it!");
      } else {
        comment("Col $col does NOT have a line below it!");
      }
      
      if (!$celula || $celula['dumb']) {
        echo "~\n";
        continue;
      }
     
      // start of cell content
      echo '\begin{center}' . "\n";
      
      if ($celula['macrotema']) { 
        echo '\track{' . $celula['macrotema'] . '}' . "\n";
      }

      $title = preg_replace('/&/', '\&', $celula['titulo']);
      $title = preg_replace('/%/', '\%', $title);
      
      echo '\talk{' . $title . '}' . "\n";
      
      if ($celula['nome']) {
        echo '\person{' . $celula['nome'] . '}' . "\n";
      }
      foreach ($celula['copalestrantes'] as $person) {
        echo '\person{' . $person['nome'] . '}' . "\n";
      }
      echo '\programendcell' . "\n";
      echo '\end{center}' . "\n";
      // end of cell content

      // end of multirow cell
      if ((! $celula['dumb']) && ($celula['num'] > 1)) {
        echo '}}' . "\n";
      }
    }
    linebreak();

    // print bottom lines of rows
    // ...
    for($c = 1; $c <= $col; $c++) {
      if ($last[$c]) {
        cline($c);
      }
    }
  }
  echo '\end{tabular}' . "\n";
}

?>

