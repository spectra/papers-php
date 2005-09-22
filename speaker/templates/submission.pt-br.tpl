<h2>Submissões de propostas</h2>

<p>
As submissões estão abertas até o dia <u>{$submissionLastDay|date_format}</u>.
Você pode <a href='submit'>submeter uma proposta de palestra</a>.
</p>

{if count($proposals)}
{include file="proposals.tpl"}
{/if}
