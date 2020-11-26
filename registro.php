<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	<title>Registro</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
<div class="contenedor">
	<div class="container-logo">
		<img id="img_login" src="assets/img/user.svg" width="100px">
        <h4 style="color:#ffffff;">Sing Up</h4>
        <div class="col-md-12">
            <form action="php/registrar_usuario.php" method="post" style="color:#fff; font-weight:bold;" id="form_registro">
                <div class="row" style="margin-bottom: 15px; margin-top:15px;">
                    <div class="col-md-4"><label for="nombre">Nombre:</label></div>
                    <div class="col-md-8"><input type="text" name="nombre" id="nombre" class="form-control" required autocomplete="off"></div>
                </div>
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-md-4"><label for="apellidos">Apellidos:</label></div>
                    <div class="col-md-8"><input type="text" name="apellidos" id="apellidos" class="form-control" required autocomplete="off"></div>
                </div>
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-md-4"><label for="rol">Perfil:</label></div>
                    <div class="col-md-8">
                        <select name="rol" id="rol" class="form-control" required>
                            <option selected disabled value="">Selección</option>
                            <option value="1">Profesor</option>
                            <option value="2">Estudiante</option>
                        </select>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-md-4"><label for="usuario">Usuario:</label></div>
                    <div class="col-md-8">
                        <input type="text" name="usuario" id="usuario" class="form-control" required autocomplete="off">
                    </div>
                </div>
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-md-4"><label for="password">Contraseña:</label></div>
                    <div class="col-md-8">
                        <input type="password" name="password" id="password" class="form-control" required autocomplete="off">
                    </div>
                </div>
            <input type="submit" name="btn-login" id="btn-login" value="Registrar" class="btn btn-primary">
            </form>
        </div>
	</div>
</div>
</body>
</html>