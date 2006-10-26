<?

# application path
$_application_path = preg_replace('/\/(admin|speaker|pub|reviewer)\/[^\/]*$/','', $_SERVER['SCRIPT_FILENAME']);



#### utility functions ##############################################

function papers_expand_path($path) {
  global $_application_path;
  return str_replace('{PAPERSROOT}', $_application_path, $path);
}

function papers_url() {
  $path = preg_replace('/\/(admin|speaker|pub|reviewer)\/[^\/]*$/','', $_SERVER['REQUEST_URI']);
  $protocol = (($_SERVER['SERVER_PORT'] == 443)?'https':'http') . '://';
  return $protocol . $_SERVER['HTTP_HOST'] .  $path;
}

#### end of utility functions #######################################


$_configpaths = array(
  $_application_path . '/conf',
  '/etc/papers',
);

$_server = preg_replace('/:.*/','',$_SERVER['HTTP_HOST']);
$_path = preg_replace('/(admin|speaker|pub|reviewer).*/','', $_SERVER['REQUEST_URI']);

$configfilename = $_server . $_path;
$configfilename = preg_replace('/\//','.', $configfilename);
$configfilename = preg_replace('/[^a-zA-Z0-9.]/','', $configfilename) . 'conf.php';

# try to load configuration file from all the paths
$_loaded_config = false;
foreach ($_configpaths as $path) {
  $configfile = $path . '/' . $configfilename;
  if (file_exists($configfile)) {
    require_once($configfile);
    $_loaded_config = true;
    break;
  }
}
if (! $_loaded_config) {
  header('Content-Type: text/plain');
  echo("Could not open configuration file $configfilename !\n\n");
  echo('Search path: ' . join(':',$_configpaths) . "\n\n");
  echo("Did you read the INSTALL file?");
  exit;
}

# add (calculated) url to configuration:
$papers['event']['papers_url'] = papers_url();

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
papers_ext_conf($_application_path . '/ext/smarty/libs', 'smarty');
papers_ext_conf($_application_path . '/ext/adodb', 'adodb');

# auto configuration on Debian
papers_ext_conf('/usr/share/adodb', 'adodb'); # old
papers_ext_conf('/usr/share/php/adodb', 'adodb'); # new
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
