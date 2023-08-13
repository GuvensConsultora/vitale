<HTML>
<HEAD>
<STYLE type="text/css">
   TABLE {border: 1px solid black; border-spacing: 0pt;}
   TD {border: 1px solid black; border-spacing: 0pt;}
</STYLE>
</HEAD>
<BODY>
<?php
        $pmes = $_POST['pmes'];
        $pano = $_POST['pano'];
        $codos = $_POST['codos'];
        $fdesde = $_POST['fdesde'];
        $fhasta = $_POST['fhasta'];
        $cs = $_POST['cs'];
        $cs1 = $_POST['cs1'];
        $host        = "host = 172.17.0.2";
        $port        = "port = 5432";
        $dbname      = "dbname = sistema";
        $credentials = "user = horacio password=123456";
        $sql="SELECT * FROM  nomencladores.cie10assr ORDER BY descripcion1";
        $conn = pg_connect("$host $port $dbname $credentials");
        $fecha="select * from nomencladores.meses where id = '$pmes' ";
$mes=pg_query($conn,$fecha);
$periodo = pg_fetch_row($mes);
$sql="select  * 
 from sss.obras where id='$codos'";
$resultado=pg_query($conn,$sql);
$row = pg_fetch_row($resultado);
echo "<table border='1' width='100%' bordercolorlight='#000000' bordercolordark='#000000' bordercolor='#000000'>";
echo "<tr>";
echo "<th colspan=7><h3>AREA SANITARIA SAN RAFAEL</h3></th>";
echo "</tr>";
echo "<tr>";
echo "<th colspan=7>FACTURACION DEL MES " . $pmes ." DEL ". $pano . "</th>";
echo "</tr>";
echo "<tr>";
echo "<th colspan=7>$row[2]</th>";
echo "</tr>";
echo "<tr>";
  echo "<th>Id </th><th>";
  echo "Cs </th><th>";
  echo "Nro Carnet </th><th>";
  echo "Fecha</th><th>";
  echo "Apellido y nombre </th><th>";
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
                to_char( anexo.fecha, 'DD-MM-YYYY')as fecha,
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
       WHERE 
    			idos='$codos' 
		and 	periododmes ='$pmes' 
		and 	periodoano ='$pano' 
		and 	anexo.fecha >= '$fdesde' 
		and 	anexo.fecha <= '$fhasta'
		and 	anexo.idcentro >= '$cs'
		and	anexo.idcentro <= '$cs1'

	)
	 AS tb

INNER JOIN
    personas.fisica
ON
    tb.doc = fisica.documento
INNER JOIN
    nomencladores.arapres
ON
    tb.idpres = arapres.codigo
ORDER BY 
    idcentro,fecha, fisica.nombre";
    
    
$resultado2=pg_query($conn,$sql2);
while ($row2 = pg_fetch_row($resultado2)) 
{
  $contador = $contador +1 ;
  echo "<FORM name='modiflinea' action='modifilinea.php' method='POST'>";
  echo "<tr>";
  echo "<td>$contador|$row2[0]</td><td>";
  echo "$row2[1] </td><td>";
  echo "$row2[2] </td><td><p align=center>";
  echo "$row2[3]</p></td><td>";
  echo "$row2[4]</td><td>";
  echo "$row2[5]</td><td><p ALIGN=RIGHT>";
  echo "$row2[6]</p></td></tr>";
  echo "</FORM>";
}

$total ="SELECT
        to_char( sum(importe), '$9999999D99')as importe      
       FROM 
        areasanrafael.anexo 
       WHERE idos='$codos' and periododmes ='$pmes' and periodoano ='$pano' and fecha >= '$fdesde' and fecha <= '$fhasta' and idcentro = '$cs'";
$total1=pg_query($conn,$total);
$total2 = pg_fetch_row($total1);
echo "<th colspan=6>Total facturado</th><th>$total2[0]</th>";
echo "</form></table>";
?>
</BODY>
</HTML>
