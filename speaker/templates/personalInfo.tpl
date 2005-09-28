<h2>{#personalInfo#}</h2>

<center>
<form action='{if $user}personalInfoSave{else}accountSave{/if}' method='POST'>
<table class='formulario'>


  <tr>
    <td colspan='4' align='center'>
      <span style='color: green'><sup>BR</sup></span> for Brazilians only, don't care if you
      are not Brazilian.
      <br/>
      <span class='warn'>*</span> {#mandatoryFields#}.
    </td>
  </tr>

  <tr>
    <th>{#name#}:<span class='warn'>*</span>
    </th>
    <td><input size="30" maxlength="50" name="nome" type="text"
    value="{$person.nome}"></td>
    <th>E-mail:<span class='warn'>*</span>
    </th>
    <td><input size="30" maxlength="50" name="email" type="text"
    value="{$person.email}"></td>
  </tr>

  <tr>
    <th>{#gender#}:</th>
    <td> 
       {#female#} <input type="radio" name="sexo" value="f" {if $person.sexo == 'f'}checked{/if} />
       {#male#}   <input type="radio" name="sexo" value="m" {if $person.sexo != 'f'}checked{/if} />
    </td>
    <th>{#nickname#}</th>
    <td><input type="text" name="nickname" size="30" maxlength="30" value='{$person.nickname}'/></td>
  </tr>

  {if $user}
  <tr>
    <th colspan='4'>Change password</th>
  </tr>
  <tr>
    <th>{#currentPassword#}
    </th>
    <td colspan="3"><input size="30" maxlength="50" name="currentPassword" type="password" value=""></td>
  </tr>
  {/if}
  <tr>
    <th>{if $user}{#newPassword#}{else}{#password#}{/if} {if !$user}<span class='warn'>*</span>{/if}  </th>
    <td colspan="3"><input size="30" maxlength="50" name="newPassword" type="password" value=""></td>
  </tr>
  <tr>
    <th>{#repeatPassword#}{if !$user}<span class='warn'>*</span>{/if}
    </th>
    <td colspan="3"><input size="30" maxlength="50" name="repeatPassword" type="password" value=""></td>
  </tr>

  <tr>
    <th>RG: <span style='color: green'><sup>BR</sup></span></th>
    <td>
      <input type="text" size="15" maxlength="15"
             name="rg" value="{$person.rg}"/>
    </td>
    <th>Órgão Expeditor: <span style='color: green'><sup>BR</sup></span></th>
    <td>
      <input type="text" name="rg_orgao" value="{$person.rg_orgao}"
             size="15" maxlength="15"/>
    </td>
  </tr>
  <tr>
    <th>CPF: <span style='color: green'><sup>BR</sup></span></th>
    <td>
      <input type="text" name="cpf" value="{$person.cpf}"
             size="15" maxlength="11" />
    </td>
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
    <th>{#city#}:</th>

    <td><input size="30" maxlength="30" name="cidade" type="text"
    value="{$person.cidade}"></td>
  </tr>

  <tr>
    <th>{#state#}:</th>

    <td><input size="30" maxlength="30" name="estado" type="text"
    value="{$person.estado}"></td>
    <th>{#country#}:</th>

    <td><input size="30" maxlength="30" name="pais" type="text"
    value="{$person.pais}"></td>
  </tr>

  <tr>
    <th>{#phone#}:<br>
    <font size="-1"><i>{#ddd#}</i></font></th>

    <td><input size="30" maxlength="30" name="fone" type="text"
    value="{$person.fone}"></td>
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

  <tr>
    <td colspan="4" align="center"><input type="submit"
    value="{#save#}">
    </td>
  </tr>
</table>
</form>
</center>
