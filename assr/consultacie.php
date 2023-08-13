<html>

	    <head>
		<meta http-equiv="Content-Language" content="es-mx">
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<meta name="GENERATOR" content="Microsoft FrontPage 4.0">
		<meta name="ProgId" content="FrontPage.Editor.Document">
	    <title>CONSULTA CIE 10</title>
	    </head>

	    <body bgcolor="#FFCCCC" onLoad="this.document.buscacie.filtro.focus()">

	    <p align="center">
		    <font color="#0000FF" size="3">
			<u>AREA SANITARIA SAN RAFAEL</u>
		    </font>
	    </p>
	    <p align="center">
		    <font color="#0000FF" size="2">
			<u>TRAE CODIGO DE PRESTACION</u>
		    </font>
	    </p>
	    		<form name="buscacie" method="POST" action="consultacie.php">
	    			<p align="center">
			    	<u><i><font size="5">Ingresar datos</font></i></u>	
					    <font size="6">
						<input type=text name=filtro 
						onChange=	'javascript:this.value=
								this.value.toUpperCase();'>
					    </font>
		    		    <input type="submit" value="Enviar" name="B1">
				    <input type="reset" value="Restablecer" name="B2">
        			</p>
			</form>
<?
	
	if ($filtro=="")
		{
			echo "<p align='center'> INGRESA UN DATO VALIDO </p>";
		}
	else
		{
			echo "<p align='center'><table border='2' width='90%' bordercolor='red'>";
			$conn = pg_connect("dbname=sistema user=apache password=1234");
			$sql  = "select * from nomencladores.cie10completo where descripcion like '%$filtro%' ORDER BY cod3";
			$consulta = pg_query($conn, $sql);
			echo "<tr><th>Cod</th><th>Sub C.</th><th>Descripcion</th></tr>";
			while ($cie = pg_fetch_row( $consulta ))
				{
					echo "<tr>";
					echo "<td>$cie[1]</td>";
					echo "<td>$cie[2]</td>";
					echo "<td>$cie[5]</td>";
					echo "</tr>";
				};
			echo "</table></p>";
		};
?>

		</body>
	</html>
