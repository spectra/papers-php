<?

require_once 'include/auth.inc.php';
require_once 'include/basic.inc.php';
require_once 'include/mysql.inc.php';
require_once 'include/persons.inc.php';
require_once 'include/pathinfo.inc.php';

$mysql = new Mysql;
$person = Persons::find($mysql, $user);
$smarty->assign('person', $person);
$smarty->assign('content', 'personalInfo.tpl');
$smarty->display('index.tpl')
?>
