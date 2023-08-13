<?php
//// ------------------------- VERIFICO QUE LA VARIABLE $codos que viene de este archivo no este vasi
////------------------------- Si està vacia comienzo a armar la pàgina de carga de datos.
//// 
        $codos=$_POST['codos'];
        $prest=$_POST['prest'];
        $carnet=$_POST['carnet'];
        $cie=$_POST['cie'];
        $cs = $_POST['cs'];
        $pmes=$_POST['pmes'];
        $pano=$_POST['pano'];
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


if ($linea == !""):
    $sql_borrar_linea ="delete from areasanrafael.anexo where idmov='$linea'";
$borrar_linea=pg_query($conn,$sql_borrar_linea);
endif;



if ($doc =="") 
        {
        ?>
    <html>
    <title>Carga de anexos al listado </title>
	<script>
	    
	</script>
    <body onLoad="this.document.lista.consdoc">
 <?php
	echo "<table border=1 align=center>";
    echo "<div align='center'><H4>Formulario cargador de listados </h4></div>";
/// ------------------------------------------------------------------------------------------
/// ---------- Comienzo el formulario de carga de datos.--------------------------------------
///-------------------------------------------------------------------------------------------
echo "<dib align='center'><form name=lista method=post action=generalista1.php>";
echo "<tr><th>Documento</th>";
echo "<th>Fecha</th>";
echo "<th>Mes</th>";
echo "<th>Año</th>";
echo "<th>Periodo</th>";
echo "<th>Código de O S</th>";
echo "<th>C.de S.</th>";
echo "<th>Prestacion</th>";
echo "<tr><th  colspan='6'>Nombre</th>";
echo "<th>Nro Carnet</th>";
echo "<th>Acción</th></tr>";
echo "<tr>";
echo "<td><input size=8 name=doc type=text value='$doc'></td>";
echo "<td><input size=2 name=dia type=text value='$dia'></td>";
echo "<td><input size=2 name=mes type=text value='$mes'></td>";
echo "<td><input size=4 name=ano type=text value='$ano'></td>";
echo "<td><input size=2 name=pmes type=text value='$pmes'></td>";
echo "<td><input size=6 name=codos type=text value='$codos'></td>";
echo "<td><input size=3 name=cs type=text title=Doble click sobre este campo para obtener ayuda del centro de salud value='$cs'onclick=abreobs('sanrafael.ath.cx/centros.php')></td>";
echo "<td><input size=8 name=prest accesskey='P'  type=text value='$prest'></td></tr><tr>";

//------Pruebo la generaciòn de select en un if para seleccionar una variableya
//********* Gargada *///

$sql="SELECT * FROM nomencladores.cie10assr ORDER BY descripcion1";
$resultado=pg_query($conn,$sql);

  //echo "$cie";  // Esta variable viene del formulario anterior

$sql="SELECT * FROM nomencladores.cie10assr ORDER BY descripcion1";
$resultado=pg_query($conn,$sql);
echo "<tr><th>Diagnostico</th><td colspan=7><select accesskey='G'  name=cie>";
while ($row = pg_fetch_row($resultado)) 
   {
   if (trim($row[0]) == trim($cie))
	{
	  echo "<option value=$row[0] title=$row[0] selected > $row[2] | $row[0]</option>";
	}
	else
	{
	  echo "<option value=$row[0] title=$row[0]> $row[2] | $row[0]</option>";
	}
   } 
	 ;
echo "</select></td></tr>";
?><tr><td colspan='6'><input size="50" name=nombre type=text value='<?php echo "$nombre";?>'></td>
<td ><input name=carnet type=text value='<?php echo "$carnet";?>'></td>
<?php
echo "<td><input name=confirma type=submit value='confirmar'></td></tr>";
echo "</form></table>";
///-----------------------------------------------------------------------------------------------------
/// -----------------------------TERMINA EL FORMULARIO DE CARGAD DE DATOS -------------------------------
}
?>
<iframe src="generalista21.php" width="1200" height="400" name="ventana"></iframe>
</body>
</html>
