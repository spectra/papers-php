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

$sql = "SELECT cod, tstamp, dthora, nome, rg, rg_orgao, cpf, passaporte, email,
passwd, org, cidade, estado, pais, fone, coment, fotourl, biografia, comentadm,
status, pago, vl_viagem, vl_hotel, vl_alimen, vl_outros
        FROM pessoas
        WHERE cod = $cod";
$rs = $mysql->conn->Execute($sql);

$sql = "SELECT cod, titulo, status
        FROM propostas
        WHERE pessoa = $cod
        ORDER BY titulo";
$pr = $mysql->conn->Execute($sql);

$smarty->assign('rs', $rs->fields);
$smarty->assign('pr', $pr->getArray());
$smarty->assign('total', $rs->RecordCount());

$smarty->assign('title', $rs->fields['nome'] . ' (' . $rs->fields['cod'] . ')');
$smarty->assign('linkup', 'proponentes');

# Altera o fundo da TD status
$smarty->config_load('papers.conf', 'colors');
$stcolor = $smarty->get_config_vars('bgcolor_' . $rs->fields['status']);
$smarty->assign('stcolor', $stcolor);

$smarty->assign('central', 'proponente.tpl');

$smarty->display('index.tpl');

?>
