/* $Id$ */

chPago(document.f1.pago);
chValores();

function chStatus()
{
  if ((document.f1.status.value == 'a') || (document.f1.status.value == 'p'))
  {
    alert("ATENÇÂO: O fato de você marcar a pessoa aqui como (pré) aprovada, não aprova\nas propostas ligadas a ela. Você deve também aprovar as propostas desejadas\numa a uma.");
  }
  else
  {
    alert("ATENÇÂO: Você marcando esta pessoa como reprovada, desistência ou\nindefinido, todas as propostas relativas a ela serão ajustadas para\no mesmo status.");
    if (document.f1.pago.checked)
    {
      document.f1.pago.checked = false;
      chPago(document.f1.pago);
    }
  }

}

function chPago(o)
{
  if (o.checked)
  {
    document.f1.vl_viagem.disabled = false;
    document.f1.vl_hotel.disabled = false;
    document.f1.vl_alimen.disabled = false;
    document.f1.vl_outros.disabled = false;
    document.f1.vl_total.disabled = false;
  }
  else
  {
    document.f1.vl_viagem.disabled = true;
    document.f1.vl_hotel.disabled = true;
    document.f1.vl_alimen.disabled = true;
    document.f1.vl_outros.disabled = true;
    document.f1.vl_total.disabled = true;
  }
}

function chValores(o)
{
  if (o)
  {
    re = /,/;
    o.value = o.value.replace(re, '.');
  }
  
  total = Number(parseFloat(document.f1.vl_viagem.value) +
  parseFloat(document.f1.vl_hotel.value) +
  parseFloat(document.f1.vl_alimen.value) +
  parseFloat(document.f1.vl_outros.value));

  total = total.toFixed(2);

  document.f1.vl_total.value = total;
}
