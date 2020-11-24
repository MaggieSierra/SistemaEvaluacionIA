<ul class='nav nav-tabs'>
    <li class='nav-item'><a class='nav-link' href='index.php'>Inicio</a></li>
    <?php if($rol == 1){ ?>
        <li class="nav-item"><a class="nav-link" href="#">Evaluaciones</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Calificaciones</a></li>
    <?php } else { ?>
        <li class="nav-item"><a class="nav-link active" href="#">Materias</a></li>
    <?php } ?>
    <li class="nav-item"><a class="nav-link" href="#">Cerrar Sesion</a></li>
</ul>