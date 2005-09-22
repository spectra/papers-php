<h2>{#lostMyPassword#}</h2>

<center>
  <form action="lostPassword" method="POST" style='width: 40%;'>
    <table class='formulario'>
      <tr>
        <td colspan='2'>
          {#fillYourEmail#}
        </td>
      </tr>
      <tr>
        <th>
          E-mail:
        </th>
        <td>
          <input type="text" name="email"/>
        </td>
      </tr>
      <tr>
        <td colspan='2' align='center'>
          <input type='submit' value='OK'/>
        </td>
      </tr>
    </table>
  </form>
</center>
