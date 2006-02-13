<hr/>

<p>Desmarque/marque as trilhas para escondê-las/exibí-las</p>

<table border="0" width='100%'>
<tr>
<form>
{section loop=$macrotemas name=m}
<td width='25%' {if !$print}style='background: {$macrotemas[m].cor};'{/if}>
<input type='checkbox' name='track{$macrotemas[m].cod}' checked onclick='javascript: toggle(this, {$macrotemas[m].cod}, "{if $print}div{else}td{/if}")'>
{$macrotemas[m].titulo}
</td>
{if $smarty.section.m.iteration % 4 == 0}
</tr><tr>
{/if}
{/section}
</form>
</tr>
</table>
<hr/>
{literal}
<script language='javascript'>

function toggleByTag(element, tagname, show) {
  if (tagname == 'div') {
    element.style.display = show?'block':'none';
    return;
  }
  if (tagname == 'td') {
    element.style.visibility = show?'visible':'hidden';
    return;
  }
}

function toggle(checkbox, cod, tagname) {
  var elements = document.getElementsByTagName(tagname);
  for (var i = 0; i < elements.length; i++) {
    var cell = elements.item(i);
    if (cell.className == 'track_' + cod) {
      toggleByTag(cell, tagname, checkbox.checked);
    }
  }
}
</script>
{/literal}
