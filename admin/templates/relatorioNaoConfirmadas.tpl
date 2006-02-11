<h2>Relatório: palestras aprovadas e não confirmadas</h2>

<table align='center' class='formulario'>
  <tr>
    <th>Pessoa</th>
    <th>Palestra</th>
  </tr>
{section loop=$propostas name=p}
  <tr>
    <td>{$propostas[p].nome}</td>
    <td>{$propostas[p].titulo}</td>
  </tr>
{/section}
</table>
