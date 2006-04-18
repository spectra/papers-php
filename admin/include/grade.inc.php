<?

include_once('include/propostas.inc.php');

# $CORES[9] = "#00CCFF";
# $CORES[11] = "#0099FF";
# $CORES[8] = "#33CC99";
# $CORES[16] = "#6633cc";
# $CORES[12] = "#6699CC";
# $CORES[13] = "#66CC33";
# $CORES[17] = "#66ff33";
# $CORES[6] = "#999966";
# $CORES[0] = "#99ffcc";
# $CORES[14] = "#CC9966";
# $CORES[7] = "#cccccc";
# $CORES[3] = "#CCCCFF";
# $CORES[4] = "#ccffff";
# $CORES[5] = "#ff99ff";
# $CORES[2] = "#ffcc66";
# $CORES[15] = "#FFCCFF";
# $CORES[1] = "#ffff99";
# $CORES[10] = "#FFFFee";
 
$CORES[0] = "#0099FF";
$CORES[1] = "#00CCFF";
$CORES[2] = "#00FF99";
$CORES[3] = "#33CC99";
$CORES[4] = "#9966cc";
$CORES[5] = "#6699CC";
$CORES[6] = "#66CC33";
$CORES[7] = "#66ff33";
$CORES[8] = "#999966";
$CORES[9] = "#99ffcc";
$CORES[10] = "#CC9966";
$CORES[11] = "#cccccc";
$CORES[12] = "#CCCCFF";
$CORES[13] = "#ccffff";
$CORES[14] = "#ff99ff";
$CORES[15] = "#ffcc66";
$CORES[16] = "#FFCCFF";
$CORES[17] = "#ffff99";
$CORES[18] = "#FF33ee";

class Grade {

    function cor($track) {
      global $CORES;
      return $CORES[$track % 18];
    }

    function carregar ($db) {

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
      $grade = array();
      $dias = array();
      $salas = array();
      $horarios = array();
      foreach ($celulas as $celula) {
        extract($celula);
	
        $grade[$dia][$sala][$horario]['cod'] = $cod;
        $grade[$dia][$sala][$horario]['titulo'] = $titulo;
        $grade[$dia][$sala][$horario]['nome'] = $nome;
        $grade[$dia][$sala][$horario]['macrotema'] = $macrotema;
        $grade[$dia][$sala][$horario]['cod_macrotema'] = $cod_macrotema;
        $grade[$dia][$sala][$horario]['cor'] = Grade::cor($cod_macrotema);
        $grade[$dia][$sala][$horario]['confirmada'] = $confirmada;
        $grade[$dia][$sala][$horario]['copalestrantes'] = Propostas::copalestrantes($db,$cod);
        $grade[$dia][$sala][$horario]['mesa'] = Propostas::mesa($db,$cod);

	if (! in_array($dia,$dias)) {
	  array_push($dias,$dia);
	}
	if (! in_array($sala,$salas)) {
	  array_push($salas,$sala);
	}
	if (! in_array($horario,$horarios)) {
	  array_push($horarios,$horario);
	}
      }
      
      sort($dias);
      sort($salas);
      sort($horarios);

      foreach ($dias as $dia) {
        foreach ($horarios as $horario) {
          foreach ($salas as $sala) {

            if (! isset($grade[$dia][$sala][$horario])) {
	      continue;
	    }
	  
            if ($horario > 1 && $grade[$dia][$sala][$horario - 1]['cod'] == $grade[$dia][$sala][$horario]['cod']) {

              $first = $horario - 1;
              while ($grade[$dia][$sala][$first]['dumb']) {
                $first--;
              }
            
              $grade[$dia][$sala][$first]['num']++;
              $grade[$dia][$sala][$horario]['dumb'] = true;
              $grade[$dia][$sala][$horario]['num'] = 0;
            } else {
              $grade[$dia][$sala][$horario]['dumb'] = false;
              $grade[$dia][$sala][$horario]['num'] = 1;
            }

	  }
	}
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
    
    function vazios($db) {
      $sql = "select dias.descricao as dia, salas.descricao as sala, horarios.inicio as horario from dias, salas, horarios where exists (select 1 from grade where salas.numero = grade.sala) and not exists (select 1 from grade where grade.sala = salas.numero and grade.horario = horarios.numero and grade.dia = dias.numero) order by dias.numero, salas.numero, horarios.numero";
      $rs = $db->conn->Execute($sql);
      return $rs->GetArray();
    }
    
}


?>
