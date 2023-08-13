<?
$fecha="select * from nomencladores.meses where id = '$pmes'";
$conn = pg_connect("dbname=sistema user=www-data password=12346"); 
$mes=pg_query($conn,$fecha);
$periodo = pg_fetch_row($mes);
$conn = pg_connect("dbname=sistema user=www-data password=12346"); 
$sql="select  * 
 from sss.obras where id='$codos'";
$resultado=pg_query($conn,$sql);
$row = pg_fetch_row($resultado);
echo "<table border='1' width='100%' bordercolorlight='#000000' bordercolordark='#000000' bordercolor='#000000'>";
echo "<tr>";
echo "<th colspan=9>AREA SANITARIA SAN RAFAEL</th>";
echo "</tr>";
echo "<tr>";
echo "<th colspan=9>FACTURACION DEL MES DE  $periodo[1] DEL $pano</th>";
echo "</tr>";
echo "<tr>";
echo "<th colspan=7>$row[2]</th>";
echo "</tr>";
echo "<tr>";
  echo "<th>Id </th><th>";
  echo "Cs </th><th>";
  echo "Nro Carnet</th><th>";
  echo "Fecha </th><th>";
  echo "Mes </th><th>";
  echo "Año </th><th>";
  echo "Doc. </th><th>";
  echo "C. Prest </th><th>";
  echo "Importe </th>";
echo "</tr>";
$contador = 0;
$conn = pg_connect("dbname=sistema user=www-data password=12346"); 
$sql2="SELECT idmov,
       idcentro,
       carnet,     
       tb.fecha,
       periododmes,
       periodoano,
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
       WHERE doc ='$doc') AS tb
INNER JOIN
personas.fisica
ON
tb.doc = fisica.documento
INNER JOIN
nomencladores.arapres
ON
tb.idpres = arapres.codigo
ORDER BY periododmes,periododmes,fecha";
$resultado2=pg_query($conn,$sql2);
while ($row2 = pg_fetch_row($resultado2)) 
{
  echo "<FORM name='modiflinea' action='modifilinea.php' method='POST'>";
  echo "<tr>";
  echo "<td><INPUT type='submit' value='$row2[0]' name='id'></td><td>";
  echo "$row2[1] </td><td>";
  echo "$row2[2] </td><td><p align=center>";
  echo "$row2[3]</p></td><td>";
  echo "$row2[4]</td><td>";
  echo "$row2[5]</td><td><p ALIGN=RIGHT>";
  echo "$row2[6]</p></td><td>";
  echo "$row2[7]</p></td><td>";
  echo "$row2[8]</p></td><td></tr>";
  echo "</FORM>";
}

echo "</form></table>";
?>