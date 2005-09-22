<h2>Bem-vindo</h2>

<p>
Olá, {$person.nome}.
</p>

{include file="proposalsSummary.tpl"}

{if count($proposals)}
<p>
É necessário que você <a href="proposals">confirme</a> a sua participação no
evento, para que a organização possa alocar a(s) sua(s) apresentação(ões) na
grade de programação. Além disso, é importante que você confira seus
<a href="personalInfo">dados pessoas</a>.
</p>
<p>
<strong>Importante:</strong>
A aceitação da(s) sua(s) palestras <strong>não</strong> implica que qualquer dos seus gastos com a participação no evento será coberto pela organização,
<em>a não ser que você esteja em contato com a organização e isso tenha sido discutido e aprovado pela mesma.</em>
</p>
{/if}

<p>
Você pode conferir a avaliação atribuída às suas propostas, a partir da
<a href='proposals'>listagem de propostas</a>.
</p>
