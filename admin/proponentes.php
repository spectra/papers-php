<?

# $Id$

require 'include/mysmarty.inc.php';
$smarty = new Smarty;
$smarty->compile_check = true;
# $smarty->debugging = true;

include('include/mysql.inc.php');
include('include/basic.inc.php');

expires(0);

$smarty->assign('title', 'Proponentes');
$smarty->assign('linkup', '.');

$mysql = new Mysql;

$st = str_replace('/', '', $_SERVER['PATH_INFO']);
if ($st)
  $where = "WHERE status = '$st'";

$sql = "SELECT cod, nome, org, pais, status
        FROM pessoas
        $where
        ORDER BY nome";
$rs = $mysql->conn->Execute($sql);
$smarty->assign('rs', $rs->GetArray());
$smarty->assign('total', $rs->RecordCount());
$smarty->assign('st', $st);

$smarty->config_load('papers.conf', 'colors');

$smarty->assign('central', 'proponentes.tpl');

$smarty->display('index.tpl');

?>
