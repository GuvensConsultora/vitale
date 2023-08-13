<HTML>

<BODY bgcolor="#EDFFFF">
       <script>
           fetch('/assr/consultapordni2021.php')
           .then(response => {
               if (response.ok)
                   return response.text()
               else
                   throw new Error(response.status);
               })
          .then(data => {
               console.log("Datos: " + data);
              })
          .catch(err => {
               console.error("ERROR: ", err.message)
              });
       </script>

</BODY>
</HTML>


