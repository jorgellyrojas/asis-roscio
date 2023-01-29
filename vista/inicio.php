<?php
session_start();
if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
header('location:login/login.php');
}

?>
<style>
  ul li:nth-child(1) .activo {
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

    <h4 class="text-center text-secondary"> Resumen de Asistencias </h4>
    <?php
    include "../modelo/conexion.php";
    include '../controlador/controlador_eliminar_asis.php';
    $sql=$conexion->query("SELECT
    asistencia.id_asistencia,
    asistencia.id_persona,
    asistencia.entrada,
    asistencia.salida,
    persona.id_persona,
    persona.nombre as 'nom_persona',
    persona.apellido,
    persona.ci,
    persona.des,
    des.id_des,
    des.nombre as 'nom_des'
    FROM
    asistencia 
    INNER JOIN persona on asistencia.id_persona = persona.id_persona 
    INNER JOIN des ON persona.des = des.id_des");

    ?>
    <div class="text-right mb-2">
      <a href="fpdf/ReporteAsistencia1.php" target="_blank" class="btn btn-success"><i class="fas fa-file-pdf"></i> Generar reportes</a>
    </div>
     <div class="text-right mb-2">
      <a href="Reporte_asistencia.php" target="_blank" class="btn btn-primary"><i class="fas fa-file-pdf"></i> Reporte por Fecha</a>
    </div>
    <table class="table table-bordered table-hover col-12" id="example">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nombre y Apellido</th>
      <th scope="col">C.I</th>
      <th scope="col">Tipo</th>
      <th scope="col">Entrada</th>
      <th scope="col">Salida</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php
    while ($datos =$sql->fetch_object()) { ?>
      <tr>
      <td><?= $datos->id_asistencia?></td>
      <td><?= $datos->nom_persona?></td>
      <td><?= $datos->ci?></td>
      <td><?= $datos->nom_des?></td>
      <td><?= $datos->entrada?></td>
      <td><?= $datos->salida?></td>
      <td> <a href="inicio.php?id=<?=$datos->id_asistencia?>" onclick="return advertencia()" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a> </td>
      </tr>
    <?php   
    }
    ?>
    
  </tbody>
</table>

</div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>