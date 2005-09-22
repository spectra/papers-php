<?

include('../adodb/adodb.inc.php');

$conn = &ADONewConnection("mysql");
$conn->debug = 0;
$conn->PConnect("localhost", "fisl2004", "", "fisl2004");

$cod = $_GET['cod'];

$sql = "SELECT `nome` , `email` , `passwd` , `org` , `cidade` , `estado` ,
`pais` , `fone` , `coment` , `fotourl` , `biografia`, dthora
FROM `pessoas`
WHERE cod = $cod";

$rs = $conn->Execute($sql);
extract($rs->fields, EXTR_PREFIX_ALL, 'db');

$sql = "SELECT cod, titulo
        FROM propostas
        WHERE pessoa = $cod
        ORDER BY titulo";
$rsp = $conn->Execute($sql);

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
  <title>Call for papers 2004</title>
  <style type="text/css">
  TD {
    font-family: sans-serif;
    font-size: small;
  }
  TABLE, TD, TH, TEXTAREA {
    border-style: solid;
    border-width: 1px;
    border-color: #EEEEEE;
  }
  A:hover { text-decoration: underline; }
  A { text-decoration: none; }
</style>
<link rel='up' href='.'>
<link rel='top' href='/'>
</head>

<body>

<h1>Call for papers 2004</h1>

<h2><?=$db_nome?></h2>

<ul>
<?
while (!$rsp->EOF)
{
  extract($rsp->fields, EXTR_PREFIX_ALL, 'dbp');
  print "<li><a href='proposal.php?cod=$dbp_cod'>$dbp_titulo</a>\n";
  $rsp->MoveNext();
}
?>
</ul>

<hr>

<table align="center" cellpadding="3" cellspacing="0">
  <tbody>
  <tr>
    <td>Data de cadastro:
    </td>
    <td><?=$db_dthora?>
    </td>
  </tr>
  <tr>
    <td>E-mail:
    </td>
    <td><a href="mailto:<?=$db_email?>"><?=$db_email?></a>
    </td>
  </tr>
  <tr>
    <td>Instituição:
    </td>
    <td><?=$db_org?>
    </td>
  </tr>
  <tr>
    <td>Cidade:
    </td>
    <td><?=$db_cidade?>
    </td>
  </tr>
  <tr>
    <td>Estado:
    </td>
    <td><?=$db_estado?>
    </td>
  </tr>
  <tr>
    <td>País:
    </td>
    <td><?=$db_pais?>
    </td>
  </tr>
  <tr>
    <td>Telefone:
    </td>
    <td><?=$db_fone?>
    </td>
  </tr>
  <tr>
    <td>URL de uma foto:
    </td>
    <td><a href="<?=$db_fotourl?>"><?=$db_fotourl?></a>
    </td>
  </tr>
  <tr>
    <td>Mini-currículum:
    </td>
    <td><textarea cols="60" rows="8" name="biografia"
    readonly><?=$db_biografia?></textarea>
    </td>
  </tr>
  <tr>
    <td>Comentários:
    </td>
    <td><textarea cols="60" rows="8" name="coment"
    readonly><?=$db_coment?></textarea>
    </td>
  </tr>
</tbody></table>

<hr>

</body>
</html>
