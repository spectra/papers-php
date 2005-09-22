<html>
  <head>
    <title>teste</title>
    <style type="text/css">
      table.grade {
        width: 100%;
      }
    
      table.grade td,
      table.grade th {
        font-size: x-small;
        width: 60px;
        border-spacing: 0;
      }
    
      table.grade td {
        border: 1px;
      }
      
      
      table.grade td a:link,
      table.grade td a:visited {
        display: block;
        background: #f0f0f0;
        text-decoration: none;
      }
      
      table.grade td a:hover {
        background: #f09999;
      }

      table.grade th,
      table.grade th a:link,
      table.grade th a:visited
      {
        background: #b0b0b0;
      }
      
    </style>
  </head>
  <body>
<?

  $dias = 3;
  $salas = 6;
  $horarios = 10;

  echo "<table class='grade'>\n<tr>\n";

  for ($dia = 1; $dia <= $dias; $dia++) {
    echo "<td>\n";
    echo "<table class='grade'>\n<tr><th colspan='$salas'>Dia $dia</th></tr>\n";

    echo "<tr>\n";
    for ($sala = 1; $sala <= $salas; $sala++) {
      echo "<th><a href='sala/$sala'>s$sala</a></th>";
    }
    echo "</tr>";
    
    for ($horario = 1; $horario <= $horarios; $horario++) {
      echo "<tr>\n";
      for ($sala = 1; $sala <= $salas; $sala++) {
        echo "<td>";
        echo "<a href='$dia,$sala,$horario'>&nbsp;</a>";
        echo "</td>";
      }
      echo "</tr>\n";
    }
    echo "</table>";
    echo "</td>\n";
  }

  echo "</tr>\n</table>\n";


?>
  </body>
</html>
