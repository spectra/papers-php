<hr/>
<h3>Legenda</h3>

<p>Desmarque as trilhas pelas quais você não tem interesse para escondê-las</p>

<table border="0" width='100%'>
<tr>
<form>
{section loop=$macrotemas name=m}
<td style='background: {$macrotemas[m].cor}; '>
<input type='checkbox' name='track{$macrotemas[m].cod}' checked onclick='javascript: toggle({$macrotemas[m].cod})'>
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
function toggle(cod) {

}
</script>
{/literal}
