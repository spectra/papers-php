<!-- $Id$ -->
{config_load file=papers.conf}

<script language="JavaScript" type="text/javascript" src="js/proponentes.js">
</script>

<div class="small">
  <form name="f1">
    Filtro: <select name="status" onChange="stChange()">
      <option></option>
      <option value="i"{if $st == 'i'} selected{/if}>Indefinido</option>
      <option value="a"{if $st == 'a'} selected{/if}>Aprovado</option>
      <option value="r"{if $st == 'r'} selected{/if}>Reprovado</option>
      <option value="p"{if $st == 'p'} selected{/if}>Pré-aprovado</option>
      <option value="d"{if $st == 'd'} selected{/if}>Desistência</option>
    </select>
  </form>
</div>

<hr>

<div align="center">
  {include file="legenda.tpl"}
</div>

<div align="right"><strong>Total: {$total}</strong></div>

<table width="100%">
  <tr bgcolor="#CCCCCC">
    <th width="15"></th>
    <th>Nome
    </th>
    <th>Organização
    </th>
    <th>País
    </th>
  </tr>

  {section loop=$rs name=p}
  <tr{if $smarty.section.p.index is even} bgcolor="#EEEEEE"{/if}>

    {if $rs[p].status == 'a'}{assign var='stcolor' value=#bgcolor_a#}
    {elseif $rs[p].status == 'r'}{assign var='stcolor' value=#bgcolor_r#}
    {elseif $rs[p].status == 'd'}{assign var='stcolor' value=#bgcolor_d#}
    {elseif $rs[p].status == 'p'}{assign var='stcolor' value=#bgcolor_p#}
    {elseif $rs[p].status == 'i'}{assign var='stcolor' value=#bgcolor_i#}{/if}
  
    <td bgcolor="{$stcolor}">
    </td>
    <td><a href="proponente/{$rs[p].cod}">{$rs[p].nome}</a>
    </td>
    <td>{$rs[p].org}
    </td>
    <td>{$rs[p].pais}
    </td>
  </tr>
  {/section}
</table>

<div align="center" style="margin-top: 15px">
  {include file="legenda.tpl"}
</div>
