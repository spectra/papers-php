<h2>{#personalInfo#}</h2>

<form action='{if $user}personalInfoSave{else}accountSave{/if}' method='POST'>
<table class='formulario' align='center' width='70%'>


  <tr>
    <th colspan='2'>
      {#personalInfo#}
      (<span class='warn'>*</span> = {#mandatoryFields#})
    </th>
  </tr>
  <tr>
    <td colspan='2' align='center'>
      <span style='color: green'><sup>BR</sup></span> for Brazilians only, don't care if you
      are not Brazilian.
      <br/>
    </td>
  </tr>

  <tr>
    <th>{#name#}:<span class='warn'>*</span>
    </th>
    <td><input size="30" maxlength="50" name="nome" type="text"
    value="{$person.nome}"></td>
  </tr>
  <tr>
    <th>E-mail:<span class='warn'>*</span>
    </th>
    <td><input size="30" maxlength="50" name="email" type="text"
    value="{$person.email}"></td>
  </tr>


  {if $user}
  <tr><td colspan='2'>&nbsp;</td></tr>
  <tr>
    <th colspan='2'>Change password</th>
  </tr>
  <tr>
    <th>{#currentPassword#}
    </th>
    <td ><input size="30" maxlength="50" name="currentPassword" type="password" value=""></td>
  </tr>
  {/if}
  <tr>
    <th>{if $user}{#newPassword#}{else}{#password#}{/if} {if !$user}<span class='warn'>*</span>{/if}  </th>
    <td><input size="30" maxlength="50" name="newPassword" type="password" value=""></td>
  </tr>
  <tr>
    <th>{#repeatPassword#}{if !$user}<span class='warn'>*</span>{/if}
    </th>
    <td><input size="30" maxlength="50" name="repeatPassword" type="password" value=""></td>
  </tr>

  <tr><td colspan='2'>&nbsp;</td></tr>

  <tr>
    <th>CPF: <span style='color: green'><sup>BR</sup></span></th>
    <td>
      <input type="text" name="cpf" value="{$person.cpf}"
             size="15" maxlength="11" />
      (sem pontos ou traços)
    </td>
  </tr>

{if ! $event.hide_optional_personal_info}
  <tr>
    <th>{#gender#}:</th>
    <td> 
       {#female#} <input type="radio" name="sexo" value="f" {if $person.sexo == 'f'}checked{/if} />
       {#male#}   <input type="radio" name="sexo" value="m" {if $person.sexo != 'f'}checked{/if} />
    </td>
  </tr>
   
  <tr>
    <th>{#nickname#}</th>
    <td><input type="text" name="nickname" size="30" maxlength="30" value='{$person.nickname}'/></td>
  </tr>

  <tr>
    <th>RG: <span style='color: green'><sup>BR</sup></span></th>
    <td>
      <input type="text" size="15" maxlength="15"
             name="rg" value="{$person.rg}"/>
    </td>
  </tr>

  <tr>
    <th>Órgão Expeditor: <span style='color: green'><sup>BR</sup></span></th>
    <td>
      <input type="text" name="rg_orgao" value="{$person.rg_orgao}"
             size="15" maxlength="15"/>
    </td>
  </tr>
  
  <tr>
    <th>{#passport#}:</th>
    <td>
      <input type="text" name="passaporte" value="{$person.passaporte}"
             size="15" maxlength="30" />
    </td>
  </tr>

  <tr>
    <th>{#institution#}:</th>

    <td><input size="30" maxlength="50" name="org" type="text"
    value="{$person.org}"></td>
  </tr>

  <tr>
    <th>{#city#}:</th>
    <td><input size="30" maxlength="30" name="cidade" type="text"
    value="{$person.cidade}"></td>
  </tr>

  <tr>
    <th>{#state#}:</th>

    <td><input size="30" maxlength="30" name="estado" type="text"
    value="{$person.estado}"></td>
  </tr>
  <tr>
    
    <th>{#country#}:</th>

    <td><input size="30" maxlength="30" name="pais" type="text"
    value="{$person.pais}"></td>
  </tr>

  <tr>
    <th>{#phone#}:<br>
    <font size="-1"><i>{#ddd#}</i></font></th>

    <td><input size="30" maxlength="30" name="fone" type="text"
    value="{$person.fone}"></td>
  </tr>

  <tr>
    <th>{#photoUrl#}:<br>
    <font size="-1"><i>{#photoSpec#}</i></font></th>

    <td><input size="30" name="fotourl" type="text" value="{$person.fotourl}">{if
    $person.fotourl} <a href="{$person.fotourl}" target="_window">abrir</a>{/if}</td>
  </tr>

  <tr>
    <th>{#minicurriculum#}:<br>
    <font size="-1"><i>{#minicurriculumSpec#}</i></font></th>

    <td colspan="3">
    <textarea cols="80" rows="8" name="biografia">{$person.biografia}</textarea></td>
  </tr>

  <tr>
    <th>{#comments#}:</th>

    <td colspan="3">
    <textarea cols="80" rows="8" name="coment">{$person.coment}</textarea></td>
  </tr>
{/if}

  <tr>
    <td colspan="4" align="center"><input type="submit"
    value="{#save#}">
    </td>
  </tr>
</table>
</form>
