As palestras já alocadas aparecem <span style='background: #99ff99;'>em
verde</span> na lista abaixo.
<strong>Atenção:</strong>
Apenas palestras
<strong>aprovadas</strong> (ou <strong>pré-aprovadas</strong>)
que já tenham sido <strong>confirmadas</strong> pelos seus proponentes estão
disponíveis para alocação na grade. Entre parênteses o número de palestras
confirmadas/número total de palestras
<strong>aprovadas</strong> (ou <strong>pré-aprovadas</strong>)
do macrotema.
<hr/>
{section loop=$macrotemas name=m}
  {assign var="mt" value=$macrotemas[m].cod}
  <h2>{$macrotemas[m].titulo} ({$confirmacoes[$mt].confirmadas}/{$confirmacoes[$mt].total})</h2>
    {section loop=$propostas[$mt] name=p}
      {assign var="proposta" value=$propostas[$mt][p]}
      {if $alocadas[$proposta.cod]}
        {assign var="bg" value="#99ff99"}
      {else}
        {assign var="bg" value="transparent"}
      {/if}
      <div style='background: {$bg};'>
        <a href="alocacao/{$proposta.cod}">{$proposta.titulo}</a>
        (<a href='proposta/{$proposta.cod}'>ver cadastro da palestra</a>)
      </div>
    {/section}
{/section}
