<h2>{#proposalSubmission#}</h2>

{if (! $proposal) && ($event.agreement) }
{literal}
<style type="text/css">
  div#submissionForm { display: none; }
  div#terms {
     margin-left: 15%; width: 70%; height: 10em;
     overflow: scroll-auto; margin-top: 1em; margin-bottom: 1em;
     border: 1px solid #CCC;
     padding: 0.5em;
  }
</style>
<script language='Javascript'>

function accepted() {
  var agreement = document.getElementById('agreement');
  var form = document.getElementById('submissionForm');
  agreement.style.display = 'none';
  form.style.display = 'block';
}

</script>
{/literal}
<div id='agreement'>
<div id='terms'>
{$event.agreement[$language]}
</div>
<center>
  <form name='agreement'>
    <input type='button' onclick='javascript: accepted();' value='{#iAccept#}'>
  </form>
</center>
</div>
{/if}

<div id='submissionForm'>
<form name="form1" action="submitSave" method="POST">
  {if $proposal}<input type="hidden" name="cod" value="{$proposal.cod}"/>{/if}
  <table class='formulario' align='center'>
    <tbody>
    <tr>
      <th bgcolor="#dddddd" align="center" colspan="2">{#proposalInfo#}
      </th>
    </tr>
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
    <tr>
      <td bgcolor="#eeeeee" align="center" colspan="4"><input value="{#save#}" type="submit">
      </td>
    </tr>
  </tbody></table>
</form>
</div>

