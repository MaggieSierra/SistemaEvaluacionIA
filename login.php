<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	<title>Login</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
<div class="contenedor">
	<div class="container-logo">
		<img id="img_login" src="assets/img/user.svg" width="100px">
		<h4 style="color:#ffffff;">Sing In</h4>
		<div class="col-md-12">
			<form action="loginprocess.jsp" method="post">
				<div style="max-width: 300px;position: relative; margin-bottom: 25px;">
					<input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuario" required autocomplete="off" style="padding-left:30px;">
					<img src="assets/img/usuario.svg" style="position: absolute;top: 8px;left: 3px;width: 27px;">
				</div>
				<div style="max-width: 300px;position: relative;margin-bottom: 25px;">
					<input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required autocomplete="off" style="padding-left:30px;">
					<img src="assets/img/bloquear.svg" style="position: absolute;top: 6px;left: 3px;width: 27px;">
				</div>
			<input type="submit" name="btn-login" id="btn-login" value="Login" class="btn btn-primary">
			</form>
		</div>
		
	</div>
</div>
</body>
</html>