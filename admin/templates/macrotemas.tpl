<form action="macrotemasSave" method="POST">
  <table  align="center" class="formulario">
    {section loop=$rs name=p}
      <tr>
        <th >Macrotema "{$rs[p].titulo}"</th>
      </tr>
      <tr>
        <td align='center'>
          <input size="5" type="text" name="espacos_{$rs[p].cod}" value="{$rs[p].espacos}"/>
        </td>
      </tr>
    {/section}
    <tr>
      <th>
        <input type="submit" value="Salvar"/>
      </th>
    </tr>
  </table>
<form>
