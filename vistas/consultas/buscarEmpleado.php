<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
	function buscar_ajax(cadena){
		$.ajax({
		type: 'POST',
		url: 'buscar.php',
		data: 'cadena=' + cadena,
		success: function(respuesta) {
			//Copiamos el resultado en #mostrar
			$('#mostrar').html(respuesta);
	   }
	});
	}
</script>
    </head>
    <body>
       <form>
	<input type="text" name="bucar" onkeyup="buscar_ajax(this.value);">
        </form>
         <div id="mostrar"></div>
    </body>
</html>
