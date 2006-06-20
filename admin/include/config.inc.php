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

# extension discovery
$_needed_extensions = array(
  'smarty',
  'adodb',
);
$_extensions = array();

# discover function
function papers_ext_conf($path, $extname) {
  global $_extensions;
  if ($_extensions[$extname]) {
    return;
  }
  if (is_dir($path)) {
    ini_set('include_path', ini_get('include_path') . ":" . $path);
    $_extensions[$extname] = 1;
  }
}

# auto configuration of locally installed extensions
$_application_path = preg_replace('/\/(admin|speaker|pub|reviewer)\/[^\/]*$/','', $_SERVER['SCRIPT_FILENAME']);
papers_ext_conf($_application_path . '/ext/smarty/libs', 'smarty');
papers_ext_conf($_application_path . '/ext/adodb', 'adodb');

# auto configuration on Debian
papers_ext_conf('/usr/share/adodb', 'adodb');
papers_ext_conf('/usr/share/php/smarty/libs', 'smarty');


# check if the needed extensions are available
$_missing_extensions = array();
foreach ($_needed_extensions as $ext) {
  if (! $_extensions[$ext]) {
    array_push($_missing_extensions, $ext);
  }
}
if (! empty($_missing_extensions)) {
  header("Content-Type: text/plain");
  echo "The following extensions are missing: \n";
  foreach ($_missing_extensions as $ext) {
    echo "  $ext\n";
  }
  echo "\nInstall these extensions before running papers. See the INSTALL file.";
  exit;
}

?>
