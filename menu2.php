<div class="col-md-12" align="center" style="color:#368ca7; margin-top:15px;"><h2>Evaluaciones Online</h2></div>
<ul class='nav nav-tabs'>
    <li class='nav-item'><a class='nav-link' href='index.php'>Inicio</a></li>
    <?php if($_SESSION['rol'] == 1){ ?>
        <li class="nav-item"><a class="nav-link" href="materias.php">Materias</a></li>
        <li class="nav-item"><a class="nav-link" href="evaluaciones.php">Evaluaciones</a></li>
        <li class="nav-item"><a class="nav-link" href="calificaciones.php">Calificaciones</a></li>
    <?php } else { ?>
        <li class="nav-item"><a class="nav-link" href="materias.php">Materias</a></li>
    <?php } ?>
    <li class="nav-item"><a class="nav-link" href="../logout.php">Cerrar Sesion</a></li>
</ul>