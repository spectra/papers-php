<?

require_once 'include/auth.inc.php';
require_once 'include/basic.inc.php';
require_once 'include/mysql.inc.php';
require_once 'include/persons.inc.php';
require_once 'include/pathinfo.inc.php';

if (!$_POST['nome'] || !$_POST['email']) {
  $smarty->fatal('mandatoryFieldsMissing');
}

$mysql = new Mysql;
$person = Persons::find($mysql, $user);
Persons::update($mysql, $person['cod'], $_POST);

if ($_POST['newPassword']) {
  if ($_POST['newPassword'] != $_POST['repeatPassword']) {
    $smarty->fatal('passwordsDontMatch');
  }
  if (md5($_POST['currentPassword']) != $person['passwd']) {
    $smarty->fatal("currentPasswordIncorrect");
  }
  Persons::setPassword($mysql, $person['cod'], $_POST['newPassword']);
}

// if the e-mail was changed, update session logon info
if ($_POST['email'] != $user) {
  $_SESSION['papersauth'] = $_POST['email'];
}

header('Location: proposals');

?>
