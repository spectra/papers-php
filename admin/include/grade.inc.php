<?

include_once('include/propostas.inc.php');

class Grade {

    function carregar ($db) {
      $CORES["Desenvolvimento"] = "#99ffcc";
      $CORES["Bancos de Dados"] = "#ffff99";
      $CORES["Desktop"] = "#ffcc66";
      $CORES["Redes"] = "#CCCCFF";
      $CORES["Segurança"] = "#ccffff";
      $CORES["Cases"] = "#ff99ff";
      $CORES["Comunidade"] = "#999966";
      $CORES["Governos"] = "#cccccc";
      $CORES["Política / Filosofia"] = "#33CC99";
      $CORES["Inclusão Social / Digital"] = "#00CCFF";
      $CORES["Organização"] = "#FFFFee";

      $sql = 'select
                dia, sala, horario,
                propostas.titulo, propostas.cod as cod,
                nome,
                macrotemas.titulo as macrotema,
                propostas.confirmada as confirmada
              from grade
                   join propostas  on grade.proposta   = propostas.cod
                   join pessoas    on propostas.pessoa = pessoas.cod
                   join macrotemas on propostas.tema   = macrotemas.cod';
      $rs = $db->conn->Execute($sql);
      $celulas = $rs->GetArray();
      foreach ($celulas as $celula) {
        extract($celula);
        $grade[$dia][$sala][$horario]['cod'] = $cod;
        $grade[$dia][$sala][$horario]['titulo'] = $titulo;
        $grade[$dia][$sala][$horario]['nome'] = $nome;
        $grade[$dia][$sala][$horario]['macrotema'] = $macrotema;
        $grade[$dia][$sala][$horario]['cor'] = $CORES[$macrotema];
        $grade[$dia][$sala][$horario]['confirmada'] = $confirmada;
        $grade[$dia][$sala][$horario]['copalestrantes'] = Propostas::copalestrantes($db,$cod);
        $grade[$dia][$sala][$horario]['mesa'] = Propostas::mesa($db,$cod);
        $rs->MoveNext();
      }

      return $grade;
    }

    function alocar($db,$dia,$sala,$horario,$proposta) {
      $sql = "insert into grade values($dia,$sala,$horario,$proposta)";
      $db->conn->Execute($sql);
    }

    function limpar($db,$dia,$sala,$horario) {
      $db->conn->Execute("delete from grade
                          where dia = $dia
                                and sala = $sala
                                and horario = $horario"
                  );
    }

    function alocadas($db) {
      $rs = $db->conn->Execute('select distinct proposta from grade');
      while (! $rs->EOF) {
        $alocadas[$rs->fields['proposta']] = 1;
        $rs->MoveNext();
      }
      return $alocadas;
    }

    function estahAlocada($db, $proposta) {
      $rs = $db->conn->Execute("select 1 from grade where proposta = $proposta");
      return ($rs->RowCount() > 0);
    }

    function celulas($db, $proposta) {
      $rs = $db->conn->Execute("select dias.descricao as dia , substring(horarios.inicio,1,5) as inicio, substring(horarios.final,1,5) as final, salas.descricao as sala, concat(dia,',',sala,',',horario) as cod from grade join dias on dias.numero = grade.dia join horarios on horarios.numero = grade.horario join salas on salas.numero = grade.sala where proposta = $proposta");
      return $rs->GetArray();
    }
    
}


?>
