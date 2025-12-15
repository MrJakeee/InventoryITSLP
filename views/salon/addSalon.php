<?php


require_once __DIR__ . "/../../core/MySQLConnect.php";
require_once __DIR__ . "/../../controller/SalonController.php";
require_once __DIR__ . "/../../core/Usuario.php";

session_start();

$usuario = $_SESSION["user"];
$edificios = $_SESSION["edificios"];
$tipoSalones = $_SESSION["tiposSalones"];

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
      <form action="/post/addSalon" method="post">
        <p>Ingrese un codigo de salon</p>
        <input type="text" name="codigo_salon" placeholder="Código del salón" required />
        <p>Seleccione un edificio:</p>
        <select name="id_edificio" required>
          <?php foreach ($edificios as $edificio): ?>
            <option value="<?php echo $edificio['id_edificio']; ?>"><?php echo $edificio['codigo_edificio']; ?></option>
          <?php endforeach; ?>
        </select>
        <p>Seleccione el tipo de salon</p>
        <select name="id_tipo_salon">
          <?php foreach ($tipoSalones as $tipoSalon): ?>
            <option value="<?php echo $tipoSalon['id_tipo_salon']; ?>"><?php echo $tipoSalon['nombre_tipo_salon']; ?></option>
          <?php endforeach; ?>
        </select>
        <p>Seleccione el estado del salón</p>
        <select name="id_status">
          <option value="1">Activo</option>
          <option value="0">Inactivo</option>
        </select>

        <input type="submit" value="Agregar Salón" class="button_form">
    </div>

    </form>

  </main>
</body>

</html>