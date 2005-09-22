<h2>Imprensa / <em>Press</em></h2>

<center>
<strong>
<a href="press#cadastro">Quero cadastrar meu veículo</a> <br/>
<em><a href="press#cadastro">I want to include my vehicle</a></em>
</strong>
</center>

<h2>Veículos já cadastrados (<em>registered vehicles</em>):</h2>

{section loop=$press name=p}
<div class='press'>
<strong>{$press[p].veiculo}</strong>
({$press[p].num}
{if $press[p].num == 1}profissional{else}profissionais{/if}
)
<br/>
{$press[p].cidade} - {$press[p].estado} - {$press[p].pais}
</div>
{/section}

<a name="cadastro"></a>
{include file='pressForm.tpl'}
