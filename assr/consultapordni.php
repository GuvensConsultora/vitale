<?php
   $doc = $_POST['doc'];
   $usuario =$_POST["usuario"];
   $clave = $_POST["clave"];
   $host        = "host = 172.17.0.2";
   $port        = "port = 5432";
   $dbname      = "dbname = sistema";
   $credentials = "user = horacio password=123456";
   $conn = pg_connect("$host $port $dbname $credentials");
   $sql="select nombre,tipodoc,documento,sexo,cuil,fnacimiento from personas.fisica where documento='$doc'";
   $resultado=pg_query($conn,$sql);
   $docu=$row[2];
   echo $docu;
if($docuk=="")
    {
        ?>
            <HTML>

     <script>
     </script> 

     <script>
     function ponPrefijo(pref,codos,carnet,nombre)
     { 	window.opener.document.lista.doc.value = pref
		window.opener.document.lista.codos.value = codos
       	window.opener.document.lista.carnet.value = carnet
		window.opener.document.lista.nombre.value = nombre
	    window.close()
	    sssalud.close()
    }
    </script>
    <script>
    function sss(){
    sssalud = window.open("https://seguro.sssalud.gov.ar/index/indexss.php?opc=bus650","miwin","left= 250, width=800,height=600,top=10 scrollbars=yes")
        	sssalud.focus()
    }
    </script>
    <script>
    function anses()
    {
        sssalud = window.open("http://www.anses.gov.ar/autopista/Serv_publicos/ooss.htm","miwin","left= 250, width=800,height=600,top=10 scrollbars=yes")
	sssalud.focus()
    }
    </script>

    <script>
    function pami()
    {
        sssalud = window.open("http://www.pami.org.ar/medicos/padron.asp","miwin","left= 250, width=800,height=600,top=10 scrollbars=yes")
	sssalud.focus()
    }
    </script>

    <BODY bgcolor="#EDFFFF">
	         <FORM name="act" method="POST" action="actualizadatos.php">
		    <?php echo "<hd>";
		    $sql="select nombre,tipodoc,documento,sexo,cuil,fnacimiento, age('now',fnacimiento)as edad from personas.fisica where documento='$doc'";
		    $resultado=pg_query($conn,$sql);
		    echo "<table WIDTH=100% BORDER=1 BORDERCOLOR='#000001'>";
		    echo "<form name=actualiza action=xxx.php method=post>";
		    $row = pg_fetch_row($resultado); 
		    ?>
	     <th>Apellido y nombre </th><th>Nro doc </th> <th>Sex </th><th>Fecha Nac </th><th>Cuil Benf </th><th>Acción</th>
	     <tr><TD><input type="text" size="25" value= "<?php echo "$row[0]";?>" name="apellido"></TD>
	     <TD><input type="text" size="9" value= "<?php echo "$row[2]";?>" readonly=true name="doc"></TD>
	     <TD><input type="text" size="2" value= "<?php echo "$row[3]";?>" name="sex"></TD>
	     <TD><input type="text" size="9" value= "<?php echo "$row[5]";?>" name="nacimiento"></TD> 
	     <TD><input type="text" size="11" value= "<?php echo "$row[4]";?>" name="cuilb"></TD></tr>
	     <tr><td colspan='3'><input type="text" size='40' value="<?php echo "$row[6]";?>">
	     </td><TD colspan='3'><input type="submit" value= "enviar" name="enviar"> </TD></tr>
	    <?php

		echo "</form></table>";
		$conn = pg_connect("dbname=sistema user=apache password=12346"); 
		$sql1="select * from ubicacion.ubicada where tipodoc=$tdoc and documento='$doc'";
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


		$sql2="select cuilt,ncarnet,idos,obrasocial,idin,tb.id,documento, emision from
		(select * from sss.vinculo where documento='$doc')as tb
		    LEFT JOIN
		         sss.obras
		    ON
    			 tb.idos = obras.id";
		    $resultado2=pg_query($conn,$sql2);  
    		  echo "<table WIDTH=100% BORDER=1 BORDERCOLOR='#000001'>";
	          echo "<th>Cuil Tit </th>";
    		  echo "<th>Nro de carnet</th>";
    		  echo "<th>Código O.S. </th>";
    		  echo "<th>Nombre </th>";
    		  echo "<th>Acción</th>";


			while ($row2 = pg_fetch_row($resultado2)) 
    		        	{
    				    ?>
        			<tr>
			        <TD><input type="hidden" size="5" value="<?php echo "$doc";?>" name="doc"><input type="hidden" size="5" value="<?php echo "$row2[5]";?>" name="id"><input type="text" size="11" value= "<?php echo "$row2[0]";?>" name="cuilt"></TD>
	    		        <TD><input type="text" size="17" value= "<?php echo "$row2[1]";?>" name="carnet" span style ="font-size:15pt"></TD>
        			<TD><input type="text" size="6" value= "<?php echo "$row2[2]";?>" name="codos"></TD>
        			<TD><?php echo "$row2[3]";?></TD>
        			<TD><input type="submit" value= "modifica" accesskey="M" name="enviar">
        			<input type="Button" value="confirma" accesskey="C" onclick="ponPrefijo('<?php echo "$doc";?>','<?php echo "$row2[2]";?>','<?php echo "$row2[1]";?>','<?php echo "$row[0]";?>')"></TD>
				<?php
        			echo "</tr>";
    				}
    		echo "</table>";
		echo "</tr>";
    		echo "</table>";
		echo "</tr></table></FORM>";
    echo "</BODY>";
    echo "</HTML>";
    }
    ?>
	 
	
<ul> 
	<li> 
            <p align="center"><a href="apersona.php" title="Formulario Para dar de alta una nueva persona en el sistema">Alta Persona</a></p>
	</li> 
    </ul>

    <ul> 
	<li> 
	    <p ALIGN="CENTER"><a href="consultaape.php" >Busca por apellido y nombre</a></p>
	</li> 
    </ul> 