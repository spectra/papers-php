<?

function expires($minutos = "60")
{
  # Expira a pagina em $minutos
  
  $segundos = $minutos * 60;
  $data = gmdate("D, d M Y H:i:s T", time() + $segundos);

  header("Expires: $data");
}

function writeLog($file, $msg)
{
  if (! $msg) return false;

  $smarty = new Smarty;
  $smarty->config_load('papers.conf');
  $logbase = $smarty->get_config_vars('log');

  $user = $_SERVER['REMOTE_USER'];
  $dthora = date('M d H:i:s');

  unset($smarty);

  # Retira os \n's para nao estragar o log
  $msg = str_replace("\n", ' ', $msg);

  return ! system("echo $dthora $user $msg >> $logbase/$file");
}

?>
