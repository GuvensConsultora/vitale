<?php
   $usuario =$_POST["usuario"];
   $clave = $_POST["clave"];
   $host        = "host = 172.17.0.2";
   $port        = "port = 5432";
   $dbname      = "dbname = sistema";
   $credentials = "user = horacio password=123456";

if ($usuario =="")
{
   echo "<HTML>";
   echo "<HEAD>";
   echo "<TITLE>AREA SANITARIA SAN RAFAEL SISTEMA DE AUDITORIA EN CAPTACIÓN DE AFILIADOS</TITLE>";
   echo "</HEAD>";
   echo "<body>";
   echo "<br>";
   echo "<div align=center><h1>Ingresar los datos correspondientes</h1></div>";
   echo "</body>";
   echo "</HTML>";
}
else
{

       $sql="select * from usuarios.usuarios where nic ='$usuario' and password ='$clave'";
       $conn = pg_connect("$host $port $dbname $credentials");
       $resultado=pg_query($conn,$sql);
       $row = pg_fetch_row($resultado);
       if ($row[0] =="") 
             {
                  echo "<HTML>";
                  echo "<HEAD>";
                  echo "<TITLE>AREA SANITARIA SAN RAFAEL SISTEMA DE AUDITORIA EN CAPTACIÓN DE  AFILIADOS</TITLE>";
                  echo "</HEAD>";
                  echo "<body>";
		  echo "<br>";
                  echo "<div align=center><h1>Usuario y/o clave inexistente</h1></div>";
                  echo "</body>";
                  echo "</HTML>";
            }
            else
            {
              echo "<HTML>";
              echo "<HEAD>";
              echo "<TITLE>AREA SANITARIA SAN RAFAEL SISTEMA DE AUDITORIA EN  CAPTACIÓN DE AFILIADOS</TITLE>";
              echo "</HEAD>";
              echo "<FRAMESET  rows='*,5%' cols='15%,*'>";
              echo "       <FRAME src='menu0.php'>";
              echo "       <FRAME src='centro.php' name='cuerpo'>";
              echo "       <FRAME src='' name='ayuda'>";
              echo "       <FRAME src='ayudas.php' name='ayuda'>";
              echo "</FRAMESET>";
              echo "</HTML>";
             }
};
?>
