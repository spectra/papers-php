<?

require 'Smarty.class.php';
$smarty = new Smarty;
$smarty->compile_check = true;

include('include/mysql.inc.php');
include('include/basic.inc.php');
include('include/propostas.inc.php');
include('include/macrotemas.inc.php');
include('include/grade.inc.php');
include('include/pessoas.inc.php');
include('include/dias.inc.php');
include('include/horarios.inc.php');
include('include/salas.inc.php');


expires(0);

$smarty->assign('title', 'Alocação de Espaços');

$mysql = new Mysql;

if (isset($_GET['biografia'])) {
  $smarty->assign('biografia',true);
}

$smarty->assign('resumos', Propostas::resumosAnais($mysql));
$smarty->display('resumos.tpl'); 


?>

