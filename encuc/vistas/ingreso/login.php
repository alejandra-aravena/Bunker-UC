<?php
session_start();
if(!empty($_SESSION['username'])) {
	if ($_SESSION['admin']) {
		header('Location: ../home.php');
	} else {
		header('Location: ../estacion/estacion/verEstacion.php');
	}
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <link rel="icon" href="../../favicon.ico">
    
    <title>Ingreso al sistema</title>

    <!-- Bootstrap -->
    <link href="../../librerias/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <link href="../css/login.css" rel="stylesheet" />
    
  </head>
  
  <body>
    <div class="container">
    
      <form class="form-signin" method="post" id="formulario">
        <h2 class="form-signin-heading">Ingreso</h2>
        <label for="username" class="sr-only">Usuario</label>
        <input type="input" name="username" id="username" class="form-control" placeholder="Usuario" required autofocus>
        <label for="password" class="sr-only">Contraseña</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me" name="remember"> Recordarme
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Acceder</button>
        <br />
        <div class="alert alert-danger" role="alert" id="error">Usuario o contraseña incorrecto</div>
      </form>
    </div> <!-- /container -->
    
    <!-- jQuery -->
    <script src="../../librerias/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../../librerias/bootstrap/js/bootstrap.min.js"></script>
    
    <script src="../js/login.js"></script>
  </body>
</html>