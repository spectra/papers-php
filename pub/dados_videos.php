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

header('Content-Type: text/plain; charset=utf8');
expires(0);
$mysql = new Mysql;

function track($t) {
  echo '\track{' . $t . "}\n";
}

function person($name, $email) {
  echo '\name{' . $name . '}';
  if ($name != $email) {
    echo '\email{' . $email . '}';
  }
  echo "\n";
}

function escape($text) {

  $t = preg_replace('/&/', '\&', $text);
  $t = preg_replace('/%/', '\%', $t);
  $t = preg_replace('/\$/', '\$', $t);
  $t = str_replace('\\', '', $t);
  return $t;

}

function p($text, $field) {
  $text = preg_replace("/^[ \t\n]/", "", $text);
  echo($field . ': ' . utf8_encode(escape($text)));
  echo("\n");
}

function ascii7bitfilename($text) {

   $filename = preg_replace('/[�����]/', 'a', $text);
   $filename = preg_replace('/[����]/', 'e', $filename);
   $filename = preg_replace('/[����]/', 'i', $filename);
   $filename = preg_replace('/[�����]/', 'o', $filename);
   $filename = preg_replace('/[����]/', 'u', $filename);
   $filename = preg_replace('/[�]/', 'c', $filename);

   $filename = preg_replace('/[�����]/', 'A', $filename);
   $filename = preg_replace('/[����]/', 'E', $filename);
   $filename = preg_replace('/[����]/', 'I', $filename);
   $filename = preg_replace('/[�����]/', 'O', $filename);
   $filename = preg_replace('/[����]/', 'U', $filename);
   $filename = preg_replace('/[�]/', 'C', $filename);
   
   $filename = preg_replace('/[�]/', 'o', $filename);
   $filename = preg_replace('/[�]/', 'o', $filename);
   $filename = preg_replace('/[�]/', 'a', $filename);
   
   $filename = preg_replace('/[ ,:.\'"\/?!()]/', '_', $filename);

   return $filename;
}

function abst($text) {

  $a = $text;

  $a = wordwrap($a, 60, "\n");

  $a = preg_replace('/\n/', "\n ", $a);

  return $a;
}


$resumos = Propostas::resumosAnais($mysql);

foreach($resumos as $palestra) {

  if (preg_match('/^(WSL|Organ)/',$palestra['macrotema'])) {
    continue;
  }

  $titulo = preg_replace('/^[ \t\n]*/', '', $palestra['titulo']);

  p($palestra['cod'], 'Code');

  p($titulo, 'Title');

  p($palestra['sala'][0], 'Room');
  p($palestra['dia'][0], 'Day');
  p($palestra['horario'][0], 'Time');
  
  p($palestra['macrotema'], 'Track');
  
  p($palestra['nome'], 'Speaker');

  $filename = $palestra['nome'];

  foreach($palestra['copalestrantes'] as $cop) {
    p($cop['nome'], 'Speaker');
    $filename = $filename . '+' . $cop['nome'];
  }

  $filename = $filename . '-' . $titulo;

  p(ascii7bitfilename($filename) . '.ogg', 'Filename');

  p(abst($palestra['resumo']), 'Abstract');

  echo("\n"); // linha vazia


  //($palestra['resumo']);
  
}


?>

