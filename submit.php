<?

header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
header('Pragma: no-cache');
header('Content-Type: text/plain');

include('adodb.inc.php');

# Remove todos os espacos desnecessarios dos campos
function trim1($str) { return trim($str); }
array_walk($_POST, 'trim1');
extract($_POST, EXTR_PREFIX_ALL, 'p');

$lang = (preg_match('/pt/', $_SERVER["HTTP_ACCEPT_LANGUAGE"]))?('pt'):('en');

if ($_SERVER["REQUEST_METHOD"] != 'POST')
{
  print "Invalid method.\n";
  exit;
}

$conn = &ADONewConnection("mysql");
$conn->debug = 0;
// host,user,pass,db
include("conf.inc");
$conn->PConnect("localhost", $myUsername, $myPassword, $myDatabase);

# Verifica a existencia do e-mail digitado

$sql = "SELECT cod, passwd FROM pessoas
        WHERE email = '$p_email'";
$rs = $conn->Execute($sql);

# Usuario ja existe. Vamos validar sua senha.
if ($rs->RecordCount() >= 1)
{
  if (md5($p_passwd) != $rs->fields['passwd'])
  {
    if ($lang == 'pt')
      print "Senha incorreta.";
    else
      print "Invalid password.";

    exit;
  }
  $cod = $rs->fields['cod'];
}
# Usuario nao existe. Vamos salvar seus dados.
else
{
  # Compara as duas senhas fornecidas
  if ($p_passwd != $p_passwd2)
  {
    if ($lang == 'pt')
      print "As duas senhas não conferem.";
    else
      print "The passwords don't match.";

    exit;
  }

  $r['email']     = $p_email;
  $r['passwd']    = md5($p_passwd);
  $r['nome']      = $p_nome;
  $r['rg']        = $p_rg;
  $r['rg_orgao']  = $p_rg_orgao;
  $r['cpf']       = $p_cpf;
  $r['passaporte']= $p_passaporte;
  $r['org']       = $p_org;
  $r['cidade']    = $p_cidade;
  $r['estado']    = $p_estado;
  $r['pais']      = $p_pais;
  $r['fone']      = $p_fone;
  $r['fotourl']   = $p_fotourl;
  $r['biografia'] = $p_biografia;
  $r['coment']    = $p_coment;
  $r['dthora']    = time();

  $sql = 'SELECT * FROM pessoas WHERE cod = -1';
  $rs  = $conn->Execute($sql);
  $sql = $conn->GetInsertSQL($rs, $r);

  if (! $conn->Execute($sql))
  {
    if ($lang == 'pt')
      print "Erro no banco de dados ao cadastrar usuário.";
    else
      print "Database error saving the user data.";

    print "\n\n" . $conn->ErrorNo() . " - " . $conn->ErrorMsg() . "\n";

    exit;
  }
  $cod = $conn->Insert_ID();
}

# Dados do usuario
$sql = "SELECT `nome` , `rg`, `rg_orgao`, `cpf`, `passaporte`, `email` ,
`passwd` , `org` , `cidade` , `estado` , `pais` , `fone` , `coment` , `fotourl`
, `biografia`
FROM `pessoas`
WHERE cod = $cod";
$rs_user = $conn->Execute($sql);

if ($rs_user->RecordCount() != 1)
{
    if ($lang == 'pt')
      print "Erro fatal. Impossível obter os dados do usuário.";
    else
      print "Fatal error. Could not get the user data.";

    exit;
}

extract($rs_user->fields, EXTR_PREFIX_ALL, 'db');

# Salvar dados da proposta

unset($r);

$r['titulo'] = $p_titulo;
$r['tema'] = $p_tema;
$r['idioma'] = $p_idioma;
$r['publicoalvo'] = $p_publicoalvo;
$r['descricao'] = $p_descricao;
$r['resumo'] = $p_resumo;
$r['coapresentadores'] = $p_coapresentadores;
$r['comentarios'] = $p_comentarios;

$r['autoriza_video'] = ($p_autoriza_video=="on")?(1):(0);
$str_autoriza_video = ($p_autoriza_video=="on")?("Sim"):("Não");
$str_autoriza_video_english = ($p_autoriza_video=="on")?("Yes"):("No");

$r['pessoa'] = $cod;

$r['ip']       = $_SERVER['REMOTE_ADDR'];
$r['ip_proxy'] = $_SERVER['HTTP_X_FORWARDED_FOR'];
$r['browser']  = $_SERVER["HTTP_USER_AGENT"];
$r['dthora']   = time();

$sql = 'SELECT * FROM propostas WHERE cod = -1';
$rs  = $conn->Execute($sql);
$sql = $conn->GetInsertSQL($rs, $r);

if (! $conn->Execute($sql))
{
  if ($lang == 'pt')
    print "Erro no banco de dados ao cadastrar proposta.";
  else
    print "Database error saving the proposal.";

  print "\n\n" . $conn->ErrorNo() . " - " . $conn->ErrorMsg() . "\n";

  exit;
}
$cod_prop = $conn->Insert_ID();

# Pega o titulo do tema enviado
if ($lang == 'pt')
  $sql = "SELECT titulo FROM macrotemas
          WHERE cod = $p_tema";
else
  $sql = "SELECT titulo_en AS titulo FROM macrotemas
          WHERE cod = $p_tema";
$rs = $conn->Execute($sql);
$dsc_tema = $rs->fields['titulo'];

# Gerar um e-mail para o usuario

if ($lang == 'pt')
{
  $subject = "FISL - Chamada de trabalhos [$cod_prop]";

$msg = "
Olá $db_nome,

Recebemos agora a sua proposta de trabalho para o 6o Fórum Internacional de
Software Livre.

Durante o mês seguinte ao final do prazo de submissão de propostas,
avaliaremos todas as propostas, e caso a sua seja selecionada, entraremos em
contato por e-mail.

Agradecemos o seu interesse, e boa sorte.

Confira abaixo os seus dados. Em caso de dúvidas, basta responder este e-mail.
Teremos o maior prazer em atendê-lo.

DADOS PESSOAIS
--------------

Código de usuário: $cod

Nome: $db_nome
RG: $db_rg -- $db_rg_orgao
CPF: $db_cpf
Passaporte: $db_passaporte
E-mail: $db_email
Senha: $p_passwd
Instituição: $db_org

Cidade: $db_cidade
Estado: $db_estado
País: $db_pais

Fone: $db_fone
URL foto: $db_fotourl

Biografia:
$db_biografia

Comentários:
$db_coment


DADOS DA PROPOSTA
-----------------

ANOTE ESTE NÚMERO
Código: $cod_prop

Título: $p_titulo
Tema: $p_tema - $dsc_tema
Idioma: $p_idioma

Autoriza a cessão de direitos sobre o vídeo gravado na apresentação: $str_autoriza_video

Público alvo:
$p_publicoalvo

Descrição:
$p_descricao

Resumo:
$p_resumo

Co-apresentadores:
$p_coapresentadores

Comentários:
$p_comentarios
";
}
else
{
  $subject = "FISL - Call for papers [$cod_prop]";

$msg = "
Hello $db_nome,

We just received your proposal for the 6th International Free Software Forum.

During the month after the end of proposals submission period, we'll
evaluate every proposal, and in case of your proposal being selected, we'll
contact you by e-mail.

Thank you for your interest, and good luck.

Check your data out below. If you have doubts, just answer this e-mail. It's
our pleasure helping you.

PERSONAL DATA
-------------

User ID: $cod

Name: $db_nome
RG: $db_rg -- $db_rg_orgao
CPF: $db_cpf
Passport: $db_passaporte
E-mail: $db_email
Password: $p_passwd
Organization: $db_org

City: $db_cidade
State: $db_estado
Country: $db_pais

Phone number: $db_fone
Photo URL: $db_fotourl

Biography:
$db_biografia

Comments:
$db_coment


PROPOSAL DATA
-------------

TAKE NOTE OF THIS NUMBER
Code: $cod_prop

Title: $p_titulo
Theme: $p_tema - $dsc_tema
Language: $p_idioma

Authorizes cession of rights about video: recorded during presentation: $str_autoriza_video_english

Target audience:
$p_publicoalvo

Description:
$p_descricao

Brief description:
$p_resumo

Co-presenters:
$p_coapresentadores

Comments:
$p_comentarios
";
}

mail($db_email, $subject, $msg, 'From: temario@softwarelivre.org
Content-Type: text/plain; charset=iso-8859-1');

header("Location: submitok.php?user=$cod");

?>
