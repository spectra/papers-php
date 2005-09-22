<?

include('include/mysql.inc.php');
include('include/basic.inc.php');
include('include/pessoas.inc.php');
include('include/propostas.inc.php');

require 'Smarty.class.php';
$smarty = new Smarty;
$smarty->compile_check = true;
# $smarty->debugging = true;

expires(0);
header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');

$mysql = new Mysql;

$pessoa = Pessoas::incluirConvidado($mysql, $_POST['nome'], $_POST['email'], $_POST['biografia']);
$proposta = $_POST['proposta'];

Propostas::incluirMesa($mysql,$proposta,$pessoa);

header("Location: mesa/$proposta");


?>
