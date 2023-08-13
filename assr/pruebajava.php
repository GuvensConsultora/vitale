<?php
?>
<HTML>
<script>
var miPopup
function modificadatospersonales(docu){
	miPopup = window.open("formoddp.html","miwin","width=300,height=350,top=10 scrollbars=yes")
	miPopup.focus()
	miPopup.verifica.doc.value= doc
	
}
</script> 
<BODY bgcolor="#EDFFFF">
 <div align="center"><h2>AREA SANITARIA SAN RAFAEL</h2></div>
<?echo "<hd>";
echo "$documento";
$doc=$_POST['doc'];
$conn = pg_connect("dbname=sistema user=apache password=12346"); 
$sql="select * from personas.fisica where documento='$doc'";
$resultado=pg_query($conn,$sql);
echo "<table WIDTH=100% BORDER=1 BORDERCOLOR='#000001'><th>";
echo "<form name=actualiza action=xxx.php method=post>";
while ($row = pg_fetch_row($resultado)) 
{
  echo "Apellido y nombre </th><th>";
  echo "Nº doc </th><th>";
  echo "Sexo </th><th>";
  echo "Fecha Nac </th><th>";
  echo "Cuil Benf </th><tr><td>";
  echo "$row[0]</td><td>";
  echo "$row[1] <input type=Button value=$row[2] onclick=modificadatospersonales($row[2])>
</td><td>";
  echo "$row[3] </td><td>";
  echo "$row[5]</td><td>";
  echo "$row[4]</td><td>";
  echo "</td></tr></table>";
  $cuilt=$row[7];
}
echo "</form></table>";
$conn = pg_connect("dbname=sistema user=apache password=12346"); 
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
$conn = pg_connect("dbname=sistema user=apache password=12346"); 
$sql2="select * from sss.pertenecea where documento='$doc'";
$resultado2=pg_query($conn,$sql2);  
          echo "<table WIDTH=100% BORDER=1 BORDERCOLOR='#000001'>";
          echo "<th>Cuil Tit </th>";
          echo "<th>Nro de carnet </th>";
          echo "<th>Código O.S. </th>";
          echo "<th>Nombre </th>";
          echo "<th>Acción</th>";
while ($row2 = pg_fetch_row($resultado2)) 
       {
            echo "<tr>";
            echo "<td style='text-align : center;'>$row2[2]</td>";
            echo "<td style='text-align : center;'>$row2[3]</td>";
            echo "<td style='text-align : center;'>$row2[4]</td>";
            echo "<td style='text-align : center;'>$row2[5]</td>";
            echo "</tr>";
	    echo "<tr><td colspan=5>";
	    	$conn = pg_connect("dbname=sistema user=apache password=12346"); 
		$sql3="select * from (select * from sss.vinculo where cuilt='$row2[2]' and idos='$row2[4]') as tb left join personas.fisica on tb.documento = fisica.documento";
		$resultado3=pg_query($conn,$sql3);  
          	echo "<table WIDTH=100% BORDER=1 BORDERCOLOR='#000001'>";
          	echo "<th>Documento </th>";
          	echo "<th>Apellido Nombre </th>";
          	echo "<th>Sexo </th>";
          	echo "<th>Cuil </th>";
          	echo "<th>Acción</th>";
		while ($row3 = pg_fetch_row($resultado3)) 
       			{
            		echo "<tr>";
            		echo "<td style='text-align : center;'>$row3[1]</td>";
            		echo "<td style='text-align : center;'>$row3[8]</td>";
            		echo "<td style='text-align : center;'>$row3[11]</td>";
           		echo "<td style='text-align : center;'>$row3[12]</td>";
			echo "<td style='text-align : center;'>$row3[13]</td>";
            		echo "</tr>";
	    		}
      echo "</table>";
	    echo "</tr>";
       }
      echo "</table>";
?>
</BODY>
</HTML>