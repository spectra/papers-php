<ul>
  {section loop=$pessoas name=p}
    <li>
      <a href="mesa/{$proposta.cod},{$pessoas[p].cod}?acao=incluir">{$pessoas[p].nome}</a>
    </li>
  {/section}
</ul>
