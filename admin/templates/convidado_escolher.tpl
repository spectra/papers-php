<h2>Escolher pessoa para incluir como convidado</h2>

<ul>
  {section loop=$pessoas name=p}
    <li>
      <a href="convidado?select=no&cod={$pessoas[p].cod}">{$pessoas[p].nome}</a>
    </li>
  {/section}
</ul>
