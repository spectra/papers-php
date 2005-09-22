<ul>
  {section loop=$rs name=i}
    <li>
      <a href="dias/{$rs[i].numero}">{$rs[i].numero}: {$rs[i].descricao}</a>
    </li>
  {/section}
</ul>
<a href="dias/0">Incluir dia</a>
