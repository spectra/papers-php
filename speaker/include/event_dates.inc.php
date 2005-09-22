<?

include_once('include/config.inc.php');

// indique aqui o período de submissão (use essas variáveis pra mostrar nos
// templates):
$SUBMISSION_FIRST_DAY = strtotime($papers['event']['submission_first_day']);
$SUBMISSION_LAST_DAY = strtotime($papers['event']['submission_last_day']);

/* não altere daqui pra baixo! */ 
/* * * * * * * * * * * * * * * */
/* * * * * * * * * * * * * * * */

$PERIOD_BEFORE_SUBMISSION = 0;
$PERIOD_SUBMISSION = 1;
$PERIOD_REVIEW = 2;

$submissionPeriod = array("before", "submission", "review");

// auxiliar
$temp = getdate($SUBMISSION_LAST_DAY);

// pra testar:
$SUBMISSION_START = $SUBMISSION_FIRST_DAY;
$SUBMISSION_END = mktime( $temp['hours'], $temp['minutes'], $temp['seconds'], $temp['mon'], $temp['mday'] + 1,  $temp['year'] ); // 0 hora do dia seguinte


// current period is ...
$today = time();
$SUBMISSION_PERIOD = null;
if ($today < $SUBMISSION_START) {
  $SUBMISSION_PERIOD = $PERIOD_BEFORE_SUBMISSION;
} elseif ($today >= $SUBMISSION_START && $today <= $SUBMISSION_END) {
    $SUBMISSION_PERIOD = $PERIOD_SUBMISSION;
  } else {
    $SUBMISSION_PERIOD = $PERIOD_REVIEW;
  }

if ($smarty) {
  $smarty->assign('submissionFirstDay', $SUBMISSION_FIRST_DAY);
  $smarty->assign('submissionLastDay', $SUBMISSION_LAST_DAY);
  $smarty->assign('submissionPeriod', $submissionPeriod[$SUBMISSION_PERIOD]);
}


?>
