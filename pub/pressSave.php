<?

require 'include/mysmarty.inc.php';
$smarty = new Smarty;
$smarty->compile_check = true;
include('include/mysql.inc.php');
include('include/basic.inc.php');
include('include/press.inc.php');

$mandatory = array('nome','veiculo','pais','estado',
                   'cidade','email');

$labels = array(
  'nome' => 'Nome (<em>Name</em>)',
  'veiculo' => 'Veículo (<em>Vehicle</em>)',
  'pais' => 'País (<em>Country</em>)',
  'estado' => 'Estado (<em>State</em>)',
  'cidade' => 'Cidade (<em>City</em>)',
  'email' => 'e-mail'
);

foreach ($mandatory as $field) {
  if (! $_POST[$field] ) {
    $missing[] = $field;
    $stop = 1;
  }
}
if ($stop) {
  $smarty->assign('central','pressForm.tpl');
  $smarty->assign('missing', $missing);
  $smarty->assign('labels', $labels);
  $smarty->assign('fields', $_POST);
  $smarty->display('index.tpl');
} else {
  $mysql = new Mysql;
  Press::insert($mysql, $_POST);
  header('Location: pressRegistration');
}

?>
