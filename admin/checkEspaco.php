<?

# $Id$

require 'include/mysmarty.inc.php';
$smarty = new Smarty;
$smarty->compile_check = true;
# $smarty->debugging = true;

include('include/mysql.inc.php');
include('include/basic.inc.php');

expires(0);

$cod = str_replace('/', '', $_SERVER['PATH_INFO']);

$mysql = new Mysql;
# $mysql->conn->debug = 1;

$sql = "SELECT cod, titulo
        FROM propostas
        WHERE espaco = $cod";
$rs = $mysql->conn->Execute($sql);

$smarty->assign('rs', $rs->fields);
$smarty->assign('cod', $cod);

$smarty->display('checkEspaco.tpl');

?>
