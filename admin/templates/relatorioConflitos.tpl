<h1><a name="inicio">Relatório de Conflito de horários</a></h1>

<table align='center' class='formulario'>
  <tr>
    <th>Pessoa</th>
    <th>Dia</th>
    <th>Horário</th>
    <th>Número de espaços</th>
  </tr>
{section loop=$conflitos name=c}
  <tr>
    <td>{$conflitos[c].nome}</td>
    <td>{$conflitos[c].dia}</td>
    <td>{$conflitos[c].horario}</td>
    <td>{$conflitos[c].count}</td>
  </tr>
{/section}
</table>
