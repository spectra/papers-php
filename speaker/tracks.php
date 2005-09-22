<?
require_once 'include/basic.inc.php';
require_once 'include/auth.inc.php';
require_once 'include/mysql.inc.php';
require_once 'include/tracks.inc.php';

$mysql = new Mysql;

$smarty->assign('tracks', Tracks::findAll($mysql,$language));
$smarty->assign('content', 'tracks.tpl');


// TODO: achar uma forma melhor de mostrar o estado das propostas.
// $proposals = Proposals::loadAccepted($mysql, $person['cod']);
// $smarty->assign('proposals', $proposals);

$smarty->display('index.tpl');

?>
