<!-- $Id$ -->

<script language="JavaScript" type="text/javascript" src="js/proposta.js">
</script>

<form name="f1" action="propostaSave" method="POST" onSubmit="return chEspSt();">
  <input type="hidden" name="cod" value="{$rs.cod}">
  <table cellpadding="3" cellspacing="0">
    <tbody>
    <tr>
      <td>Proponente:
      </td>
      <td><a href="proponente/{$rs.pessoa}">{$rs.nome}</a>
      </td>
    </tr>
    <tr>
      <td>Título:
      </td>
      <td><input size="40" maxlength="200" name="titulo" type="text" value='{$rs.titulo}'>
      </td>
    </tr>
    <tr>
      <td valign='top'>Copalestrantes:
         <br/>
         (<a href="copalestrantes/{$rs.cod}">Alterar</a>)
      </td>
      <td>
        {section loop=$copalestrantes name=cp}
          <a href="proponente/{$copalestrantes[cp].cod}">{$copalestrantes[cp].nome}</a>
          <br/>
        {/section}
        <br/>
      </td>
    </tr>
    <tr>
      <td valign='top'>Coordenação de Mesa:
         <br/>
         (<a href="mesa/{$rs.cod}">Alterar</a>)
      </td>
      <td>
        {section loop=$mesa name=m}
          <a href="proponente/{$mesa[m].cod}">{$mesa[m].nome}</a>
          <br/>
        {/section}
        <br/>
      </td>
    </tr>

    <tr>
      <td bgcolor="{$stcolor}">Status:
      </td>
      <td bgcolor="{$stcolor}"><select name="status" onChange="chStatus()">
      <option value="i">Indefinido</option>
      <option value="a"{if $rs.status == 'a'} selected{/if}>Aprovado</option>
      <option value="r"{if $rs.status == 'r'} selected{/if}>Reprovado</option>
      <option value="p"{if $rs.status == 'p'} selected{/if}>Pré-aprovado</option>
      <option value="c"{if $rs.status == 'c'} selected{/if}>Convidado</option>
      <option value="d"{if $rs.status == 'd'} selected{/if}>Desistência</option>
      </select>
      </td>
    </tr>

    <tr>
      <td>Espaço na grade:
      </td>
      <td><input type="text" name="espaco" value="{$rs.espaco}" maxlength="3" size="5"> <a href="javascript:checkEspaco()">verificar disponibilidade</a>
      </td>
    </tr>
    
    <tr>
      <td>Macrotema:
      </td>
      <td><select name="tema">
      {section loop=$macrotemas name=c}
        <option value="{$macrotemas[c].cod}" {if $rs.tema == $macrotemas[c].cod}selected{/if}>{$macrotemas[c].titulo}</option>
      {/section}
      </select>
      </td>
    </tr>
    <tr>
      <td>Nível envolvimento do Proponente:
      </td>
      <td>
        <select name="nivel_envolvimento" id="nivel_envolvimento">
          {section loop=$envolvement_level name=c}
             <option value="{$envolvement_level[c]}" 
                  {if $rs.nivel_envolvimento ==$envolvement_level[c]}selected{/if}>
                    {$envolvement_level[c]}
             </option>
          {/section}
        </select>                    
      </td>
    </tr>
    <tr>
      <td>Nível da Palestra:
      </td>
      <td>
        <select name="nivel_proposta" id="nivel_proposta">
          {section loop=$proposal_level name=c}
             <option value="{$proposal_level[c]}" 
                  {if $rs.nivel_proposta ==$proposal_level[c]}selected{/if}> {$proposal_level[c]}
             </option>
          {/section}
        </select>                    
      </td>
    </tr>        
    <tr>
      <td>Idioma:
      </td>
      <td><select name="idioma">
      <option value="pt"{if $rs.idioma == 'pt'} selected{/if}>Português</option>
      <option value="en"{if $rs.idioma == 'en'} selected{/if}>Inglês</option>
      <option value="es"{if $rs.idioma == 'es'} selected{/if}>Espanhól</option>
      </select>
      </td>
    </tr>
    <tr>
      <td>Público-alvo:
      </td>
      <td><textarea cols="80" rows="5" name="publicoalvo">{$rs.publicoalvo}</textarea>
      </td>
    </tr>
    <tr>
      <td>Descrição da palestra:<br>
      <font size="-1"><i>Até 250 palavras</i></font>
      </td>
      <td><textarea cols="80" rows="8" name="descricao">{$rs.descricao}</textarea>
      </td>
    </tr>
    <tr>
      <td>Resumo da apresentação:<br>
      <font size="-1"><i>+/- 50 palavras<br>
      Para peças de divulgação</i></font>
      </td>
      <td><textarea cols="80" rows="5" name="resumo">{$rs.resumo}</textarea>
      </td>
    </tr>
    <tr>
      <td>Co-apresentadores:<br>
      <font size="-1"><i>Nome e e-mail</i></font>
      </td>
      <td><textarea cols="80" rows="5" name="coapresentadores">{$rs.coapresentadores}</textarea>
      </td>
    </tr>
    <tr>
      <td>Comentários:
      </td>
      <td><textarea cols="80" rows="5" name="comentarios">{$rs.comentarios}</textarea>
      </td>
    </tr>

    <tr>
      <td><b>Comentários<br>administrativos:</b>
      </td>
      <td><textarea name="comadm" rows="5" cols="80">{$rs.comadm}</textarea>
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
      <td bgcolor="#eeeeee" align="center" colspan="2"><input value="Salvar alterações" type="submit">
      </td>
    </tr>
  </tbody></table>
</form>
