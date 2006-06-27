<?
require_once 'include/basic.inc.php';
require_once 'include/auth.inc.php';
require_once 'include/mysql.inc.php';
require_once 'include/tracks.inc.php';
require_once 'include/proposals.inc.php';

header('Content-Type: text/html; charset=iso-8859-1');

$mysql = new Mysql;

$tcod = $_GET['tcod'];
$pcod = $_GET['pcod'];

if ($papers['debug']) {
  sleep(3);
}

if ($pcod) {
  $proposal = Proposals::find($mysql, $pcod, $language);
  if ($proposal) {
    $keywords = Proposals::getKeywords($mysql, $proposal['cod'], $language);
  } else {
    echo 'no such proposal!';
    exit;
  }
} elseif ($tcod) {
  
  $track = Tracks::find($mysql, $tcod, $language);
  if (! $track) {
    echo 'no such track!';
    exit;
  }
  $keywords = Tracks::getKeywords($mysql, $track['cod'], $language);

} else {
  echo ('You must inform either a proposal (through pcod parameter) or a track (through tcod parameter)!');
  exit;
}

$smarty->assign('keywords', $keywords);

$smarty->display('keywordsjs.tpl');

?>
