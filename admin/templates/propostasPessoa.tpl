<!-- $Id$ -->

<table>
  {section name=p loop=$pr}
  <tr>
    {if $pr[p].status == 'a'}{assign var='stcolor' value=#bgcolor_a#}
    {elseif $pr[p].status == 'r'}{assign var='stcolor' value=#bgcolor_r#}
    {elseif $pr[p].status == 'd'}{assign var='stcolor' value=#bgcolor_d#}
    {elseif $pr[p].status == 'p'}{assign var='stcolor' value=#bgcolor_p#}
    {elseif $pr[p].status == 'i'}{assign var='stcolor' value=#bgcolor_i#}{/if}
  
    <td bgcolor="{$stcolor}">&nbsp;&nbsp;&nbsp;
    </td>
    <td><a href="proposta/{$pr[p].cod}">{$pr[p].titulo}</a>
    </td>
  </tr>
  {/section}
</table>
