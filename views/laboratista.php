<?php

require_once __DIR__ . "/../core/Usuario.php";

session_start();

$usuario = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Búsqueda por tipo de recurso</title>
  <link rel="stylesheet" href="../css/container_global.css">
</head>
<body>
  <header>
    <nav>
      <a href="/views/viewinventario">Inventario</a>
      <a href="#">Usuario: <?php echo $usuario->getNombreUsuario(); ?></a>
      <a href="/logout">Cerrar Sesión</a>
    </nav>
  </header>

  <main>
    <h1>Búsqueda por tipo de recurso</h1>
    <form action="#" method="get">
      <input type="text" name="recurso" placeholder="Ingrese el tipo de recurso..." />
      <button type="submit">Buscar</button>
    </form>

    <h2>Listado de búsqueda</h2>

    <div class="resultado">
      En espera...
    </div>
  </main>
</body>
</html>
