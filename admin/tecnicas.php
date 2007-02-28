<?
require 'include/mysmarty.inc.php';
$smarty = new Smarty;
$smarty->compile_check = true;

include('include/mysql.inc.php');
include('include/basic.inc.php');
include('include/propostas.inc.php');
include('include/macrotemas.inc.php');

expires(0);

$mysql = new Mysql;

if (empty($_POST)) {

  $macrotemas = Macrotemas::carregar($mysql);
  $propostas = Propostas::carregarPorMacrotemaParaAlocacao($mysql);
  
  $smarty->assign('macrotemas', $macrotemas);
  $smarty->assign('propostas', $propostas);
  
  $smarty->assign('central', 'tecnicas.tpl');
  $smarty->assign('linkup', '.');
  $smarty->display('index.tpl');
} else {

  foreach($_POST as $key => $val) {
    if (preg_match("/tecnica_era_([0-9]+)/", $key, $matches)) {
      $cod = $matches[1];

      // deixando de ser tecnica
      if ($_POST["tecnica_era_$cod"] && !$_POST["tecnica_$cod"]) {
        $mysql->conn->Execute("update propostas set tecnica = 0 where cod = $cod");
      }

      // passando a ser tecnica
      if (!$_POST["tecnica_era_$cod"] && $_POST["tecnica_$cod"]) {
        $mysql->conn->Execute("update propostas set tecnica = 1 where cod = $cod");
      }
    }
  }

  header('Location: tecnicas');
  exit;

}


?>
