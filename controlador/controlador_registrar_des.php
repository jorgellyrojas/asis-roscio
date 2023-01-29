<?php
	if (!empty($_POST["btnregistrar"]))
	{
		if (!empty($_POST["txtnombre"])){
			$nombre=$_POST["txtnombre"];

			$verificarNombre=$conexion->query("select count(*) as 'total' from des where nombre='$nombre'");
			if ($verificarNombre->fetch_object()->total>0) { ?>
				<script>
			$(function notificacion(){
				new PNotify({
					title: "ERROR",
					type: "error",
					text: "La categoria <?= $nombre ?> ya existe",
					styling: "bootstrap3"
				})
			})
		</script>
		<?php } else{
			$registro=$conexion->query("insert into des(nombre)values('$nombre')");
			if ($registro==true) {
				?> 
				<script>
			$(function notificacion(){
				new PNotify({
					title: "CORRECTO",
					type: "success",
					text: "Se ha registrado correctamente",
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
					title: "INCORRECTO",
					type: "error",
					text: "Error al registrar",
					styling: "bootstrap3"
				})
			})
		</script>
				<?php
			}
			
		}
				
	} else { ?>
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
	} ?>
	<script>
		setTimeout(() =>{
			window.history.replaceState(null, null, window.location.pathname);
		}, 0);
	</script>
	<?php
}
?>