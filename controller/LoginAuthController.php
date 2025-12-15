<?php

require_once __DIR__ . "/../core/MySQLConnect.php";
require_once __DIR__ . "/../core/Usuario.php";

session_start();

class LoginAuthController
{
    static $error_log = "";
    static $mensaje = "";
    public static function login()
    {
        
        if (!empty($_POST['matricula']) && !empty($_POST['password'])) {
            $matricula = $_POST['matricula'];
            $password = $_POST['password'];

            $pass_hash = password_hash($password, PASSWORD_DEFAULT);

            try {
                $connection = new MySQLConnect(
                    "localhost",
                    "root",
                    "3810",
                    "universidad"
                );

                $queryConnection = $connection->getConnection();
                $query = "
                    SELECT * FROM usuarios JOIN cargos ON usuarios.id_cargo = cargos.id_cargo
                    WHERE cargos.id_cargo = usuarios.id_cargo AND usuarios.matricula_usuario = ?;
                ";

                $smnt = $queryConnection->prepare($query);
                $smnt->bind_param("s", $matricula);
                $smnt->execute();

                $result = $smnt->get_result();
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();

                    if (password_verify($password, $row['pass_usuario'])) {
                        $user = new Usuario(
                            $row['matricula_usuario'],
                            $row['nombre_usuario'],
                            $row['nombre_cargo']
                        );
                        $_SESSION['user'] = $user;
                    } else {
                        $_SESSION['error_log'] = "error";
                        $_SESSION['mensaje'] = "Contraseña incorrecta";
                        header('Location: /');
                        exit();
                    }

                    switch ($row['nombre_cargo']) {
                        case 'Administrativo':
                            header('Location: /views/viewadministrativo');
                            break;
                        case 'Docente':
                            header('Location: /views/viewdocente');
                            break;
                        case 'Laboratista':
                            header('Location: /views/viewlaboratista');
                            break;
                        default:
                            header('Location: /');
                            exit();
                    }
                } else {
                    $_SESSION['error_log'] = "error";
                    $_SESSION['mensaje'] = "Ha ocurrido un error";
                    header('Location: /');
                    exit;
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        } else {
            $_SESSION['error_log'] = "error";
            $_SESSION['mensaje'] = "Los datos son incorrectos";
            header('Location: /');
            exit;
        }
    }
}
