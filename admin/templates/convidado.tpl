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
    <th>Título</th>
    <td><input type="text" name="titulo"/></td>
  </tr>
  <tr>
    <th>Macro-tema</th>
      <td>
        <select name="tema">
          <option></option>
          <option value="1">Desenvolvimento</option>
          <option value="2">Bancos de Dados</option>
          <option value="3">Desktop</option>
          <option value="4">Redes</option>
          <option value="5">Segurança</option>
          <option value="6">Cases</option>
          <option value="7">Comunidade</option>
          <option value="8">Software Livre em Governos</option>
          <option value="9">Política/Filosofia</option>
          <option value="10">Inclusão Social/Digital</option>
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
