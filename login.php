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
	<h2>Evaluación Online</h2><br>
	<div class="container-logo">
		<img id="img_login" src="assets/img/user.svg" width="100px">
		<h4>Sing In</h4>
		<div class="col-md-12">
			<form action="" id="formlogin" method="post">
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
			<h6>¿No tienes una cuenta? <a href="registro.php">Regístrate</a></h6>
		</div>
	</div>
</div>
<script src="assets/js/jquery.min.js"></script>

<script type="text/javascript">
jQuery(document).on('submit', '#formlogin', function(event){
	event.preventDefault();

	jQuery.ajax({
		url: 'php/validar_usuario.php',
		type: 'POST',
		dataType: 'json',
		data: $(this).serialize(),
		beforeSend: function(){
		}
	})
	.done(function(respuesta){
		console.log(respuesta);
		if(!respuesta.error){
			if(respuesta.rol == '1'){
				location.href = 'index.php';
			}else if(respuesta.rol == '2'){
				location.href = '';
			}
		}else{

		}
	})
	.fail(function(resp){
		console.log(resp.responseText);
	})
	.always(function(){
		console.log("complete");
	});
});
</script>
</body>
</html>