
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
        $csdesde = $_POST['csdesde'];
        $cshasta = $_POST['cshasta'];
        $operacion=$_POST['operacion'];
        $fecha=$_POST['fecha']; 
        $doc=$_POST['doc'];
        $idpres=$_POST['idpres'];
        $idos=$_POST['idos'];
        $linea=$_POST['linea'];
        $carnet=$_POST['carnet'];
        $cs = $_POST['cs'];
        $cie = $_POST['cie'];
        $pres = $_POST['pres'];
        $importe = $_POST['importe'];
        $codos_modificado = $_POST['codos_modificado'];
        $host        = "host = 172.17.0.2";
        $port        = "port = 5432";
        $dbname      = "dbname = sistema";
        $credentials = "user = horacio password=123456";
        $conn = pg_connect("$host $port $dbname $credentials");

if ($operacion == "modifica"):
    $sql_mod = "update areasanrafael.anexo set  fecha = '$fecha', doc='$doc',importe ='$importe', idcentro = '$cs', idpres = '$pres', ccie = '$cie', idos = '$codos_modificado'  where idmov='$linea'"; 
    $modifica=pg_query($conn,$sql_mod);
endif;

$fecha="select * from nomencladores.meses where id = '$pmes'";
$mes=pg_query($conn,$fecha);
$periodo = pg_fetch_row($mes);
$sql="select  * 
 from sss.obras where id='$codos'";
$resultado=pg_query($conn,$sql);
$row = pg_fetch_row($resultado);
echo "<table border='1' width='100%' bordercolorlight='#000000' bordercolordark='#000000' bordercolor='#000000'>";
echo "<tr>";
echo "<TR><th colspan=5><h3>CENTRO DE SALUD 158 CUADRO NACIONAL</h3></th>";
echo "<th colspan=2><h5>HPGD: 13320895 </H5></TH></TR>";
echo "<TR><th colspan=7> <h4>AREA SANITARIA SAN RAFAEL</h4></th>";
echo "</tr>";
echo "<tr>";
echo "<th colspan=8>FACTURACION DEL MES DE <INPUT TYPE=TEXT value= ".$periodo[1]." size=20 border=0>  DEL  <INPUT TYPE=TEXT value=".$pano." size=3 border=0></th>";
echo "</tr>";
echo "<tr>";
echo "<th colspan=8>$row[2]</th>";
echo "</tr>";
echo "<tr>";
  echo "<th>Id </th><th>";
  echo "Cs </th><th>";
  echo "Nro D.N.I. </th><th>";
  echo "Fecha</th><th>";
  echo "Apellido y nombre </th><th>";
  echo "C. Prest </th><th>";
  echo "Importe </th><th>";
  echo "</tr>";
$contador = 0;
	$sql2="SELECT idmov,
			idcentro,
			doc,     
    			to_char(tb.fecha,'DD/MM/YYYY') as fecha1,
    			fisica.nombre,
    			arapres.detalle,
    			tb.importe,
			ccie,
			cie10assr.descripcion1
		FROM 
		    (
			SELECT
			        idmov,
			        fecha,
			        doc,
			        idpres,
			        idos,
			        periododmes,
			        periodoano,
			        to_char( importe, '$9999D99')as importe,
    				carnet,
				ccie,
    				idcentro 
    			FROM 
			        areasanrafael.anexo 
	    		WHERE 
	    			idos='$codos' 
			AND	periododmes ='$pmes' 
			AND	periodoano ='$pano' 
			AND 	fecha >= '$fdesde' 
			AND	fecha <= '$fhasta'
			AND     idcentro >= '$csdesde'
			AND	idcentro <= '$cshasta' 
			
		    ) AS tb
		LEFT JOIN
			personas.fisica
		ON
			tb.doc = fisica.documento
		LEFT JOIN
			nomencladores.arapres
		ON
			tb.idpres = arapres.codigo
		LEFT JOIN
			nomencladores.cie10assr
		ON
			tb.ccie = cie10assr.id			
		ORDER BY 
			idcentro,tb.fecha,fisica.nombre";
		
$resultado2=pg_query($conn,$sql2);
while ($row2 = pg_fetch_row($resultado2)) 
{
  $contador = $contador +1 ;
  echo "<FORM name='modiflinea' action='modificalinea21.php' method='POST'>";
  echo "<tr>";
  echo "<td rowspan=2 align=center>
           <input type=hidden name=pmes value=$pmes>
           <input type=hidden name=pano value=$pano>
           <input type=hidden name=codos value=$codos>
           <input type=hidden name=fdesde value=$fdesde>
           <input type=hidden name=fhasta value=$fhasta>
           <input type=hidden name=csdesde value=$csdesde>
           <input type=hidden name=cshasta value=$cshasta>
           <input type=hidden value=$row2[0] name=id><input type=submit name='$contador' value=$contador></td><td>";
  echo "$row2[1] </td><td>";
  echo "$row2[2] </td><td><p align=center>";
  echo "$row2[3]</p></td><td>";
  $qcaracteres = strlen($row2[4]);
  if ($qcaracteres == 0){
      echo "Error de carga en datos personales Revisar  y corregir</td><td>";
  }
  else {
        echo "$row2[4]</td><td>";
  }
  echo "$row2[5]</td><td><p ALIGN=RIGHT>";
  echo "$row2[6]</p></td><td></tr><td>";
  echo "$row2[7]</td><td colspan=5 bgcolor=fffff>$row2[8]</tr>";
  echo "</FORM>";
}
$total ="
	SELECT
    	    to_char( sum(importe), '$9999999D99')as importe      
        FROM 
    	    areasanrafael.anexo 
        WHERE 
    	    idos='$codos' 
	AND periododmes ='$pmes' 
	AND periodoano ='$pano' 
	AND fecha >= '$fdesde' 
	AND fecha <= '$fhasta'
	AND     idcentro >= '$csdesde'
	AND	idcentro <= '$cshasta'
	"
	;
$total1=pg_query($conn,$total);
$total2 = pg_fetch_row($total1);
echo "<th colspan=5>Total facturado</th><th colspan=2 align=right>$total2[0]</th>";
echo "</form></table>";
?>
</BODY>
</HTML>