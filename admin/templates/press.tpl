<table class='formulario'>
  <tr>
    <th>Nome</th>
    <th>Veículo</th>
    <th>Cargo</th>
    <th>Registro Profissional</th>
    <th>Endereço Profissional</th>
    <th>País</th>
    <th>Estado</th>
    <th>Cidade</th>
    <th>e-mail</th>
    <th>Ações</th>
  </tr>
  {section loop=$press name=p}
    <tr>
      <td>{$press[p].nome}</td>
      <td>{$press[p].veiculo}</td>
      <td>{$press[p].cargo}</td>
      <td>{$press[p].registro_profissional}</td>
      <td>{$press[p].endereco_profissional}</td>
      <td>{$press[p].pais}</td>
      <td>{$press[p].estado}</td>
      <td>{$press[p].cidade}</td>
      <td>{$press[p].email}</td>
      <td>(<a href="press?acao=aprovar&cod={$press[p].cod}">aprovar</a>) (<a href="press?acao=remover&cod={$press[p].cod}">remover</a>) (<a href="press?acao=editar&cod={$press[p].cod}">editar</a>)</td>
    </tr>
  {/section}
</table>
<h2>Profissionais Aprovados</h2>
<table class='formulario'>
  <tr>
    <th>Nome</th>
    <th>Veículo</th>
    <th>Cargo</th>
    <th>Registro Profissional</th>
    <th>Endereço Profissional</th>
    <th>País</th>
    <th>Estado</th>
    <th>Cidade</th>
    <th>e-mail</th>
    <th>Ações</th>
  </tr>
  {section loop=$pressModerated name=p}
    <tr>
      <td>{$pressModerated[p].nome}</td>
      <td>{$pressModerated[p].veiculo}</td>
      <td>{$pressModerated[p].cargo}</td>
      <td>{$pressModerated[p].registro_profissional}</td>
      <td>{$pressModerated[p].endereco_profissional}</td>
      <td>{$pressModerated[p].pais}</td>
      <td>{$pressModerated[p].estado}</td>
      <td>{$pressModerated[p].cidade}</td>
      <td>{$pressModerated[p].email}</td>
      <td>(<a href="press?acao=reprovar&cod={$pressModerated[p].cod}">reprovar</a>)  (<a href="press?acao=editar&cod={$pressModerated[p].cod}">editar</a>)</td>
    </tr>
  {/section}
</table>
