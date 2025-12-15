<?php

require_once __DIR__ . "/../core/Usuario.php";
require_once __DIR__ . "/../controller/SalonController.php";

session_start();

$usuario = $_SESSION['user'];
$salones = $_SESSION['salones'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/salones.css">
  <title>Salones</title>
</head>
<body>
  <header>
    <nav>
      <a href="/views/viewadministrativo">Pagina Principal</a>
      <a href="/get/dataUsuarios">Usuarios</a>
      <a href="/views/viewinventario">Inventario</a>
      <a href="#">Usuario: <?php echo $usuario->getNombreUsuario(); ?></a>
      <a href="/logout">Cerrar Sesión</a>
    </nav>
  </header>

  <main>
    <h1>Salones</h1>
      <button onclick="location.href = '/get/dataInputSalon'"
      style="margin-bottom: 1rem;">
        Agregar Salon
      </button>
    <?php if (count($salones) > 0): ?>
      <?php foreach ($salones as $salon): ?>
        <div class="resultado">
          <form action="/get/datasalones" method="get">
            <p><strong>Código:</strong> <?php echo htmlspecialchars($salon['codigo_salon']); ?></p>
            <p><strong>Tipo:</strong> <?php echo htmlspecialchars($salon['nombre_tipo_salon']); ?></p>
            <p><strong>Edificio:</strong> <?php echo htmlspecialchars($salon['nombre_edificio']); ?></p>
            <p><strong>Estatus:</strong> <?php echo htmlspecialchars($salon['activo'] ? "Activo" : "Inactivo"); ?></p>
          </form>
          <div class="acciones">
            <button onclick="location.href = '/delete/dataSalon/<?php echo $salon['id_salon']; ?>'">Eliminar</button>
            <button onclick="location.href = '/get/dataSalon/<?php echo $salon['id_salon']; ?>'">Editar</button>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No hay salones disponibles.</p>
    <?php endif; ?>


  </main>
</body>
</html>
