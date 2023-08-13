<html>
<title>Generar lista de facturación realizadas</title>
<BODY onLoad="this.document.cargar.codos.focus()">
<DIV ALIGN= CENTER><H2>Area Sanitaria San Rafael<H2></DIV>
<hr>
<FORM NAME="cargar" ACTION="listaanexo1.php" METHOD="POST">
<table align="center">
<tr><tH>Ingresar el Número de obra social</tH><td><input type=text name=codos title='Ingresar el c�digo de la Obra Social'></td></tr>
<tr>
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
<input type=text name=pano title='Ingresar el periodod bajo análisis' value='2006' size=4></td></tr>
<tr><th>Desde</th><td><input type=text name=fdesde ></td><tr>
<tr><th>Hasta</th><td><input type=text name=fhasta ></td><tr>
<tr><td><input type=submit name=enviar value=confirmar></td>/<tr>
</table>
</FORM>
<hr>
</body>
</html>