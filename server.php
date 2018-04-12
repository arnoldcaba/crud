<?php
  session_start();
  //inicializar variables
  $name = "";
  $addres = "";
  $id = 0;
  $edit_state = false;

  //conectando con la db
  $db = mysqli_connect('localhost', 'root', '', 'crud');

  // si se selecciona boton guardar
  if (isset($_POST['guardar'])) {
    $name = $_POST["nombre"];
    $addres = $_POST["direccion"];

    $query = "INSERT INTO usuario (nombre, direccion) VALUES ('$name','$addres')";
    mysqli_query($db, $query);
    $_SESSION["msg"] = "Datos guardados!";
    header('location: index.php');
  }

  // leer los campos de la tabla

  $results = mysqli_query($db,"SELECT * FROM usuario");

  //update
  if (isset($_POST["editar"])) {
    $name = mysql_real_escape_string($_POST["nombre"]);
    $addres = mysql_real_escape_string($_POST["direccion"]);
    $id = mysql_real_escape_string($_POST["id"]);

    mysqli_query($db, "UPDATE usuario set nombre = '$name', direccion = '$addres' where id = $id" );
    $_SESSION["msg"] = "Datos actualizados!";
    header('location: index.php');
  }

  //delete fields
  if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    mysqli_query($db, "DELETE FROM usuario WHERE id=$id");
    $_SESSION["msg"] = "Dato eliminado!";
    header('location: index.php');
  }

 ?>
