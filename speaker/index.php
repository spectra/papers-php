<?
require_once 'include/basic.inc.php';
require_once 'include/auth.inc.php';
require_once 'include/mysql.inc.php';
require_once 'include/persons.inc.php';
require_once 'include/proposals.inc.php';
require_once 'include/event_dates.inc.php';

$mysql = new Mysql;

$person = Persons::find($mysql, $user);
$smarty->assign('person',$person);

switch ($SUBMISSION_PERIOD) {
  case $PERIOD_BEFORE_SUBMISSION:
    $smarty->assign('content', "beforeSubmission.$language.tpl");
    break;
  case $PERIOD_SUBMISSION:
    $smarty->assign('content', "submission.$language.tpl");
    $smarty->assign('proposals', Proposals::load($mysql, $person['cod']));
    break;
  case $PERIOD_REVIEW:
    $smarty->assign('content', "proposals.tpl");
    $smarty->assign('proposals', Proposals::load($mysql, $person['cod']));
    break;
}

// TODO: achar uma forma melhor de mostrar o estado das propostas.
// $proposals = Proposals::loadAccepted($mysql, $person['cod']);
// $smarty->assign('proposals', $proposals);

$smarty->display('index.tpl');

?>
