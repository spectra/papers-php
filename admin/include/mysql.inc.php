<?php
# mysql.inc.php - Abstracao para conexao com o banco de dados

include_once('include/config.inc.php');

class Mysql
{
  var $conn;

  function Mysql()
  {

    global $papers;

    /* XXX: esse caminho é relativo ao script que está chamando este arquivo.
     * Estamos assumindo que esse script está em /papers/admin, ou seja, um
     * nível acima deste arquivo (que está em papers/admin/includes). */
    $dev = file_exists(realpath('../papers-dev'));
    $environment = $dev?'development':'production';

    $hostname = $papers[$environment]['hostname'];
    $database = $papers[$environment]['database'];
    $username = $papers[$environment]['username'];
    $password = $papers[$environment]['password'];

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
