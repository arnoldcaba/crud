<?php include('server.php');
  //fetch the record
  if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit_state = true;
    $rec = mysqli_query($db, "SELECT * FROM usuario WHERE id = $id");
    $record = mysqli_fetch_array($rec);
    $name = $record['nombre'];
    $addres = $record['direccion'];
    $id = $record['id'];
  }

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>CRUD in PHP</title>
  </head>
  <body>

    <?php if (isset($_SESSION["msg"])): ?>
        <div class="msg">
          <?php
            echo $_SESSION["msg"];
            unset($_SESSION["msg"]);
           ?>
        </div>
    <?php endif; ?>
    <table>
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Dirección</th>
          <th colspan="2">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($row = mysqli_fetch_array($results)) {?>
          <tr>
            <td><?php echo $row["nombre"]; ?></td>
            <td><?php echo $row["direccion"]; ?></td>
            <td>
              <a class="edit_btn"href="index.php?edit=<?php echo $row['id']; ?>">Edit</a>
            </td>
            <td>
              <a class="delete_btn"href="server.php?delete=<?php echo $row['id']; ?>">Delete</a>
            </td>
          </tr>
        <?php } ?>


      </tbody>
    </table>
    <form class="" action="server.php" method="post">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <div class="input-group">
        <label>Nombre</label>
        <input type="text" name="nombre" value="<?php echo $name; ?>">
      </div>
      <div class="input-group">
        <label>Dirección</label>
        <input type="text" name="direccion" value="<?php echo $addres; ?>">
      </div>
      <div class="input-group">
        <?php if ($edit_state==false): ?>
          <button type="submit" name="guardar" class="btn">Guardar</button>
        <?php else: ?>
          <button type="submit" name="editar" class="btn">Editar</button>
        <?php endif; ?>

      </div>
    </form>

  </body>
</html>
