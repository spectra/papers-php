<?

require_once 'include/auth.inc.php';
require_once 'include/basic.inc.php';
require_once 'include/mysql.inc.php';
require_once 'include/persons.inc.php';
require_once 'include/pathinfo.inc.php';
require_once 'include/proposals.inc.php';

$mysql = new Mysql;
$person = Persons::find($mysql, $user);


if ($SUBMISSION_PERIOD == $PERIOD_SUBMISSION) {

  $fields = $_POST;
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
