<?
header('Content-Type: image/svg+xml; charset=iso-8859-15');
print('<?xml version="1.0" encoding="iso-8859-15" standalone="no"?>');

include('include/mysmarty.inc.php');

include('include/mysql.inc.php');
include('include/basic.inc.php');
include('include/propostas.inc.php');
include('include/macrotemas.inc.php');
include('include/grade.inc.php');
include('include/pessoas.inc.php');
include('include/dias.inc.php');
include('include/horarios.inc.php');
include('include/salas.inc.php');

$mysql = new Mysql;
$dias = Dias::carregar($mysql);
$horarios = Horarios::carregar($mysql);
$salas = Salas::carregarNaoVazias($mysql);
$grade = Grade::carregar($mysql);

$cw = 135;  # Cell Width
$ch = 120;  # Cell Height

function escXML($str) {
  return str_ireplace (
    Array( '<',    '>',    '&'     ),
    Array( '&lt;', '&gt;', '&amp;' ),
    $str
  );
}

function getPalSize( $grade, $dia, $sala, $hora ) {
  $thisPal = $grade[$dia][$sala][$hora]['cod'];
  $size = 1;
  $hora++;
  while ( $grade[$dia][$sala][$hora] && $grade[$dia][$sala][$hora]['cod'] == $thisPal ) {
    $size++;
    $hora++;
  }
  return $size;
}

?>
<svg
  xmlns="http://www.w3.org/2000/svg"
  xmlns:xlink="http://www.w3.org/1999/xlink"
  width="42cm" height="59.4cm">
<defs>
  <linearGradient id="grad-palestra" x1="50%" y1 = "65%" x2 = "50%" y2 = "120%">
    <stop stop-color="#EEE" offset="0" />
    <stop stop-color="#CCC" offset="1" />
  </linearGradient>
  <style type="text/css"><![CDATA[<? require_once ('svg.css'); ?>]]></style>
</defs>
<?
$dp = 40; # Day position
foreach ($dias as $dia) {
?>

<text x="115" y="<?= $dp - 10 ?>" class="dia"><?= $dia['descricao'] ?></text>

<?

$pos = 0;
foreach ($horarios as $hora) {
?>
  <g class="hora">
    <rect x="<?= $pos*$cw + 113 ?>" y="<?= $dp ?>" ry="5" width="<?= $cw-2 ?>" height="18" />
    <text x="<?= ($pos+.5)*$cw + 113 ?>" y="<?= $dp+13 ?>"><?=  $hora['inicio'] ?></text>
  </g>
<?
  $pos++;
}

#########################################################

$pos = 0;
foreach ($salas as $sala) {
?>
  <g class="sala">
    <rect x="1" y="<?= $dp + $pos*$ch + 20 ?>" ry="5" width="110" height="<?= $ch-2 ?>" />
    <text x="100" y="<?= $dp + ($pos*$ch) + ($ch/2 + 22) ?>"><?=  $sala['descricao'] ?></text>
  </g>
<?
  $pos++;
}

#########################################################

$posY = 0;
foreach ($salas as $sala) {
  $ultimaPalestra = -1;
  $posX = 0;
  foreach ($horarios as $hora) {
    $palestra = $grade[ $dia['numero'] ][ $sala['numero'] ][ $hora['numero'] ];
    $palSize = getPalSize( $grade, $dia['numero'], $sala['numero'], $hora['numero'] );
    $palestrantes = Array();
    if ( $palestra['copalestrantes'] ) {
      foreach ($palestra['copalestrantes'] as $p) {
        $palestrantes[] = $p['nome'];
      }
    }
    $tema = ereg_replace( '[Dd]esenvolvimento', 'Des.', $palestra['macrotema'] );
    $tema = ereg_replace( 'Sistemas Embarcados', 'Embarcados', $tema );
    $temaClass = substr( ereg_replace( '[^a-z]|envolvimento', '',
                         strtolower($palestra['macrotema']) ), 0, 10);
    ?>
    <g class="palestra">
      <? if ( $palestra && $palestra['cod'] != $ultimaPalestra ) { ?>
        <rect x="<?= $posX*$cw + 113 ?>" y="<?= $dp + $posY*$ch + 20 ?>" ry="5"
              width="<?= ($cw*$palSize) - 2 ?>" height="<?= $ch-2 ?>" />
        <text x="<?= $posX*$cw + 118 ?>"
              y="<?= $dp + ($posY*$ch) + 32 ?>"
              class="tema <?= $temaClass ?>"><?= $tema ?></text>
        <flowRoot>
          <flowRegion>
	    <rect x="<?= $posX*$cw + 113 ?>" y="<?= $dp + $posY*$ch + 50 ?>"
                  width="<?= ($cw*$palSize)-2 ?>" height="<?= $ch-30 ?>" />
          </flowRegion>
          <flowPara class="ptit"><?= escXML( $palestra['titulo'] ) ?></flowPara>
          <flowPara></flowPara>
          <flowPara class="pess"><?= escXML( implode( ', ', $palestrantes ) ) ?></flowPara>
        </flowRoot>
      <? } elseif ( ! $palestra ) { ?>
        <rect x="<?= $posX*$cw + 113 ?>" y="<?= $dp + $posY*$ch + 20 ?>" ry="5"
              width="<?= ($cw*$palSize) - 2 ?>" height="<?= $ch-2 ?>" class="vazio" />
      <? }
	 $ultimaPalestra = $palestra['cod'];
      ?>
    </g>
    <?
    $posX++;
  }
  $posY++;
}

$dp += $ch * 16;
}
?>
</svg>
