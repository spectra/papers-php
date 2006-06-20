<?php
# mysql.inc.php - Abstracao para conexao com o banco de dados

require_once('include/config.inc.php');

class Mysql
{
  var $conn;

  function Mysql()
  {

    global $papers;

    $hostname = $papers['db']['hostname'];
    $database = $papers['db']['database'];
    $username = $papers['db']['username'];
    $password = $papers['db']['password'];

    require_once('adodb.inc.php');

    $conn = &ADONewConnection('mysql');
    $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
    define('ADODB_FORCE_NULLS',1);
    $conn->PConnect($hostname, $username, $password, $database);

    if ($conn->errorMsg()) {
      header("Content-Type: text/plain");
      echo("Error connecting to database: " . $conn->errorMsg());
      exit;
    }

    $this->conn = $conn;
  }

  function execute($sql) {
    $rs =  $this->conn->Execute($sql);
    if ($this->conn->errorMsg()) {
      header("Content-Type: text/plain");
      echo("Error connecting to database: " . $this->conn->errorMsg());
      exit;
    }
    return $rs;
  }
}
?>
