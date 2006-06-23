<h2>{#proposalSubmission#}</h2>

<script type='text/javascript' src='js/prototype.js'></script>
<script type='text/javascript'>
var speakers = 0;
var maxSpeakers = {$event.max_authors};
var noMoreSpeakers = "{#noMoreSpeakers#}";
var onlyEmailIsNeeded = "{#onlyEmailIsNeeded#}";
var proposal = {if $proposal.cod}{$proposal.cod}{else}0{/if};
var track = {if $proposal.tema}{$proposal.tema}{else}0{/if};
{literal}

function toggleSubmission(status) {
  var button = document.getElementById('submitButton');
  button.disabled = status;
}

function addNewSpeaker(req) {
  $('speakers').innerHTML += req.responseText;
  speakers++;
  alert(onlyEmailIsNeeded);
}

function toggleRemoveSpeaker(n) {
  var id = 'speaker' + n + '_remove';
  var box = $(id);
  var speakerform = $('speaker' + n);
  if (box.checked) {
    speakerform.style.setProperty('background', '#f6f6f6', null);
    speakerform.style.setProperty('color', '#cfcfcf', null);
  } else {
    speakerform.style.setProperty('background', 'white', null);
    speakerform.style.setProperty('color', 'black', null);
  }
}

function addSpeaker() {
  if (speakers >= maxSpeakers) {
    alert(noMoreSpeakers);
    return;
  }
  nspeaker = speakers + 1;
  new Ajax.Request(
    'newSpeaker?nspeaker=' + nspeaker + '&cod=' + proposal,
    {
      method: 'get',
      onComplete: addNewSpeaker,
      on404: function(req) { alert('not found!'); },
    }
  );
}

function getKeywords() {
  var box = $('tema');
  var newtrack = box.options[box.selectedIndex].value;

  if (newtrack == "") {
    $('keywords').innerHTML = "";
    return;
  }
  
  var url =
    (proposal > 0 && track == newtrack)
    ?
    'keywords?pcod=' + proposal
    :
    'keywords?tcod=' + newtrack
    ;
  
  new Ajax.Request(
    url,
    {
      method: 'get',
      onComplete: function (req) {
                    $('keywords').innerHTML = req.responseText;
                  },
      on404: function(req) { alert('not found!'); },
    }
  );
}


{/literal}
</script>

<div>

<form name="form1" {if $event.file_upload_on_submission}enctype="multipart/form-data" {/if} action="submitSave" method="POST">
  {if $proposal.cod}<input type="hidden" name="cod" value="{$proposal.cod}"/>{/if}
  <table class='formulario' align='center' width='70%'>
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
    <tr>
      <td align="center" colspan="2">
      <em>{#tipForSubmission#}</em>
      </td>
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
      <td><input size="50" maxlength="200" name="titulo" type="text" value="{$proposal.titulo}">
      </td>
    </tr>
    <tr>
      <th>{#track#}:<span class='warn'>*</span>
      <br/>
      <font size="-1"><i><a href="tracks">{#readMore#}...</a></i></font>
      </th>
      <td>
        <select name="tema" id="tema" onchange='getKeywords()'>
          <option></option>
          {html_options options=$tracks selected=$proposal.tema}
        </select>
      </td>
    </tr>
    <tr>
      <th valign='top'>{#keywords#}</th>
      <td>
        {section loop=$keywords name=k}
          {if $keywords[k].chosen}
            <input type='hidden' name='had_keyword_{$keywords[k].id}' value='1'/>
          {/if}
        {/section}
        <div id='keywords'>
        {include file=keywords.tpl}
        </div>
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
      <th colspan="2">{#proponents#}:</th>
    </tr>
    <tr>
      <td colspan='2'>
      <div id='speakers'>
      {section loop=$speakers name=s}
        {assign var=speaker value=$speakers[s]}
        {assign var=nspeaker value=$smarty.section.s.iteration}
        {include file=speaker.tpl}
        <script type='text/javascript'>speakers = speakers + 1;</script>
      {/section}
      </div>
        <input type='button' onclick='javascript: addSpeaker()' value='{#addSpeaker#}' style='margin-left: 10%; margin-bottom: 1em;'/>
      </td>
    </tr>
    
    <tr>
      <th colspan="2">{#intendedAudience#}:<span class='warn'>*</span>
      </th>
    </tr>
    <tr>
      <td colspan="2">
        <center>
	  <textarea cols="80" rows="8" name="publicoalvo">{$proposal.publicoalvo}</textarea>
	</center>
      </td>
    </tr>
    
    <tr>
      <th colspan="2">{#lectureDescription#}:<span class='warn'>*</span>
      <br/>
      <font size="-1"><i>{#lectureDescriptionExplanation#}</i></font>
      </th>
    </tr>
    <tr>
      <td colspan="2">
        <center>
	  <textarea cols="80" rows="8" name="descricao">{$proposal.descricao}</textarea>
	</center>
      </td>
    </tr>
    
    <tr>
      <th colspan="2">{#lectureAbstract#}:<span class='warn'>*</span>
      <br/>
      <font size="-1"><i>{#lectureAbstractExplanation#}</i></font>
      </th>
    </tr>
    <tr>
      <td colspan="2">
        <center>
	  <textarea cols="80" rows="5" name="resumo">{$proposal.resumo}</textarea>
	</center>
      </td>
    </tr>

    <tr>
      <th colspan="2">{#comments#}:
      </th>
    </tr>
    <tr>
      <td colspan="2">
        <center>
	  <textarea cols="80" rows="5" name="comentarios">{$proposal.comentarios}</textarea>
	</center>
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
    {if $event.file_upload_on_submission}
    <tr>
      <th colspan='2'>
        {#fileUpload#}
        <br/>
        <font size="-1"><i>{#fileUploadDescription#}</i></font>
        
      </th>
    </tr>
    <tr>
      <td colspan='2'>
      {if $files}
        <br/>
        {#uploadedFiles#}:
        <ul>
          {section loop=$files name=f}
            <li>{$files[f]} (<a href='removeFile?proposal_file={$files[f]}'>{#remove#}</a>)</li>
          {/section}
        </ul>
      {/if}
	<center>
	  <br/>
	  {#acceptedFileTypes#}:
	  {section loop=$acceptedFileTypes name=t}
            {if $smarty.section.t.iteration > 1},{/if}
	    <strong>{$acceptedFileTypes[t]|upper}</strong>
	  {/section}
	  <br/>
	  <br/>
	  <input name="proposal_file" type="file" size='40'/>
	  <br/>
	  <br/>
	</center>
      </td>
    </tr>
    {/if}
    <tr>
      <td bgcolor="#eeeeee" align="center" colspan="2">
        <input value="{#save#}" type="submit" id='submitButton' {if $event.agreement && !$proposal}disabled='1'{/if}>
      </td>
    </tr>
  </tbody></table>
</form>
</div>

