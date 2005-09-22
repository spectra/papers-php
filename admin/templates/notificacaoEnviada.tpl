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
    <th>Mensagem</th>
  </tr>
  {section loop=$propostas name=pr}
    <tr>
      <td>{$propostas[pr].title}</td>
      <td>{$propostas[pr].name}</td>
      <td>{$propostas[pr].email}</td>
      <td>
        {if $tipo eq 'a'}Aceitação{/if}
        {if $tipo eq 's'}Aguardo{/if}
        {if $tipo eq 'r'}Recusa{/if}
        {if $tipo eq 'p'}Prorrogada{/if}
        {if $tipo eq 'd'}Desistência{/if}
        {if $tipo eq 'n'}Novas Aprovadas{/if}
        {if $tipo eq 'c'}Convidado{/if}
        {if $tipo eq 'm'}Coordenador de mesa{/if}
      </td>
    </tr>
  {/section}
</table>
