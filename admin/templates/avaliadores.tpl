<form action='avaliadoresSave' method='POST'>
  <table align='center' class='formulario'>
    <tr>
      <th>Nome</th>
      <th>e-mail</th>
      <th>Avaliador?</th>
    </tr>
  {section loop=$rs name=p}
    <tr>
      <td>{$rs[p].nome}</td>
      <td>{$rs[p].email}</td>
      <td>
        <input type="checkbox" name="avaliador_{$rs[p].cod}" {if $rs[p].avaliador}checked{/if}/>
        <input type="hidden" name="avaliador_era_{$rs[p].cod}" value="{if $rs[p].avaliador}1{else}0{/if}"/>
      </td>
    </tr>
  {/section}
    <tr>
      <th colspan="3">
        <input type='submit' value='Salvar'/>
      </th>
    </tr>
  </table>
</form>
