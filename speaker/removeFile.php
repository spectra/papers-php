<?

require_once 'include/auth.inc.php';
require_once 'include/basic.inc.php';
require_once 'include/mysql.inc.php';
require_once 'include/persons.inc.php';
require_once 'include/pathinfo.inc.php';
require_once 'include/event_dates.inc.php';
require_once 'include/proposals.inc.php';
require_once 'include/tracks.inc.php';
require_once 'include/config.inc.php';

$mysql = new Mysql;
$person = Persons::find($mysql, $user);

if ($PERIOD_SUBMISSION) {

  $file = $_GET['proposal_file'];

  preg_match('/(.*)\.([^\.]*)$/', $file, $matches);
  $cod = $matches[1];
  $extension = $matches[2];

  if ($cod) {

    // check if the person saving the proposal is its owner
    $proposal = Proposals::find($mysql,$cod);
    if (!$proposal || !Proposals::owns($person,$proposal, $mysql)) {
      $smarty->fatal('onlyProposalOwnerCanUpdate');
    }

    // remove the file
    Proposals::removeFile($file);
  }

} else {
  $smarty->fatal('notInSubmissionPeriod');
  return;
}

header('Location: .');

?>
