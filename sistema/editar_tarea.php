<?php include_once "includes/header.php";
  $id = $_GET['id'];
  include "../conexion.php";
  if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['titulo']) || empty($_POST['fechaCreacion']) || empty($_POST['estado']) || empty($_POST['fechaVencimiento'])) {
      $alert = '<div class="alert alert-danger" role="alert">
                Todo los campos son obligatorios
              </div>';
    } else {
      $titulo = $_POST['titulo'];
      $fechaCreacion = $_POST['fechaCreacion'];
      $estado = $_POST['estado'];
      $fechaVencimiento = $_POST['fechaVencimiento'];
      
      $query_insert = mysqli_query($conexion, "UPDATE `tarea` SET `titulo`='$titulo',`fecha_creacion`='$fechaCreacion',`id_estado`='$estado',`fecha_vencimiento`='$fechaVencimiento' WHERE  `tarea`.`id_tarea`= $id");
      if ($query_insert) {
        $alert = '<div class="alert alert-primary" role="alert">
                Producto actualizado con exito
              </div>';
      } else {
        $alert = '<div class="alert alert-danger" role="alert">
                Error al actualizar la tarea
              </div>';
      }
    }
  }

// Validar producto

if (empty($_REQUEST['id'])) {
  header("Location: lista_tarea.php");
} else {
  $id_tarea = $_REQUEST['id'];
  if (!is_numeric($id_tarea)) {
    header("Location: lista_tarea.php");
  }
  $consulta="SELECT DISTINCT t.id_tarea, t.titulo, t.fecha_creacion, e.nombre AS 'estado', t.fecha_vencimiento FROM tarea t LEFT JOIN usuario u ON u.id_usuario = t.id_usuario LEFT JOIN estados e ON e.id_estado = t.id_estado WHERE t.id_tarea = $id_tarea";

  $query_tarea = mysqli_query($conexion, $consulta);
  $result_tarea = mysqli_num_rows($query_tarea);

  if ($result_tarea > 0) {
    $data_tarea = mysqli_fetch_assoc($query_tarea);
   
  } else {
    header("Location: lista_tarea.php");
  }
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <div class="row">
    <div class="col-lg-6 m-auto">

      <div class="card">
        <div class="card-header bg-primary text-white">
          Modificar tarea
        </div>
        <div class="card-body">
          <form action="" method="post">
            <?php echo isset($alert) ? $alert : ''; ?>
            <div class="form-group">
            <div class="form-group">
           <label for="producto">Titulo</label>
           <input type="text" placeholder="Ingrese titulo" name="titulo" id="titulo" class="form-control" value="<?php echo $data_tarea['titulo']; ?>">
         </div>
         <div class="form-group">
           <label for="precio">Fecha creacion</label>
           <input type="Date" placeholder="Ingrese fecha creacion" class="form-control" name="fechaCreacion" id="fechaCreacion"value="<?php echo $data_tarea['fecha_creacion']; ?>">
         </div>
         <div class="form-group">
         <label>Estado</label>
         <?php
            $query_estado = mysqli_query($conexion, "SELECT id_estado, nombre FROM estados ORDER BY nombre ASC");
            $resultado_estado = mysqli_num_rows($query_estado);
            mysqli_close($conexion);
            ?>
           <select id="estado" name="estado" class="form-control">
             <?php
              if ($resultado_estado > 0) {
                while ($estado = mysqli_fetch_array($query_estado)) {
                  // code...
              ?>
                 <option value="<?php echo $estado['id_estado']; ?>"><?php echo $estado['nombre']; ?></option>
             <?php
                }
              }
              ?>
           </select>
            </div>
            <div class="form-group">
           <label for="precio">Fecha Vencimiento</label>
           <input type="Date" placeholder="Ingrese fecha creacion" class="form-control" name="fechaVencimiento" id="fechaVencimiento"value="<?php echo $data_tarea['fecha_vencimiento']; ?>">
         </div>
            <input type="submit" value="Actualizar tarea" class="btn btn-primary">
          </form>
        </div>
      </div>
    </div>
  </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php include_once "includes/footer.php"; ?>