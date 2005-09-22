<?

require_once 'include/mysql.inc.php';
require_once 'include/mysmarty.inc.php';


$smarty = new MySmarty;

require_once 'include/language.inc.php'; // already starts the session

/* authentication stuff */

$user = $_SESSION['papersauth'];
$smarty->assign('user', $user);

if (!$_SESSION['papersauth']) {
  if (isset ($_POST['username']) && isset ($_POST['password'])) {
    $email = $_POST['username'];
    $passwd = $_POST['password'];
    if (login($email, $passwd)) {
      $_SESSION['papersauth'] = $email;
      header ('Location: ' . $_SERVER['REQUEST_URI']);
      exit;
    } else {
      $smarty->assign('message', 'invalidLogin');
      $smarty->assign('content', 'login.tpl');
      $smarty->display('index.tpl');
      exit;
    }
  } else {
    $smarty->assign('content', 'login.tpl');
    $smarty->display('index.tpl');
    exit;
  }
}

function login($email, $password) {
  $mysql = new Mysql;
  $sql = "select 1 from pessoas where email = '$email' and passwd = md5('$password')";
  $rs = $mysql->conn->Execute($sql);
  return ($rs->RowCount() == 1);
}

function logout() {
  unset($_SESSION['papersauth']);
}

?>
