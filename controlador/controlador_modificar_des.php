<?php
if (!empty($_POST["btnmodificar"])) {
	if (!empty($_POST["txtnombre"])) {
			$nombre=$_POST["txtnombre"];
			$id=$_POST["txtid"];
			$verificarNombre=$conexion->query("select count(*) as 'total' from des where nombre='$nombre' and id_des!=$id");
			if ($verificarNombre->fetch_object()->total > 0) {
				?>
				<script>
			$(function notificacion(){
				new PNotify({
					title: "ERROR",
					type: "error",
					text: "El usuario <?= $usuario ?> ya existe",
					styling: "bootstrap3"
				})
			})
		</script>
		<?php
			} else {
				$modificar = $conexion->query("update des set nombre='$nombre' where id_des=$id");
				if ($modificar == true) {
					?> 
				<script>
			$(function notificacion(){
				new PNotify({
					title: "CORRECTO",
					type: "success",
					text: "El usuario se ha modificado correctamente",
					styling: "bootstrap3"
				})
			})
		</script>
				<?php
				}
				else { ?>
		<script>
			$(function notificacion(){
				new PNotify({
					title: "INCORRECTO",
					type: "error",
					text: "Error al modificar usuario",
					styling: "bootstrap3"
				})
			})
		</script>
		<?php

				}
			}
			
	} else {
		 ?>
		<script>
			$(function notificacion(){
				new PNotify({
					title: "ERROR",
					type: "error",
					text: "Los campos estan vacios",
					styling: "bootstrap3"
				})
			})
		</script>
		<?php
	}
	?>
	<script>
		setTimeout(() =>{
			window.history.replaceState(null, null, window.location.pathname);
		}, 0);
	</script>
	<?php
}
?>