<ul>
  {section loop=$copalestrantes name=cp}
    <li>
      <a href="proponente/{$copalestrantes[cp].cod}">{$copalestrantes[cp].nome}</a>
      (<a href="copalestrantes/{$proposta.cod},{$copalestrantes[cp].cod}?acao=remover">remover</a>)
    </li>
  {/section}
</ul>

<ul>
  <li>
    <a href="copalestrantes/{$proposta.cod}?acao=adicionar">Adicionar copalestrante <strong>não cadastrado</strong> ainda</a>
  </li>
  <li>
    <a href="copalestrantes/{$proposta.cod}?acao=escolher">Adicionar copalestrante <strong>já cadastrado</strong></a>
  </li>
</ul>
