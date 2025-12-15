<?php
require_once __DIR__ . "/../../core/MySQLConnect.php";
require_once __DIR__ . "/../../controller/SalonController.php";
require_once __DIR__ . "/../../core/Usuario.php";

session_start();

$usuario = $_SESSION['user'];
$fgetDataUser = $_SESSION['getDataUser'];
$fcargos = $_SESSION['cargos'];

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../../css/salones.css">
  <title>Editar usuarios</title>
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
      <h1>Editar Usuario</h1>
      <form action="/post/editUsuario" method="post">
        <p>Nombre de usuario:</p>
        <input required type="text" name="usuarioNombre" value="<?php echo $fgetDataUser['nombre_usuario']; ?>">
        <p>Contraseña: </p>
        <input type="password" name="usuarioPassword" value= "" >
        <p>Cargo:</p>
        <select required name="cargo">
          <option selected
            value = "<?php echo $fgetDataUser['id_cargo']; ?>">
            <?php echo $fgetDataUser['nombre_cargo']; ?>
          </option>
          <?php foreach ($fcargos as $fcargo): ?>
            <option value="<?php echo $fcargo['id_cargo']; ?>"><?php echo $fcargo['nombre_cargo']; ?></option>
          <?php endforeach; ?>
        </select>
        <input type="submit" value="Guardar cambios">
      </form>
    </div>

    </form>

  </main>
</body>

</html>