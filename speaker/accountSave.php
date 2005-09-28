<?

require_once 'include/basic.inc.php';
require_once 'include/mysql.inc.php';
require_once 'include/persons.inc.php';
require_once 'include/pathinfo.inc.php';

require_once 'include/mysmarty.inc.php';
$smarty = new MySmarty;
require_once 'include/language.inc.php'; // already starts the session

$mysql = new Mysql;

$error = null;
if (Persons::find($mysql,$_POST['email'])) {
  $error = 'existingEmail';
}

if (! $_POST['newPassword'] || !$_POST['nome'] || !$_POST['email']|| !$_POST['newPassword'] || !$_POST['repeatPassword'] ) {
  $error = 'mandatoryFieldsMissing';
}

if ($_POST['newPassword'] != $_POST['repeatPassword']) {
  $error = 'passwordsDontMatch';
}

if ($error) {
  $smarty->assign('content', 'personalInfo.tpl');
  $smarty->assign('message', $error);
  $smarty->assign('person', $_POST);
  $smarty->display('index.tpl');
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
