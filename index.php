
<?php

require_once __DIR__ . "/core/Router.php";
require_once __DIR__ . "/controller/LoginAuthController.php";
require_once __DIR__ . '/includes/verify_user.php';
require_once __DIR__ . '/controller/SalonController.php';
require_once __DIR__ . '/controller/UsuarioController.php';
require_once __DIR__ . '/controller/InventarioController.php';
require_once __DIR__ . "/core/Usuario.php";
$route = new Router();

$route->get('/', function () {
    header('Location: /views/viewlogin.php');
});

$route->post('/login', function () {
    LoginAuthController::login();
});

$route->get('/views/viewadministrativo', function () {
    header('Location: /views/administrativo.php');
});

$route->get('/views/viewdocente', function () {
    header('Location: /views/docente.php');
});

$route->get('/views/viewlaboratista', function () {
    header('Location: /views/laboratista.php');
});

$route->get('/views/viewsalones', function () {
    header('Location: /views/salones.php');
});

$route->get('/views/viewsaloneslaboratista', function () {
    header('Location: /views/laboratista/viewSalones.php');
});

$route->get('/views/viewusuarios', function () {
    header('Location: /views/usuarios.php');
});

$route->get('/views/addSalon', function () {
    header('Location: /views/salon/addSalon.php');
});

$route->get('/views/viewinventario', function () {
    header('Location: /views/inventario.php');
});

$route->get('/views/editSalon', function () {
    header('Location: /views/salon/editSalon.php');
});

$route->get('/views/addUsuario', function () {
    header('Location: /views/usuarios/addUsuario.php');
});

$route->get('/views/editUsuario', function () {
    header('Location: /views/usuarios/editUsuario.php');
});

$route->get('/views/addLogInventario', function () {
    header('Location: /views/inventario/addLogInventario.php');
});

$route->get('/logout', function () {
    verify_user::closeSession();
});

$route->post('/create/datasalones', function () {
    SalonController::addSalon();
});

$route->get('/delete/dataSalon/{id}', function ($id) {
    SalonController::deleteSalon($id);
});

$route->get('/delete/dataUsuario/{id}', function ($id) {
    UsuarioController::deleteUsuario($id);
});

$route->get('/get/datasalones', function () {
    SalonController::getData();
});

$route->get('/get/dataInputSalon', function () {
    SalonController::getDataInputSalon();
});

$route->get('/get/dataSalon/{id}', function ($id) {
    SalonController::getDataSalonSpecific($id);
});

$route->get('/get/dataUsuarios', function () {
    UsuarioController::getUsuarios();
});

$route->get('/get/dataInputUsuarios', function () {
    UsuarioController::getDataInputUsuario();
});

$route->get('/get/getAllRegisters' , function(){
    InventarioController::getAllRegisters();
});

$route->get('/get/usuarioData/{id}', function ($id) {
    UsuarioController::getDataUser($id);
});

$route->get('/get/inventarioData/{id}', function ($id) {

});

$route->post('/post/addSalon', function () {
    SalonController::addSalon();
});

$route->post('/post/editSalon', function () {
    SalonController::editSalon();
});

$route->post('/post/addUsuario', function () {
    UsuarioController::addUsuarios();
});

$route->post('/post/editUsuario', function () {
    UsuarioController::RequireEditUsuario();
});

$route->get('/delete/deleteLogInventario/{id}', function ($id) {
    InventarioController::deleteLogInventory($id);
});

$route->post('/post/deleteSalon/{id}', function ($id) {
   SalonController::deleteSalon($id);
});

$route->get('/get/logsInventario', function () {
    InventarioController::logsInventarioAdd();
});

$route->post('/post/addLogInventory/', function(){
    InventarioController::addLogInventory();
});






$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$route->dispatch($path, $method);

?>