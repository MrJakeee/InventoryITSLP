
<?php

require_once __DIR__ . "/../core/MySQLConnect.php";
require_once __DIR__ . "/../core/Usuario.php";
class SalonController
{

    private static $connection;

    private static $user;

    public static function init()
    {
        require_once __DIR__ . "/../core/Usuario.php";
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        self::$user = $_SESSION['user'];
    }

    public static function Connection()
    {
        try {
            self::$connection = new MySQLConnect("localhost", "root", "3810", "universidad");
            return self::$connection;
        } catch (Exception $e) {
            error_log("Error en la conexión: " . $e->getMessage());
        }
    }

    public static function getData()
    {
        self::init();
        try {
            $connection = self::Connection();
            $queryConnection = $connection->getConnection();
            $query = "select * from salones JOIN tipo_salones ON salones.id_tipo_salon = tipo_salones.id_tipo_salon
            JOIN edificio ON salones.id_edificio = edificio.id_edificio;";

            $smnt = $queryConnection->prepare($query);
            $smnt->execute();

            $result = $smnt->get_result();

            $salones = [];
            while ($row = $result->fetch_assoc()) {
                $salones[] = $row;
            }

            $_SESSION["salones"] = $salones;

            switch (self::$user->getCargoUsuario()){
                case "Administrativo":
                    header('Location: /views/viewsalones');
                    break;
                case "Laboratista":
                    header('Location: /views/viewsaloneslaboratista');
                    break;

                case "default":
                    header("Location: /");
            }

        } catch (Exception $e) {
            error_log("Error en la consulta: " . $e->getMessage());
        }
    }


    public static function deleteSalon($id_salon){
        try {
            $connection = self::Connection();
            $queryConnection = $connection->getConnection();
            $query = "DELETE FROM salones WHERE id_salon = ?";
            $smnt = $queryConnection->prepare($query);
            $smnt->bind_param("i", $id_salon);
            $smnt->execute();

            if ($smnt->affected_rows > 0) {
                echo "Salon eliminado con exito";
                $smnt->close();
                header('Location: /get/datasalones');
            } else {
                echo "Salon no eliminado";
                $smnt->close();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public static function addSalon()
    {
        $codigo_salon = $_POST['codigo_salon'];
        $id_edificio = $_POST['id_edificio'];
        $activo = $_POST['id_status'];
        $id_tipo_salon = $_POST['id_tipo_salon'];
        try {
            $query = "INSERT INTO salones (id_edificio, codigo_salon, activo, id_tipo_salon) VALUES (?, ?, ?, ?)";
            $connection = self::Connection();
            $queryConnection = $connection->getConnection();

            $smnt = $queryConnection->prepare($query);
            $smnt->bind_param("issi", $id_edificio, $codigo_salon, $activo, $id_tipo_salon);
            $smnt->execute();

            if ($smnt->affected_rows > 0) {
                header("Location: /get/datasalones");
                exit();
            } else {
                echo "Salon no agregado";
            }
            $smnt->close();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public static function getDataInputSalon()
    {
        try {
            $queryEdificio = "select id_edificio, codigo_edificio from edificio";
            $querytipoSalon = "select id_tipo_salon, nombre_tipo_salon from tipo_salones";

            $connection = self::Connection();
            $queryConnection = $connection->getConnection();
            $smnt = $queryConnection->prepare($queryEdificio);
            $smnt->execute();
            $result = $smnt->get_result();
            $edificios = [];
            while ($row = $result->fetch_assoc()) {
                $edificios[] = $row;
            }

            $_SESSION['edificios'] = $edificios;

            $smnt1 = $queryConnection->prepare($querytipoSalon);
            $smnt1->execute();
            $result1 = $smnt1->get_result();
            $tiposSalones = [];
            while ($row = $result1->fetch_assoc()) {
                $tiposSalones[] = $row;
            }

            $_SESSION['tiposSalones'] = $tiposSalones;
            header('Location: /views/addSalon');
            exit();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public static function getDataSalonSpecific($id_salon)
    {
        try {
            $querySalon = "SELECT * FROM salones JOIN edificio ON salones.id_edificio = edificio.id_edificio
                JOIN tipo_salones ON salones.id_tipo_salon = tipo_salones.id_tipo_salon WHERE id_salon = ?;";
            $connection = self::Connection();
            $queryConnection = $connection->getConnection();
            $smnt = $queryConnection->prepare($querySalon);
            $smnt->bind_param("i", $id_salon);
            $smnt->execute();
            if ($result = $smnt->get_result()) {
                $row = $result->fetch_assoc();
                $_SESSION['salon'] = $row;
                header('Location: /views/salon/editSalon.php');
                exit();
            } else {
                echo 'Error';
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public static function editSalon()
    {
        $salon = $_SESSION['salon'];
        $codigo_salon = $_POST['codigo_salon'];
        $activo = $_POST['id_status'];
        $id_salon = $salon['id_salon'];
        try {
            $querySalonEdit = "UPDATE salones
                    SET codigo_salon = ? , activo = ? WHERE id_salon = ?";
            $connection = self::Connection();
            $queryConnection = $connection->getConnection();
            $smnt = $queryConnection->prepare($querySalonEdit);
            $smnt->bind_param("sii", $codigo_salon, $activo, $id_salon);
            $smnt->execute();

            if ($smnt->affected_rows > 0) {
                echo "Se ha realizado correctamente";
                header("Location: /get/datasalones");
            } else {
                echo "La consulta ha fallado";
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

?>