<?php


require_once __DIR__ . "/../../core/MySQLConnect.php";
require_once __DIR__ . "/../../controller/SalonController.php";
require_once __DIR__ . "/../../core/Usuario.php";

session_start();

$usuario = $_SESSION["user"];
$salon = $_SESSION["salon"];
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../../css/salones.css">
  <title>Agregar Salones</title>
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
      <form action="/post/editSalon" method="post">
        <p>Ingrese un codigo de salon</p>
        <input type="text" name="codigo_salon" placeholder="Código del salón" required
          value="<?php echo $salon['codigo_salon']; ?>" />
        <p>Seleccione un edificio:</p>
        <select name="id_edificio" required disabled>
          <option value="<?php echo $salon['id_edificio']; ?>"> <?php echo $salon['codigo_edificio'] ?></option>
        </select>
        <p>Seleccione el tipo de salon</p>
        <select name="id_tipo_salon" disabled>
          <option value="<?php echo $salon['id_tipo_salon']; ?>"> <?php echo $salon['nombre_tipo_salon'] ?></option>
        </select>
        <p>Seleccione el estado del salón</p>
        <select name="id_status">
          <option value="1">Activo</option>
          <option value="0">Inactivo</option>
        </select>

        <input type="submit" value="Editar Salón" class="button_form">
    </div>

    </form>

  </main>
</body>

</html>