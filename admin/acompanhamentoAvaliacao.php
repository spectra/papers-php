<?
require 'Smarty.class.php';
$smarty = new Smarty;
$smarty->compile_check = true;

include('include/mysql.inc.php');
include('include/basic.inc.php');

expires(0);

$mysql = new Mysql;

$rs = $mysql->conn->Execute('select cod, titulo, espacos from macrotemas');
$macrotemas = $rs->GetArray();

foreach($macrotemas as $macrotema) {
  $mt = $macrotema['cod'];

  // avaliadores do macrotema:
  $sql = "select distinct(avaliador) as avaliador
          from avaliacoes
               join propostas on avaliacoes.proposta = propostas.cod
          where propostas.tema = $mt";
  $rs = $mysql->conn->Execute($sql);
  $avaliadores[$mt] = $rs->GetArray();

  // propostas a serem avaliadas no macrotema:
  $sql = "select cod
          from propostas
          where tema = $mt and
          tipo = 's' and
          status != 'd' ";
  $rs = $mysql->conn->Execute($sql);
  $propostas[$mt] = $rs->GetArray();
}

  // avaliações:
$sql = "select proposta, avaliador
        from avaliacoes";
$rs = $mysql->conn->Execute($sql);
while (! $rs->EOF) {
  $avaliacoes[$rs->fields['avaliador']][$rs->fields['proposta']] = 1;
  $rs->MoveNext();
}

// avalidores
$rs = $mysql->conn->Execute('select cod, nome from pessoas join avaliador on avaliador.pessoa = pessoas.cod');
$nomes = $rs->GetAssoc();

$smarty->assign('macrotemas', $macrotemas);
$smarty->assign('avaliadores', $avaliadores);
$smarty->assign('propostas', $propostas);
$smarty->assign('avaliacoes', $avaliacoes);
$smarty->assign('nomes', $nomes);

$smarty->assign('title', 'Acompanhamento de Avaliações');
$smarty->assign('linkup', '.');
$smarty->assign('central', 'acompanhamentoAvaliacao.tpl');
$smarty->display('index.tpl');

?>
