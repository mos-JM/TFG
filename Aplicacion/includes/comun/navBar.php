  <!-- Navbar -->
  <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell fa-fw"></i>
          <span class="badge badge-danger">1+</span><!--Aqui una variable de correo -->
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
          <a class="dropdown-item" href="#">Acción</a>
          <a class="dropdown-item" href="#">Otras acciones</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Otras cosas aqui</a>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-envelope fa-fw"></i>
          <span class="badge badge-danger">7</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
          <a class="dropdown-item" href="#">Mensajes</a>
          <a class="dropdown-item" href="#">Otra accion</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Algo aqui</a>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <?php
            if (isset($_SESSION["login"]) && ($_SESSION["login"]===true)) {
              echo "<a class='dropdown-item' href='#'>". $_SESSION['nombre'] . "</a>";
              
            } else {
              echo "Usuario desconocido. <a href='login.php'>Login</a> <a href='registro.php'>Registro</a>";
            }
          ?>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Ajustes</a>
          <a class="dropdown-item" href="#">Actividad</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Salir</a>
        </div>
      </li>
    </ul>