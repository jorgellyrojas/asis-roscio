<?php
if (!empty($_POST["btnmodificar"])) {
	if (!empty($_POST["txtid"])) {
		$id = $_POST["txtid"];
		$nombre=$_POST["txtnombre"];
		$telefono=$_POST["txttelefono"];
		$ubicacion=$_POST["txtubicacion"];
		$rif=$_POST["txtrif"];
		$sql=$conexion->query("update institucion set nombre='$nombre', telefono='$telefono', ubicacion='$ubicacion', ruc='$rif' where id_institucion=$id");
		if ($sql == true) {
				?> 
				<script>
			$(function notificacion(){
				new PNotify({
					title: "CORRECTO",
					type: "success",
					text: "Los datos se han modificado correctamente",
					styling: "bootstrap3"
				})
			})
		</script>
				<?php
		} else {
			?>
		<script>
			$(function notificacion(){
				new PNotify({
					title: "ERROR",
					type: "error",
					text: "Error al modificar",
					styling: "bootstrap3"
				})
			})
		</script>
		<?php
		}
		
	} else {
		?>
		<script>
			$(function notificacion(){
				new PNotify({
					title: "ERROR",
					type: "error",
					text: "No se ha enviado el identificador",
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