<h2>{#addSpeaker#}: {$proposal.titulo}</h2>
<div class='message'>
<span>{#attention#}</span>
{#addSpeakerExplanation#}
</div>

{if $search}
<center>
<h3>{#clickToAddSpeaker#}</h3>
</center>
<table class='formulario' align='center'>
  <tr>
    <th>{#name#}</th>
    <th>e-mail</th>
  </tr>
  {section loop=$search name=s}
    <tr>
      <td><a href='addSpeakerSave?cod={$proposal.cod}&scod={$search[s].cod}'>{$search[s].nome}</a></td>
      <td><a href='addSpeakerSave?cod={$proposal.cod}&scod={$search[s].cod}'>{$search[s].email}</a></td>
    </tr>
  {/section}
</table>
{else}
<center>
<h3>{#searchSpeaker#}</h3>
<form action="addSpeaker/{$proposal.cod}" method="GET">
  <input type="text" name="search" size="50">
  <input type="submit" value="{#search#}"/>
</form>
</center>
{/if}

