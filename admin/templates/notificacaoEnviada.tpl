<h1>Notificação realizada</h1>

{section loop=$propostas name=pr}
  {if ! $propostas[pr].notificacaoOk}
    <div>
      <strong>Atenção:</strong>
      Problema enviando mensagem para <code>{$propostas[pr].email}</code>.
    </div>
  {/if}
{/section}

<p>Os autores das seguintes propostas foram notificados:</p>

<table class='formulario'>
  <tr>
    <th>Proposta</th>
    <th>Autor</th>
    <th>E-mail</th>
    <th>Grupo:</th>
  </tr>
  {section loop=$propostas name=pr}
    <tr>
      <td>{$propostas[pr].title}</td>
      <td>{$propostas[pr].name}</td>
      <td>{$propostas[pr].email}</td>
      <td>
        {$tipo}
      </td>
    </tr>
  {/section}
</table>
