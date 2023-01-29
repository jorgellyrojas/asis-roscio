<?php
	if (!empty($_POST["btnregistrar"]))
	{
		if (!empty($_POST["txtnombre"]) and !empty($_POST["txtapellido"])
			and !empty($_POST["txtci"]) and !empty($_POST["txtdes"])){
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
					text: "El numero de cédula <?= $ci ?> ya se encuentra registrado",
					styling: "bootstrap3"
				})
			})
		</script>
		<?php } else{
			$sql = $conexion->query("insert into persona (nombre, apellido, ci, des) values ('$nombre', '$apellido', '$ci', '$des')");
			if ($sql==true) {
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