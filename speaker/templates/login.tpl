<table class='formulario' width='100%'>
  <tr>
    <th width='50%'>{#alreadyRegistered#}</th>
    <th width='50%'>{#notRegistered#}</th>
  </tr>
  <tr>
  <td valign='top' style='padding: 1em;'>
    <p>{#alreadyRegisteredContinue#}</p>
    <p><a href='lostPassword'>{#lostMyPassword#}</a></p>

  <table class='formulario' align='center'>
    <form action="" method='POST'>
      <tr>
        <th colspan='2'>{#login#}</th>
      </tr>
      <tr>
        <th>E-mail</th>
        <td><input type='text' name='username' size='25'/></td>
      </tr>
      <tr>
        <th>{#password#}</th>
        <td><input type='password' name='password' size='10'/></td>
      </tr>
      <tr>
        <th colspan='2'>
          <center>
            <input type='submit' value='{#login#} !'/>
          </center>
        </th>
      </tr>
    </form>
  </table>
  </td>
  <td valign='top' style='padding: 1em;'>
    <p>{#notRegisteredContinue#}</p>
  </td>
</tr>
</table>
