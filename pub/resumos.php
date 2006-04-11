<?

require 'Smarty.class.php';
$smarty = new Smarty;
$smarty->compile_check = true;

include('include/mysql.inc.php');
include('include/basic.inc.php');
include('include/propostas.inc.php');
include('include/macrotemas.inc.php');
include('include/grade.inc.php');
include('include/pessoas.inc.php');

header('Content-Type: text/plain');
expires(0);
$smarty->assign('title', 'Alocação de Espaços');
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
  return $t;

}

function abst($text) {
  if (trim($text) == "") {
    echo '\vspace{1em}' . "\n";
    return;
  }

  echo '\talkabstract{' . "\n";

  echo escape($text);
  echo "\n";

  echo '}' . "\n";
}

function title($text) {
  echo '\talktitle{' . escape($text) . '}' . "\n";
}

$resumos = Propostas::resumosAnais($mysql);

foreach($resumos as $palestra) {

  if (preg_match('/^(WSL|Organ)/',$palestra['macrotema'])) {
    continue;
  }

  echo '\begin{talkabstractblock}' . "\n";
  
  title($palestra['titulo']);
  track($palestra['macrotema']);
  person($palestra['nome'], $palestra['email']);
  foreach($palestra['copalestrantes'] as $cop) {
    person($cop['nome'], $cop['email']);
  }
  abst($palestra['resumo']);

  echo '\end{talkabstractblock}' . "\n";
  
}


?>

