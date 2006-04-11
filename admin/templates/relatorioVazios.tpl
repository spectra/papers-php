<h1><a name="inicio">Relatório de horários vazios</a></h1>

<table align='center' class='formulario'>
  <tr>
    <th>Dia</th>
    <th>Sala</th>
    <th>Horário</th>
  </tr>
{section loop=$vazios name=v}
  <tr>
    <td>{$vazios[v].dia}</td>
    <td>{$vazios[v].sala}</td>
    <td>{$vazios[v].horario}</td>
  </tr>
{/section}
</table>
