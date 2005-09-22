<h1><a name="inicio">Relatório de Desistencias</a></h1>

<form action="marcarDesistenciasSave" method="POST">
{assign var="tema" value=$macrotemas[mt].cod}
  <table style='width: 100%;'>
    <tr>
    <th>&nbsp;</th>
    <th>Título</th>
    <th>Autor</th>
    </tr>
  {section loop=$desistencias name=pr}
    <tr {if $smarty.section.pr.iteration is odd}style='background: #d3d3d3{/if}'>
      <td><input type="checkbox" CHECKED name="status{$desistencias[pr].cod}" value="{$desistencias[pr].cod}" /></td>
      <td><a href="proposta/{$desistencias[pr].cod}">{$desistencias[pr].title}</a></td>
      <td>{$desistencias[pr].name}</td>
    </tr>
  {/section}
  </table>

  <center style='margin-left: 150px; margin-right: 150px;'>
    <input type='submit' value='Salvar Desistências'/>
    <br/>
    <br/>
    Clicando em <strong>Salvar Desistências</strong>,
    os status das propostas serão alterados para "Desistência".
  </center>
</form>

