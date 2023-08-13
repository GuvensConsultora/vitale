<html>
<BODY onLoad="this.document.cargar.codos.focus()">
<div align=center><h2>Area Sanitaria San Rafael<h2></div>
<div align=center><h3>Alta de anexos en listados<h3></div>
<hr>
<FORM NAME="cargar" ACTION="generalista21.php" METHOD="POST">
<table align="center">
<tr><td>Ingresar el Número de obra social</td><td><input type=text name=codos title='Ingresar el código de la Obra Social'></td></tr>
<tr>
<td>Ingresar el Número de centro de salud</td><td><input type=text name=cs title='Ingresar en número del centro de salud'></td></tr>
<tr><td>Ingresar el Periodo mensual bajo análisis</td>
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
</td><tr></tr><td>Ingresar el Periodo anual análisis</td><td><input type=text name=pano title='Ingresar el periodod bajo análisis' value='2007'></td></tr>
<tr><td><input type=submit name=enviar value=confirmar></td>/<tr>
</table>
</FORM>
<hr>
</body>
</html>