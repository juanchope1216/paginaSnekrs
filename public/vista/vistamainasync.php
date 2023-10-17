<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8" />
	<title>Main Async</title>
	<link rel="stylesheet" href="public/css/common.css">
	
	<script src="public/js/constants.js"></script>
	<script src="public/js/grabardivision.js"></script>
	<script>
		function validacionFormMateriales() {
			console.log(form_Materialess.Materiales.value);

			
			return true;
		}
	</script>
</head>

<body>
	<h1>Admin de divisiones.</h1>

	<form name='form_Materiales' onsubmit="return validacionFormMateriales();">
		
		<input id="Materiales" name="Materiales" type="text" placeholder="nombre de la Materiales" maxlength="20" />
		
		<select name="conferencia">
			<option value="0">Elige una conferencia</option>
			<option value="1">Este</option>
			<option value="2">Oeste</option>
		</select>
		<input type="button" value="Grabar" />
	</form>
	<div class='message hiddenD'>División dada de alta correctamente.</div>

</body>

</html>