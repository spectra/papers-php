<?

/* MUST be included after a Smary object, names $smarty, been created */

/* language stuff */

session_start();

if (isset($_GET['language'])) {
  $language = $_GET['language'];
  $_SESSION['language'] = $language;
} else {
  if (isset($_SESSION['language'])) {
    $language = $_SESSION['language'];
  } else {
    $language = (preg_match('/pt/', $_SERVER["HTTP_ACCEPT_LANGUAGE"]))?'pt-br':'en';
  }
}
$smarty->assign('language', $language);

function change_language($lang) {
  $uri = $_SERVER['REQUEST_URI'];

  if (preg_match('/\?/', $uri)) {
    if (preg_match('/[?&]language=[^?&]*/', $uri)) {
      return preg_replace('/([?&])language=[^?&]*/',"\${1}language=$lang", $uri);
    } else {
      return $uri . '&language=' . $lang;
    }
  } else {
    return $uri . '?language=' . $lang;
  }
}

function change_language_smarty($params) {
  extract($params);
  if ($language) {
    return change_language($language);
  }
}
$smarty->register_function('change_language', 'change_language_smarty');

?>
