<form action="macrotemasSave" method="POST">
  <table class='formulario' align='center'>
  <tr>
    <th>Espa&#231;os nos Macrotemas</th>
  </tr>
  </table>
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
</form>

<form action="addmacrotemaSave" method="POST">
<br>
<table class='formulario' align='center'>
  <tr>
    <th>Adicione novo macrotema</th>
  </tr>
</table>
<table class='formulario' align='center'>
  <tr>
    <th>T&iacute;tulo:</th>
    <td><input type="text" name="titulo"/></td>
  </tr>
  <tr>
    <th>T&iacute;tulo em ingl&ecirc;s:</th>
    <td><input type="text" name="titulo_en"/></td>
  </tr>
  <tr>
    <th>Descri&ccedil;&atilde;o:</th>
    <td><input type="text" name="descr"/></td>
  </tr>
  <tr>
    <th>Descri&ccedil;&atilde;o em ingl&ecirc;s:</th>
    <td><input type="text" name="descr_en"/></td>
  </tr>
  <tr>
    <th>Espa&ccedil;os:</th>
    <td><input type="text" name="espacos"/></td>
  </tr>
  <tr>
    <td colspan='2'>
      <input type="submit"/>
    </td>
  </tr>
</table>
</form>
