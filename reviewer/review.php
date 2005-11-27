<?

require 'Smarty.class.php';
$smarty = new Smarty;
$smarty->compile_check = true;

require_once ('include/mysql.inc.php');
require_once ('include/basic.inc.php');
require_once ('include/auth.inc.php');
require_once ('include/reviewer_auth.inc.php');
require_once ('include/pathinfo.inc.php');

expires(0);

$cod = PathInfo::getInteger();

$mysql = new Mysql;
$person = Persons::find($mysql, $user);
$pcod = $person['cod'];
$smarty->assign('person',$person);

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

  $sql = "select
            pessoas.cod, pessoas.nome
          from pessoas join copalestrantes on copalestrantes.pessoa = pessoas.cod
          where copalestrantes.proposta = $cod";
  $rs_copalestrantes = $mysql->conn->Execute($sql);
  $smarty->assign('copalestrantes', $rs_copalestrantes->GetArray());

  $sql = "select *
          from avaliacoes
          where proposta = $cod
                and avaliador = $pcod";
  $rs_avaliacao = $mysql->conn->Execute($sql);
  $smarty->assign('avaliacao', $rs_avaliacao->fields);

  $smarty->assign('content', 'review.tpl');
  
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

  $sql = "select proposta from avaliacoes where avaliador = $pcod";
  $rs = $mysql->conn->Execute($sql);
  while (! $rs->EOF) {
    $avaliada[$rs->fields['proposta']] = 1;
    $rs->MoveNext();
  }
  
  $smarty->assign('avaliada', $avaliada);

  $smarty->assign('macrotemas', $macrotemas);
  $smarty->assign('propostas', $propostas);

  $smarty->assign('content', 'listProposals.tpl');

  $smarty->display('index.tpl');
}

?>

