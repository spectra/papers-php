<?

require_once 'include/auth.inc.php';
require_once 'include/basic.inc.php';
require_once 'include/mysql.inc.php';
require_once 'include/persons.inc.php';
require_once 'include/proposals.inc.php';
require_once 'include/tracks.inc.php';
require_once 'include/pathinfo.inc.php';

$mysql = new Mysql;

$cod = PathInfo::getInteger();
if (!$cod) {
  header('Location: ../proposals');
  exit;
}


if ($PERIOD_RESULT) {

  $person = Persons::find($mysql, $user);
  $proposal = Proposals::find($mysql, $cod);
  
  if (! Proposals::owns($person, $proposal, $mysql)) {
    $smarty->assign('message', 'onlyProposalOwnerCanCheckReviews');
  } else {
    $smarty->assign('content', 'reviews2.tpl');
    $smarty->assign('proposal', $proposal);
    $smarty->assign('person', $person);
  
    $track = Tracks::find($mysql, $proposal['tema'], $language);
    $smarty->assign('track', $track);
  
    $reviews = Proposals::reviews($mysql, $proposal['cod']);
    $smarty->assign('reviews', $reviews);
  }
  
  $smarty->display('index.tpl');
} else {
  $smarty->fatal('resultNotReleasedYet');
}

?>
