<?php


require_once __DIR__ . "/../core/MySQLConnect.php";
require_once __DIR__ . "/../core/Usuario.php";

class InventarioController
{

    private static $connection;

    public static function Connection(){
        try {
            self::$connection = new MySQLConnect("localhost", "root", "3810", "universidad");
            return self::$connection;
        } catch (Exception $e) {
            error_log("Error en la conexión: " . $e->getMessage());
        }
        return null;
    }


    public static function getAllRegisters(){
        $sql = "
            SELECT * FROM inventario JOIN universidad.tipo_articulos ta on inventario.id_tipo_articulo = ta.id_tipo_articulo
            JOIN universidad.salones s on inventario.id_salon = s.id_salon
            JOIN universidad.marcas m on inventario.id_marca = m.id_marca
            ";

        $items = [];
        try{
            $connection = self::Connection();
            $queryConnection = $connection->getConnection();
            $smnt = $queryConnection->prepare($sql);
            $smnt->execute();
            $result = $smnt->get_result();

            while ($rows = $result->fetch_assoc()) {
                $items[] = $rows;
            }

            $_SESSION["items"] = $items;
            $smnt->close();
            header("Location: /views/viewinventario");

        }catch(Exception $e){
            echo $e->getMessage();
        }

    }

    public static function logsInventarioAdd(){
        $tipos_articulos = "SELECT * FROM tipo_articulos";
        $tipos_marcas = "SELECT * FROM marcas";
        $salones = "SELECT * FROM salones";
        try{
            $connection = self::Connection();
            $queryConnection = $connection->getConnection();
            $smntArticulos = $queryConnection->prepare($tipos_articulos);
            $smntArticulos->execute();
            $resultArticulos = $smntArticulos->get_result();

            $smntMarcas = $queryConnection->prepare($tipos_marcas);
            $smntMarcas->execute();
            $resultMarcas = $smntMarcas->get_result();

            $smntSalones = $queryConnection->prepare($salones);
            $smntSalones->execute();
            $resultSalon = $smntSalones->get_result();

            $itemsArticulos = [];
            $itemsMarcas = [];
            $itemsSalones = [];

            while ($rowsArticulo = $resultArticulos->fetch_assoc()) {
                $itemsArticulos[] = $rowsArticulo;
            }

            while ($rowsMarca = $resultMarcas->fetch_assoc()) {
                $itemsMarcas[] = $rowsMarca;
            }

            while ($rowsSalon = $resultSalon->fetch_assoc()) {
                $itemsSalones[] = $rowsSalon;
            }

            $_SESSION["itemsArticulos"] = $itemsArticulos;
            $_SESSION["itemsMarcas"] = $itemsMarcas;
            $_SESSION["itemsSalones"] = $itemsSalones;

            $smntArticulos->close();
            $smntMarcas->close();
            $smntSalones->close();

            header("Location: /views/addLogInventario");

        }catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public static function addLogInventory(){
        $nombre_articulo = $_POST['articulo'];
        $descripcion_articulo = $_POST['descripcion_articulo'];
        $modelo_articulo = $_POST['modelo_articulo'];
        $serie_articulo = $_POST['serie_articulo'];
        $tipo_articulo = $_POST['tipo_articulo'];
        $tipo_marca = $_POST['tipo_marca'];
        $salon = $_POST['salon'];
        $prestamo = $_POST['prestamo'];
        $status = $_POST['status'];
        $registro_verificado = $_POST['registro_verificado'];

        try{
            if (
                isset($_POST['articulo'], $_POST['descripcion_articulo'], $_POST['modelo_articulo'],
                    $_POST['serie_articulo'], $_POST['tipo_articulo'], $_POST['tipo_marca'],
                    $_POST['salon'], $_POST['prestamo'], $_POST['status'], $_POST['registro_verificado'])
            ){
                $sql_add_log = "
                    INSERT INTO inventario 
                    (nombre_articulo, descripcion_articulo, modelo_articulo, serie_articulo, 
                     id_tipo_articulo, id_marca, id_salon, prestamo, status, registro_verificado) 
                    VALUES (?,?,?,?,?,?,?,?,?,?)
                ";

                $conecction = self::Connection();
                $queryConnection = $conecction->getConnection();
                $smnt = $queryConnection->prepare($sql_add_log);
                $smnt->bind_param(
                    "ssssiiissi",
                    $nombre_articulo,
                    $descripcion_articulo,
                    $modelo_articulo,
                    $serie_articulo,
                    $tipo_articulo,
                    $tipo_marca,
                    $salon,
                    $prestamo,
                    $status,
                    $registro_verificado
                );
                $smnt->execute();
                if ($smnt->affected_rows > 0) {
                    $smnt->close();
                    header("Location: /get/getAllRegisters");
                }else{
                    echo "ERROR";
                    $smnt->close();
                    header("Location: /get/getAllRegisters");
                }
            }
        }catch (Exception $e){
            echo $e->getMessage();
        }

    }

    public static function deleteLogInventory($id){
        try{
            $sql = "DELETE FROM inventario WHERE no_inventario = ?";
            $connection = self::Connection();
            $queryConnection = $connection->getConnection();
            $smnt = $queryConnection->prepare($sql);
            $smnt->bind_param("i", $id);
            $smnt->execute();

            if ($smnt->affected_rows > 1){
                header("Location: /get/getAllRegisters");
                $smnt->close();
            }else{
                header("Location: /get/getAllRegisters");
                $smnt->close();
            }
        }catch (Exception $e){
            echo "Prueba ". $e->getMessage();
        }

    }


}