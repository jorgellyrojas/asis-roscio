<?php
session_start();
if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
header('location:login/login.php');
}
$id=$_SESSION["id"];
?>
<style>
  ul li:nth-child(5) .activo {
    background: rgb(11, 150, 214) !important;
  }
</style>

<script>
    function advertencia() {
        var not=confirm("¿Estás seguro que deseas eliminar?")
        return not;
    }
</script>


<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

    <h4 class="text-center text-secondary"> PERFIL </h4>

    <?php
    include "../modelo/conexion.php";
    include "../controlador/controlador_modificar_usuario.php";
    $sql=$conexion->query("select * from usuario where id_usuario=$id")
    ?>
    <div class="row">
      <form action="" method="POST">
        <?php 
        while ($datos=$sql->fetch_object()){ ?>
          <div hidden class="fl-flex-label mb-4 px-2 col-12 col-md-6">
          <input type="text" placeholder="ID" name="txtid" class="input input__text" value="<?=$datos->id_usuario?>">
        </div>
          <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
          <input type="text" placeholder="Nombre" name="txtnombre" class="input input__text" value="<?=$datos->nombre?>">
        </div>
        <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
          <input type="text" placeholder="Apellido" name="txtapellido" class="input input__text" value="<?=$datos->apellido?>">
        </div>
        <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
          <input type="text" placeholder="Usuario" name="txtusuario" class="input input__text" value="<?=$datos->usuario?>">
        </div>
        <div class="text-right p-2">
          <button type="submit" value="ok" name="btnmodificar" class="btn btn-primary btn-rounded">Modificar</button>
        </div>
      </form>
    </div>
          <?php
        }
        ?>
        
</div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>