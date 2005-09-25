<?

require_once 'include/basic.inc.php';
require_once 'include/mysql.inc.php';
require_once 'include/persons.inc.php';
require_once 'include/pathinfo.inc.php';

require_once 'include/mysmarty.inc.php';
$smarty = new MySmarty;
require_once 'include/language.inc.php'; // already starts the session

$mysql = new Mysql;
$person = Persons::find($mysql, $user);


if (Persons::find($mysql,$_POST['email'])) {
  $smarty->fatal('existingEmail');
}

if ($_POST['newPassword'] == "") {
  $smarty->fatal('mandatoryFieldsMissing');
}

if ($_POST['newPassword'] != $_POST['repeatPassword']) {
  $smarty->fatal('passwordsDontMatch');
}

Persons::create($mysql, $_POST);
//echo "<pre>";
//print_r($_POST);
//echo "</pre>";

// register the e-mail in the session
$_SESSION['papersauth'] = $_POST['email'];

// $_SESSION['papersauth'] = 'teste';
header('Location: .');

?>
