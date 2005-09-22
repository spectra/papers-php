<?

require 'Smarty.class.php';
$smarty = new Smarty;
$smarty->compile_check = true;

include('include/mysql.inc.php');
include('include/basic.inc.php');

expires(0);

$smarty->assign('title', 'Avaliação de propostas');

$cod = str_replace('/', '', $_SERVER['PATH_INFO']);
$user = $_SERVER['PHP_AUTH_USER'];

$smarty->assign('user', $user);

$mysql = new Mysql;

if ($cod) {
  // Avaliar uma proposta

  $sql = "select
            propostas.titulo, propostas.cod,
            pessoas.nome, pessoas.cod as cod_pessoa,
            macrotemas.titulo as macrotema
          from propostas
            join pessoas on propostas.pessoa = pessoas.cod
            join macrotemas on propostas.tema = macrotemas.cod
          where propostas.cod = $cod";
  $rs_proposta = $mysql->conn->Execute($sql);
  $smarty->assign('proposta', $rs_proposta->fields);

  $sql = "select *
          from avaliacoes
          where proposta = $cod
                and avaliador = '$user'";
  $rs_avaliacao = $mysql->conn->Execute($sql);
  $smarty->assign('avaliacao', $rs_avaliacao->fields);

  $smarty->assign('central', 'avaliacao.tpl');
  
  $smarty->assign('linkup', 'avaliacao');
  
  $smarty->display('index.tpl');
  
} else {
  // Listar propostas sem avaliar

  $rs = $mysql->conn->Execute('select cod, titulo, espacos from macrotemas');
  $macrotemas = $rs->GetArray();

  foreach ($macrotemas as $macrotema) {
    $mt = $macrotema['cod'];

    $sql = "select cod, titulo
            from propostas
            where propostas.tema = $mt
                  and status = 'i'
            order by titulo";
    $rs = $mysql->conn->Execute($sql);

    $propostas[$mt] = $rs->GetArray();
  }

  $sql = "select proposta from avaliacoes where avaliador = '$user'";
  $rs = $mysql->conn->Execute($sql);
  while (! $rs->EOF) {
    $avaliada[$rs->fields['proposta']] = 1;
    $rs->MoveNext();
  }
  
  $smarty->assign('avaliada', $avaliada);

  $smarty->assign('macrotemas', $macrotemas);
  $smarty->assign('propostas', $propostas);

  $smarty->assign('central', 'avaliacao_propostas.tpl');
  $smarty->assign('linkup', '.');
  $smarty->display('index.tpl');
}

?>

