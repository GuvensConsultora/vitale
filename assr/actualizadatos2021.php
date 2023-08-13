<?php echo "<hd>";

   $doc=$_POST['doc'];
   $codos=$_POST['codos'];
   $sex=$_POST['sex'];
   $apellido=$_POST['apellido'];
   $nacimiento=$_POST['nacimiento'];
   $cuilb=$_POST['cuilb'];
   $codosreg=$_POST['codosreg'];
   $cs = $_POST['cs'];
   $pmes=$_POST['pmes'];
   $pano=$_POST['pano'];
   $usuario =$_POST["usuario"];
   $clave = $_POST["clave"];
   $host        = "host = 172.17.0.2";
   $port        = "port = 5432";
   $dbname      = "dbname = sistema";
   $credentials = "user = horacio password=123456";
   $conn = pg_connect("$host $port $dbname $credentials");
   $operacion=$_POST['operacion'];
   $borrar_persona=$_POST['borrar_persona'];
   $borrar_obra_social=$_POST['borrar_obra_social'];
   $vincular_obra_social=$_POST['vincular_obra_social'];
   $id_persona=$_POST['id_persona'];
   $id_vinculo_os=$_POST['id_vinculo_os'];


///////////////////////// BORRAR UNA PERSONA CON SU OBRAS SOCIAL EN LA BASE ///////

if ($borrar_persona == "Borrar Persona"):
    $sql_borrar_obra_social ="delete from sss.vinculo where documento = '$doc'";
    $borrar_linea=pg_query($conn,$sql_borrar_obra_social);
    $sql_borrar_persona ="delete from personas.fisica where id='$id_persona'";
    $borrar_linea=pg_query($conn,$sql_borrar_persona);
endif;

//////////////////////////VINCULO OBRA SOCIAL EN PROCESO ////////////////////
if ($vincular_obra_social == "Vincular O.S. en proceso"):
///    echo "documento: ".$doc. "<br>";
///    echo "idcodos: ".$codos. "<br>";
///    $sql="Select * from sss.obras where id = $codos";
///    $resultado=pg_query($conn,$sql);
///    while ($row = pg_fetch_row($resultado))
///        {
///            echo "Para N.O.S. ".$row[1]." El id es".$row[0]." El nombre es: ".$row[2];
///        }
    $sql1="insert into sss.vinculo(documento,idos)values('$doc','$codos')";
    $resultado1=pg_query($conn,$sql1);
endif;
//////////////// BORRA OBRA SOCIAL EXCEDENTE /////////////////////////////////
if ($borrar_obra_social != ""):
///    echo "borro obra social id: ".$borrar_obra_social. "<br>";
    $sql_borrar_obra_social ="delete from sss.vinculo where id='$borrar_obra_social'";
    $borrar_linea=pg_query($conn,$sql_borrar_obra_social);
endif;
/////////////////// DAR DE ALTA UNA NUEVA PERSONA ////////////////////////////
if ($operacion == "alta"):
///    echo $apellido."<br>";

    $sql="insert into personas.fisica(nombre,documento,sexo,cuil,fnacimiento)values('$apellido','$doc','$sex','$cuilb','$nacimiento')";
    $resultado=pg_query($conn,$sql);
endif;


?>
<HTML>
<BODY bgcolor="#EDFFFF">
 <div align="center"><h1>AREA SANITARIA SAN RAFAEL</h1></div>
<FORM name='act' method='POST' action='generalista21.php'>
<?php echo "<hd>";

$sql="select nombre,tipodoc,documento,sexo,cuil,fnacimiento,id from personas.fisica where documento='$doc'";
$resultado=pg_query($conn,$sql);
$nro_filas = pg_num_rows($resultado);


////////////////// FORMULARIO DE ALTA DE PERSONAS ////////////////////////////

if ($nro_filas == "0"):
    ?>

    <TABLE align="center">
  <tr>  <th>Apellido y nombre </th>
        <th>Nro doc </th>
        <th>Sex </th>
        <th>Fecha Nac </th>
        <th>Cuil Benf </th>
       
  <tr>
    <TD><input type="text" size="25" name="apellido" required onChange='javascript:this.value=this.value.toUpperCase();'></TD>
    <TD><input type="text" size="9"  value="<?php echo $doc ?>" name="doc" required></TD>
    <TD><input type="text" size="2"  name="sex" required onChange='javascript:this.value=this.value.toUpperCase();'></TD>
    <TD><input type="date" size="9"  name="nacimiento" required></TD>
    <TD><input type="text" size="11" name="cuilb" required></TD>
    <TD><input type="hidden" value= "alta" name="operacion">
    <input type="hidden" name="codos" value="<?php echo $codos ?>">
    <input type="hidden" name="pmes" value="<?php echo $pmes ?>">
    <input type="hidden" name="pano" value="<?php echo $pano ?>">
    <input type="hidden" name="cs" value="<?php echo $cs ?>">
    <input type="submit" value= "Alta persona" name="Alta" onclick="this.form.action='actualizadatos2021.php'"> </TD>
  </TABLE>

<?php
    exit;
endif;

echo "<div align='center'><h2>Datos Personales</h2></div>";
echo "<table WIDTH=100% BORDER=1 BORDERCOLOR='#000001'>";

while ($row = pg_fetch_row($resultado)) 
    {
       ?>
  <tr> <th>Apellido y nombre </th>
        <th>Nro doc </th>
        <th>Sex </th>
        <th>Fecha Nac </th>
        <th>Cuil Benf </th>
        <th>Acción</th></tr>
  <tr><TD><input type="text" size="25" value= "<?php echo "$row[0]";?>" name="apellido"></TD>
        <TD><input type="text" size="9" value="<?php echo "$row[2]";?>" readonly=true name="doc"></TD>
             <TD><input type="text" size="2" value= "<?php echo "$row[3]";?>" name="sex"></TD>
             <TD><input type="text" size="9" value= "<?php echo "$row[5]";?>" name="nacimiento"></TD>
             <TD><input type="text" size="11" value= "<?php echo "$row[4]";?>" name="cuilb"></TD>
             <TD><input type="hidden" value= "Borrar-persona" name="operacion">
             <input type="hidden" size="5" value= "<?php echo "$row[6]";?>" name="id_persona">
        <input type="submit" value= "Borrar Persona" name="borrar_persona" onclick="this.form.action='actualizadatos2021.php'"> </TD>

<?php }
echo "</table>";
echo "<div align='center'><h2>Domicilio</h2></div>";
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

echo "<div align='center'><h2>Datos sistema de seguridad social</h2></div>";
?>
<div align="center"><input type="submit" value="Vincular O.S. en proceso" name="vincular_obra_social" onclick="this.form.action='actualizadatos2021.php'"></div><br>
<?php

/////////////////////// BLOQUE DE OBRAS SOCIALES /////////////////////////
$sql2="select cuilt,ncarnet,idos,obrasocial,idin,tb.id, tb.documento  from
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
          echo "<th>Borrar </th>";
          echo "<th>Modificar</th>";
        
while ($row2 = pg_fetch_row($resultado2)) 
       {?>

        <tr>
            <TD><input type="hidden" size="5" value="<?php echo "$row2[6]";?>" name="doc">
                 <input type="text" size="11" value= "<?php echo "$row2[0]";?>" name="cuilt">
                 <input type="hidden" value="<?php echo "$row2[5]";?>" name="id_vinculo_os"></td>
           <TD><input type="text" size="11" value= "<?php echo "$row2[1]";?>" name="carnet"></TD>
           <TD><input type="text" size="11" value= "<?php echo "$row2[2]";?>" name="codosreg"></TD>
           <TD><?php echo "$row2[3]";?></TD>
           <TD><input type=hidden value=borra_os name=operacion>
           <input type="submit" value= "<?php echo "$row2[5]";?>" name="borrar_obra_social" onclick="this.form.action='actualizadatos2021.php'">
    <?php
           echo "</tr>";
   
	    echo "</tr>";
       }
      echo "</table>";

echo "<br><div align='center'><h2>Prestación</div>";
	echo "<table border=1 align=center>";
/// ------------------------------------------------------------------------------------------
/// ---------- Comienzo el formulario de carga de prestación --------------------------------------
///-------------------------------------------------------------------------------------------

echo "<th>Obra Social</th>";
echo "<td><input type=text value=$codos name=codos></td>";
echo "<th>Año</th>";
echo "<td><input size=4 name=pano type=text value='$pano' readonly=true></td>";
echo "<th>Periodo</th>";
echo "<td><input size=2 name=pmes type=text value='$pmes' readonly=true></td>";
echo "<th>C.de S.</th>";
echo "<td><input size=3 name=cs type=text title=Doble click sobre este campo para obtener ayuda del centro de salud value='$cs'onclick=abreobs('sanrafael.ath.cx/centros.php') readonly=true></td></tr><tr>";
echo "<th>Prestacion</th>";
echo "<td><input size=8 name=prest accesskey='P' type=text value='$prest'> - (Alt+p)</td>";
echo "<th>Fecha</th>";
echo "<td><input name=fecha type=date value='$fecha' ></td>";
//------Pruebo la generaciòn de select en un if para seleccionar una variableya
//********* Gargada *///
$sql="SELECT * FROM nomencladores.cie10assr ORDER BY descripcion1";
$resultado=pg_query($conn,$sql);
  //echo "$cie";  // Esta variable viene del formulario anterior
$sql="SELECT * FROM nomencladores.cie10assr ORDER BY descripcion1";
$resultado=pg_query($conn,$sql);
echo "<tr><th>Diagnostico</th><td colspan=7><select accesskey='G'  name=cie>";
while ($row = pg_fetch_row($resultado)) 
   {
   if (trim($row[0]) == trim($cie))
	{
	  echo "<option value=$row[0] title=$row[0] selected > $row[2] | $row[0]</option>";
	}
	else
	{
	  echo "<option value=$row[0] title=$row[0]> $row[2] | $row[0]</option>";
	}
   } 
	 ;
echo "</select></td></tr>";
?>
<?php

echo "<td colspan=7 align=center>
         <input type=hidden value=actualiza_todo name=operacion>
         <input name=confirma type=submit value='Confirmar carga de prestación y actualización de datos'></td></tr>";
echo "</form></table>";
///-----------------------------------------------------------------------------------------------------
/// -----------------------------TERMINA EL FORMULARIO DE CARGAD DE DATOS -------------------------------


?>

</BODY>
</HTML>
