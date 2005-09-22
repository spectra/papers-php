<?

include('../adodb/adodb.inc.php');

$conn = &ADONewConnection("mysql");
$conn->debug = 0;
$conn->PConnect("localhost", "fisl2004", "", "fisl2004");

$cod = $_GET['cod'];

$sql = "SELECT propostas.titulo, propostas.descricao, propostas.publicoalvo,
propostas.comentarios, propostas.coapresentadores, propostas.resumo,
propostas.browser, propostas.ip_proxy, propostas.idioma, propostas.ip,
macrotemas.titulo AS tema, pessoas.nome AS pessoa, propostas.pessoa AS
pessoacod, propostas.dthora
FROM propostas, macrotemas, pessoas
WHERE propostas.cod = $cod
AND propostas.tema = macrotemas.cod
AND propostas.pessoa = pessoas.cod";

$rs = $conn->Execute($sql);
extract($rs->fields, EXTR_PREFIX_ALL, 'db');

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

<h2><?=$db_titulo?></h2>

<h3><a href="person.php?cod=<?=$db_pessoacod?>"><?=$db_pessoa?></a></h3>

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
    <td>Macrotema:
    </td>
    <td><?=$db_tema?>
    </td>
  </tr>
  <tr>
    <td>Idioma:
    </td>
    <td><?=$db_idioma?>
    </td>
  </tr>
  <tr>
    <td>Público-alvo:
    </td>
    <td><textarea cols="60" rows="5" name="publicoalvo"
    readonly><?=$db_publicoalvo?></textarea>
    </td>
  </tr>
  <tr>
    <td>Descrição da palestra:
    </td>
    <td><textarea cols="60" rows="8" name="descricao"
    readonly><?=$db_descricao?></textarea>
    </td>
  </tr>
  <tr>
    <td>Resumo da apresentação:
    </td>
    <td><textarea cols="60" rows="5" name="resumo"
    readonly><?=$db_resumo?></textarea>
    </td>
  </tr>
  <tr>
    <td>Co-apresentadores:
    </td>
    <td><textarea cols="60" rows="5" name="coapresentadores"
    readonly><?=$db_coapresentadores?></textarea>
    </td>
  </tr>
  <tr>
    <td>Comentários:
    </td>
    <td><textarea cols="60" rows="5" name="comentarios"
    readonly><?=$db_comentarios?></textarea>
    </td>
  </tr>
</tbody></table>

<hr>

</body>
</html>
