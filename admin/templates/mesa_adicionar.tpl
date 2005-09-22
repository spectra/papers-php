<form action="mesaSave" method="POST">
<table class='formulario' align='center'>
  <input type="hidden" name="proposta" value="{$proposta.cod}"/>
  <tr>
    <th>Nome:</th>
    <td><input type="text" name="nome"/></td>
  </tr>
  <tr>
    <th>e-mail:</th>
    <td><input type="text" name="email"/></td>
  </tr>
  <tr>
    <th>mini-currículo:</th>
    <td><textarea name="biografia" cols='60' rows='10'></textarea></td>
  </tr>
  <tr>
    <td colspan='2'>
      <input type="submit"/>
    </td>
  </tr>
</table>
</form>
