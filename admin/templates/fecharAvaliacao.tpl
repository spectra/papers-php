<ul>
  <li>
    <strong>Aprovadas (pela avaliação)</strong>
    <span style='background: #99f099;'>em verde</span>
    ,
    <strong>reprovadas (pela avaliação)</strong> 
    <span style='background: #c0c0c0;'>em cinza</span>
    .
  </li>
  <li>
    Já <strong>aprovadas</strong> (ou pré-aprovadas) em
    <span style='background: #aaccff;'>azul</span>,
    já <strong>recusadas</strong> em 
    <span style='background: #ffbbbb;'>vermelho</span>,
  </li>
  <li>
    <strong>Pré-aprovadas</strong>
    (convidados: nos espaços da organização) em
    <span style='background: #cc6600;'>laranja</span>.
  </li>
  <li>
    <strong>Entre parênteses</strong> ao lado do nome do macrotema, a
    quantidade de espaços destinados a palestras da chamada de trabalhos
    daquele macrotema / a quantidade de palestras que já foram aprovadas para
    esse macrotema.
  </li>
</ul>
<hr/>
<form action="fecharAvaliacaoSave" method="POST">
{section loop=$macrotemas name=mt}
{assign var="tema" value=$macrotemas[mt].cod}
<h2>{$macrotemas[mt].titulo} ({$macrotemas[mt].espacos}/{$numeroDeAprovadas[$tema]})</h2>
  <table style='width: 100%;'>
    <tr>
      <th>Status</th>
      <th>Posição</th>
      <th>Título</th>
      <th>Nível</th>
      <th>Autor</th>
      <th>Pontuação</th>
    </tr>
  {section loop=$aprovadas[$tema] name=pr}
    <tr style='background: {if $aprovadas[$tema][pr].status == 'a'}#aaccff{else}#cc6600{/if};'>
      <td>
        <select name="status{$aprovadas[$tema][pr].cod}">
          {html_options options=$status selected=$aprovadas[$tema][pr].status}
        </select>
      </td>
      <td>
       {ranking_position ranking_array=$ranking[$tema] proposta=$aprovadas[$tema][pr].cod}
        &ordm;
      </td>
      <td><a href="proposta/{$aprovadas[$tema][pr].cod}">{$aprovadas[$tema][pr].titulo}</a></td>
      <td>{$aprovadas[$tema][pr].nivel_proposta}</td>
      <td>{$aprovadas[$tema][pr].autor}</td>
      <td>
        {$aprovadas[$tema][pr].score}
        <input type="hidden" name="score{$aprovadas[$tema][pr].cod}" value="{$aprovadas[$tema][pr].score}"/>
      </td>
    </tr>
  {/section}
  {section loop=$propostas[$tema] name=pr}
    <input type="hidden" name="score{$propostas[$tema][pr].cod}" value="{$propostas[$tema][pr].score}"/>
    {if $smarty.section.pr.iteration <= ($macrotemas[mt].espacos - $numeroDeAprovadas[$tema])}
    <tr style='background: #99f099;'>
    <input type="hidden" name="status{$propostas[$tema][pr].cod}" value="a"/>
    {else}
    <tr style='background: #c0c0c0;'>
    <input type="hidden" name="status{$propostas[$tema][pr].cod}" value="r"/>
    {/if}
      <td>
        {if $smarty.section.pr.iteration <= ($macrotemas[mt].espacos - $numeroDeAprovadas[$tema])}
          Vai pra 'Aprovado'.
        {else}
          Vai pra 'Recusado'.
        {/if}
      </td>
      <td>
       {ranking_position ranking_array=$ranking[$tema] proposta=$propostas[$tema][pr].cod}
        &ordm;
      </td>
      <td><a href="proposta/{$propostas[$tema][pr].cod}">{$propostas[$tema][pr].titulo}</a></td>
      <td>{$propostas[$tema][pr].nivel_proposta}</td>
      <td>{$propostas[$tema][pr].autor}</td>
      <td>
        {$propostas[$tema][pr].score}
      </td>
    </tr>
  {/section}
  {section loop=$recusadas[$tema] name=pr}
    <tr style='background: #ffbbbb;'>
      <td>
        <select name="status{$recusadas[$tema][pr].cod}">
          {html_options options=$status selected=$recusadas[$tema][pr].status}
        </select>
      </td>
      <td>
       {ranking_position ranking_array=$ranking[$tema] proposta=$recusadas[$tema][pr].cod}
        &ordm;
      </td>
      <td><a href="proposta/{$recusadas[$tema][pr].cod}">{$recusadas[$tema][pr].titulo}</a></td>
      <td>{$recusadas[$tema][pr].nivel_proposta}</td>
      <td>{$recusadas[$tema][pr].autor}</td>
      <td>
        {$recusadas[$tema][pr].score}
        <input type="hidden" name="score{$recusadas[$tema][pr].cod}" value="{$recusadas[$tema][pr].score}"/>
      </td>
    </tr>
  {/section}
  </table>
{/section}
<br/>
<center style='margin-left: 150px; margin-right: 150px;'>
  <input type='submit' value='Salvar avaliação'/>
  <br/>
  <br/>
  Clicando em <strong>Salvar avaliação</strong>,
  os status das propostas serão alterados
  de acordo com esse <em>ranking</em>: As 
  <span style='background: #99f099;'>em verde</span>
  serão marcadas como aprovadas, e as
  <span style='background: #c0c0c0;'>em cinza</span>
  serão marcadas como reprovadas.
</center>
</form>
