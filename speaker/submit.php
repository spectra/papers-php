<?
require_once 'include/basic.inc.php';
require_once 'include/auth.inc.php';
require_once 'include/mysql.inc.php';
require_once 'include/persons.inc.php';
require_once 'include/proposals.inc.php';
require_once 'include/tracks.inc.php';
require_once 'include/event_dates.inc.php';
require_once 'include/pathinfo.inc.php';

$mysql = new Mysql;

$person = Persons::find($mysql, $user);
$smarty->assign('person',$person);

if ($PERIOD_SUBMISSION) {

  $smarty->assign('content', "submit.tpl");
  $smarty->assign('tracks', Tracks::findAllAssoc($mysql, $language));

  $cod = PathInfo::getInteger();
  if ($cod) {
    $proposal = Proposals::find($mysql, $cod);

    if (! Proposals::owns($person, $proposal)) {
      echo "You can only edit your own proposals!";
      return;
    }
    
    $smarty->assign('proposal', $proposal);
  }
  
} else {
  echo "Not in submission period.";
  return;
}

$smarty->display('index.tpl');

?>
