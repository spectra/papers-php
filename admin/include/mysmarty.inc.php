<?

require_once 'Smarty.class.php';
require_once 'include/config.inc.php';

class MySmarty extends Smarty {

  function MySmarty() {
    global $papers;

    parent::Smarty();

    $this->compile_check = true;

    $this->assign('event', $papers['event']);
  }

  function fatal($msg = 'unamedFatalError') {
    $this->assign('message', $msg);
    $this->display('index.tpl');
    exit;
  }

}

?>
