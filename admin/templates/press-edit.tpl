<form action="pressSave" method="POST">
<input type="hidden" name="cod" value='{$pressPerson.cod}'/>
<table class='formulario'>
  <tr>
    <th>Nome</th>
    <td><input name='nome' type='text' value='{$pressPerson.nome}'/></td>
  </tr>
  <tr>
    <th>Veículo</th>
    <td><input name='veiculo'  type='text' value='{$pressPerson.veiculo}'/></td>
  </tr>
  <tr>
    <th>Cargo</th>
    <td><input name='cargo' type='text' value='{$pressPerson.cargo}'/></td>
  </tr>
  <tr>
    <th>Registro Profissional</th>
    <td><input name='registro_profissional' type='text' value='{$pressPerson.registro_profissional}'/></td>
  </tr>
  <tr>
    <th>Endereço Profissional</th>
    <td>
      <textarea
        maxlength="100"
        rows="2"
        cols="60"
        name="endereco_profissional">{$pressPerson.endereco_profissional}</textarea>
    </td>
  </tr>
  <tr>
    <th>País</th>
    <td><input name='pais' type='text' value='{$pressPerson.pais}'/></td>
  </tr>
  <tr>
    <th>Estado</th>
    <td><input name='estado' type='text' value='{$pressPerson.estado}'/></td>
  </tr>
  <tr>
    <th>Cidade</th>
    <td><input name='cidade' type='text' value='{$pressPerson.cidade}'/></td>
  </tr>
  <tr>
    <th>e-mail</th>
    <td><input name='email' type='text' value='{$pressPerson.email}'/></td>
  </tr>
  <tr>
    <th colspan='2'><input type='submit' value='Salvar'/></th>
  </tr>
</table>
</form>
