<?

  require_once ('include/mysql.inc.php');
  require_once ('include/basic.inc.php');
  require_once ('include/auth.inc.php');
  require_once ('include/reviewer_auth.inc.php');
  require_once ('include/persons.inc.php');

  expires(0);
  header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
  header('Content-Type: text/plain');
  
  $proposta = $_POST['proposta'];
 
  $mysql = new Mysql;

  // incluir o nome do avaliador entre os campos
  $campos = $_POST;
  $person = Persons::find($mysql, $user);
  $user_pcod = $person['cod'];
  $campos['avaliador'] = $person['cod'];


  $sql = "select *
          from avaliacoes
          where proposta = $proposta
                and avaliador = $user_pcod";
  $rs = $mysql->conn->Execute($sql);
  $count = $rs->RecordCount();

  if ($count > 0) {
    // avaliação já existe. Atualizar.
    $sql = $mysql->conn->GetUpdateSQL($rs, $campos);
  } else {
    // avaliação ainda não existe. Incluir.
    $sql = $mysql->conn->GetInsertSQL($rs, $campos);
  }

  // fazer a atualização
  $mysql->conn->Execute($sql);
  
  // voltar para a lista de propostas para avaliar:
  header("Location: review");

?>
