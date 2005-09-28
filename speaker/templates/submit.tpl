<h2>{#proposalSubmission#}</h2>

{literal}
<script language="Javascript">

function toggleSubmission(status) {
  var button = document.getElementById('submitButton');
  button.disabled = status;
}
{/literal}

</script>

<div>
<form name="form1" action="submitSave" method="POST">
  {if $proposal.cod}<input type="hidden" name="cod" value="{$proposal.cod}"/>{/if}
  <table class='formulario' align='center'>
    <tbody>
    {if ($event.agreement) }
      <tr>
        <th colspan='2'>
          {#termsForSubmission#}
        </th>
      </tr>
      <tr>
      <td colspan='2'>
      <div id='terms'>
      {$event.agreement[$language]}
      </div>
      </td>
      </tr>
    {/if}
    <tr>
      <th bgcolor="#dddddd" align="center" colspan="2">{#proposalInfo#}
      </th>
    </tr>
    {if $proposal.cod}
      <tr>
        <th>{#proponents#}:</th>
        <td>
          <ul>
          {section loop=$speakers name=s}
            <li>
              {$speakers[s].nome}
              {if !$speakers[s].main}
                (<a href="addSpeakerRemove?cod={$proposal.cod}&scod={$speakers[s].cod}" onclick="return confirm('{#removeConfirm#}')">{#remove#}</a>)
              {/if}
            </li>
          {/section}
          </li>
          <br/>
          <br/>
          <a href="addSpeaker/{$proposal.cod}">{#addSpeaker#}</a>
        </td>
      </tr>
    {/if}
    <tr>
      <th bgcolor="#dddddd" align="center" colspan="2">
        <span class='warn'>*</span>
        {#mandatoryFields#}
      </th>
    </tr>
    <tr>
      <th>{#title#}: <span class='warn'>*</span>
      </th>
      <td><input size="40" maxlength="80" name="titulo" type="text" value="{$proposal.titulo}">
      </td>
    </tr>
    <tr>
      <th>{#track#}:<span class='warn'>*</span>
      <br/>
      <font size="-1"><i><a href="tracks">{#readMore#}...</a></i></font>
      </th>
      <td>
        <select name="tema">
          <option></option>
          {html_options options=$tracks selected=$proposal.tema}
        </select>
      </td>
    </tr>
    <tr>
      <th>{#language#}:<span class='warn'>*</span>
      </th>
      <td><select name="idioma">
      <option value="pt" {if $proposal.idioma == 'pt'}selected{/if}>{#language_pt#}</option>
      <option value="en" {if $proposal.idioma == 'en'}selected{/if}>{#language_en#}</option>
      <option value="es" {if $proposal.idioma == 'es'}selected{/if}>{#language_es#}</option>
      </select>
      </td>
    </tr>
    <tr>
      <th>{#intendedAudience#}:<span class='warn'>*</span>
      </th>
      <th>{#lectureDescription#}:<span class='warn'>*</span>
      <br/>
      <font size="-1"><i>{#lectureDescriptionExplanation#}</i></font>
      </th>
    <tr>
      <td><textarea cols="46" rows="8" name="publicoalvo">{$proposal.publicoalvo}</textarea>
      </td>
      <td><textarea cols="46" rows="8" name="descricao">{$proposal.descricao}</textarea>
      </td>
    </tr>
    <tr>
      <th>{#lectureAbstract#}:<span class='warn'>*</span>
      <br/>
      <font size="-1"><i>{#lectureAbstractExplanation#}</i></font>
      </th>
      <th>{#comments#}:
      </th>
    </tr>
    <tr>
      <td><textarea cols="46" rows="5" name="resumo">{$proposal.resumo}</textarea>
      </td>
      <td><textarea cols="46" rows="5" name="comentarios">{$proposal.comentarios}</textarea>
      </td>
    </tr>
    {if ($event.agreement)}
      <tr>
        <td colspan="2">
          <div style='margin-left: 30%; margin-right: 30%;'>
            <input type="radio" name="accept" value="1" onclick='javascript:toggleSubmission(false);' {if $proposal}checked{/if}> {#iAcceptTheTerms#}
            <br/>
            <input type="radio" name="accept" value="0" onclick='javascript:toggleSubmission(true);'> {#iDontAcceptTheTerms#}
          </div>
        </td>
      </tr>
    {/if}
    <tr>
      <td bgcolor="#eeeeee" align="center" colspan="2">
        <input value="{#save#}" type="submit" id='submitButton' {if !$proposal}disabled='1'{/if}>
      </td>
    </tr>
  </tbody></table>
</form>
</div>

