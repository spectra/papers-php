<?

$STATUS_PRE_APROVADO = '\'p\'';
$STATUS_CONVIDADO = '\'c\'';
$STATUS_APROVADO = '\'a\'';
$STATUS_INDEFINIDO = '\'i\'';
$STATUS_RECUSADO = '\'r\'';
$STATUS_DESISTENCIA = '\'d\'';
$TODOS_STATUS = array(
                  $STATUS_PRE_APROVADO,
                  $STATUS_APROVADO,
                  $STATUS_INDEFINIDO,
                  $STATUS_RECUSADO,
                  $STATUS_CONVIDADO,
                  $STATUS_DESISTENCIA
                );

$STATUS_DESCRIPTIONS = array (
                          'p' => 'Pré-aprovado',
                          'a' => 'Aprovado',
                          'i' => 'Indefinido',
                          'r' => 'Recusado',
                          'd' => 'Desistência'
                             );



class Propostas {

  function carregar($db) {
    $rs = $db->conn->Execute('select * from propostas');
    return $rs->GetArray();
  }

  function _carregarPorMacrotemaImpl($db, $cond) {
    $rs = $db->conn->Execute('select cod from macrotemas');
    $macrotemas = $rs->GetArray();
    
    foreach ($macrotemas as $macrotema) {
      $mt = $macrotema['cod'];
      $sql = "select *
              from propostas
              where propostas.tema = $mt
                    $cond
              order by titulo";
      $rs = $db->conn->Execute($sql);

      $propostas[$mt] = $rs->GetArray();
    }

    return $propostas;
  }

  function carregarPorMacrotemaParaAlocacao($db) {
    return Propostas::_carregarPorMacrotemaImpl($db, "and (tipo = 's' and (status in('a','p') and confirmada = 1) or tipo in ('c','v','p'))");
  }
  
  function carregarPorMacrotema($db, $status) {
    if ($status) {
      $condStatus = 'and status in (' . join($status,',') . ')';
    } else {
      $condStatus = '';
    }
    
    return Propostas::_carregarPorMacrotemaImpl($db, $condStatus);
  }

  function encontrar($db,$cod) {
    $rs = $db->conn->Execute("select * from propostas where cod = $cod");
    $rsa = $rs->GetArray();
    return $rsa[0];
  }

  function aprovadasPorMacrotema($db, $macrotema) {
    $rs = $db->conn->Execute("select count(*) as num from propostas where propostas.tema = $macrotema and propostas.status = 'a' ");
    $rsa = $rs->GetArray();
    return $rsa[0]['num'];
  }

  function confirmacoesPorMacrotema($db) {
    $sql = "select tema, 
                   count(*) as total,
                   sum(if(confirmada = 1,1,0)) as confirmadas
            from propostas
            where status in ('a','p')
            group by tema
            ";
    $rs = $db->conn->Execute($sql);
    return $rs->GetAssoc();
  }

  function incluirPalestraConvidada($db, $fields) {
    $rs = $db->conn->Execute('select dthora,titulo,descricao,tema,pessoa,publicoalvo,resumo,idioma,status,tipo,confirmada from propostas where cod = -1');
    $fields['dthora'] = time();
    $sql = $db->conn->GetInsertSQL($rs,$fields);
    if (! $db->conn->Execute($sql)) {
      echo "Ocorreu um erro incluindo palestra no banco.";
      exit;
    }

    $rs = $db->conn->Execute('select last_insert_id() as cod');
    $rsa = $rs->GetArray();
    return $rsa[0]['cod'];
  }

  function copalestrantes($db, $cod) {
    $rs = $db->conn->Execute("
      select pessoas.*
      from copalestrantes
      join pessoas on copalestrantes.pessoa = pessoas.cod
      where copalestrantes.proposta = $cod
      order by pessoas.nome
      ");
    return $rs->GetArray();
  }

  function removerCopalestrante($db,$cod,$pessoa) {
    $sql = "delete from copalestrantes where proposta = $cod and pessoa = $pessoa";
    $db->conn->Execute($sql);
  }

  function incluirCopalestrante($db,$cod,$pessoa) {
    $sql = "insert into copalestrantes values ($cod,$pessoa)";
    $db->conn->Execute($sql);
  }
  
  function mesa($db, $cod) {
    $rs = $db->conn->Execute("
      select pessoas.*
      from mesa
      join pessoas on mesa.pessoa = pessoas.cod
      where mesa.proposta = $cod
      ");
    return $rs->GetArray();
  }

  function removerMesa($db,$cod,$pessoa) {
    $sql = "delete from mesa where proposta = $cod and pessoa = $pessoa";
    $db->conn->Execute($sql);
  }

  function incluirMesa($db,$cod,$pessoa) {
    $sql = "insert into mesa values ($cod,$pessoa)";
    $db->conn->Execute($sql);
  }

  function resumosAnais ($db) {
    $sql = "select
              propostas.titulo, propostas.cod as cod,
              nome,
              email,
              biografia,
              org,
              macrotemas.titulo as macrotema,
              propostas.resumo as resumo
            from propostas
                 join pessoas    on propostas.pessoa = pessoas.cod
                 join macrotemas on propostas.tema   = macrotemas.cod
            where exists (select 1 from grade where grade.proposta = propostas.cod)
            order by propostas.titulo
                               ";
    $rs = $db->conn->Execute($sql);
    $celulas = $rs->GetArray();
    foreach ($celulas as $celula) {
      extract($celula);
      $palestra['cod'] = $cod;
      $palestra['titulo'] = $titulo;
      $palestra['nome'] = $nome;
      $palestra['email'] = $email;
      $palestra['biografia'] = $biografia;
      $palestra['macrotema'] = $macrotema;
      $palestra['resumo'] = $resumo;
      $palestra['copalestrantes'] = Propostas::copalestrantes($db,$cod);

      $resumos[] = $palestra;
      
      $rs->MoveNext();
    }

    return $resumos;
  }

  function naoConfirmadas($db) {
    $rs = $db->conn->Execute("select propostas.titulo, pessoas.nome from propostas join pessoas on pessoas.cod = propostas.pessoa where tipo = 's' and propostas.status in ('a','p') and (confirmada is null or not confirmada)");
    return $rs->GetArray();
  }

}

?>
