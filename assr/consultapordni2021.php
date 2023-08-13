<?php

//$doc = $_POST['doc'];
   $doc = 21949513;
//$usuario =$_POST["usuario"];
//$clave = $_POST["clave"];
   $usuario = "CECILIA";
   $clave = "grabriel96";
   $host        = "host = 172.17.0.2";
   $port        = "port = 5432";
   $dbname      = "dbname = sistema";
   $credentials = "user = horacio password=123456";
   $conn = pg_connect("$host $port $dbname $credentials");
   $sql="select nombre,tipodoc,documento,sexo,cuil,fnacimiento from personas.fisica where documento='$doc'";
   $resultado=pg_query($conn,$sql);
   $docu=$row[2];
   $docu;
?>