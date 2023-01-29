<?php
if (!empty($_POST["btnmodificar"])) {
	if (!empty($_POST["txtid"]) and !empty($_POST["txtnombre"]) and !empty($_POST["txtapellido"]) and !empty($_POST["txtci"]) and !empty($_POST["txtdes"])) {
			$id=$_POST["txtid"];
			$nombre=$_POST["txtnombre"];
			$apellido=$_POST["txtapellido"];
			$ci=$_POST["txtci"];
			$des=$_POST["txtdes"];
			$sql=$conexion->query("select count(*) as 'total' from persona where ci='$ci'");
			if ($sql->fetch_object()->total>0) { ?>
				<script>
			$(function notificacion(){
				new PNotify({
					title: "ERROR",
					type: "error",
					text: "La cédula de identidad <?= $ci ?> ya se encuentra registrada",
					styling: "bootstrap3"
				})
			})
		</script>
		<?php
			} else {
				$modificar = $conexion->query("update persona set nombre='$nombre', apellido='$apellido', ci='$ci', des='$des' where id_persona=$id");
				if ($modificar == true) {
					?> 
				<script>
			$(function notificacion(){
				new PNotify({
					title: "CORRECTO",
					type: "success",
					text: "Se ha modificado correctamente",
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
					text: "Error al modificar",
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