<?

require 'Smarty.class.php';
$smarty = new Smarty;
$smarty->compile_check = true;

require_once ('include/mysql.inc.php');
require_once ('include/basic.inc.php');
require_once ('include/auth.inc.php');
require_once ('include/reviewer_auth.inc.php');
require_once ('include/pathinfo.inc.php');
require_once ('include/proposals.inc.php');

expires(0);

$cod = PathInfo::getInteger();

if (! $cod) {
  header("Location: .");
  exit;
}

$mysql = new Mysql;
$person = Persons::find($mysql, $user);
$smarty->assign('person',$person);

$proposal = Proposals::find($mysql, $cod);
$smarty->assign('proposal', $proposal);
$smarty->assign('content', 'proposal.tpl');

$smarty->display('index.tpl');

?>

