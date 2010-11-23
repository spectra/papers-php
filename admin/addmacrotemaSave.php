<?

include('include/mysql.inc.php');
include('include/basic.inc.php');
include('include/macrotemas.inc.php');

require 'include/mysmarty.inc.php';
$smarty = new Smarty;
$smarty->compile_check = true;
# $smarty->debugging = true;

$smarty->config_load('papers.conf');

expires(0);
header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');

$mysql = new Mysql;

$cod = Macrotemas::adicionar($mysql, $_POST['titulo'], $_POST['titulo_en'], $_POST['descr'], $_POST['descr_en'], $_POST['espacos']);

?>
