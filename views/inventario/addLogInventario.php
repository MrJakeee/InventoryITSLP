<?php


require_once __DIR__ . "/../../core/MySQLConnect.php";
require_once __DIR__ . "/../../controller/SalonController.php";
require_once __DIR__ . "/../../core/Usuario.php";

session_start();

$usuario = $_SESSION["user"];
$itemsArticulos = $_SESSION["itemsArticulos"];
$itemsMarcas = $_SESSION["itemsMarcas"];
$itemsSalones = $_SESSION["itemsSalones"];

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
        <form action="/post/addLogInventory/" method="post">
            <p>Nombre de articulo</p>
            <input type="text" name="articulo" id="articulo" placeholder="articulo">
            <p>Descripcion de articulo</p>
            <input type="text" name="descripcion_articulo" id="descripcion_articulo" placeholder="Descripcion articulo">
            <p>Modelo de articulo</p>
            <input type="text" name="modelo_articulo" id="modelo_articulo" placeholder="Modelo articulo">
            <p>Serie de articulo</p>
            <input type="text" name="serie_articulo" id="serie_articulo" placeholder="Serie articulo">
            <p>Tipo de articulo</p>
            <select name="tipo_articulo" id="categoria_articulo">
                <option value="" selected>Seleccione el tipo de Articulo</option>
                <?php foreach ($itemsArticulos as $item): ?>
                    <option value="<?php echo $item['id_tipo_articulo'] ?>"><?php echo $item['nombre_tipo_articulo']?> </option>
                <?php endforeach; ?>
            </select>
            <p>Marca</p>
            <select name="tipo_marca" id="tipo_marca">
                <option value="" selected>Seleccione el tipo de Marca</option>
                <?php foreach ($itemsMarcas as $itemMarca): ?>
                    <option value="<?php echo $itemMarca['id_marca']?>"><?php echo $itemMarca['nombre_marca']?></option>
                <?php endforeach; ?>
            </select>
            <p>Salon</p>
            <select name="salon" id="salon">
                <option value="" selected>Seleccione el salon</option>
                <?php foreach ($itemsSalones as $itemSalon): ?>
                    <option value="<?php echo $itemSalon['id_salon'] ?>"><?php echo $itemSalon['codigo_salon']?></option>
                <?php endforeach; ?>
            </select>
            <p>Prestamo</p>
            <select name="prestamo" id="prestamo">
                <option value="1" selected>Verdadero</option>
                <option value="0" selected>Falso</option>
            </select>
            <p>Status</p>
            <select name="status" id="status">
                <option value="Bueno" selected>Bueno</option>
                <option value="Regular" selected>Regular</option>
                <option value="Malo" selected>Malo</option>
            </select>
            <p>Registro verificado</p>
            <select name="registro_verificado" id="registro_verificado">
                <option value="1" selected>Verificado</option>
                <option value="0" selected>No Verificado</option>
            </select>
            <input type="submit" value="Agregar log Inventario" class="button_form">
    </div>

    </form>

</main>
</body>

</html>