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
  if ($cod) {
    $proposal = Proposals::find($mysql, $cod);

    if (! Proposals::owns($person, $proposal, $mysql)) {
      $smarty->fatal('onlyProposalOwnerCanUpdate');
    }
    
    $smarty->assign('proposal', $proposal);

    $speakers = Proposals::findSpeakers($mysql, $cod);
    $smarty->assign('speakers', $speakers);

    $smarty->assign('files', Proposals::getFiles($cod));
  } else {

    // new proposal: check if the maximum number of submissions was already
    // reached
    $max = $papers['event']['max_submissions'];
    if ($max) {
      // there is a limit of submissions!
    
      $proposals = Proposals::load($mysql, $person['cod']);
      if (count($proposals) >= $max) {
        $smarty->fatal('maximumNumberOfSubmissions');
      }
    }

    // a new proposal has one speaker: the current user
    $person['main'] = true;
    $speakers = array($person);
    $smarty->assign('speakers', $speakers);
    
  }

  $smarty->assign('content', "submit.tpl");
  $smarty->assign('tracks', Tracks::findAllAssoc($mysql, $language));
  
} else {
  $smarty->fatal('notInSubmissionPeriod');
}

$smarty->display('index.tpl');

?>
