<?

require_once 'Smarty.class.php';
require_once 'include/config.inc.php';

class MySmarty extends Smarty {

  function MySmarty() {
    global $papers;

    parent::Smarty();

    $this->assign('event', $papers['event']);
  }

}

?>
