<?

require_once 'include/auth.inc.php';
require_once 'include/basic.inc.php';
require_once 'include/mysql.inc.php';
require_once 'include/persons.inc.php';
require_once 'include/proposals.inc.php';
require_once 'include/tracks.inc.php';
require_once 'include/event_dates.inc.php';

$mysql = new Mysql;

$cod = $_POST['proposal'];
if (! preg_match('/^[0-9]+$/',$cod)) {
  header('Location: proposals');
  exit;
}

if ($PERIOD_RESULT) {

  if (! $PERIOD_UPDATES ) {
    $smarty->fatal('tooLateForUpdates');
  }

  $person = Persons::find($mysql, $user);
  $proposal = Proposals::find($mysql, $cod);
  
  if (! Proposals::owns($person, $proposal, $mysql)) {
    $smarty->fatal('message', 'onlyProposalOwnerCanConfirm');
  } else {

    if ($proposal['status'] != 'a' && $proposal['status'] != 'p') {
      $smarty->fatal('onlyAcceptedCanConfirm');
    }
  
    // salvar e redirecionar pra lista de propostas
    Proposals::update($mysql, $cod, $_POST);
    header('Location: proposals');
  }
} else {
  $smarty->fatal('resultNotReleasedYet');
}


?>
