<?

// only proceed with web server authentication
// TODO: put all /admin/ under papers authentication 
if (! $_SERVER['REMOTE_USER']) {
  header('Content-Type: text/plain');
  echo('This feature is not enabled under no authentication');
  exit;
}


require_once 'include/mysql.inc.php';
require_once 'include/basic.inc.php';
require_once 'include/mysmarty.inc.php';

$smarty = new MySmarty;
$mysql = new Mysql;
$sql = $_POST['sql'];

$sql = str_replace("\\'", "'", $sql);

if ($sql) {

  $rs = $mysql->execute($sql);
  if ($rs->RowCount() > 0) {
    $data = $rs->GetArray();
    $smarty->assign('data', $data);
    $smarty->assign('sql', $sql);
    $smarty->assign('has_data', count($data));

    if (count($data) > 0) {
      $fields = array();
      foreach($data[0] as $key => $value) {
        array_push($fields, $key);
      }
      $smarty->assign('fields', $fields);
    }
  }


}

$smarty->assign('central', 'console.tpl');
$smarty->display('index.tpl');
  
?>
