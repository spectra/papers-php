{config_load file="$language.conf"}
<div class='speaker' style='margin-left: 10%; margin-bottom: 1em; margin-top: 1em; margin-right: 10%;'>
<input type='hidden' name='speaker{$nspeaker}_cod' value='{$speaker.cod}'/>
  <table class='formulario' style='width: 100%;' id='speaker{$nspeaker}'>
    <tr>
      <th width='30%'>{#name#}</th>
      <td>{if $speaker}{$speaker.nome}{else}<input type='text' name="speaker{$nspeaker}_nome" size='40'/>{/if}</td>
    </tr>
    <tr>
      <th>e-mail</th>
      <td>{if $speaker}{$speaker.email}{else}<input type='text' name="speaker{$nspeaker}_email" size='40'/>{/if}</td>
    </tr>
    <tr>
      <th>CPF</th>
      <td>{if $speaker}{$speaker.cpf}{else}<input type='text' name="speaker{$nspeaker}_cpf" size='11'/>{/if}</td>
    </tr>
  </table>
  {if ($proposal > 0) && (($speaker && ! $speaker.main) || ! $speaker)}
    <input type='checkbox' name='speaker{$nspeaker}_remove' onclick='toggleRemoveSpeaker({$nspeaker})' id='speaker{$nspeaker}_remove'/>{#remove#} ({#saveForConfirmRemoval#})
  {/if}
</div>
