<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script type="text/javascript" >

$(document).ready(function()
{
	$("#nombre").keyup(function()
        {
		var texto_escrito = $(this).val();
		$("#un_div").html(texto_escrito);
	})
})
</script> 

</head>

<body>

<form>
    <input type="date" name="nombre" id="nombre" maxlength="30" />

</form>
<br />
<div id="un_div" style="background-color:#FFC; padding:12px">_</div>


</body>
</html>