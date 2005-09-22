<!-- $Id$ -->

<form action='proponenteSave' method='POST' name="f1">
<input type="hidden" name="cod" value="{$rs.cod}">
<table cellspacing="0" cellpadding="2">

  <tr>
    <td>Nome completo:</td>

    <td><input size="30" maxlength="50" name="nome" type="text"
    value='{$rs.nome}'></td>

    <td>E-mail:</td>

    <td><input size="30" maxlength="50" name="email" type="text"
    value="{$rs.email}"> <a href="mailto:{$rs.email}">escrever</a></td>
  </tr>

  <tr>
    <td>RG:</td>
    <td>
      <input type="text" size="15" maxlength="15"
             name="rg" value="{$rs.rg}"/>
    </td>
    <td>Órgão Expeditor:</td>
    <td>
      <input type="text" name="rg_orgao" value="{$rs.rg_orgao}"
             size="15" maxlength="15"/>
    </td>
  </tr>
  <tr>
    <td>CPF:</td>
    <td>
      <input type="text" name="cpf" value="{$rs.cpf}"
             size="15" maxlength="11" />
    </td>
    <td>Passaporte:</td>
    <td>
      <input type="text" name="passaporte" value="{$rs.passaporte}"
             size="15" maxlength="30" />
    </td>
  </tr>

  <tr>
    <td>Instituição:</td>

    <td><input size="30" maxlength="50" name="org" type="text"
    value="{$rs.org}"></td>
    <td>Cidade:</td>

    <td><input size="30" maxlength="30" name="cidade" type="text"
    value="{$rs.cidade}"></td>
  </tr>

  <tr>
    <td>Estado:</td>

    <td><input size="30" maxlength="30" name="estado" type="text"
    value="{$rs.estado}"></td>
    <td>País:</td>

    <td><input size="30" maxlength="30" name="pais" type="text"
    value="{$rs.pais}"></td>
  </tr>

  <tr>
    <td>Telefone:<br>
    <font size="-1"><i>com DDD</i></font></td>

    <td><input size="30" maxlength="30" name="fone" type="text"
    value="{$rs.fone}"></td>
    <td>URL de uma foto:<br>
    <font size="-1"><i>100x100 alta qualidade</i></font></td>

    <td><input size="30" name="fotourl" type="text" value="{$rs.fotourl}">{if
    $rs.fotourl} <a href="{$rs.fotourl}" target="_window">abrir</a>{/if}</td>
  </tr>

  <tr>
    <td></td>
    <td><label><input type="checkbox" name="newpass"
    value="1"> Enviar nova senha por e-mail</label>
    </td>

    <td bgcolor="{$stcolor}">Situação:
    </td>

    <td bgcolor="{$stcolor}"><select name="status" onChange="chStatus()">
    <option value="i">Indefinido</option>
    <option value="a"{if $rs.status == 'a'} selected{/if}>Aprovado</option>
    <option value="r"{if $rs.status == 'r'} selected{/if}>Reprovado</option>
    <option value="p"{if $rs.status == 'p'} selected{/if}>Pré-aprovado</option>
    <option value="d"{if $rs.status == 'd'} selected{/if}>Desistência</option>
    </select>
    </td>
  </tr>

  <tr>
    <td>Viagem:
    </td>
    <td><label><input type="checkbox" name="pago" value="1"{if $rs.pago} checked{/if} onChange="chPago(this)"> Pago pelo PSL</label>
    </td>

    <td>Valor viagem:
    </td>
    <td><input type="text" name="vl_viagem" value="{$rs.vl_viagem|string_format:"%.2f"}" size="20" onChange="chValores(this)">
    </td>
  </tr>

  <tr>
    <td>
    </td>
    <td>
    </td>
    <td>Valor hospedagem:
    </td>
    <td><input type="text" name="vl_hotel" value="{$rs.vl_hotel|string_format:"%.2f"}" size="20" onChange="chValores(this)">
    </td>
  </tr>

  <tr>
    <td>
    </td>
    <td>
    </td>
    <td>Valor alimentação:
    </td>
    <td><input type="text" name="vl_alimen" value="{$rs.vl_alimen|string_format:"%.2f"}" size="20" onChange="chValores(this)">
    </td>
  </tr>

  <tr>
    <td>
    </td>
    <td>
    </td>
    <td>Outros:
    </td>
    <td><input type="text" name="vl_outros" value="{$rs.vl_outros|string_format:"%.2f"}" size="20" onChange="chValores(this)">
    </td>
  </tr>

  <tr>
    <td>
    </td>
    <td>
    </td>
    <td><b>TOTAL:</b>
    </td>
    <td><input type="text" name="vl_total" size="20" value="0.00" readonly style="background-color: #EEEEEE">
    </td>
  </tr>

  <tr>
    <td colspan="4">&nbsp;
    </td>
  </tr>

  <tr>
    <td>Mini-currículum:<br>
    <font size="-1"><i>+/- 50 palavras</i></font></td>

    <td colspan="3">
    <textarea cols="80" rows="8" name="biografia">{$rs.biografia}</textarea></td>
  </tr>

  <tr>
    <td>Comentários:</td>

    <td colspan="3">
    <textarea cols="80" rows="8" name="coment">{$rs.coment}</textarea></td>
  </tr>

  <tr>
    <td><b>Comentários<br>administrativos:</b>
    </td>
    <td colspan="3"><textarea name="comentadm" rows="8"
    cols="80">{$rs.comentadm}</textarea>
    </td>
  </tr>

  <tr>
    <td>Data de inserção:
    </td>
    <td colspan="3">{$rs.dthora|date_format:"%d/%b/%Y %Hh%M"}
    </td>
  </tr>

  <tr>
    <td>Última alteração:
    </td>
    <td colspan="3">{$rs.tstamp|date_format:"%d/%b/%Y %Hh%M"}
    </td>
  </tr>

  <tr>
    <td>Propostas:
    </td>
    <td colspan="3" style="border: dashed 1px #CCCCCC">
      {include file="propostasPessoa.tpl"}
    </td>
  </tr>

  <tr>
    <td colspan="4" align="center"><input type="submit"
    value="Salvar alterações">
    </td>
  </tr>

  <tr>
    <td colspan="4" align="center" style="padding-top: 15px">
      {include file="legenda.tpl"}
    </td>
  </tr>
  
</table>
</form>

<script language="JavaScript" type="text/javascript" src="js/proponente.js">
</script>
