<?

require_once('persons.inc.php');
require_once('auth.inc.php');
require_once('event_dates.inc.php');

function isReviewer($theUser) {
  $db = new Mysql;
  $person = Persons::find($db, $theUser);
  $cod = $person['cod'];
  $sql = "select count(*) as num
          from avaliador
               join pessoas on pessoas.cod = avaliador.pessoa
          where pessoas.cod = $cod";
  $rs = $db->conn->Execute($sql);
  $rsa = $rs->GetArray();
  return ($rsa[0]['num'] > 0);
}

function canReviewTrack($db, $pcod, $tcod) {
  $sql1 = "select count(*) as num from propostas where pessoa = $pcod and tema = $tcod";
  $rs1 = $db->conn->Execute($sql1);
  $rsa1 = $rs1->GetArray();
  if ($rsa1[0]['num'] > 0) {
    return false;
  }

  $sql2 = "select count(*) as num from propostas join copalestrantes on copalestrantes.proposta = propostas.cod where copalestrantes.pessoa = $pcod and propostas.tema = $tcod";
  $rs2 = $db->conn->Execute($sql2);
  $rsa2 = $rs2->GetArray();
  if ($rsa2[0]['num'] > 0) {
    return false;
  }
 
  return true;
}

if (! isReviewer($user)) {
  $smarty->fatal('notAReviewer');
}

if (! $PERIOD_REVIEW) {
  $smarty->assign('reviewFirstDay', $REVIEW_FIRST_DAY);
  $smarty->assign('reviewLastDay', $REVIEW_LAST_DAY);
  $smarty->assign('content', "notInReviewPeriod.$language.tpl");
  $smarty->display('index.tpl');
  exit;
}

?>
