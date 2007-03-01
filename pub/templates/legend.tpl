<hr/>
<h2>Trilhas</h2>

<p>Desmarque/marque as trilhas para escondê-las/exibí-las</p>

<table border="0" width='100%' id='table_legend'>
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

var show = {
  'tech' : true,
  'non_tech' : true
};

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
    if (cell.className == 'tech_track_' + cod ) {
      toggleByTag(cell, tagname, checkbox.checked && show['tech']);
    }
    if (cell.className == 'non_tech_track_' + cod ) {
      toggleByTag(cell, tagname, checkbox.checked && show['non_tech']);
    }
  }
}

function toggle_tech(checkbox, type, tagname) {
  show[type] = checkbox.checked;
  track_boxes = document.getElementById('table_legend').getElementsByTagName('input');
  for (var i = 0; i < track_boxes.length; i++) {
    box = track_boxes[i];
    if (box.type == 'checkbox') {
      cod = box.name.replace(/^track/, '');
      toggle(box, cod, tagname);
    }
  }
}

</script>
{/literal}

<h2>Exibir palestras técnicas/não-técnicas</h2>

<ul>
  <div>
    <input type='checkbox' name='show_tech' checked onclick='javascript: toggle_tech(this, "tech", "{if $print}div{else}td{/if}")'/> Exibir palestras técnicas
  </div>
  <div>
    <input type='checkbox' name='show_tech' checked onclick='javascript: toggle_tech(this, "non_tech", "{if $print}div{else}td{/if}")'/> Exibir palestras não-técnicas
  </div>
</ul>

<hr/>
