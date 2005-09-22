<h2>{#track#}s</h2>

<dl>
{section loop=$tracks name=t}
  <dt><strong>{$tracks[t].titulo}</strong></dt>
  <dd><em>{$tracks[t].descr}</em></dd>
{/section}
</dl>
