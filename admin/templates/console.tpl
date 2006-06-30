<h2>Console SQL</h2>


{if $has_data}
<table class='formulario' align='center'>
<!-- fields -->
<tr>
{section loop=$fields name=h}
<th>{$fields[h]}</th>
{/section}
</tr>
<!-- body -->
{section loop=$data name=i}
  <tr>
  {section loop=$fields name=f}
    {assign var=thefield value=$fields[f]}
    <td>{$data[i][$thefield]}</td>
  {/section}
  </tr>
{/section}
</table>
{/if}

<center>
<form method="post">
  <textarea name='sql' cols='80' rows='10'>{$sql}</textarea>
  <br/>
  <input type='submit' value='Execute'/>
</form>
</center>
