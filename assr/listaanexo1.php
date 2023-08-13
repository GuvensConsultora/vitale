<?php
        $codos=$_POST['codos'];
        $prest=$_POST['prest'];
        $carnet=$_POST['carnet'];
        $cie=$_POST['cie'];
        $cs = $_POST['cs'];
        $pmes=$_POST['pmes'];
        $pano=$_POST['pano'];
        $fdesde=$_POST['fdesde'];
        $fhasta=$_POST['fhasta'];
        $doc=$_POST['doc'];
        $dia=$_POST['dia'];
        $mes=$_POST['mes'];
        $ano=$_POST['ano'];
        $linea=$_POST['id'];
        $host        = "host = 172.17.0.2";
        $port        = "port = 5432";
        $dbname      = "dbname = sistema";
        $credentials = "user = horacio password=123456";
        $conn = pg_connect("$host $port $dbname $credentials");


$fecha="select * from nomencladores.meses where id = '$pmes'";
$mes=pg_query($conn,$fecha);
$periodo = pg_fetch_row($mes);
$sql="select  * 
 from sss.obras where id='$codos'";
$resultado=pg_query($conn,$sql);
$row = pg_fetch_row($resultado);
echo "<table border='1' width='100%' bordercolorlight='#000000' bordercolordark='#000000' bordercolor='#000000'>";
echo "<tr>";
echo "<th colspan=7>AREA SANITARIA SAN RAFAEL</th>";
echo "</tr>";
echo "<tr>";
echo "<th colspan=7>FACTURACION DEL MES DE  $periodo[1] DEL $pano</th>";
echo "</tr>";
echo "<tr>";
echo "<th colspan=7>$row[2]</th>";
echo "</tr>";
echo "<tr>";
  echo "<th>Id </th><th>";
  echo "Cs </th><th>";
  echo "Fecha </th><th>";
  echo "Nro Carnet</th><th>";
  echo "Doc. </th><th>";
  echo "C. Prest </th><th>";
  echo "Importe </th>";
echo "</tr>";
$contador = 0;
$sql2="SELECT idmov,
       idcentro,
       carnet,     
       tb.fecha,
       fisica.nombre,
       arapres.detalle,
       tb.importe
FROM (
SELECT
        idmov,
        to_char(fecha, 'DD-MM-YYYY')as fecha,
        doc,
        idpres,
        idos,
        periododmes,
        periodoano,
        to_char( importe, '$9999D99')as importe,
        carnet,
        idcentro 
       FROM 
        areasanrafael.anexo 
       WHERE idos='$codos' and periododmes ='$pmes' and periodoano ='$pano' and fecha >= '$fdesde' and fecha <= '$fhasta') AS tb
INNER JOIN
personas.fisica
ON
tb.doc = fisica.documento
INNER JOIN
nomencladores.arapres
ON
tb.idpres = arapres.codigo
ORDER BY idcentro,tb.fecha";
$resultado2=pg_query($conn,$sql2);
while ($row2 = pg_fetch_row($resultado2)) 
{
  echo "<FORM name='modiflinea' action='modifilinea.php' method='POST'>";
  echo "<tr>";
  echo "<td>  <input type=hidden name=fdesde value=$fdesde>
              <input type=hidden name=fhasta value=$fhasta>
              <INPUT type='submit' value='$row2[0]' name='id'></td><td>";
  echo "$row2[1] </td><td>";
  echo "$row2[2] </td><td><p align=center>";
  echo "$row2[3]</p></td><td>";
  echo "$row2[4]</td><td>";
  echo "$row2[5]</td><td><p ALIGN=RIGHT>";
  echo "$row2[6]</p></td><td></tr>";
  echo "</FORM>";
}

echo "</form></table>";
?>