<?

include_once('include/propostas.inc.php');

class Grade {

    function carregar ($db) {
      $CORES[0] = "#99ffcc";
      $CORES[1] = "#ffff99";
      $CORES[2] = "#ffcc66";
      $CORES[3] = "#CCCCFF";
      $CORES[4] = "#ccffff";
      $CORES[5] = "#ff99ff";
      $CORES[6] = "#999966";
      $CORES[7] = "#cccccc";
      $CORES[8] = "#33CC99";
      $CORES[9] = "#00CCFF";
      $CORES[10] = "#FFFFee";
      $CORES[11] = "#0099FF";
      $CORES[12] = "#6699CC";
      $CORES[13] = "#66CC33";
      $CORES[14] = "#CC9966";
      $CORES[15] = "#FFCCFF";

      $sql = 'select
                dia, sala, horario,
                propostas.titulo, propostas.cod as cod,
                nome,
                macrotemas.titulo as macrotema,
		macrotemas.cod as cod_macrotema,
                propostas.confirmada as confirmada
              from grade
                   join propostas  on grade.proposta   = propostas.cod
                   join pessoas    on propostas.pessoa = pessoas.cod
                   join macrotemas on propostas.tema   = macrotemas.cod';
      $rs = $db->conn->Execute($sql);
      $celulas = $rs->GetArray();
      foreach ($celulas as $celula) {
        extract($celula);

        if ($horario > 1 && $grade[$dia][$sala][$horario - 1]['cod'] == $cod) {
	  $grade[$dia][$sala][$horario - 1]['num']++;
	  $grade[$dia][$sala][$horario]['dumb'] = true;
	  $grade[$dia][$sala][$horario]['numm'] = 0;
	} else {
          $grade[$dia][$sala][$horario]['dumb'] = false;
          $grade[$dia][$sala][$horario]['num'] = 1;
	}
	
        $grade[$dia][$sala][$horario]['cod'] = $cod;
        $grade[$dia][$sala][$horario]['titulo'] = $titulo;
        $grade[$dia][$sala][$horario]['nome'] = $nome;
        $grade[$dia][$sala][$horario]['macrotema'] = $macrotema;
        $grade[$dia][$sala][$horario]['cor'] = $CORES[$cod_macrotema % 16];
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

    function conflitos($db) {
      $sql = "select pessoas.nome, dias.descricao as dia, substring(horarios.inicio,1,5) as horario, count(grade.sala) as count from pessoas join propostas on (propostas.pessoa = pessoas.cod or exists (select 1 from copalestrantes where copalestrantes.pessoa = pessoas.cod and copalestrantes.proposta = propostas.cod)) join grade on propostas.cod = grade.proposta join horarios on horarios.numero = grade.horario join dias on dias.numero = grade.dia group by pessoas.nome, dia, horario having count > 1;";
      $rs = $db->conn->Execute($sql);
      return $rs->GetArray();
    }
    
}


?>
