<?

include('../adodb/adodb.inc.php');

$conn = &ADONewConnection("mysql");
$conn->debug = 0;
$conn->PConnect("localhost", "fisl2004", "", "fisl2004");
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;

$sql = "SELECT cod, nome, org
        FROM pessoas
        ORDER BY dthora";

$rs = $conn->Execute($sql);

$num_pessoas = $rs->RecordCount();

$sql = "SELECT count(*) as count FROM propostas";
$rsprop = $conn->Execute($sql);

$num_propostas = $rsprop->fields['count'];

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
  <title>Call for papers 2004</title>
  <style type="text/css">
  LI, TD {
    font-family: sans-serif;
    font-size: small;
  }
  A:hover { text-decoration: underline; }
  A { text-decoration: none; }
</style>
<link rel='up' href='/'>
<link rel='top' href='/'>
</head>

<body>

<h1>Call for papers 2004</h1>

<h2>Inscritos até este momento</h2>

<table width="100%">
  <tr>
    <td><?print date('r');?>
    </td>
    <td align="right"><b><?=$num_pessoas?> pessoas, <?=$num_propostas?>
    propostas</b>
    </td>
  </tr>
</table>

<hr>

<ul>
<?

while (!$rs->EOF)
{
  extract($rs->fields, EXTR_PREFIX_ALL, 'db');

  print "<li><a href='person.php?cod=$db_cod'><b>$db_nome</b></a> - <i>$db_org</i>\n";

  $sql = "SELECT cod, titulo
          FROM propostas
          WHERE pessoa = $db_cod
          ORDER BY titulo";

  $rsp = $conn->Execute($sql);

  print "<ul>\n";
  
  while (!$rsp->EOF)
  {
    extract($rsp->fields, EXTR_PREFIX_ALL, 'dbp');

    print "<li><a href='proposal.php?cod=$dbp_cod'>$dbp_titulo</a>\n";
    
    $rsp->MoveNext();
  }

  print "</ul>\n";

  $rs->MoveNext();
}

?>

</ul>

<hr>

</body>
</html>
