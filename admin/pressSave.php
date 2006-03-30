<?

  include('include/mysql.inc.php');
  include('include/basic.inc.php');
  include('include/press.inc.php');

  expires(0);
  header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
  header('Content-Type: text/plain');

  $mysql = new Mysql;
  Press::update($mysql, $_POST);

  header('Location: press');
  
?>
