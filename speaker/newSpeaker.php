<?
require_once 'include/basic.inc.php';
require_once 'include/auth.inc.php';
require_once 'include/mysql.inc.php';

header('Content-Type: text/html; charset=iso-8859-1');

$smarty->assign('nspeaker', $_GET['nspeaker']);
$smarty->display('speaker.tpl');

?>
