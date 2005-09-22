<!-- $Id$ -->
{config_load file=papers.conf section="colors"}

<script language="JavaScript" type="text/javascript" src="js/propostas.js">
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
      <option value="c"{if $st == 'c'} selected{/if}>Convidado</option>
    </select>
  </form>
</div>

<hr>

<div align="center">
  {include file="legenda.tpl"}
</div>

<div align="right"><strong>Total: {$total}</strong></div>
{section name=mt loop=$rs_mt}
<table style="border: 1px solid black; margin-top: 10px" width="100%">
  <tr>
    <th colspan="3" bgcolor="#CCCCCC">{$rs_mt[mt].titulo}
    </th>
  </tr>

  {assign var="tema" value=$rs_mt[mt].cod}
  {section name=pr loop=$rs_pr[$tema]}
    {if $rs_pr[$tema][pr].status == 'a'}{assign var='stcolor' value=#bgcolor_a#}
    {elseif $rs_pr[$tema][pr].status == 'r'}{assign var='stcolor' value=#bgcolor_r#}
    {elseif $rs_pr[$tema][pr].status == 'd'}{assign var='stcolor' value=#bgcolor_d#}
    {elseif $rs_pr[$tema][pr].status == 'p'}{assign var='stcolor' value=#bgcolor_p#}
    {elseif $rs_pr[$tema][pr].status == 'i'}{assign var='stcolor' value=#bgcolor_i#}
    {elseif $rs_pr[$tema][pr].status == 'c'}{assign var='stcolor' value=#bgcolor_c#}{/if}
  <tr>
    <td bgcolor="{$stcolor}" width="15">
    </td>
    <td><a href="proposta/{$rs_pr[$tema][pr].cod}">{$rs_pr[$tema][pr].titulo}</a>
    </td>
    <td><a href="proponente/{$rs_pr[$tema][pr].pessoa}">{$rs_pr[$tema][pr].nome}</a>
    </td>
  </tr>
  {/section}
</table>
{/section}

<div align="center" style="margin-top: 10px">
  {include file="legenda.tpl"}
</div>
