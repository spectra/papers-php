  var opt;
{section loop=$keywords name=k}
  // start a new item
  opt = document.createElement('input');
  opt.type = 'checkbox';
  opt.name = 'keyword_{$keywords[k].id}';
  opt.checked = {if $keywords[k].chosen}true{else}false{/if};
  target.appendChild(opt);
  target.appendChild(document.createTextNode("{$keywords[k].descr}"));
  target.appendChild(document.createElement('br'));
{/section}
