<?php
$nombre = $_POST['nombre'];
$td = $_POST['td'];
$doc = $_POST['doc'];
$sexo = $_POST['sexo'];
$cuil = $_POST['cuil'];
$fecha = $_POST['fecha'];
$host        = "host = 172.17.0.2";
$port        = "port = 5432";
$dbname      = "dbname = sistema";
$credentials = "user = horacio password=123456";
$conn = pg_connect("$host $port $dbname $credentials");
$sql="INSERT INTO personas.fisica(nombre,tipodoc,documento,sexo,cuil,fnacimiento) values ('$nombre','$td','$doc','$sexo','$cuil','$fecha')";
$resultado1=pg_query($conn,$sql);
$sql1="SELECT nombre,tipodoc,documento,sexo,cuil,fnacimiento from personas.fisica where documento='$doc'";
$resultado1=pg_query($conn,$sql1);
while ($row = pg_fetch_row($resultado1));
{
    echo "<div align=center>";
    echo "<table>";
    echo "<form name=alta method=post action=apersona.php>";
    echo "<tr><th>APELLIDO Y NOMBRE</th><td><input title='Ingrese el apellido y nombre' type=text name=nombre size=25 value=$row[1] onChange='javascript:this.value=this.value.toUpperCase()'></td></tr>";
    echo "<tr><th>TIPO DE DOC</th><td><SELECT value= value=$row[2] name=td><option>DNI</option><option>LC</option><option>LE</option><option>CL</option></select></td></tr>";
    echo "<tr><th>Nro de Doc</th><td><input title='Nro de documento' value=$row[2] type=text name=doc size=8></td></tr>";
    echo "<tr><th>SEXO</th><td><SELECT name=sexo value=$row[3]><option>F</option><option>M</option></select></td></tr>";
    echo "<tr><th>Nro de CUIL</th><td><input title='Nro de CUIL'  type=text name=cuil size=11></td></tr>";
    echo "<tr><th>Fecha de nac</th><td><input title='Ingrese los datos separados con  guión intermedio'  type=text name=fecha size=8></td></tr>";
    echo "<tr><td><input type=submit title='Enviar datos al servidor' name=enviar></th><td><input type=reset title='Enviar datos al servidor' name=reset></td></tr>";
    echo "</form>";
    echo "</table></div>";
}
?>
 