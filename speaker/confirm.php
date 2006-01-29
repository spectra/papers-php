<?

require_once 'include/auth.inc.php';
require_once 'include/basic.inc.php';
require_once 'include/mysql.inc.php';
require_once 'include/persons.inc.php';
require_once 'include/proposals.inc.php';
require_once 'include/tracks.inc.php';
require_once 'include/pathinfo.inc.php';
require_once 'include/event_dates.inc.php';

$mysql = new Mysql;

$cod = PathInfo::getInteger();
if (!$cod) {
  header('Location: ../proposals');
  exit;
}

if ($PERIOD_RESULT) {

  if (! $PERIOD_UPDATES ) {
    $smarty->fatal('tooLateForUpdates');
  }

  $person = Persons::find($mysql, $user);
  $proposal = Proposals::find($mysql, $cod);

  if (! Proposals::owns($person, $proposal, $mysql)) {
    $smarty->fatal('onlyProposalOwnerCanConfirm');
  } else {

    if ($proposal['status'] != 'a' && $proposal['status'] != 'p') {
      $smarty->fatal('onlyAcceptedCanConfirm');
    }
  
    $smarty->assign('proposal', $proposal);
    $smarty->assign('person', $person);
    $smarty->assign('content', 'confirm.tpl');
  }
  
  $smarty->display('index.tpl');
} else {
  $smarty->fatal('resultNotReleasedYet');
}

?>
