<?php


require_once __DIR__ . "/../../core/MySQLConnect.php";
require_once __DIR__ . "/../../controller/UsuarioController.php";
require_once __DIR__ . "/../../core/Usuario.php";

session_start();

$usuario = $_SESSION["user"];
$cargos = $_SESSION["cargos"];

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../../css/salones.css">
  <title>Agregar Usuarios</title>
</head>

<body>
  <header>
    <nav>
      <a href="/views/viewadministrativo">Pagina Principal</a>
      <a href="/views/viewusuarios">Usuarios</a>
      <a href="/views/viewinventario">Inventario</a>
      <a href="#">Usuario: <?php echo $usuario->getNombreUsuario(); ?></a>
      <a href="/logout">Cerrar Sesión</a>
    </nav>
  </header>

  <main>

    <div class="form_login">
      <form action="/post/addUsuario" method="post">
        <p>Nombre de usuario:</p>
        <input type="text" name="nombre_usuario">
        <p>Contraseña:</p>
        <input type="password" name="pass_usuario">
        <p>Cargo:</p>
        <select name="id_cargo" id="id_cargo">
          <?php foreach($cargos as $cargo) : ?>
            <option value="<?php echo $cargo['id_cargo']; ?>"><?php echo $cargo['nombre_cargo']; ?></option>
          <?php endforeach; ?>
        </select>
        <input type="submit" value="Agregar Salón" class="button_form">
    </div>

    </form>

  </main>
</body>

</html>