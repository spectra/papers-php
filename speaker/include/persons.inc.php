<?

class Persons {

  function find($db, $email) {
    $email = str_replace("'",'',$email);
  
    $sql = "
      select *
      from pessoas
      where email = '$email'
    ";
    $rs = $db->conn->Execute($sql);
    $rsa = $rs->GetArray();
    return $rsa[0];
  }

  function search($db, $search) {
    $rs = $db->conn->Execute("select * from pessoas where email like concat('%',concat(?,'%')) or nome like concat('%',concat(?,'%'))", array($search, $search));
    return $rs->GetArray();
  }

  function update($db, $cod, $fields) {
    $rs = $db->conn->Execute("select nome,email,rg,rg_orgao,cpf,passaporte,org,cidade,estado,pais,fone,fotourl,biografia,coment,sexo,nickname  from pessoas where cod = $cod");
    $sql = $db->conn->GetUpdateSQL($rs, $fields, false, true);
    $db->conn->Execute($sql);
  }

  function newPassword($db, $cod) {

    $letters = explode(' ', 'a b c d e f g h i j k l m n o p q r s t u v x y w z A B C D E F G H I J K L M N O P Q R S T U V X Y W Z 0 1 2 3 4 5 6 7 8 9');

    $passwd = '';
    for($i = 0; $i < 8; $i++) {
      $passwd .= $letters[ array_rand( $letters ) ];
    }

    return Persons::setPassword($db, $cod, $passwd);
  }

  function setPassword($db, $cod, $passwd) {
    $db->conn->Execute("update pessoas set passwd = md5('$passwd') where cod = $cod");
    
    return $passwd;
  }
  
  function create($db, $fields) {
    $rs = $db->conn->Execute("select nome,email,rg,rg_orgao,cpf,passaporte,org,cidade,estado,pais,fone,fotourl,biografia,coment,sexo,nickname,passwd  from pessoas where cod = -1");

    $fields['passwd'] = md5($fields['newPassword']);

    $sql = $db->conn->GetInsertSQL($rs, $fields, false, true);

    $db->conn->Execute($sql);
  }

}

?>
