<?
$configbase = '/etc/papers/';

$_server = preg_replace('/:.*/','',$_SERVER['HTTP_HOST']);
$_path = preg_replace('/(admin|speaker|pub|reviewer).*/','', $_SERVER['REQUEST_URI']);

$configfile = $_server . $_path;
$configfile = preg_replace('/\//','.', $configfile);

$configfile = $configbase . preg_replace('/[^a-zA-Z0-9.]/','', $configfile) . 'conf.php';

if (file_exists($configfile)) {
  require_once($configfile);
} else {
  header('Content-Type: text/plain');
  echo("Could not open configuration file $configfile!\n\nDid you read the INSTALL file?");
  exit;
}

?>
