<?php
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reporte de asistencia</title>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="style/style.css">

    <!-- Fivecon -->
    <link rel="icon" type="imagen/x-icon" href="imagen/icono.svg">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <!-- Iconos de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <!-- pNotify -->
        <link href="public/pnotify/css/pnotify.css" rel="stylesheet" />
        <link href="public/pnotify/css/pnotify.buttons.css" rel="stylesheet" />
        <link href="public/pnotify/css/custom.min.css" rel="stylesheet" />

        <!-- google fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">

        <!-- pnotify -->
        <script src="public/pnotify/js/jquery.min.js">
        </script>
        <script src="public/pnotify/js/pnotify.js">
        </script>
        <script src="public/pnotify/js/pnotify.buttons.js">
        </script>

</head>
<body>

  <!-- Barra de Navegacion -->
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-toggler" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbar-toggler">
        <a class="navbar-brand" href="#"><i class="icon-white bi bi-journal-check"></i></a>
        <ul class="navbar-nav d-flex justify-content-center align-items-center">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Reporte de Asistencia</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="vista/login/login.php">Iniciar Sesión</a>
            </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Formulario Reporte -->
    <div class="login d-flex justify-content-center align-items-center vh-100">
      <div class="bg-white p-5 rounded-5 text-secondary shadow" style="width: 25rem">
        <div class="text-center seccion-titulo">Reportar Asistencia</div>
        <div class="text-center"><p id="fecha"></p></div>
       
        <form action="" method="POST">
        <?php 
        include "modelo/conexion.php";
        include "controlador/controlador_registrar_asis.php";
        ?>
        <div class="input-group mt-1">
        <div class="input-group-text bg-dark">
          <i class="bi bi-person-lines-fill icon-white"></i>
        </div>
        <input
          class="form-control bg-light "
          type="text"
          placeholder="Cédula de Identidad"
          name="txtci"
          id = "txtci"
        />
      </div>
      <div class="botones d-flex justify-content-around mt-1">
        <button type="submit" name="btnentrada" value="ok" class="salida btn btn-dark text-white w-100 mt-4 fw-semibold shadow-sm">
          Entrada
        </button>
        <button type="submit" name="btnsalida" value="ok" class="salida btn btn-dark text-white w-100 mt-4 fw-semibold shadow-sm">
          Salida
        </button>
        </form>
      </div>
    </div>
    </div>
       
    <!-- Funcion para mostrar la fecha-->

  <script>
        setInterval(() => {
            let fecha = new Date();
            let fechaHora = fecha.toLocaleString();
            document.getElementById ("fecha").textContent = fechaHora;
        }, 1000);
  </script>

  <!-- Bootstrap JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

  <script>
    let ci=document.getElementById("txtci");
    ci.addEventListener("input", function(){                                 
      if (this.value.length > 8) {
        this.value=this.value.slice(0,8)
      }
    })
  </script>
</body>
</html>