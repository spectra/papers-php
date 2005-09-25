<?

require_once 'include/auth.inc.php';
require_once 'include/basic.inc.php';
require_once 'include/mysql.inc.php';
require_once 'include/persons.inc.php';
require_once 'include/pathinfo.inc.php';
require_once 'include/event_dates.inc.php';
require_once 'include/proposals.inc.php';
require_once 'include/tracks.inc.php';

$mysql = new Mysql;
$person = Persons::find($mysql, $user);

if ($PERIOD_SUBMISSION) {

  $fields = $_POST;

  $mandatoryMissing = false;
  foreach (array('titulo','tema','idioma','descricao','resumo','publicoalvo') as $f) {
    if (! $fields[$f]) {
      $mandatoryMissing = true;
    }
  }
  if ($mandatoryMissing) {
    $smarty->assign('mandatoryMissing', 1);
    $smarty->assign('proposal', $fields);
    $smarty->assign('content', 'submit.tpl');
    $smarty->assign('tracks', Tracks::findAllAssoc($mysql, $language));
    $smarty->display('index.tpl');
    return;
  }

  
  if ($fields['cod']) {
    // existing proposal

    // TODO: check if the person saving the proposal is its owner
    $cod = $fields['cod'];

    $proposal = Proposals::find($mysql,$cod);
    if (!Proposals::owns($person,$proposal)) {
      echo "You can only update your own proposals!";
      return;
    }
    
    unset($fields['cod']);
    Proposals::real_update($mysql, $cod, $fields);
  } else {
    // new proposal
    $fields['pessoa'] =  $person['cod'];
    Proposals::create($mysql, $fields);
  }

} else {
  echo "Not in submission period.";
  return;
}

header('Location: .');

?>
