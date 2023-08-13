<?php
   echo "<hd>";
   $doc=$_POST['doc'];
   $for_or=$_POST['for_or'];
   $usuario =$_POST["usuario"];
   $clave = $_POST["clave"];
   $host        = "host = 172.17.0.2";
   $port        = "port = 5432";
   $dbname      = "dbname = sistema";
   $credentials = "user = horacio password=123456";
   $conn = pg_connect("$host $port $dbname $credentials");

?>
<HTML>
<BODY bgcolor="#EDFFFF">
 <FORM name="act" method="POST" action="actualizadatos1.php">
<?php
      
 
echo "<hd>";
$sql="select nombre,tipodoc,documento,sexo,cuil,fnacimiento from personas.fisica where documento='$doc'";
$resultado=pg_query($conn,$sql);
if (!$resultado){
    echo "<div align=center><h3>Alta de una nueva persona en el sistema</h3></div>";
    echo "<div align=center>";
    echo "<table>";
    echo "<form name=alta method=post action=actualizadatos.php>";
    echo "<tr><th>APELLIDO Y NOMBRE</th><td colspan=3><input title='Ingrese el apellido y nombre' type=text name=nombre size=50 onChange='javascript:this.value=this.value.toUpperCase()'; ></td></tr>";
echo "<tr><th>TIPO DE DOC</th><td><SELECT name=td><option>DNI</option><option>LC</option><option>LE</option><option>CL</option></select></td>";
echo "<th>Nro de Doc</th><td><input title='Nro de documento'  type=text name=doc size=8></td></tr>";
echo "<tr><th>SEXO</th><td><SELECT name=sexo><option>F</option><option>M</option></select></td>";
echo "<th>Nro de CUIL</th><td><input title='Nro de CUIL'  type=text name=cuil size=11></td></tr>";
echo "<tr><th>Fecha de nac</th><td><input title='Ingrese los datos separados con  guión intermedio'  type=text name=fecha size=8>";
echo "<input title='form_origen' name=for_or type=hidden value=alta_persona></td>";
echo "<td><input type=submit title='Enviar datos al servidor' name=enviar><input type=reset title='Enviar datos al servidor' name=reset></td></tr>";
echo "</form>";
echo "</table></div>";

    exit;
}
echo "<table WIDTH=100% BORDER=1 BORDERCOLOR='#000001'>";
echo "<form name=actualiza action=xxx.php method=post>";
while ($row = pg_fetch_row($resultado)) 
{?>
 <th>Apellido y nombre </th><th>Nro doc </th> <th>Sex </th><th>Fecha Nac </th><th>Cuil Benf </th><th>Acción</th>
  <tr><TD><input type="text" size="25" value= "<?php echo "$row[0]";?>" name="apellido"></TD>
  <TD><input type="text" size="9" value="<?php echo "$row[2]";?>" readonly=true name="doc"></TD>
  <TD><input type="text" size="2" value= "<?php echo "$row[3]";?>" name="sex"></TD>
  <TD><input type="text" size="9" value= "<?php echo "$row[5]";?>" name="nacimiento"></TD> 
  <TD><input type="text" size="16" value= "<?php echo "$row[4]";?>" name="cuilb"></TD>
   <TD><input type="submit" value= "enviar" name="enviar"></TD>
<?php }
echo "$for_or";
echo "</form></table>";
$sql1="select * from ubicacion.ubicada where documento='$doc'";
$resultado1=pg_query($conn,$sql1);  
echo "<table WIDTH=100% BORDER=1 BORDERCOLOR='#000001'>";
          echo "<th>Domicilio </th>";
          echo "<th>Cod. Post </th>";
          echo "<th>Distrito</th>";
          echo "<th>Departamento</th>";
          echo "<th>Región</th>";
          echo "<th>Provincia</th>";
          echo "<th>Nacionalidad</th>";
while ($row1 = pg_fetch_row($resultado1)) 
       {
            echo "<tr>";
            echo "<td style='text-align : center;'>$row1[2]</td>";
            echo "<td style='text-align : center;'>$row1[3]</td>";
            echo "<td style='text-align : center;'>$row1[4]</td>";
            echo "<td style='text-align : center;'>$row1[5]</td>";
            echo "<td style='text-align : center;'>$row1[6]</td>";
            echo "<td style='text-align : center;'>$row1[7]</td>";
            echo "<td style='text-align : center;'>$row1[8]</td>";
       	    echo "</tr>";
       }
      echo "</table>";
      echo "<FORM name='act' method='POST' action='actualizadatos1.php'>";
$sql2="select cuilt,ncarnet,idos,obrasocial,idin,tb.id, tb.documento from
(select * from sss.vinculo where documento='$doc')as tb
LEFT JOIN
         sss.obras
ON
         tb.idos = obras.id";
$resultado2=pg_query($conn,$sql2);  
          echo "<table WIDTH=100% BORDER=1 BORDERCOLOR='#000001'>";
          echo "<th>Cuil Tit </th>";
          echo "<th>Nro de carnet </th>";
          echo "<th>Código O.S. </th>";
          echo "<th>Nombre </th>";
          echo "<th>Acción</th>";
while ($row2 = pg_fetch_row($resultado2)) 
       {?>
            <tr>
            <TD><input type="hidden" size="5" value="<?php echo "$row2[6]";?>" name="doc"><input type="hidden" size="5" value="<?php echo "$row2[5]";?>" name="id"><input type="text" size="11" value= "<?php echo "$row2[0]";?>" name="cuilt"></TD>
            <TD><input type="text" size="16" value= "<?php echo "$row2[1]";?>" name="carnet"></TD>
          <TD><input type="text" size="8" value= "<?php echo "$row2[2]";?>" name="codos"></TD>
          <TD><?php echo "$row2[3]";?></TD>
          <TD><input type="submit" value= "modifica" name="enviar"></TD>
	<?php
           echo "</tr>";
           echo "</table>";
	       echo "</tr>";
       }
           echo "</table>";

?>
</tr></table></FORM>
</BODY>
</HTML>


