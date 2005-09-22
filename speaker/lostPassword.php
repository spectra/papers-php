<?

require_once 'Smarty.class.php';
require_once 'include/basic.inc.php';
require_once 'include/mysql.inc.php';
require_once 'include/persons.inc.php';

$smarty = new Smarty;
require_once 'include/language.inc.php';

if (isset($_POST['email'])) {
  $mysql = new Mysql;
  $person = Persons::find($mysql, $_POST['email']);
  if ($person) {
    $passwd = Persons::newPassword($mysql, $person['cod']);
    $smarty->assign('person', $person);
    $smarty->assign('passwd', $passwd);
    mail($person['email'] , 'fisl6.0', $smarty->fetch("newPassword.$language.tpl"), 'From: temario@softwarelivre.org');
    $smarty->assign('content', "lostPassword2.$language.tpl");
  } else {
    $smarty->assign('message', 'noSuchUser');
  }
} else {
  $smarty->assign('content', 'lostPassword1.tpl');
}

$smarty->display('index.tpl');

?>
