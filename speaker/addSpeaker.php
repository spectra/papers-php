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

  $smarty->assign('content', "addSpeaker.tpl");

  $cod = PathInfo::getInteger();
  if ($cod) {
    $proposal = Proposals::find($mysql, $cod);

    if (! Proposals::owns($person, $proposal)) {
      $smarty->fatal('onlyProposalOwnerCanUpdate');
    }
    
    $smarty->assign('proposal', $proposal);

    $search = $_GET['search'];
    if ($search) {
      $smarty->assign('search', Persons::search($mysql, $search));
    }
  } else {
    header('Location: .');
    exit;
  }

  
} else {
  $smarty->fatal('notInSubmissionPeriod');
}

$smarty->display('index.tpl');

?>