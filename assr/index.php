<html>
<title> Area Sanitaria San Rafael</title>
<head>

<style type="text/css">

    body
	{
	    font-family: Georgia, "Times New Roman", serif;
	    color:yellow;
	    background-color:blue;
	}
</style>

</head>
<body>
<div align=center><h1> Area Sanitaria San Rafael Mza.</h1></div>
<div align=center><h2> Recursos Propios </h2></div>
<hr>
<br><br>

<form name=autoriza method=post action=acceso.php>

<div align=center>

<table>
    <tr>
	<th>Usuario</th>
	<td><input type="text" name="usuario" onChange='javascript:this.value=this.value.toUpperCase();'></td>
    </tr>
    <tr>
	<th>Contraseña</th>
	<td><input type="password" name="clave"></td>
    </tr>
    <tr>
	<td><input type=submit name=enviar value="Ok"></td>
	<td><input type=reset name=limpiar value=limpiar></td>
    </tr>
</table>

</div>

</form>

<HR>

<p align=center><img src="../assr/imagenes/Medical-10.gif"></p>

</body>
</html>