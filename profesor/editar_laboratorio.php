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
            <a href="Lista_Laboratorios.php" class="btn btn-info">
                << Volver Atras</a>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Laboratorios</a></li>
        </ul>
    </div>
    <main role="main" class="container my-auto">
        <div class="row">
            <div class="col-10">
                <div class="form-group col-6">
                <form name="FormData" method="post" action="" enctype="multipart/form-data" class="wrapper">
                    
                <div class="form-group col-6">
                <p class="font-weight-bold">Titulo:</p>
                    <input name="titulo" id="" cols="30" rows="10"><?= $data['titulo']; ?>
                </div>

                <div class="form-group col-6">
                    <p class="font-weight-bold">Imagen:</p>
                    <input type="file" Imagen: <?= $data['imagen']; ?>>
                </div>

                <div class="form-group col-12">
                    <p class="font-weight-bold">Descripcion:</p>
                    <textarea name="descripcion" id="" cols="30" rows="10"><?= $data['descripcion']; ?></textarea>
                </div>

                  <div class="form-group col-12">
                    <p class="font-weight-bold">Objetivos:</p>
                    <textarea name="objetivos" id="" cols="30" rows="10"><?= $data['objetivos']; ?></textarea>
                </div>
                </form>
            </div>
        </div>
    </main>
    <!-- Lista de tareas -->
    <div>
        <?php foreach ($tareas as $tarea) { ?>
            <?php if (!empty($tarea['titulo_tarea'])) { ?>
                <h5>Tarea: <?= $tarea['titulo_tarea']; ?></h5>
            <?php } ?>

            <?php if (!empty($tarea['imagen_tarea'])) { ?>
                <p>Imagen: <?= $tarea['imagen_tarea']; ?></p>
            <?php } ?>

            <?php if (!empty($tarea['descripcion_tarea'])) { ?>
                <p>Descripción: <?= $tarea['descripcion_tarea']; ?></p>
            <?php } ?>

            <?php if (!empty($tarea['codigo'])) { ?>
                <p>Código</p>
                <textarea name="code_codigo" id="" cols="30" rows="10"><?= $tarea['codigo']; ?></textarea>
            <?php } ?>

            <?php if (!empty($tarea['codigou'])) { ?>
                <p>Código U:</p>
                <div class="form-group col-12"> <textarea name="code_codigo" id="" cols="30" rows="10"><?= $tarea['codigou']; ?></textarea> </div>
            <?php } ?>
        <?php } ?>
    </div>
    <div>
    <?php foreach ($tareas as $tarea) { ?>
        <?php if (!empty($tarea['titulo_tarea'])) { ?>
            <h5>Tarea: <?= $tarea['titulo_tarea']; ?></h5>
        <?php } ?>

        <?php if (!empty($tarea['imagen_tarea'])) { ?>
            <p>Imagen: <?= $tarea['imagen_tarea']; ?></p>
        <?php } ?>

        <?php if (!empty($tarea['descripcion_tarea'])) { ?>
            <p>Descripción: <?= $tarea['descripcion_tarea']; ?></p>
        <?php } ?>

        <?php if (!empty($tarea['codigo'])) { ?>
          <p>Código</p>
            <textarea name="code_codigo" id="" cols="30" rows="10"><?= $tarea['codigo']; ?></textarea>
        <?php } ?>

        <?php if (!empty($tarea['codigou'])) { ?>
            <p>Código U:</p>
            <div class="form-group col-12">  <textarea name="code_codigo" id="" cols="30" rows="10"><?= $tarea['codigou']; ?></textarea> </div>
        <?php } ?>
    <?php } ?>
    </div>


    <button id="btn_titulo" class="btn btn-success ">Agregar Titulo</button>
    <button id="btn_descripcion" class="btn btn-info ">Agregar Descripcion</button>
    <button id="btn_codigo" class="btn btn-warning ">Agregar codigo</button>
    <button id="btn_codigou" class="btn btn-success ">Agregar Codigo U</button>
    <button id="btn_imagen" class="btn btn-info ">Agregar Imagen</button>
    <button id="actualizar" class="btn btn-danger icon-btn" type="submit">Actualizar</button>
    </body>
</main>
<?php
require_once 'includes/footer.php';
?>