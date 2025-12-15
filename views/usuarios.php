<?php

require_once __DIR__ . "/../core/Usuario.php";
require_once __DIR__ ."/../controller/SalonController.php";

session_start();

$usuario = $_SESSION['user'];
$dataUsers = $_SESSION["users"];
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
      <a href="/get/datasalones">Salones</a>
      <a href="/views/viewinventario">Inventario</a>
      <a href="#">Usuario: <?php echo $usuario->getNombreUsuario(); ?></a>
      <a href="/logout">Cerrar Sesión</a>
    </nav>
  </header>

  <main>
    <h1>Usuarios</h1>
      <button onclick="location.href = '/get/dataInputUsuarios'"
      style="margin-bottom: 1rem;">
        Agregar usuario
      </button>
    <?php if (count($dataUsers) > 0): ?>
      <?php foreach ($dataUsers as $dataUser): ?>
        <div class="resultado">
          <form action="/get/datasalones" method="get">
            <p><strong>Matricula usuarios:</strong> <?php echo htmlspecialchars($dataUser['matricula_usuario']); ?></p>
            <p><strong>Nombre de usuario:</strong> <?php echo htmlspecialchars($dataUser['nombre_usuario']); ?></p>
            <p><strong>Nombre del cargo:</strong> <?php echo htmlspecialchars($dataUser['nombre_cargo']); ?></p>
          </form>
          <div class="acciones">
            <button onclick="location.href = '/delete/dataUsuario/<?php echo $dataUser['matricula_usuario']; ?>'">Eliminar</button>
            <button onclick="location.href = '/get/usuarioData/<?php echo $dataUser['matricula_usuario']; ?>'">Editar</button>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No hay usuarios disponibles.</p>
    <?php endif; ?>


  </main>
</body>
</html>

