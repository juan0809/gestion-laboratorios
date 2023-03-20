<?php
require_once '../includes/conexion.php';

    //campos estaticos
    $titulo = $_POST['titulo'];
    $imagen = $_POST['imagen'];
    $descripcion = $_POST['descripcion'];
    $objetivos = $_POST['objetivos'];
    
   //verificar si existen los campos dinamicos sino se dejan vacios
    if (isset($_POST['input_array_titulo'])) {
        $input_array_titulo = $_POST['input_array_titulo'];
    } else {
        $input_array_titulo = '';
    }
    if (isset($_POST['input_array_descripcion'])) {
        $input_array_descripcion = $_POST['input_array_descripcion'];
    } else {
        $input_array_descripcion = '';
    }
    if (isset($_POST['input_array_imagen'])) {
        $input_array_imagen = $_POST['input_array_imagen'];
    } else {
        $input_array_imagen = '';
    }
    if (isset($_POST['input_array_codigo'])) {
        $input_array_codigo = $_POST['input_array_codigo'];
    } else {
        $input_array_codigo = '';
    }
    if (isset($_POST['input_array_codigou'])) {
        $input_array_codigou = $_POST['input_array_codigou'];
    } else {
        $input_array_codigou = '';
    }
    
    //Se guarda en la base de datos
    $sql = "INSERT INTO laboratorios (titulo, imagen, descripcion, objetivos) VALUES ('$titulo', '$imagen', '$descripcion', '$objetivos')";
    $query = $pdo->prepare(($sql));
    $query->execute();
    $id_laboratorio = $pdo->lastInsertId();

    //Se guardan los campos dinamicos en la tabla tareas
    for ($i = 0; $i < count($input_array_titulo); $i++) {
        $sql = "INSERT INTO tareas (titulo_tarea, descripcion_tarea, imagen_tarea, codigo, codigou, laboratorio_id) VALUES ('$input_array_titulo[$i]', '$input_array_descripcion[$i]', '$input_array_imagen[$i]', '$input_array_codigo[$i]', '$input_array_codigou[$i]', '$id_laboratorio')";
        $query = $pdo->prepare(($sql));
        $query->execute();
    }
  
    //Se cierra la conexion
    $pdo = null;
?>