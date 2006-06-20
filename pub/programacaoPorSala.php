<?

# $Id: grade.php 4 2005-09-22 02:31:37Z terceiro $

require 'include/mysmarty.inc.php';
$smarty = new Smarty;
$smarty->compile_check = true;
# $smarty->debugging = true;

include('include/mysql.inc.php');
include('include/basic.inc.php');
include('include/grade.inc.php');
include('include/dias.inc.php');
include('include/horarios.inc.php');
include('include/salas.inc.php');
include('include/pessoas.inc.php');

expires(0);

$smarty->assign('linkup', '.');

// if (! $dia = str_replace('/', '', $_SERVER['PATH_INFO'])) {
//   $dia = 1;
// }
// if ($dia > 1)
//   $smarty->assign('linkprevious', 'grade/' . ($dia-1));
// if ($dia < 3)
//   $smarty->assign('linknext', 'grade/' . ($dia+1));


$mysql = new Mysql;
#$mysql->conn->debug = 1;

$dias = Dias::carregar($mysql);
$smarty->assign('dias', $dias);

$horarios = Horarios::carregar($mysql);
$smarty->assign('horarios', $horarios);

$salas = Salas::carregar($mysql);
$smarty->assign('salas', $salas);

$grade = Grade::carregar($mysql);
$smarty->assign('grade', $grade);

$smarty->assign('central', "programacaoPorSala.tpl");
$smarty->display('index.tpl');

?>
