<!-- $id -->
As propostas já avaliadas aparecem <span style='background: #99ff99;'>em
verde</span> na lista abaixo. Entre parânentes ao lado do título de cada
proposta, as palavras chave correspondentes.
<hr/>
{section loop=$macrotemas name=mt}
  {assign var="tema" value=$macrotemas[mt].cod}
  {if ! $forbidden_track[$tema]}
    <h2>{$macrotemas[mt].titulo} ({$numeros[$tema].avaliadas}/{$numeros[$tema].total})</h2>
    {section loop=$propostas[$tema] name=pr}
      {assign var="proposta" value=$propostas[$tema][pr].cod}
      {if $propostas[$tema][pr].forbidden}
        <div>
          <del>{$propostas[$tema][pr].titulo}</del>
          <small>({#cannotReviewThisProposal#})</small>
        </div>
      {else}
        {if $avaliada[$proposta]}{assign var='bg' value='#99ff99'}{else}{assign var='bg' value='transparent'}{/if}
        <div style='background: {$bg};'>
          <a style='display: block;' href="review/{$proposta}">
            {$propostas[$tema][pr].titulo}
            {assign var=chosen value=0}
            ({section loop=$propostas[$tema][pr].keywords name=k}
               {if $propostas[$tema][pr].keywords[k].chosen}
                 {if $chosen > 0},{/if}
                 {assign var=chosen value=$chosen+1}
                 {$propostas[$tema][pr].keywords[k].descr}
               {/if}
             {/section})
          </a> 
        </div>
      {/if}
    {/section}
  {else}
    <div style='color: #999;'>
      <h2>{$macrotemas[mt].titulo}</h2>
      {#cannotReviewThisTrack#}
    </div>
  {/if}
{/section}
