<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-us" lang="en-us">

<head>
  <title>fisl6.0 - Fórum Internacional Software Livre</title><meta name="resource-type" content="document"/>
  <meta http-equiv="pragma" content="no-cache"/>
  <meta name="revisit-after" content="1"/>
  <meta name="classification" content="Internet"/>
  <meta name="description" content="6º Fórum Internacional Software Livre"/>
  <meta name="keywords" content="fisl software livre porto alegre brasil"/>
  <meta name="robots" content="ALL"/>
  <meta name="distribution" content="Global"/>
  <meta name="rating" content="General"/>
  <meta name="author" content="Projeto Software Livre Brasil"/>
  <meta name="language" content="pt-br"/>
  <meta name="doc-class" content="Completed"/>
  <meta name="doc-rights" content="Public"/>
  {php}
     $protocol = ($_SERVER['SERVER_PORT']==443)?('https://'):('http://');

     echo "<base href='" . $protocol
          . $_SERVER['HTTP_HOST']
          . preg_replace("/[^\/]+$/", "", $_SERVER['SCRIPT_NAME'])
          . "'/>\n";
  {/php}
  <link rel="stylesheet" type="text/css" href="screen.css" media="screen" title="Tela"/>
  <link rel="stylesheet" type="text/css" href="print.css" media="print"/>
  <link rel="stylesheet" type="text/css" href="local.css" media="screen"/>
</head>
<body>

<div id="header">
  <div id="logo">
    <a href="/"><img src="img/fisl.png" alt="fisl6.0"/></a>
  </div>

  <div id='titulo'>
    <span class="forum">6&deg; Fórum Internacional</span>
    <span class="softwarelivre">Software Livre</span>
    <span class="forum"></span>
    <br/>
      1, 2, 3 e 4 de Junho de 2005
    <br/>
    Porto Alegre/RS, Brasil
  </div>
</div>

{if $linkup}
<div>
<a href="{$linkup}">Voltar</a>
</div>
{/if}

{include file=$central}

</body>
</html>
