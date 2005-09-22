<?

class PathInfo {

  function getInteger() {
    $integer = str_replace('/','',$_SERVER['PATH_INFO']);
    if (preg_match('/^[0-9]+$/',$integer)) {
      return $integer;
    } else {
      return NULL;
    }
  }
  
}

?>
