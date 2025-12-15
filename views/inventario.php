<?php


require_once __DIR__ . "/../core/MySQLConnect.php";
require_once __DIR__ . "/../controller/UsuarioController.php";
require_once __DIR__ . "/../core/Usuario.php";

session_start();

$usuario = $_SESSION["user"];

$rows = $_SESSION['items'];


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
      <h1>Inventario</h1>

      <button onclick="location.href = '/get/logsInventario' ">Agregar nuevo registro</button>
      <?php if (count($rows) > 0): ?>
        <?php foreach ($rows as $row): ?>
              <div class = "resultado">
                  <form action="" method="get">
                      <p><strong>No. Inventario: </strong><?php echo htmlspecialchars($row['no_inventario']) ?></p>
                      <p><strong>Nombre de articulo: </strong> <?php echo htmlspecialchars($row['nombre_articulo']) ?></p>
                      <p><strong>Descripcion de articulo: </strong> <?php echo htmlspecialchars($row['descripcion_articulo']) ?></p>
                      <p><strong>Modelo de articulo: </strong> <?php echo htmlspecialchars($row['modelo_articulo']) ?></p>
                      <p><strong>Serie de articulo: </strong> <?php echo htmlspecialchars($row['serie_articulo']) ?></p>
                      <p><strong>Tipo de articulo: </strong> <?php echo htmlspecialchars($row['nombre_tipo_articulo']) ?></p>
                      <p><strong>Marca de articulo: </strong> <?php echo htmlspecialchars($row['nombre_marca']) ?></p>
                      <p><strong>Codigo de salon: </strong> <?php echo htmlspecialchars($row['codigo_salon']) ?></p>
                  </form>
                  <div class="acciones">
                      <button onclick="location.href='/delete/deleteLogInventario/<?php echo htmlspecialchars($row['no_inventario'])?>'">Eliminar</button>
                      <button onclick="location.href='/get/inventarioData/<?php echo htmlspecialchars($row['no_inventario']) ?>'">Editar</button>
                  </div>
              </div>
        <?php endforeach ?>
      <?php endif; ?>
  </main>
</body>

</html>