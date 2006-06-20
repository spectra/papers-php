<?
require 'include/mysmarty.inc.php';
$smarty = new Smarty;
$smarty->compile_check = true;

include('include/mysql.inc.php');
include('include/basic.inc.php');

expires(0);

$mysql = new Mysql;

$sql = "
select pessoas.nome as nome, count(*) as quant
from pessoas
     join propostas on (propostas.pessoa = pessoas.cod or exists (select 1 from copalestrantes where copalestrantes.proposta = propostas.cod and copalestrantes.pessoa = pessoas.cod))
where propostas.status in ('a','p')
group by pessoas.nome
having count(*) > 1
order by 1 ";
      

$rs = $mysql->conn->Execute($sql);
$repetidos = $rs->GetArray();

$smarty->assign('repetidos', $repetidos);
$smarty->assign('central', 'repetidos.tpl');
$smarty->assign('linkup', '.');
$smarty->display('index.tpl');

?>
