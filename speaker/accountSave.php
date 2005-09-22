<?

require_once 'include/basic.inc.php';
require_once 'include/mysql.inc.php';
require_once 'include/persons.inc.php';
require_once 'include/pathinfo.inc.php';

require_once 'include/mysmarty.php';
$smarty = new MySmarty;
require_once 'include/language.inc.php'; // already starts the session

$mysql = new Mysql;
$person = Persons::find($mysql, $user);


if (Persons::find($mysql,$_POST['email'])) {
  echo "existing e-mail!";
  return;
}

if ($_POST['newPassword'] == "") {
  echo "Password is mandatory!";
  return;
}

if ($_POST['newPassword'] != $_POST['repeatPassword']) {
  echo "passwords doesn't match!";
  return;
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
