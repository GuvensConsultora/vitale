<HTML>
<HEAD>
<STYLE type="text/css">
   TABLE {border: 1px solid black; border-spacing: 0pt;}
   TD {border: 1px solid black; border-spacing: 0pt;}
</STYLE>
</HEAD>
<BODY>
  <?php

     $id = $_POST['id'];
     $cod = $_POST['cod'];
     $codcar = $_POST['codcar'];
     $desc = $_POST['desc'];
     $imp = $_POST['imp'];
     $impmay22 = $_POST['impmay22'];
     $impoct22 = $_POST['impoct22'];
     $operacion = $_POST['tipo'];
           
        $host        = "host = 172.17.0.2";
        $port        = "port = 5432";
        $dbname      = "dbname = sistema";
        $credentials = "user = horacio password=123456";
        $conn = pg_connect("$host $port $dbname $credentials");

     if ($operacion == "modifica"):
             $sql_mod = "update nomencladores.arapres set detalle ='$cod',  descripcion = '$desc', codigo = '$codcar' ,importe = '$imp',mayo22 = '$impmay22', oct22 = '$impoct22' where id='$id'";
             $modifica=pg_query($conn,$sql_mod);
     endif;

echo "<table border='1' width='100%' bordercolorlight='#000000' bordercolordark='#000000' bordercolor='#000000'>";
echo "<tr>";
echo "<TR><th colspan=5><h3>PRESTACIONES H.P.G.D.</h3></th>";
echo "<th colspan=2><h5>HPGD: 13320895 </H5></TH></TR>";
echo "<TR><th colspan=7> <h4>AREA SANITARIA SAN RAFAEL</h4></th>";
echo "</tr>";
echo "<tr>";
echo "<th colspan=8>$row[2]</th>";
echo "</tr>";
echo "<tr>";
  echo "<th>Id </th><th>";
  echo "Codigo </th><th>";
  echo "Cod. Carga </th><th>";   
  echo "Descripcion </th><th>";
  echo "Monto al 30/04  </th><th>";
  echo "Monto al 30/09  </th><th>";
  echo "Monto post 30/09 </th></tr>";
$contador = 0;
$sql="SELECT id, detalle, descripcion, importe, mayo22,oct22,codigo FROM nomencladores.arapres
      ORDER BY detalle ASC";
		
$resultado=pg_query($conn,$sql);
while ($row = pg_fetch_row($resultado)) 
{
  $contador = $contador +1 ;
  echo "<FORM name='modiflinea' action='modificalineapresta.php' method='POST'>";
  echo "<tr>";
  echo "<td  align=center>
           <input type=hidden value=$row[0] name=id><input type=submit name='$contador' value=$contador></td><td>";
  //echo "$row[0] </td><td>";
  echo "$row[1] </td><td><p align=center>";
  echo "$row[6] </td><td><p align=center>";      
  echo "$row[2] </td><td><p align=center>";
  echo "$row[3] </td><td><p align=center>";
  echo "$row[4] </td><td><p align=center>";
  echo "$row[5]</p></td>";
  echo "</tr>";
  echo "</FORM>";
}
?>
</BODY>
</HTML>
