<ul class='nav nav-tabs'>
    <li class='nav-item'><a class='nav-link' href='index.php'>Inicio</a></li>
    <?php if($_SESSION['rol'] == 1){ ?>
        <li class="nav-item"><a class="nav-link" href="vteacher/evaluaciones.php">Evaluaciones</a></li>
        <li class="nav-item"><a class="nav-link" href="vteacher/calificaciones.php">Calificaciones</a></li>
        <li class="nav-item"><a class="nav-link" href="vteacher/materias.php">Materias</a></li>
    <?php } else { ?>
        <li class="nav-item"><a class="nav-link" href="vstudent/materias.php">Materias</a></li>
    <?php } ?>
    <li class="nav-item"><a class="nav-link" href="logout.php">Cerrar Sesion</a></li>
</ul>