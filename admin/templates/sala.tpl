<form action="salaSave" method="POST">

<table class='formulario' align='center'>
  <tr>
    <th>Número</th>
    <td>{if $sala.numero}<input type="hidden" name="numero" value="{$sala.numero}"/>{$sala.numero}{else}<input type="text" name="numero" size="4"/>{/if}</td>
  </tr>
  <tr>
    <th>Descrição</th>
    <td><input type="text" name="descricao" value="{$sala.descricao}"/> </td>
  </tr>
  <tr>
    <th>Detalhes</th>
    <td><textarea name="detalhes" cols="60" rows="3">{$sala.detalhes}</textarea> </td>
  </tr>
  <tr>
    <th colspan='2'><input type="submit" value="Salvar"/></th>
  </tr>
</table>
</form>
