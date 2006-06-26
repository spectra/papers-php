<?

class Proposals {

  function load($db, $cod) {
    $sql = "
      select propostas.*
      from propostas
      join pessoas on pessoas.cod = propostas.pessoa
      where pessoas.cod = $cod
      union
      select propostas.*
      from propostas
      join copalestrantes on copalestrantes.proposta = propostas.cod
      where copalestrantes.pessoa = $cod
    ";
    $rs = $db->conn->Execute($sql);
    return $rs->GetArray();
  }
  
  function loadAccepted($db, $cod) {
    $sql = "
      select propostas.*
      from propostas
      join pessoas on pessoas.cod = propostas.pessoa
      where pessoas.cod = $cod
            and propostas.status in ('a','p','c')
      union
      select propostas.*
      from propostas
      join copalestrantes on copalestrantes.proposta = propostas.cod
      where copalestrantes.pessoa = $cod
            and propostas.status in ('a','p','c')
    ";
    $rs = $db->conn->Execute($sql);
    return $rs->GetArray();
  }

  function find($db, $cod) {
    $sql = "
      select *
      from propostas
      where cod = $cod
    ";
    $rs = $db->conn->Execute($sql);
    $rsa =  $rs->GetArray();
    return $rsa[0];
  }

  function owns($person, $proposal, $db) {
    if ($person['cod'] == $proposal['pessoa']) {
      return true;
    } else {
      return Proposals::isCoSpeaker($db, $person['cod'], $proposal['cod']);
    }
  }
  
  function isCoSpeaker($db, $scod, $pcod) {
    
    $sql = "
      select 1
      from copalestrantes
      where pessoa = $scod
      and proposta = $pcod
      ";

    $rs = $db->conn->Execute($sql);
    return ($rs->RecordCount() > 0);
      
  }

  function reviews($db, $cod) {
    $sql = "
      select a1.*
      from avaliacoes a1
           join propostas p1 on p1.cod = a1.proposta
      where proposta = $cod
      and
      (select count(*)
       from avaliacoes
            join propostas p2 on p2.cod = avaliacoes.proposta
       where p2.tema = p1.tema and
             p2.tipo = 's' and
             p2.status in ('p','a','i','r') and
             avaliador = a1.avaliador
       )
       =
       (select count(*)
        from propostas p3
        where p3.tema = p1.tema and
              p3.tipo = 's' and
              p3.status in ('p','a','i','r')
       )
       order by a1.avaliador
    ";
    $rs = $db->conn->Execute($sql);
    return $rs->GetArray();
  }

  function comments($db, $cod) {
    $sql = "
      select comentarios_autor as comment
      from avaliacoes
      where proposta = $cod
      order by avaliador
    ";
    $rs = $db->conn->Execute($sql);
    return $rs->GetArray();
  }

  function minimumScoreForAcceptanceInTrack($db, $track) {
    $sql = "
      select min(score) as score
      from propostas
      where tema = $track
            and tipo = 's'
            and status = 'a';
    ";
    $rs = $db->conn->Execute($sql);
    $rsa = $rs->GetArray();
    return $rsa[0]['score'];
  }

  function update($db, $cod, $fields) {
    $rs = $db->conn->Execute("select confirmada, autoriza_video, titulo, resumo from propostas where cod = $cod");
    $sql = $db->conn->GetUpdateSQL($rs, $fields, false, true);
    $db->conn->Execute($sql);
  }

  function create($db, $fields) {
    $rs = $db->conn->Execute("select cod,titulo,tema,idioma,publicoalvo,descricao,resumo,comentarios,ip,ip_proxy,browser,dthora,pessoa from propostas where cod = -1");
    $sql = $db->conn->GetInsertSQL($rs, $fields, false, true);
    $db->conn->Execute($sql);
  }

  function real_update($db, $cod, $fields) {
    $rs = $db->conn->Execute("select cod,titulo,tema,idioma,publicoalvo,descricao,resumo,comentarios from propostas where cod = $cod");
    $sql = $db->conn->GetUpdateSQL($rs, $fields, false, true);
    $db->conn->Execute($sql);
  }

  function remove($db, $cod) {
    $db->conn->Execute("delete from propostas where cod = $cod");
  }

  function findSpeakers($db, $cod) {
    $rs = $db->conn->Execute("
        select pessoas.*, 1 as main
        from pessoas
          join propostas on pessoas.cod = propostas.pessoa
        where propostas.cod = $cod
        union
        select pessoas.*, 0 as main
        from pessoas
          join copalestrantes on copalestrantes.pessoa = pessoas.cod
        where copalestrantes.proposta = $cod
        ");
     return $rs->GetArray();
  }

  function addSpeaker($db, $pcod, $scod) {
    $sql = ("insert into copalestrantes (proposta,pessoa) values ($pcod,$scod)");
    $db->conn->Execute($sql);
  }

  function removeSpeaker($db, $pcod, $scod) {
    $sql = ("delete from  copalestrantes where proposta = $pcod and pessoa = $scod");
    $db->conn->Execute($sql);
  }

  function getFiles($cod) {
    global $papers;
    $uploddir = papers_expand_path($papers['event']['file_upload_directory']);
    $files = glob($uploddir . "/$cod.*");
    $files = array_map('basename', $files);
    return $files;
  }
  
  function removeFile($file) {
    global $papers;
    $uploaddir = papers_expand_path($papers['event']['file_upload_directory']);
    unlink($uploaddir . '/' . $file);
  }

  function getKeywords($db, $cod, $language) {
    $descr = ($language == 'pt' || $language == 'pt-br') ?
             'descr'
             :
             'descr_en as descr';

    $rs = $db->conn->execute(
      "select id, $descr, (select count(*) from propostas_keywords where proposta = $cod and keyword = keywords.id) as chosen from keywords");
    return $rs->GetArray();
  }

  function addKeyword ($db, $cod, $keyword) {
    $db->conn->execute("insert into propostas_keywords values ($cod,$keyword)");
  }

  function removeKeyword( $db, $cod, $keyword) {
    $db->conn->execute("delete from propostas_keywords where proposta = $cod and keyword = $keyword");
  }

}

?>
