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

  $cod = PathInfo::getInteger();
  if (! $cod) {
    $smarty->assign('message', 'mustSpecifyProposal');
    $smarty->display('index.tpl');
    return;
  }
  $proposal = Proposals::find($mysql, $cod);
  if (! Proposals::owns($person, $proposal, $mysql)) {
    $smarty->assign('message', 'onlyProposalOwnerCanRemove');
    $smarty->display('index.tpl');
    return;
  }

  // remove all uploaded files
  $files = Proposals::getFiles($cod);
  foreach($files as $file) {
    Proposals::removeFile($file);
  }
  
  Proposals::remove($mysql, $cod);
  header("Location: ../");
  
} else {
    $smarty->assign('message', 'notInSubmissionPeriod');
    $smarty->display('index.tpl');
    return;
}

?>
