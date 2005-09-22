<form action="horarioSave" method="POST">

<table class='formulario' align='center'>
  <tr>
    <th>Número</th>
    <td>{if $horario.numero}<input type="hidden" name="numero" value="{$horario.numero}"/>{$horario.numero}{else}<input type="text" name="numero" size="4"/>{/if}</td>
  </tr>
  <tr>
    <th>Início</th>
    <td><input type="text" name="inicio" value="{$horario.inicio}"/> (HH:MM ou HH:MM:SS)</td>
  </tr>
  <tr>
    <th>Final</th>
    <td><input type="text" name="final" value="{$horario.final}"/> (HH:MM ou HH:MM:SS)</td>
  </tr>
  <tr>
    <th colspan='2'><input type="submit" value="Salvar"/></th>
  </tr>
</table>
</form>
