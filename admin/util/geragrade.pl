#!/usr/bin/perl

$espaco = $ARGV[0] or $espaco = 1;

$hora[1] = '8h00&nbsp;~&nbsp;9h00';
$hora[2] = '8h15&nbsp;~&nbsp;9h15';
$hora[3] = '9h15&nbsp;~&nbsp;10h15';
$hora[4] = '9h30&nbsp;~&nbsp;10h30';
$hora[5] = '10h30&nbsp;~&nbsp;11h30';
$hora[6] = '10h45&nbsp;~&nbsp;11h45';
$hora[7] = '11h45&nbsp;~&nbsp;12h45';
$hora[8] = '12h00&nbsp;~&nbsp;13h00';
$hora[9] = '14h00&nbsp;~&nbsp;15h00';
$hora[10] = '14h15&nbsp;~&nbsp;15h15';
$hora[11] = '15h15&nbsp;~&nbsp;16h15';
$hora[12] = '15h30&nbsp;~&nbsp;16h30';
$hora[13] = '16h30&nbsp;~&nbsp;17h30';
$hora[14] = '16h45&nbsp;~&nbsp;17h45';
$hora[15] = '17h45&nbsp;~&nbsp;18h45';
$hora[16] = '18h00&nbsp;~&nbsp;19h00';
$hora[17] = '19h00&nbsp;~&nbsp;20h00';
$hora[18] = '19h15&nbsp;~&nbsp;20h15';

print "<table width='100%' style='border: 1px solid black'>\n";

print "<tr bgcolor='#cccccc'>\n";
print " <th></th>\n";
print " <th>Sala 1</th>\n";
print " <th>Sala 2</th>\n";
print " <th>Sala 3</th>\n";
print " <th>Sala 4</th>\n";
print " <th>Sala 5</th>\n";
print " <th>Sala 6</th>\n";
print "</tr>\n";

for ($i = 1; $i <= 18; $i++)
{
  print "<tr>\n";

  print " <td>" . $hora[$i] . "</td>\n";

  if ($i % 2)
  {
    for ($x = 1; $x <= 3; $x++)
    {
      print "  <td bgcolor='{\$grade.$espaco.bgcolor}'>$espaco<br><a href='proposta/{\$grade.$espaco.cod}'>{\$grade.$espaco.titulo}</a><br><span class='xsmall'>{\$grade.$espaco.nome}</span></td>\n";
      $espaco++;
      print "  <td bgcolor='#eeeeee'></td>\n";
    }
  }
  else
  {
    for ($x = 1; $x <= 3; $x++)
    {
      print "  <td bgcolor='#eeeeee'></td>\n";
      print "  <td bgcolor='{\$grade.$espaco.bgcolor}'>$espaco<br><a href='proposta/{\$grade.$espaco.cod}'>{\$grade.$espaco.titulo}</a><br><span class='xsmall'>{\$grade.$espaco.nome}</span></td>\n";
      $espaco++;
    }
  }

  print "</tr>\n";
}

print "</table>\n";
