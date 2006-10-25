<form action="convidadoSave" method="POST">
<table class='formulario' align='center'>
{if !$pessoa}
  <tr>
    <th>Nome:</th>
    <td><input type="text" name="nome"/></td>
  </tr>
  <tr>
    <th>e-mail:</th>
    <td><input type="text" name="email"/></td>
  </tr>
  <tr>
    <th>mini-currículo:</th>
    <td><textarea name="biografia" cols='60' rows='10'></textarea></td>
  </tr>
{else}
  <tr>
    <th>Pessoa:</th>
    <td>
      <a href="proponente/{$pessoa.cod}">{$pessoa.nome}</a>
      <input type="hidden" name="cod_pessoa" value="{$pessoa.cod}"/>
    </td>
  </tr>
{/if}
  <tr>
    <th>Envolvimento da pessoa com o Assunto:</th>
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
    <th>Título da palestra</th>
    <td><input type="text" name="titulo"/></td>
  </tr>
  <tr>
    <th>Nível da palestra:</th>
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
    <th>Tipo da palestra</th>
    <td>
      <select name='tipo'>
        <option value='c'>Convidado</option>
        <option value='p'>Patrocinador</option>
        <option value='v'>Venda (palestra comercial)</option>
      </select>
    </td>
  </tr>
  <tr>
    <th>Macro-tema</th>
      <td>
        <select name="tema">
          <option></option>
          {section loop=$macrotemas name=m}
            <option value='{$macrotemas[m].cod}'>{$macrotemas[m].titulo}</option>
          {/section}
        </select>
      </td>
  </tr>
  <tr>
    <th>Resumo (para programação, +/- 50 palavras)</th>
    <td><textarea name="resumo" cols='60' rows='10'></textarea></td>
  </tr>
  <tr>
    <th>Idioma:</th>
    <td>
      <select name="idioma">
        <option value="pt">Português</option>
        <option value="en">Inglês</option>
        <option value="es">Espanhól</option>
      </select>
    </td>
  </tr>
  <tr>
    <td colspan='2'>
      <input type="submit"/>
    </td>
  </tr>
</table>
</form>
