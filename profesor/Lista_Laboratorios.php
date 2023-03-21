<?php
    require_once 'includes/header.php';
    require_once 'includes/modals/modal_laboratorio.php';
    require_once '../includes/conexion.php';

    $sql = "SELECT * FROM laboratorios";
    $query = $pdo->prepare(($sql));
    $query->execute();
    $row = $query->rowCount();
?>
<main class="app-content">
    <div class="app-title">
        <div>
        <h1><i class="fa fa-dashboard"></i> Lista de Laboratorios</h1>
        
        <button class="btn btn-success" type="button" onclick="location.href='Laboratorios.php'">Nuevo Laboratorio</button>
        </div>
        <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">lista de laboratorios</a></li>
        </ul>
    </div>
<head>
    <!-- Cargar el CSS de Boostrap-->
    <link
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
        <link rel="stylesheet" href="https://jmblog.github.io/color-themes-for-highlightjs/css/themes/hemisu-light.css">
</head>
<body>
    <main role="main" class="container my-auto">
    <div class="row">
    <div class="col-md-12 text-center border mt-3 p-4 bg-light">
      <h4>Mis Laboratorios</h4>
      
    </div>
  </div>
  <div class="row">
        <?php if($row >0 ){
          while($data = $query->fetch()){
        ?>
        <div class="col-md-4 text-center border mt-3 p-4 bg-light">
            <div class="card m-2 shadow" style="width: 18rem;">
              <?php if(!file_exists('images/laboratorios/'.$data['imagen'])){ ?>
                <img src="images/card-school.png" class="card-img-top" style="width: 100%; height: 200px;" alt="imagen laboratorio">
              <?php }else{ ?>
                <img src="images/laboratorios/<?=$data['imagen'] ?>" style="width: 100%; height: 200px;" class="card-img-top" alt="<?=$data['titulo'] ?>">
              <?php } ?>
              <div class="card-body">
                <h4 class="card-title text-center"><?=$data['titulo'] ?></h4>
                <a href="ver_laboratorio.php?laboratorio=<?= $data['id']?>" class="btn btn-primary">Acceder</a>
                <a href="editar_laboratorio.php?laboratorio=<?= $data['id']?>" class="btn btn-secondary">Editar</a>
                <button onclick="confirmar(<?=$data['id']?>)" class="btn btn-danger">Eliminar</button>
                <script>
                  function confirmar(id){
                    var respuesta = confirm("¿Está seguro de eliminar el laboratorio?");
                    if(respuesta == true){
                      window.location.href = "eliminar_laboratorio.php?laboratorio="+id;
                    }
                  }
                </script>
              </div>
            </div>
        </div>
        <?php }  } ?>

      </div>  
    </main>
<?php
    require_once 'includes/footer.php';
?>