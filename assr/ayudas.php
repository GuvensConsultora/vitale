<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
</HEAD>
<BODY LANG="es-ES" BGCOLOR="#ffffcc" DIR="LTR">
<?php
   $sql="select * from (select * from areasanrafael.centros) as tb left join  ubicacion.distritos on tb.iddist = distritos.id";
   $host        = "host = 172.17.0.2";
   $port        = "port = 5432";
   $dbname      = "dbname = sistema";
   $credentials = "user = horacio password=123456";
   $conn = pg_connect("$host $port $dbname $credentials");
   $resultado=pg_query($conn,$sql);
   echo "<Table>";
   echo "<tr><td>";
   echo "<form name=selectcie method=post action=seleccioncie1.php name=cie10>";
   echo "<select name=cie>";
   while ($row = pg_fetch_row($resultado))
   {
   echo "<option title='$row[4]|$row[6]'> $row[0] | $row[1] </option>";
   };
   echo "</select>";
   
   $sql1="select * from nomencladores.arapres ";
   $conn = pg_connect("$host $port $dbname $credentials");
   $resultado1=pg_query($conn,$sql1);
   
   echo "<select  length=5 name=prestacion>";
   while ($row1 = pg_fetch_row($resultado1))
   {
   echo "<option title='$row1[4]'> $row1[1]|$row1[4]</option>";
   };
   echo "</select>";
   echo "</td>";
   echo "</form>";
   echo "</table>";
?>
</BODY> 
</HTML>
