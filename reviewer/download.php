<?

require 'include/mysmarty.inc.php';
$smarty = new Smarty;
$smarty->compile_check = true;

require_once ('include/mysql.inc.php');
require_once ('include/basic.inc.php');
require_once ('include/auth.inc.php');
require_once ('include/reviewer_auth.inc.php');
require_once ('include/pathinfo.inc.php');
require_once ('include/proposals.inc.php');

expires(0);

$cod = PathInfo::getInteger();

$mysql = new Mysql;
$person = Persons::find($mysql, $user);
$user_pcod = $person['cod'];
$smarty->assign('person',$person);

$file = preg_replace('/^\//', '', $_SERVER['PATH_INFO']); 
if ( ! $file ) {
  $smarty->fatal('mustSpecifyProposal');
}

preg_match('/^([0-9]+).(.*)$/', $file, $matches);
$cod = $matches[1];

$proposta = Proposals::find($mysql, $cod);

if ( ! $proposta ) {
  $smarty->fatal('mustSpecifyProposal');
}

if (! canReviewTrack($mysql, $user_pcod, $proposta['tcod'])) {
  $smarty->fatal('cannotReviewThisTrack');
}

if (! canReviewProposal($mysql, $user_pcod, $proposta)) {
  $smarty->fatal('cannotReviewThisProposal');
}

header('Content-Type: application/octec-stream');

$filename = papers_expand_path( $papers['event']['file_upload_directory'] . '/' . $file );
$stream = fopen($filename, 'r');
while ($part = fread($stream, 4096)) {
  echo $part;
}
fclose($stream);

?>

