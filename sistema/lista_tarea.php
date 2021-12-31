<?php include_once "includes/header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Tareas</h1>
		<a href="registro_tarea.php" class="btn btn-primary">Nuevo</a>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="table">
					<thead class="thead-dark">
						<tr>
							<th>ID</th>
							<th>TITULO</th>
							<th>FECHA CREACION</th>
							<th>ESTADO</th>
							<th>FECHA VENCIMIENTO</th>
							<th>USUARIO</th>
							<th>ACCIONES</th>
							
						</tr>
					</thead>
					<tbody>
						<?php
						$usuario =  $_SESSION['id_usuario'];
						include "../conexion.php";
                        $consulta="SELECT DISTINCT t.id_tarea, t.titulo, t.fecha_creacion, e.nombre AS 'estado', t.fecha_vencimiento, u.nombre AS 'autor' FROM tarea t LEFT JOIN usuario u ON u.id_usuario = t.id_usuario LEFT JOIN estados e ON e.id_estado = t.id_estado WHERE t.id_usuario = $usuario  ORDER BY t.fecha_vencimiento";
						$query = mysqli_query($conexion, $consulta);
						$result = mysqli_num_rows($query);
						if ($result > 0) {
							while ($data = mysqli_fetch_assoc($query)) { ?>
								<tr>
									<td><?php echo $data['id_tarea']; ?></td>
									<td><?php echo $data['titulo']; ?></td>
									<td><?php echo $data['fecha_creacion']; ?></td>
									<td><?php echo $data['estado']; ?></td>
									<td><?php echo $data['fecha_vencimiento']; ?></td>
									<td><?php echo $data['autor']; ?></td>
										
									<td>
										<a href="registro_tarea.php?id=<?php echo $data['id_tarea']; ?>" class="btn btn-primary"><i class='fas fa-audio-description'></i></a>
                                       
										<a href="editar_tarea.php?id=<?php echo $data['id_tarea']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
                                       
										<form action="eliminar_tarea.php?id=<?php echo $data['id_tarea']; ?>" method="post" class="confirmar d-inline">
											<button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> </button>
										</form>
									</td>
									
								</tr>
								<?php }
						} ?>

						// ver mas
		               <?php
						include "../conexion.php";
						$usuario =  $_SESSION['id_usuario'];
                        $consulta="SELECT DISTINCT t.id_tarea, t.titulo, t.fecha_creacion, e.nombre AS 'estado', t.fecha_vencimiento, u.nombre AS 'autor' FROM tarea t LEFT JOIN usuario u ON u.id_usuario = t.id_usuario  LEFT JOIN estados e ON e.id_estado = t.id_estado WHERE t.id_usuario <> $usuario  ORDER BY t.fecha_vencimiento";
						$query = mysqli_query($conexion, $consulta);
						$result = mysqli_num_rows($query);
						if ($result > 0) {
							while ($dato = mysqli_fetch_assoc($query)) { ?>
								<tr  id="demo" class="collapse">
									<td><?php echo $dato['id_tarea']; ?></td>
									<td><?php echo $dato['titulo']; ?></td>
									<td><?php echo $dato['fecha_creacion']; ?></td>
									<td><?php echo $dato['estado']; ?></td>
									<td><?php echo $dato['fecha_vencimiento']; ?></td>
									<td><?php echo $dato['autor']; ?></td>
										
									<td>
										
									</td>
									
								</tr>
								<?php }
						} ?>
					
					</tbody>
			
				</table>

			    <div class="container ">
      				<button type="button" class="btn btn-info float-right" data-toggle="collapse" data-target="#demo">Ver mas</button>
   
  			    </div>
			</div>

		</div>
	</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<?php include_once "includes/footer.php"; ?>