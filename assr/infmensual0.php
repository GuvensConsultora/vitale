<html>
<title>Generar lista de facturación realizadas</title>
<body>
<FORM NAME="cargar" ACTION="infmensual1.php" METHOD="POST">
<table align="center">
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
<tr><td><input type=submit name=enviar value=confirmar></td>/<tr>
</table>
</FORM>
</body>
</html>