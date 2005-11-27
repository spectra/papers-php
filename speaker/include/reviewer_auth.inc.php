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
