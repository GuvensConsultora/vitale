<?php
echo "<div align=center><h2> Area Sanitaria San Rafael </h2></div>"; echo "<div align=center><h3> Modifica linea en la carga de formularios </h3></div>";
        $linea=$_POST['id'];
        $pmes = $_POST['pmes'];
        $pano = $_POST['pano'];
        $codos = $_POST['codos'];
        $fdesde = $_POST['fdesde'];
        $fhasta = $_POST['fhasta'];
        $csdesde = $_POST['csdesde'];
        $cshasta = $_POST['cshasta'];


$host        = "host = 172.17.0.2";
$port        = "port = 5432";
$dbname      = "dbname = sistema";
$credentials = "user = horacio password=123456";
$conn = pg_connect("$host $port $dbname $credentials");

echo "<FORM name=modifica method=post action=listaanexo1.php>";
$sql="select  idmov,
        fecha,
        doc,
        idpres,
        idos,
        periododmes,
        periodoano,
        importe,
        carnet,
        idcentro,
	ccie 
  from areasanrafael.anexo where idmov='$linea'";
$resultado=pg_query($conn,$sql);
$row = pg_fetch_row($resultado);
echo "<div align=center><table width=30% border=1>";
echo "<tr><th>Movimiento</th><td>
           <input type=hidden name=pmes value=$pmes>
           <input type=hidden name=pano value=$pano>
           <input type=hidden name=fdesde value=$fdesde>
           <input type=hidden name=fhasta value=$fhasta>
           <input type=hidden name=csdesde value=$csdesde>
           <input type=hidden name=cshasta value=$cshasta>
           <input type=hidden name=operacion value=modifica readonly=true>
           <input type=text name=linea value='$linea' readonly=true></td></tr>";
echo "<tr><th>Fecha</th><td><input type=text name=fecha value='$row[1]'></td></tr>";
echo "<tr><th>Documento</th><td><input type=text name=doc value='$row[2]'></td></tr>";
echo "<tr><th>Prestación</th><td><input type=text name=pres value='$row[3]'></td></tr>";
echo "<tr><th>Nro Obra social</th><td><input type=text name=codos value='$row[4]'></td></tr>";

$sql1="SELECT * FROM nomencladores.cie10assr order by descripcion1";

$resultado1 = pg_query($conn,$sql1);

echo "<tr><th>C.I.E. 10</th><td><select name=cie>";

while ($row1=pg_fetch_row($resultado1))
   {
    if (trim($row1[0]) == trim($row[10]))
      {
       echo "<option value=$row1[0] title=$row1[0] selected> $row1[2] | $row1[0]</option>";
      }
      else
      {
       echo "<option value=$row1[0] title=$row1[0]> $row1[2] | $row1[0]</option>";
      }
    };

echo "<tr><th>Periodo Mensual</th><td><input type=text name=pmes value='$row[5]'></td></tr>";
echo "<tr><th>Periodo Anual</th><td><input type=text name=pano value='$row[6]'></td></tr>";
echo "<tr><th>Importe de la prestación</th><td><input type=text name=importe value='$row[7]'></td></tr>";
echo "<tr><th>Nro de Carnet</th><td><input type=text name=carnet value='$row[8]'></td></tr>";
echo "<tr><th>Centro de Salud</th><td><input type=text name=cs value='$row[9]'></td></tr>";
echo "<tr><td><input type=submit name=modifica></td></tr>";
echo "</table></form>";


?>