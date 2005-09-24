<?php
# mysql.inc.php - Abstracao para conexao com o banco de dados

include_once('include/config.inc.php');

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

    #include_once($_SERVER['DOCUMENT_ROOT'] . '/adodb/adodb.inc.php');
    include_once('adodb.inc.php');

    $conn = &ADONewConnection('mysql');
    $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
    define('ADODB_FORCE_NULLS',1);
    $conn->PConnect($hostname, $username, $password, $database);

    $this->conn = $conn;
  }
}
?>
