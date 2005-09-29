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

  $cod = preg_replace('/[^0-9]/','',$_GET['cod']);
  $scod = preg_replace('/[^0-9]/','',$_GET['scod']);

  if ($cod && $scod) {
    $proposal = Proposals::find($mysql, $cod);

    if (! Proposals::owns($person, $proposal, $mysql)) {
      $smarty->fatal('onlyProposalOwnerCanUpdate');
    }

    Proposals::addSpeaker($mysql, $cod, $scod);

    header("Location: submit/$cod");
    
  } else {
    header("Location: .");
    exit;
  }
  
} else {
  $smarty->fatal('notInSubmissionPeriod');
}

?>
