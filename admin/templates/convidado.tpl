<form action="convidadoSave" method="POST">
<table class='formulario' align='center'>
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
    <th>Título da palestra</th>
    <td><input type="text" name="titulo"/></td>
  </tr>
  <tr>
    <th>Tipo da palestra</th>
    <td>
      <select name='tipo'>
        <option value='c'>Convidado</option>
        <option value='p'>Patrocinador</option>
        <option value='v'>Venda (palestra comercial)</option>
      </select>
    </td>
  </tr>
  <tr>
    <th>Macro-tema</th>
      <td>
        <select name="tema">
          <option></option>
          {section loop=$macrotemas name=m}
            <option value='{$macrotemas[m].cod}'>{$macrotemas[m].titulo}</option>
          {/section}
        </select>
      </td>
  </tr>
  <tr>
    <th>Resumo (para programação, +/- 50 palavras)</th>
    <td><textarea name="resumo" cols='60' rows='10'></textarea></td>
  </tr>
  <tr>
    <th>Idioma:</th>
    <td>
      <select name="idioma">
        <option value="pt">Português</option>
        <option value="en">Inglês</option>
        <option value="es">Espanhól</option>
      </select>
    </td>
  </tr>
  <tr>
    <td colspan='2'>
      <input type="submit"/>
    </td>
  </tr>
</table>
</form>
