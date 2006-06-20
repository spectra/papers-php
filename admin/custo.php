<?

# $Id$

require 'include/mysmarty.inc.php';
$smarty = new Smarty;
$smarty->compile_check = true;
# $smarty->debugging = true;

include('include/mysql.inc.php');
include('include/basic.inc.php');

expires(0);

$smarty->assign('title', 'Custo com palestrantes');
$smarty->assign('linkup', '.');

$mysql = new Mysql;
#$mysql->conn->debug = 1;

# Pega todos os macro-temas
$sql = "SELECT SUM(vl_viagem) vl_viagem, SUM(vl_hotel) vl_hotel, SUM(vl_alimen)
        vl_alimen, SUM(vl_outros) vl_outros
        FROM pessoas
        WHERE pago = 1";
$rs = $mysql->conn->Execute($sql);

$total = $rs->fields['vl_viagem'] + $rs->fields['vl_hotel'] +
 $rs->fields['vl_alimen'] + $rs->fields['vl_outros'];

$smarty->assign('rs', $rs->fields);
$smarty->assign('total', $total);

$smarty->assign('central', 'custo.tpl');

$smarty->display('index.tpl');

?>
