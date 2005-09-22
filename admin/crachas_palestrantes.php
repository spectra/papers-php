<?

include("include/mysql.inc.php");
include("include/pessoas.inc.php");

header("Content-Type: text/plain  plain;charset=iso-8859-1");

$mysql = new Mysql;

$palestrantes = Pessoas::palestrantes($mysql);

foreach ($palestrantes as $palestrante) {
  extract($palestrante);
  echo "\t$nome\t$org\t$cidade\t$estado\t$pais\n";
}

?>
