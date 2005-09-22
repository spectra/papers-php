<?

require_once 'include/basic.inc.php';
require_once 'include/mysql.inc.php';
require_once 'include/persons.inc.php';
require_once 'include/pathinfo.inc.php';
// require_once 'include/auth.inc.php';
require 'adodb.inc.php';

require_once 'include/mysmarty.php';
$smarty = new MySmarty;
require_once 'include/language.inc.php';

$mysql = new Mysql;
$smarty->assign('content', 'personalInfo.tpl');
$smarty->display('index.tpl');

?>
