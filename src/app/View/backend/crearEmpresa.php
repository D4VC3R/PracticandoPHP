<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Examen DWES</title>
</head>
<body>
<h1>Formulario para crear empresas</h1>
<form action="/empresa" method="post">
	<label for="nombre">Nombre: </label>
	<input type="text" name="nombre" id="nombre">
	<label for="rentabilidad">Rentabilidad: </label>
	<input type="number" name="rentabilidad" id="rentabilidad">
	<button type="submit">Enviar</button>
</form>
</body>
</html>