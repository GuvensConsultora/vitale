<html>	
<title>Generar lista de facturación realizadas</title>
<BODY onLoad="this.document.cargar.codos.focus()">

<FORM NAME="cargar" ACTION="cargadatos.php" METHOD="POST">

<table align="center">
<DIV ALIGN= CENTER><H2>Area Sanitaria San Rafael<H2></DIV>
<DIV ALIGN= CENTER><H4>Datos para generar listados para facturación<H4></DIV>
<DIV ALIGN= CENTER><H4>Listado Nuevo<H4></DIV>
<hr>
<tr><tH>Ingresar el Número de obra social</tH><td><input type=text name=codos title='Ingresar el código de la Obra Social'></td></tr>
<tr>
    <tr>
	<th>Centro de salud desde</th>
	<td><input type=text name=csdesde title='Ingresar el centro de salud desde el cual comienza el listado'></td>
    </tr>
    <tr>
	<th>Centro de salud hasta</th>
	<td><input type=text name=cshasta title='Ingresar el centro de salud hasta el cual termina el listado'></td>
    </tr>
    
    <tH>Periodo  a imprimir</tH>
    <td><select name=pmes title='Ingresar el periodod bajo análisis'>
<option value="1">Enero</option>
<option value="2">Febrero</option>
<option value="3">Marzo</option>
<option value="4">Abril</option>
<option value="5">Mayo</option>
<option value="6">Junio</option>
<option value="7">Julio</option>
<option value="8">Agosto</option>
<option value="9">Setiembre</option>
<option value="10">Octubre</option>
<option value="11">Noviembre</option>
<option value="12">Diciembre</option>
</select>
<input type=text name=pano title='Ingresar el periodod bajo análisis' value='2007' size=4></td></tr>
<tr><th>Desde</th><td><input type=text name=fdesde ></td><tr>
<tr><th>Hasta</th><td><input type=text name=fhasta ></td><tr>
<tr><td><input type=submit name=enviar value=confirmar></td>/<tr>
</table>
</FORM>
<hr>
</body>
</html>