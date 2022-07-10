<nav class="navbar navbar-expand-lg navbar-light bg-light p-3">
  <a class="navbar-brand" href="#"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo $this->getHostPath()?>">Dashboard </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Configuracion</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Registros de usuarios</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Registro de turnos</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" data-bs-toggle="dropdown" aria-expanded="false" href="#">Usuarios</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="<?php echo $this->getHostPath()?>usuarios/agregarUsuarios">Agregar Usuarios</a>
          <a class="dropdown-item" href="<?php echo $this->getHostPath()?>usuarios/listarUsuarios">Listar usuarios</a>
        </div>
      </li>
    </ul>
   
  </div>
  <?php

 if(empty($sessionUser)){ ?>
  <span class="navbar-text">
      Login
 </span>
 <?php }else{ ?>
 <span class="navbar-text">
      <a href="<?php app\Application::getConfiguration('host')?>/usuarios/logout">Salir</a>
      <img src="<?php echo $this->getPathImages()?>/logout.png">
 </span>
 <?php } ?>
</nav>