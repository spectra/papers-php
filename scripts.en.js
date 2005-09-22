function validaEmail(o_email, branco, alerta)
{
  /* Autor: Marlon Dutra - 16/01/2002 */
  /* Valida o e-mail digitado */
  
  /*
    Se o parametro branco estiver true, permite valor em branco
    Se o parametro alerta estiver true, emite os alertas de erro
  */

  p_email = o_email.value.toLowerCase();
  
  if (branco) // Permite o e-mail em branco
  {
    if (p_email == '')
      return true;
  }
  
  reg_email = /^[\w\-\.]+@[\w\-\.]+\.[a-z]{2,4}$/;
  if (! reg_email.test(p_email))
  {
    if (alerta)
    {
      alert('Invalid e-mail');
      o_email.focus();
      o_email.select();
    }
    return false;
  }
  return true;
}

function validaForm()
{
  var form = document.form1;

  if (! validaEmail(form.email, false, true))
    return false;

  if (form.passwd.value.length <= 3)
  {
    alert('Your password must be greater than 3 chars');
    form.passwd.focus();
    return false;
  }

  if ((form.passwd2.value.length > 0) && (form.passwd2.value !=
  form.passwd.value))
  {
    alert("The passwords don't match");
    return false;
  }

  if (form.titulo.value.length < 1)
  {
    alert("Please fill out the title");
    form.titulo.focus();
    return false;
  }

  if (document.form1.tema.selectedIndex == 0)
  {
    alert("You must select a macro-theme");
    return false;
  }

  if (form.publicoalvo.value.length < 1)
  {
    alert("Please fill out the target audience");
    form.publicoalvo.focus();
    return false;
  }

  if (form.descricao.value.length < 1)
  {
    alert("Please fill out the description");
    form.descricao.focus();
    return false;
  }

  return true;
}

function email()
{
  alert("Send e-mails to t" + "ema" + "rio@so" + "ft" + "ware" + "liv" + "re"
  + ".or" + "g");

  alert();
}
