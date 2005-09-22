<?
$configbase = '/etc/papers/';

$_server = preg_replace('/:.*/','',$_SERVER['HTTP_HOST']);
$_path = preg_replace('/(admin|speaker|pub|reviewer).*/','', $_SERVER['REQUEST_URI']);

$configfile = $_server . $_path;
$configfile = preg_replace('/\//','.', $configfile);

$configfile = $configbase . preg_replace('/[^a-zA-Z0-9.]/','', $configfile) . 'conf.php';

require_once($configfile);

#header("Content-Type: text/plain");
#print_r ($papers);
#exit;

?>
