<HTML>
<HEAD>
<STYLE type="text/css">
   TABLE {border: 1px solid black; border-spacing: 0pt;}
   TD {border: 1px solid black; border-spacing: 0pt;}
</STYLE>
</HEAD>
<BODY>
<?
$conn = pg_connect("dbname=sistema user=apache password=12346"); 
$sql2="select tb.idcentro,
       centros.nombre,
       tb.idos,
       obras.obrasocial,
       tb.total,
       tb.cantidad 
       from (
      select idos, idcentro, sum(importe) as total, count(importe) as cantidad  from areasanrafael.anexo where periododmes = '6' and periodoaño ='2006' and idos <> '9999' and idos <> '99999' and idos <> '999998' and idcentro = '107'
group by idos, idcentro
order by idcentro) as tb
INNER JOIN
       sss.obras
ON
       tb.idos = obras.id
INNER JOIN
       areasanrafael.centros
ON    
       tb.idcentro = centros.nro
";
$resultado2=pg_query($conn,$sql2);
while ($row2 = pg_fetch_row($resultado2)) 
{
  echo "<FORM name='modiflinea' action='modifilinea.php' method='POST'>";
  echo "<tr>";
  echo "<td>$contador</td><td>";
  echo "$row2[1] </td><td>";
  echo "$row2[2] </td><td><p align=center>";
  echo "$row2[3]</p></td><td>";
  echo "$row2[4]</td><td>";
  echo "$row2[5]</td><td><p ALIGN=RIGHT>";
  echo "$row2[6]</p></td></tr>";
  echo "</FORM></table>";
?>
</BODY>
</HTML>