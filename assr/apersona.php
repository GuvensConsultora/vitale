<?php
if ($doc=='')
{ 
echo "<html>";
echo "<title>Formulario para dar de alta a una nueva persona</title>";
echo "<head>
 <link rel='STYLESHEET' type='text/css' href='estilo.css'>
 <title>Página que lee estilos</title>
</head>";
echo "<body onLoad='this.document.alta.nombre.focus()'>";
echo "<div align=center><h2>Area Sanitaria San Rafael</h2></div>";
echo "<div align=center><h3>Alta de una nueva persona en el sistema</h3></div>";
echo "<hr>";
echo "<div align=center>";
echo "<table>";
echo "<form name=alta method=post action=apersona1.php>";
echo "<tr><th>APELLIDO Y NOMBRE</th><td><input title='Ingrese el apellido y nombre' type=text name=nombre size=25 onChange='javascript:this.value=this.value.toUpperCase()'; ></td></tr>";
echo "<tr><th>TIPO DE DOC</th><td><SELECT name=td><option>DNI</option><option>LC</option><option>LE</option><option>CL</option></select></td></tr>";
echo "<tr><th>Nro de Doc</th><td><input title='Nro de documento'  type=text name=doc size=8></td></tr>";
echo "<tr><th>SEXO</th><td><SELECT name=sexo><option>F</option><option>M</option></select></td></tr>";
echo "<tr><th>Nro de CUIL</th><td><input title='Nro de CUIL'  type=text name=cuil size=11></td></tr>";
echo "<tr><th>Fecha de nac</th><td><input title='Ingrese los datos separados con  guión intermedio'  type=text name=fecha size=8></td></tr>";
echo "<tr><td><input type=submit title='Enviar datos al servidor' name=enviar></th><td><input type=reset title='Enviar datos al servidor' name=reset></td></tr>";
echo "</form>";
echo "</table></div>";
echo "<hr><hr>";
echo "</body></html>";
}
else
{
$conn = pg_connect("dbname=sistema user=apache password=12346"); 
$sql="INSERT INTO personas.fisica(nombre,tipodoc,documento,sexo,cuil,fnacimiento) values ('$nombre','$td','$doc','$sexo','$cuil','$fecha')";
$resultado1=pg_query($conn,$sql);
$sql1="SELECT nombre,tipodoc,documento,sexo,cuil,fnacimiento from personas.fisica where tipodoc='$td' and documento='$doc'";
$resultado1=pg_query($conn,$sql1);
$row = pg_fetch_row($resultado1);
echo "<html>";
echo "<body onLoad='this.document.aobs.codos.focus()'>";
echo "<div align=center><h1>Area Sanitaria San Rafael</h1></div>";
echo "<div align=center><h3>Persona dada de alta en el sistema</h3></div>";
echo "<div align=center><table>";
echo "<form name=aobs metho=post action=apersona1.php>";
echo "<tr><th>Apellido y Nombre</th><td>$row[0]</td>";
echo "<tr><th>Tipo de documento</th><td><input type=text value=$row[1] name=td readonly=true></td>";
echo "<tr><th>Nro de documento</th><td><input type=text value=$row[2] name=doc readonly=true></td>";
echo "<tr><th>Sexo</th><td>$row[3]</td></tr>";
echo "<tr><th>Cuil del beneficiario</th><td>$row[4]</td></tr>";
echo "<tr><th>Fecha de nacimiento</th><td>$row[5]</td></tr>";
echo "</table><hr>";
echo "<div align=center><h3>Formulario para cargar datos de la obra social</h3></div>";
echo "<div align=center><table></div>";
echo "<tr><th>Ingresar el Código de obra social</th><td><input type=text size=10 name=codos title='Ingresar el código de la obra social a la que pertenece'></td></tr>";

echo "<tr><th>Nro de cuit del titular</th><td><input type=text name=cuilt size=11 title='Ingresar el nro de cuit del titular'></td></tr>";

echo "<tr><th>Nro de carnet</th><td><input type=text name=carnet size=25 title='Ingresar el nro de carnet'></td></tr>";

echo "<tr><td><input type=submit name=enviar value=enviar></td><td><input type=reset name=limpiar value=limpiar></td></tr>";
echo "</table></div>";
echo "</body></html>";
}
?>
