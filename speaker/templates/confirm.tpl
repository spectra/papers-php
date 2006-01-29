<h2>{#confirmation#}</h2>

<p>
{#confirmationIntroduction#}
</p>

<form action="confirmSave" method="POST">
  <input type='hidden' name='proposal' value='{$proposal.cod}'/>
  <table class='formulario'>
    <tr>
      <th colspan='2'>{#confirmation#}</th>
    </tr>
    <tr>
      <th>{#proposal#}</th>
      <td>{$proposal.titulo}</td>
    </tr>
    <tr>
      <th>{#attendance#}</th>
      <td>
        {#confirmationExplanation#}: <br/>
        <input type="radio" name="confirmada" value="1" {if (!isset($proposal.confirmada)) || $proposal.confirmada == 1}checked{/if}/> {#yesIConfirm#} <br/>
        <input type="radio" name="confirmada" value="0" {if isset($proposal.confirmada) && $proposal.confirmada == 0}checked{/if}/> {#noIDontConfirm#}
      </td>
    </tr>
    <tr>
      <th>{#lectureAbstract#}</th>
      <td>
        {#lectureAbstractExplanation#} <br/>
        <textarea rows='10' cols='80' name="resumo">{$proposal.resumo}</textarea>
      </td>
    </tr>
    <tr>
      <td colspan='2'>
        <center>
          <input type='submit' value='{#confirm#}!'/>
        </center>
      </td>
    </tr>
  </table>
</form>
