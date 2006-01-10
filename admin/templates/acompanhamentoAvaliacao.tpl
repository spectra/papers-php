Quadros <span style'background: #99ff99;'>em verde</span> significam avaliações
realizadas.
<hr/>

{section loop=$macrotemas name=mt}
<h2>{$macrotemas[mt].titulo}</h2> 
  {assign var="tema" value=$macrotemas[mt].cod}
  <table class='formulario'>
    <tr>
        <th width='200px'>Avaliador \ Propostas</th>
      {section loop=$propostas[$tema] name=pr}
        <th width='30px'>{$propostas[$tema][pr].cod}</th>
      {/section}
    </tr>
    {section loop=$avaliadores[$tema] name=av}
      {assign var="aval" value=$avaliadores[$tema][av].avaliador}
      <tr>
        <td><a href='proponente/{$aval}'>{$nomes[$aval]}</a></td>
        {section loop=$propostas[$tema] name=pr}
          {assign var="prop" value=$propostas[$tema][pr].cod}
          <td {if $avaliacoes[$aval][$prop] == 1}style='background: #99ff99;'{/if}>&nbsp;</td>
        {/section}
      </tr>
    {/section}
  </table>
{/section}
