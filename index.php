<?

header('Content-Type: text/html; charset=iso-8859-1');

if (preg_match('/pt/', $_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
  include('index.pt.html');
} else {
  include('index.en.html');
}

?>
