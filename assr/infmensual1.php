<HTML>
<HEAD>
<STYLE type="text/css">
   TABLE {border: 1px solid black; border-spacing: 0pt;}
   TD {border: 1px solid black; border-spacing: 0pt;}
</STYLE>
</HEAD>
<BODY>
<div align=center><h2>Area Sanitaria San Rafael</h2></div>
<?php
       $pmes = $_POST['pmes'];
       $pano = $_POST['pano'];
        $host        = "host = 172.17.0.2";
        $port        = "port = 5432";
        $dbname      = "dbname = sistema";
        $credentials = "user = horacio password=123456";
        $conn = pg_connect("$host $port $dbname $credentials");
       
?>

<div align=center><h3>Periodo listado: <?php echo "$pmes / $pano"?></h3></div>
<?php

$sql1="SELECT tb.idcentro,
              centros.nombre,
              tb.total,
              tb.cantidad
              FROM (
              SELECT idcentro, 
                     to_char( sum(importe), '$999999D99')as total, 
                     count(importe) as cantidad  
              FROM areasanrafael.anexo 
              WHERE periododmes = '$pmes' 
                   AND periodoano ='$pano' 
                   AND idos <> '9999' 
                   AND idos <> '99999' 
                   AND idos <> '999998' 
              GROUP BY idcentro
              ORDER BY idcentro
                  ) AS tb
       INNER JOIN
           areasanrafael.centros
       ON    
            tb.idcentro = centros.nro";

$resultado1=pg_query($conn,$sql1);
 echo "<table width=100%><th width=10%>Codigo</th><th width=70%>Detalle</th><th width=15%>Importe</th><th width=5%>Cant</th>";
while ($row1 = pg_fetch_row($resultado1)) 
{
  echo "<table width=100%>";
  echo "<tr>";
  echo "<td width=10%>$row1[0] </td>";
  echo "<td width=70%>$row1[1] </td>";
  echo "<td width=15% align=right>$row1[2]</td>";
  echo "<td width=5% align=right>$row1[3]</td></tr>";
  echo "<tr><td colspan=4>";
   $sql2="SELECT 
               tb.idos,
               obras.obrasocial,
               tb.total,
               tb.cantidad
               FROM (
               SELECT 
                      idos,
                      to_char( sum(importe), '$999999D99')as total, 
                      count(importe) as cantidad  
               FROM areasanrafael.anexo 
               WHERE periododmes = '$pmes' 
                    AND periodoano ='$pano' 
                    AND idos <> '9999' 
                    AND idos <> '99999' 
                    AND idos <> '999998' 
                    AND idcentro = '$row1[0]'
               GROUP BY idos
               ORDER BY idos
                  ) AS tb
             INNER JOIN
                  sss.obras
             ON    
                  tb.idos = obras.id";

            $resultado2=pg_query($conn,$sql2);
               echo "<table width=100% border=0 borderspacing=0>";
               while ($row2 = pg_fetch_row($resultado2)) 
                {
                 echo "<tr>";
                 echo "<td width=10%>$row2[0] </td>";
                 echo "<td width=70%>$row2[1] </td>";
                 echo "<td width=15% align=right>$row2[2]</td>";
                 echo "<td width=5% align=right>$row2[3]</td></tr>";
                };
         echo "</table>";
      echo "</td></tr>";
echo "</table><br>";
}
$sql3="SELECT to_char( sum(importe), '$9999999D99')as total, 
               count(importe) as cantidad  
              FROM areasanrafael.anexo 
              WHERE periododmes = '$pmes' 
                   AND periodoano ='$pano' 
                   AND idos <> '9999' 
                   AND idos <> '99999' 
                   AND idos <> '999998' 
                  ";
       

$resultado3=pg_query($conn,$sql3);

$row3 = pg_fetch_row($resultado3);
echo "<table width=100%>";
echo "<tr><td width=80%>Total Facturado</td><td width= 15% align=right>$row3[0]</td><td width=5% align=right>$row3[1]</td></tr>";
echo "</table>";
?>
</BODY>
</HTML>