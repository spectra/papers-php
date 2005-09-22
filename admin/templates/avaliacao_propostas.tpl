<!-- $id -->
{config_load file=papers.conf}
As propostas já avaliadas aparecem <span style='background: #99ff99;'>em
verde</span> na lista abaixo.
<hr/>
{section loop=$macrotemas name=mt}
<h2>{$macrotemas[mt].titulo}</h2>
  {assign var="tema" value=$macrotemas[mt].cod}
  {section loop=$propostas[$tema] name=pr}
    {assign var="proposta" value=$propostas[$tema][pr].cod}
    {if $avaliada[$proposta]}{assign var='bg' value='#99ff99'}{else}{assign var='bg' value='transparent'}{/if}
    <div style='background: {$bg};'>
      <a style='display: block;' href="avaliacao/{$proposta}">{$propostas[$tema][pr].titulo}</a> 
    </div>
  {/section}
{/section}
