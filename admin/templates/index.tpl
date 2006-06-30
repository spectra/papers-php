{config_load file=papers.conf}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
  {if $title}
    <title>{$title} - papers</title>
  {else}
    <title>papers</title>
  {/if}
  {php}
     $protocol = ($_SERVER['SERVER_PORT']==443)?('https://'):('http://');

     echo "<base href='" . $protocol
          . $_SERVER['HTTP_HOST']
          . preg_replace("/[^\/]+$/", "", $_SERVER['SCRIPT_NAME'])
          . "'/>\n";
  {/php}
  <link rel="stylesheet" href="css/styles.css" type="text/css">
  <link rel="top" href=".">
  {if $linkup}<link rel="up" href="{$linkup}">{/if}
  {if $linknext}<link rel="next" href="{$linknext}">{/if}
  {if $linkprevious}<link rel="previous" href="{$linkprevious}">{/if}
  <!-- $Id$ -->
</head>

<body>

<h1>papers - admin</h1>

{if $title}
<h2>{$title}</h2>
{else}
<h2>Sistema de administração</h2>
{/if}
{if $linkup}<hr/><a href="{$linkup}" accesskey="U">Um nível acima (alt+u)</a>{/if}
{if $linknext}<a href="{$linknext}" accesskey="N">Próximo (alt+n)</a>{/if}
{if $linkprevious}<a href="{$linkprevious}" accesskey="P">Anterior (alt+p)</a>{/if}
<hr>

{include file="$central"}

<hr>

<div align="right" class="cl">
Copyright &copy; 2003, 2004 <a href="http://www.propus.com.br/">Propus</a>.
<br/>
Copyright &copy; 2005, 2006 <a href="http://associacao.softwarelivre.org/">Associação Software Livre.Org</a>.
<br/>
Copyright &copy; 2006 <a href="http://www.colibre.com.br/">Colibre</a>.
<br/>
</div>

</body>
</html>
