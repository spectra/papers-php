<a name="toc"></a>
<ul>
{section loop=$dias name=d}
  <li><a href="{php}echo $_SERVER['REQUEST_URI']; {/php}#dia{$dias[d].numero}">{$dias[d].descricao}</a></li>
{/section}
</ul>

{section loop=$dias name=d}
  <a name="dia{$dias[d].numero}"></a>
  <h2>{$dias[d].descricao} <span style='font-size: 10px;'>(<a href="#toc">voltar ao topo</a>)</span></h2>
    <table class='formulario grade' style='width: 100%;'>
      <tr>
        <th></th>
        {section loop=$salas name=s}
          <th>
            {$salas[s].descricao}
          </th>
        {/section}
      </tr>
      {section loop=$horarios name=h}
        <tr>
          <th>{$horarios[h].inicio}/{$horarios[h].final}</th>
          {section loop=$salas name=s}
            {assign var="dia" value=$dias[d].numero}
            {assign var="sala" value=$salas[s].numero}
            {assign var="horario" value=$horarios[h].numero}
            {assign var="celula" value=$grade[$dia][$sala][$horario]}
	    {if !$admin && $celula.dumb}
	    <!-- dumb cell: day {$dia}, room {$sala}, hour {$horario} -->
	    {else}
	    <!-- day {$dia}, room {$sala}, hour {$horario} -->
	    <td bgcolor="{$celula.cor}" {if $celula.num > 1}rowspan="{$celula.num}"{/if} class='track_{$celula.cod_macrotema}'>
              {if $celula}
              <center>
                <a href="{$urlBase}/{$celula.cod}">
                  <strong>{$celula.macrotema}</strong>
                  <br/>
                  <em>{$celula.titulo}</em> <br />
                  Nível: <em>{$celula.nivel_proposta}</em>
		</a>
                <br/>
                <br/>
              </center>
		<ul style='padding-left: 20px;'>
                <li>{$celula.nome}</li>
                {section loop=$celula.copalestrantes name=cp}
                  <li> {$celula.copalestrantes[cp].nome}</li>
                {/section}
		</ul>
                {if !$nocoord}
                {if count($celula.mesa) > 0}
                  Coordenação de mesa:
                  <ul style='padding-left: 20px;'>
                  {section loop=$celula.mesa name=m}
                    <li> {$celula.mesa[m].nome}</li>
                  {/section}
                  </ul>
                {/if}
                {/if}
            {/if}
            </td>
	    {/if}
          {/section}
        </tr>
      {/section}
    </table>
{/section}
