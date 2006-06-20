<?

# $Id$

require 'include/mysmarty.inc.php';
$smarty = new Smarty;
$smarty->compile_check = true;
# $smarty->debugging = true;

include('include/mysql.inc.php');
include('include/basic.inc.php');

expires(0);

$st = str_replace('/', '', $_SERVER['PATH_INFO']);

$smarty->assign('title', 'Propostas');
$smarty->assign('linkup', '.');

$mysql = new Mysql;
#$mysql->conn->debug = 1;

# Pega todos os macro-temas
$sql = "SELECT cod, titulo
        FROM macrotemas
        ORDER BY titulo";
$rs_mt = $mysql->conn->Execute($sql);

$total = 0;
# Pra cada macro-tema, pegas as palestras relacionadas e joga numa matriz
while (!$rs_mt->EOF)
{
  if ($st) $where = "AND p.status = '$st'";
  $tema = $rs_mt->fields['cod'];

  $sql = "SELECT p.cod, p.titulo, a.nome, p.pessoa, p.status
          FROM propostas p, pessoas a
          WHERE p.pessoa = a.cod
          AND   tema = $tema
          $where
          ORDER BY p.titulo";
  $rs = $mysql->conn->Execute($sql);
  $rs_pr[$tema] = $rs->GetArray();

  $total += $rs->RowCount();

  $rs_mt->MoveNext();
}
$rs_mt->MoveFirst();

$smarty->assign('rs_pr', $rs_pr);
$smarty->assign('total', $total);
$smarty->assign('rs_mt', $rs_mt->GetArray());

$smarty->assign('st', $st);

$smarty->assign('central', 'propostas.tpl');

$smarty->display('index.tpl');

?>
