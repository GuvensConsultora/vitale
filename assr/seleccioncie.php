<?
$sql="SELECT * FROM nomencladores.cie10assr";
$conn = pg_connect("dbname=sistema user=apache password=12346");
$resultado=pg_query($conn,$sql);
echo "<form name=selectcie method=post action=seleccioncie1.php name=cie10>";
echo "<select name=cie>";
while ($row = pg_fetch_row($resultado)) 
{
  echo "<option value=$row[0]> $row[1] | $row[2] </option>";
};
echo "</select>";
echo "<input type=submit>";
echo "</form>";
?>