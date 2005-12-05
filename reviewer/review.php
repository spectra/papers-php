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
$user_pcod = $person['cod'];
$smarty->assign('person',$person);

if ($cod) {
  // Avaliar uma proposta

  $sql = "select
            propostas.titulo, propostas.cod, propostas.descricao, propostas.resumo,
            propostas.publicoalvo, propostas.comentarios, propostas.pessoa,
            macrotemas.titulo as macrotema, macrotemas.cod as tcod
          from propostas
            join macrotemas on propostas.tema = macrotemas.cod
          where propostas.cod = $cod";
  $rs_proposta = $mysql->conn->Execute($sql);
  $arr = $rs_proposta->GetArray();
  $proposta = $arr[0];
  $smarty->assign('proposta', $proposta);

  if (! canReviewTrack($mysql, $user_pcod, $proposta['tcod'])) {
    $smarty->fatal('cannotReviewThisTrack');
  }

  $pcod = $proposta['pessoa'];
  $sql = "select
            pessoas.nome, pessoas.cod, pessoas.biografia, pessoas.email,
            pessoas.cidade, pessoas.estado, pessoas.pais, pessoas.coment,
            pessoas.org, pessoas.nickname
          from pessoas where cod = $pcod
          union
          select
            pessoas.nome, pessoas.cod, pessoas.biografia, pessoas.email,
            pessoas.cidade, pessoas.estado, pessoas.pais, pessoas.coment,
            pessoas.org, pessoas.nickname
          from pessoas join copalestrantes on copalestrantes.pessoa = pessoas.cod
          where copalestrantes.proposta = $cod";
  $rs_palestrantes = $mysql->conn->Execute($sql);
  $smarty->assign('palestrantes', $rs_palestrantes->GetArray());

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

    // check if the user can review this track
    if (canReviewTrack($mysql, $user_pcod, $mt)) {

      $sql = "select cod, titulo
              from propostas
              where propostas.tema = $mt
                    and status = 'i'
              order by titulo";
      $rs = $mysql->conn->Execute($sql);

      $propostas[$mt] = $rs->GetArray();
    }
  }

  $sql = "select proposta from avaliacoes where avaliador = $user_pcod";
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

