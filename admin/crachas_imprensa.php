<?

include("include/mysql.inc.php");
include("include/press.inc.php");

header("Content-Type: text/plain  plain;charset=iso-8859-1");

$mysql = new Mysql;

$imprensas = Press::loadForNameTags($mysql);

foreach ($imprensas as $imprensa) {
  extract($imprensa);
  echo "\t$nome\t$veiculo\t$cidade\t$estado\t$pais\n";
}

?>
