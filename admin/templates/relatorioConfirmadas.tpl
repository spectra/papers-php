<h1><a name="inicio">Relatório de Palestras Confirmadas</a></h1>

<ul>
{section loop=$macrotemas name=mt}
<li><a href="relatorioConfirmadas#{$macrotemas[mt].titulo}">{$macrotemas[mt].titulo}</a></li>
{/section}
</ul>

<p><strong>Total de Palestras Confirmadas {$n_confirmadas}</strong></p>

{section loop=$macrotemas name=mt}
{assign var="tema" value=$macrotemas[mt].cod}
<h2><a name="{$macrotemas[mt].titulo}">{$macrotemas[mt].titulo}</a> (<a href="relatorioConfirmadas#inicio">voltar ao inicio</a>)</h2>
  <table style='width: 100%;'>
  {section loop=$confirmadas[$tema] name=pr}
    <tr {if $smarty.section.pr.iteration is odd}style='background: #d3d3d3'{/if}>
      <td>{$smarty.section.pr.iteration}</td>
      <td>{$confirmadas[$tema][pr].titulo}</td>
      <td>{$confirmadas[$tema][pr].autor}</td>
    </tr>
    <tr {if $smarty.section.pr.iteration is odd}style='background: #d3d3d3'{/if}>
      <td colspan="3">
        <strong>Resumo:</strong><br />
        {$confirmadas[$tema][pr].resumo}
      </td>
    </tr>
    <tr {if $smarty.section.pr.iteration is odd}style='background: #d3d3d3'{/if}>
      <td colspan="3">
        <strong>Descricao:</strong><br />
        {$confirmadas[$tema][pr].descricao}
      </td>
    </tr>
  {/section}
  </table>
<br />
{/section}

