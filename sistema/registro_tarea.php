 <?php include_once "includes/header.php";
  include "../conexion.php";
  if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['titulo']) || empty($_POST['fechaCreacion']) || empty($_POST['estado']) || empty($_POST['estado'])|| empty($_POST['fechaVencimiento'])) {
      $alert = '<div class="alert alert-danger" role="alert">
                Todo los campos son obligatorios
              </div>';
    } else {
      $titulo = $_POST['titulo'];
      $fechaCreacion = $_POST['fechaCreacion'];
      $estado = $_POST['estado'];
      $fechaVencimiento = $_POST['fechaVencimiento'];
      $usuario = $_SESSION['id_usuario'];
      

      $query_insert = mysqli_query($conexion, "INSERT INTO `tarea`(`id_tarea`, `titulo`, `fecha_creacion`, `id_estado`, `fecha_vencimiento`, `id_usuario`) VALUES (Null,'$titulo','$fechaCreacion','$estado','$fechaVencimiento','$usuario');");
      if ($query_insert) {
        $alert = '<div class="alert alert-primary" role="alert">
                Producto Registrado
              </div>';
      } else {
        $alert = '<div class="alert alert-danger" role="alert">
                Error al registrar el producto
              </div>';
      }
    }
  }
  ?>

 <!-- Begin Page Content -->
 <div class="container-fluid">

   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Panel de Administración</h1>
     <a href="lista_tarea.php" class="btn btn-primary">Regresar</a>
   </div>

   <!-- Content Row -->
   <div class="row">
     <div class="col-lg-6 m-auto">
       <form action="" method="post" autocomplete="off">
         <?php echo isset($alert) ? $alert : ''; ?>
         <div class="form-group">
         <div class="form-group">
           <label for="producto">Titulo</label>
           <input type="text" placeholder="Ingrese titulo" name="titulo" id="titulo" class="form-control">
         </div>
         <div class="form-group">
           <label for="precio">Fecha creacion</label>
           <input type="Date" placeholder="Ingrese fecha creacion" class="form-control" name="fechaCreacion" id="fechaCreacion">
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
           <input type="Date" placeholder="Ingrese fecha creacion" class="form-control" name="fechaVencimiento" id="fechaCreacion">
         </div>
      
         <input type="submit" value="Guardar Producto" class="btn btn-primary">
       </form>
     </div>
   </div>


 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->
 <?php include_once "includes/footer.php"; ?>