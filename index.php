<!DOCTYPE html>
<html lang="es">
    <head>
		<meta charset="UTF-8" />
		<meta type="author" content="Manuel Solís Gómez (masogo008@gmail.com)" />
		<meta type="description" content="Inicio de sesion de un listado de minijuegos" />
		<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1, maximum-scale=1, minimum-scale=1" />
        <meta name="keywords" content="Minijuegos, Fundacion Loyola, Alumnos" />
		<title> Inicio sesion </title>
		<link rel="stylesheet" type="text/css" href="css/estiloGeneral.css" />
		<link rel="stylesheet" type="text/css" href="css/estiloInicio.css" />
	</head>
    <body>
        <?php
            require ('php/controlador.php');
            $controlador = new Controlador();
        ?>
        <main>
            <?php
                $controlador->sesion();
            ?>
        </main>
    </body>
</html>