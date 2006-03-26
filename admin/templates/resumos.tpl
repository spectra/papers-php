<html>
<body>

<h1>Resumos</h1>

{section loop=$resumos name=r}
<center>
<h2>{$resumos[r].titulo}</h2>
<h3>Trilha: {$resumos[r].macrotema}</h3>

{$resumos[r].nome} <br/>
<u>{$resumos[r].email}</u><br/>
{if $resumos[r].org}
  {$resumos[r].org} <br/>
{/if}
{if $biografia}
  <blockquote><strong>Minicurrículo:</strong> {$resumos[r].biografia}</blockquote>
{/if}

{assign var=cops value=$resumos[r].copalestrantes}
{section loop=$cops name=c} 
<br/>
{$cops[c].nome} <br/>
<u>{$cops[c].email}</u> <br/>
{if $cops[c].org}
  {$cops[c].org} <br/>
{/if}
{if $biografia}
  (bleble)
  <blockquote><strong>Minicurrículo:</strong> {$cops[c].biografia}</blockquote>
{/if}
{/section}
</center>

<br/>

<div>
{if $biografia}
<strong>Resumo:</strong>
{/if}
{$resumos[r].resumo}
</div>
<hr/>

{/section}
</body>
</html>

