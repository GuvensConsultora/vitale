<?php
$linea = 344857;
echo $linea;
$doc = 21949513;
$host        = "host = 172.17.0.2";
$port        = "port = 5432";
$dbname      = "dbname = sistema";
$credentials = "user = horacio password=123456";
$conn = pg_connect("$host $port $dbname $credentials");
echo $doc;
$sql1="update areasanrafael.anexo set doc ='$doc' where idmov='$linea'";
$resultado1=pg_query($conn,$sql1);

?>