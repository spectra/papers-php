<h2>Proposal submissions</h2>

<p>
Submissions are open until <u>{$submissionLastDay|date_format}</u>.
You can <a href='submit'>submit a lecture proposal</a>.
</p>

{if count($proposals)}
{include file="proposals.tpl"}
{/if}
