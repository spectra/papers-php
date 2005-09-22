<table class='formulario' align='center'>
  <tr>
    <th colspan="2">Dados</th>
  </tr>
  <tr>
    <th>Proposta</th>
    <td>{$proposta.titulo}</td>
  </tr>
  <tr>
    <th>Autor</th>
    <td>{$pessoa.nome}</td>
  </tr>
  <tr>
    <th>Macrotema</th>
    <td>{$macrotema.titulo}</td>
  </tr>
  <tr>
    <th colspan="2">Na grade</th>
  </tr>
  {section loop=$celulas name=c}
    <tr>
      <td colspan="2">
        {$celulas[c].dia},
        {$celulas[c].inicio}/{$celulas[c].final},
        {$celulas[c].sala}
        (<a href="alocacaoSave?acao=remover&celula={$celulas[c].cod}">remover</a>)
        (<a href="alocacaoSave?acao=mover&celula={$celulas[c].cod}&proposta={$proposta.cod}">mover</a>)
      </td>
    </tr>
  {/section}
</table>

<center>
<a href="alocacao/{$proposta.cod}?force=1">Alocar mais um espaço</a>
</center>
