<ul>
  {section loop=$rs name=i}
    <li>
      <a href="salas/{$rs[i].numero}">{$rs[i].numero}: {$rs[i].descricao}</a>
    </li>
  {/section}
</ul>
<a href="salas/0">Incluir sala</a>
