<?php

   $doc=$_POST['doc'];
   $usuario =$_POST["usuario"];
   $clave = $_POST["clave"];
   $host        = "host = 172.17.0.2";
   $port        = "port = 5432";
   $dbname      = "dbname = sistema";
   $credentials = "user = horacio password=123456";
   $conn = pg_connect("$host $port $dbname $credentials");
   $sql="update sss.vinculo set cuilt='$cuilt', idos='$codos',ncarnet='$carnet'  where id='$id'";
   $resultado=pg_query($conn,$sql);
?>
<HTML>
<BODY bgcolor="#EDFFFF">
 <FORM name="act" method="POST" action="actualizadatos.php">
<?php echo "<hd>";
$sql="select nombre,tipodoc,documento,sexo,cuil,fnacimiento from personas.fisica where documento='$doc'";
$resultado=pg_query($conn,$sql);
echo "<table WIDTH=100% BORDER=1 BORDERCOLOR='#000001'>";
echo "<form name=actualiza action=xxx.php method=post>";
while ($row = pg_fetch_row($resultado)) 
{?>
 <th>Apellido y nombre </th><th>Nº doc </th> <th>Sex </th><th>Fecha Nac </th><th>Cuil Benf </th><th>Acción</th>
  <tr><TD><input type="text" size="25" value= "<?php echo "$row[0]";?>" name="apellido"></TD>
  <TD><input type="text" size="9" value= "<?php echo "$row[2]";?>" readonly=true name="doc"><input type="Button" value="sss" onclick="sss()"><input type="Button" value="anses" onclick="anses()"></TD>
  <TD><input type="text" size="2" value= "<?php echo "$row[3]";?>" name="sex"></TD>
  <TD><input type="text" size="9" value= "<?php echo "$row[5]";?>" name="nacimiento"></TD> 
  <TD><input type="text" size="11" value= "<?php echo "$row[4]";?>" name="cuilb"></TD>
   <TD><input type="submit" value= "enviar" name="enviar"></TD>
<?php
       }
echo "</form></table>";
$sql1="select * from ubicacion.ubicada where documento='$doc'";
$resultado1=pg_query($conn,$sql1);  
echo "<table WIDTH=100% BORDER=1 BORDERCOLOR='#000001'>";
          echo "<th>Domicilio </th>";
          echo "<th>Cod. Post </th>";
          echo "<th>Distrito</th>";
          echo "<th>Departamento</th>";
          echo "<th>Region</th>";
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
          echo "<th>Codigo O.S. </th>";
          echo "<th>Nombre </th>";
          echo "<th>Accion</th>";
while ($row2 = pg_fetch_row($resultado2)) 
       {?>
            <tr>
            <TD><input type="hidden" size="5" value="<?php echo "$row2[6]";?>" name="doc"><input type="hidden" size="5" value="<?php echo "$row2[5]";?>" name="id"><input type="text" size="11" value= "<?php echo "$row2[0]";?>" name="cuilt"></TD>
            <TD><input type="text" size="11" value= "<?php echo "$row2[1]";?>" name="carnet"></TD>
          <TD><input type="text" size="11" value= "<?php echo "$row2[2]";?>" name="codos"></TD>
          <TD><?php echo "$row2[3]";?></TD>
          <TD><input type="submit" value= "modifica" name="enviar">
          <input type="Button" value="confirma" onclick="ponPrefijo('<? echo "$doc";?>','<? echo "$row2[2]";?>','<? echo "$row2[1]";?>','<? echo "$row[0]";?>')"></TD>
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


