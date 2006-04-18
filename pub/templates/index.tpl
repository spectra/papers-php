<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-us" lang="en-us">

<head>
  <title>{$event.codename} - {$event.name}</title><meta name="resource-type" content="document"/>
  <meta http-equiv="pragma" content="no-cache"/>
  <meta name="revisit-after" content="1"/>
  <meta name="classification" content="Internet"/>
  <meta name="description" content="{$event.name}"/>
  <meta name="keywords" content="{$event.codename} {$event.name}"/>
  <meta name="robots" content="ALL"/>
  <meta name="distribution" content="Global"/>
  <meta name="rating" content="General"/>
  <meta name="author" content="{$event.name}"/>
  <meta name="language" content="pt-br"/>
  <meta name="doc-class" content="Completed"/>
  <meta name="doc-rights" content="Public"/>
  <meta name="Content-Type" content="text/html; charset=iso88591"/>
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

{if $linkup}
<div>
<a href="{$linkup}">Voltar</a>
</div>
{/if}

{include file=$central}

</body>
</html>
