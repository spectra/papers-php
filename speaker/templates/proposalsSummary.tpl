{if count($proposals)}
  {#followsAcceptedProposals#}
  <ul>
  {section loop=$proposals name=pr}
    <li>
      {$proposals[pr].titulo}
    </li>
  {/section}
  </ul>
{else}
  {#noAcceptedProposals#}
{/if}
