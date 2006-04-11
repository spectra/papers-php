<?
class Pessoas {

  function encontrar($db,$cod) {
    $rs = $db->conn->Execute("select * from pessoas where cod = $cod");
    $rsa = $rs->GetArray();
    return $rsa[0];
  }

  function incluirConvidado($db,$nome,$email,$biografia) {
    $rs = $db->conn->Execute('select nome,email,biografia,dthora from pessoas where cod = -1');

    $r['nome'] = $nome;
    $r['email'] = $email;
    $r['biografia'] = $biografia;
    $r['dthora'] = time();

    $sql = $db->conn->GetInsertSQL($rs,$r);
    
    if (! $db->conn->Execute($sql)) {
      echo "Ocorreu um erro incluindo convidado no banco.";
      exit;
    }

    $rs = $db->conn->Execute("select cod from pessoas where email = '$email'");
    $rsa = $rs->GetArray();
    return $rsa[0]['cod'];
  }

  function carregar($db) {
    $rs = $db->conn->Execute('select * from pessoas order by nome');
    return  $rs->GetArray();
  }

  function newPassword($db, $cod) {
    $passwd = str_replace("\n", '', `makepasswd --chars=8`);
    $sql = "update pessoas set passwd = md5('$passwd') where cod = $cod";

    $db->conn->Execute($sql);
    
    return $passwd;
  }
  
  function palestrantes($db) {
    $sql = "  select distinct
                pessoas.nome,
                pessoas.org,
                pessoas.cidade,
                pessoas.estado,
                pessoas.pais,
                pessoas.email
              from
                pessoas
                join propostas on propostas.pessoa = pessoas.cod
                join grade on grade.proposta = propostas.cod
            union
              select distinct
                pessoas.nome,
                pessoas.org,
                pessoas.cidade,
                pessoas.estado,
                pessoas.pais,
                pessoas.email
              from pessoas
                join copalestrantes on pessoas.cod = copalestrantes.pessoa
                join propostas on propostas.cod = copalestrantes.proposta
                join grade on grade.proposta = propostas.cod
            order by 1
           ";
  
    $rs = $db->conn->Execute($sql);
    
    return $rs->GetArray();
  }

}
?>
