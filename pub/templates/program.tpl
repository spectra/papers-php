<h1>{$event.name} - Programação</h1>

<p>
Salas, dias e horários estão sujeitos a alterações, de acordo com os critérios
da organização do <em>{$event.name}</em>.
</p>

<p>
<strong>Veja também:</strong> uma versão sem decorações,
<a href="programacao?print=1">para impressão</a>.
</p>

<div id="legend">
{include file="legend.tpl"}
</div>

<div id="program">
{include file='grade.tpl'}
</div>

<div style='text-align: center; margin: 1em;'>
Dúvidas? Escreva para <code>{mailto address=$event.contact_email encode="javascript"}</code>
</div>
