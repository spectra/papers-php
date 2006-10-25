<?

# $Id$

require 'include/mysmarty.inc.php';
$smarty = new Smarty;
$smarty->compile_check = true;
# $smarty->debugging = true;

include('include/mysql.inc.php');
include('include/basic.inc.php');
include('include/propostas.inc.php');
include('include/macrotemas.inc.php');

expires(0);

$cod = str_replace('/', '', $_SERVER['PATH_INFO']);

$mysql = new Mysql;
# $mysql->conn->debug = 1;

$sql = "SELECT a.cod, a.tstamp, a.dthora, a.titulo, a.descricao, a.tema,
        pessoas.nome, a.publicoalvo, a.comentarios, a.coapresentadores,
        a.resumo, a.idioma, a.status, a.espaco, a.comadm, a.pessoa, a.nivel_proposta, a.nivel_envolvimento
        FROM propostas a
        LEFT OUTER JOIN pessoas
        ON a.pessoa = pessoas.cod
        WHERE a.cod = $cod";
$rs = $mysql->conn->Execute($sql);

$smarty->assign('rs', $rs->fields);

$smarty->assign('macrotemas', Macrotemas::carregar($mysql));

$smarty->assign('copalestrantes', Propostas::copalestrantes($mysql, $cod));

$smarty->assign('mesa', Propostas::mesa($mysql, $cod));

$smarty->assign('title', $rs->fields['titulo'] . ' (' . $rs->fields['cod'] . ')');
$smarty->assign('linkup', 'propostas');
$smarty->assign('proposal_level', array('','Iniciante','Avancado'));
$smarty->assign('envolvement_level', array('Criador', 'Mantenedor', 'Tradutor', 'Desenvolvedor', 'Entusiasta', 'Instrutor', 'Usuario', 'Critico', 'Outros'));    

# Altera o fundo da TD status
$smarty->config_load('papers.conf', 'colors');
$stcolor = $smarty->get_config_vars('bgcolor_' . $rs->fields['status']);
$smarty->assign('stcolor', $stcolor);

$smarty->assign('central', 'proposta.tpl');

$smarty->display('index.tpl');

?>
