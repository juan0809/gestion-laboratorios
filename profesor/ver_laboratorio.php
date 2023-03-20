<?php
if (!empty($_GET['laboratorio'])) {
  $laboratorio = $_GET['laboratorio'];
} else {
  header("Location: profesor");
}
require_once 'includes/header.php';
require_once '../includes/conexion.php';

//consulta del laboratorio
$sql = "SELECT * FROM laboratorios WHERE id = $laboratorio";
$query = $pdo->prepare($sql);
$query->execute();
$data = $query->fetch();

//consulta de las tareas
$sql = "SELECT * FROM tareas WHERE laboratorio_id = $laboratorio";
$query = $pdo->prepare($sql);
$query->execute();
$tareas = $query->fetchAll();

?>

<link rel="stylesheet" href="css/style.css">

<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> Laboratorio <?= $data['titulo']; ?></h1>
      <a href="Lista_Laboratorios.php" class="btn btn-info">
      << Volver Atras</a>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Laboratorios</a></li>
    </ul>
  </div>
  <div >
    <p>Imagen: <?= $data['imagen']; ?> </p>
  </div>
  <div >
    <p><?= $data['descripcion']; ?> </p>
  </div>
  <div >
    <p class="font-weight-bold">Objetivos:</p>
    <P><?= $data['objetivos']; ?></P>
  </div>

  <!-- Lista de tareas -->
    <div>
    <?php foreach ($tareas as $tarea) { ?>
        <?php if (!empty($tarea['titulo_tarea'])) { ?>
            <h5><?= $tarea['titulo_tarea']; ?></h5>
        <?php } ?>

        <?php if (!empty($tarea['imagen_tarea'])) { ?>
            <p>Imagen: <?= $tarea['imagen_tarea']; ?></p>
        <?php } ?>

        <?php if (!empty($tarea['descripcion_tarea'])) { ?>
            <p><?= $tarea['descripcion_tarea']; ?></p>
        <?php } ?>

        <?php if (!empty($tarea['codigo'])) { ?>
          <p>Codigo de ejemplo</p>
            <textarea name="code_codigo" id="" cols="30" rows="10"><?= $tarea['codigo']; ?></textarea>
        <?php } ?>

        <?php if (!empty($tarea['codigou'])) { ?>
            <p>Código U:</p>
            <div class="form-group col-12">  <textarea name="code_codigo" id="" cols="30" rows="10"><?= $tarea['codigou']; ?></textarea> </div>
        <?php } ?>
    <?php } ?>
    </div>

</main>

<?php
require_once 'includes/footer.php';
?>