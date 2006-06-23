{if $keywords}
{section loop=$keywords name=k}
<input type='checkbox' name='keyword_{$keywords[k].id}' {if $keywords[k].chosen}checked{/if}/> {$keywords[k].descr}<br/>
{/section}
{/if}
