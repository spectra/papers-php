{config_load file=papers.conf}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
  <title>Espaço na grade</title>
  <base href="{#base#}">
</head>

<body>

<p>
{if $rs.cod}
Espaço {$cod} utilizado pela proposta <a href="proposta/{$rs.cod}" target="_new">{$rs.cod} - {$rs.titulo}</a>.
{else}
Espaço {$cod} livre.
{/if}
</p>

<p align="center"><input type="button" value="Fechar" onClick="javascript:window.close()">

</body>
</html>
