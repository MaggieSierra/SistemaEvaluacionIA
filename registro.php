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
        <div id="response"></div>
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
<script src="assets/js/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#form_registro").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr("action"),
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if(data != ""){
                        $("#response").html("<span style='color:red; font-weight:bold;'>"+data+"<span>");
                    }else{
                        $("#response").html("<span style='color:green; font-weight:bold;'>Registro exitoso<span>");
                    }
                }
            });
        }));
    });
</script>
</body>
</html>