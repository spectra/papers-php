<h2>Cadastro para Imprensa / <em>Press Registration</em></h2>

{if $missing}
  <div class='error'>
    <p>
    <strong>
    Erro (<em>Error</em>):
    </strong>
    </p>
    <ul>
      {section loop=$missing name=m}
        <li>
          {assign var=miss value=$missing[m]}
          {$labels[$miss]}:
          campo obrigatório
          (<em>mandatory field</em>)
          .
        </li>
      {/section}
    </ul>
  </div>
{/if}
<p>
<span style='color:red;'><strong>*</strong></span>
= campos obrigatórios
(<em>mandatory fields</em>)
</p>

<form action="pressSave" method="POST">
<table class='press'>
  <tr>
    <td>Nome / <em>Name</em>
      <span style='color:red;'><strong>*</strong></span>
    </td>
    <td><input type="text" size="50" maxlength="50" name="nome" value="{$fields.nome}"/></td>
  </tr>
  <tr>
    <td>Veículo / <em>Vehicle</em>
      <span style='color:red;'><strong>*</strong></span>
    </td>
    <td><input type="text" size="50" maxlength="50" name="veiculo" value="{$fields.veiculo}"/></td>
  </tr>
  <tr>
    <td>Cargo / <em>Position</em></td>
    <td><input type="text" size="30" maxlength="30" name="cargo" value="{$fields.cargo}"/></td>
  </tr>
  <tr>
    <td>Registro Profissional / <em>Professional ID</em></td>
    <td><input type="text" size="30" maxlength="30" name="registro_profissional" value="{$fields.registro_profissional}"/></td>
  </tr>
  <tr>
    <td>Endereço Profissional / <em>Professional Address</em></td>
    <td>
      <textarea
        maxlength="100"
        rows="2"
        cols="60"
        name="endereco_profissional">{$fields.endereco_profissional}</textarea>
    </td>
  </tr>
  <tr>
    <td>Cidade / <em>City</em>
      <span style='color:red;'><strong>*</strong></span>
    </td>
    <td><input type="text" size="30" maxlength="30" name="cidade" value="{$fields.cidade}"/></td>
  </tr>
  <tr>
    <td>Estado / <em>State</em>
      <span style='color:red;'><strong>*</strong></span>
    </td>
    <td><input type="text" size="30" maxlength="30" name="estado" value="{$fields.estado}"/></td>
  </tr>
  <tr>
    <td>País / <em>Country</em>
      <span style='color:red;'><strong>*</strong></span>
    </td>
    <td><input type="text" size="30" maxlength="30" name="pais" value="{$fields.pais}"/></td>
  </tr>
  <tr>
    <td>e-mail
      <span style='color:red;'><strong>*</strong></span>
    </td>
    <td><input type="text" size="50" maxlength="50" name="email" value="{$fields.email}"/></td>
  </tr>
  <tr>
    <td colspan='2' align='center'>
      <input type="submit" value='Enviar'/>
      <strong><em>Submit</em></strong>
    </td>
  </tr>
</table>
</form>
