<?

require 'Smarty.class.php';
$smarty = new Smarty;
$smarty->compile_check = true;

include('include/mysql.inc.php');
include('include/basic.inc.php');

expires(0);

$smarty->assign('title', 'Avaliadores');

$smarty->assign('user', $user);
$smarty->assign('linkup', '.');

$mysql = new Mysql;

$sql = "select cod, nome, email, not(isnull(avaliador.pessoa)) as avaliador from pessoas left outer join avaliador on pessoas.cod = avaliador.pessoa";

$rs = $mysql->conn->Execute($sql);
$smarty->assign('rs', $rs->GetArray());

$smarty->assign('central', 'avaliadores.tpl');

$smarty->display('index.tpl');
  
?>

