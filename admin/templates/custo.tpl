<table>
  <tr>
    <td>Viagens:
    </td>
    <td>R$ {$rs.vl_viagem|string_format:"%.2f"}
    </td>
  </tr>
  <tr>
    <td>Hospedagens:
    </td>
    <td>R$ {$rs.vl_hotel|string_format:"%.2f"}
    </td>
  </tr>
  <tr>
    <td>Alimentação:
    </td>
    <td>R$ {$rs.vl_alimen|string_format:"%.2f"}
    </td>
  </tr>
  <tr>
    <td>Outros:
    </td>
    <td>R$ {$rs.vl_outros|string_format:"%.2f"}
    </td>
  </tr>
  <tr>
    <td><b>Total:</b>
    </td>
    <td><b>R$ {$total|string_format:"%.2f"}</b>
    </td>
  </tr>
</table>
