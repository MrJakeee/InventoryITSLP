<?php

use function PHPSTORM_META\type;

require_once __DIR__ . '/../core/MySQLConnect.php';

class UsuarioController
{

  public static function Connection()
  {
    $connect = new MySQLConnect("localhost", "root", "3810", "universidad");
    return $connect;
  }

  public static $queryConnection;

  public static function getUsuarios()
  {
    try {
      self::$queryConnection = self::Connection()->getConnection();
      $queryUsuario = "select matricula_usuario, nombre_usuario, nombre_cargo from usuarios
                      JOIN cargos ON usuarios.id_cargo = cargos.id_cargo";
      $smnt = self::$queryConnection->prepare($queryUsuario);
      $smnt->execute();
      $result = $smnt->get_result();
      while ($rows = $result->fetch_assoc()) {
        $usuarios[] = $rows;
      }
      $_SESSION['users'] = $usuarios;
      header('Location: /views/viewusuarios');
      exit();
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }


  public static function deleteUsuario($id)
  {
    try {
      $queryDelete = "delete from usuarios where matricula_usuario = ?";
      self::$queryConnection = self::Connection()->getConnection();
      $smnt = self::$queryConnection->prepare($queryDelete);
      $smnt->bind_param("s", $id);
      $smnt->execute();
      if ($smnt->affected_rows > 0) {
        echo "Se ha elimiado correctamente";
        header('Location: /get/dataUsuarios');
        exit();
      } else {
        echo "No se ha podido eliminar correctamente al usuario";
      }
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  public static function getDataInputUsuario()
  {
    try {
      $queryCargo = "select * from cargos";
      self::$queryConnection = self::Connection()->getConnection();
      $smnt = self::$queryConnection->prepare($queryCargo);
      $smnt->execute();
      $result = $smnt->get_result();
      while ($rows = $result->fetch_assoc()) {
        $cargos[] = $rows;
      }
      $_SESSION['cargos'] = $cargos;
      header('Location: /views/addUsuario');
      exit();
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  public static function addUsuarios()
  {
    $nombre_usuario = $_POST['nombre_usuario'];
    $pass_usuario = $_POST['pass_usuario'];
    $id_cargo = $_POST['id_cargo'];

    $password = password_hash($pass_usuario, PASSWORD_DEFAULT);
    try {
      $queryAddUsuario = "INSERT INTO usuarios (nombre_usuario, pass_usuario, id_cargo) VALUES (?,?,?)";
      self::$queryConnection = self::Connection()->getConnection();
      $smnt = self::$queryConnection->prepare($queryAddUsuario);
      $smnt->bind_param("ssi", $nombre_usuario, $password, $id_cargo);
      $smnt->execute();
      if ($smnt->affected_rows > 0) {
        header("Location: /get/dataUsuarios");
        exit();
      } else {
        echo "No se ha podido agregar correctamente al usuario";
      }
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  public static function getDataUser($id)
  {
    $query = "SELECT * FROM usuarios JOIN cargos ON usuarios.id_cargo = cargos.id_cargo WHERE matricula_usuario = ?";
    $querycargos = "SELECT * FROM cargos";
    try {
      self::$queryConnection = self::Connection()->getConnection();
      $smnt = self::$queryConnection->prepare($query);
      $smnt->bind_param("i", $id);
      $smnt->execute();

      $usuariobyId = [];
      $result = $smnt->get_result();
      if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        $usuariobyId = $usuario;
      }

      $smnt1 = self::$queryConnection->prepare($querycargos);
      $smnt1->execute();
      $cargos = [];
      $result = $smnt1->get_result();
      while ($rows = $result->fetch_assoc()) {
        $cargos[] = $rows;
      }

      $_SESSION['cargos'] = $cargos;
      $_SESSION['getDataUser'] = $usuariobyId;
      header('Location: /views/editUsuario');
      exit();
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  public static function RequireEditUsuario()
  {
    $nombre_usuario = $_POST['usuarioNombre'];
    $password = $_POST['usuarioPassword'];
    $id_cargo = $_POST['cargo'];

    $usuario = $_SESSION['getDataUser'];
    $matricula_usuario = $usuario['matricula_usuario'];
    if (empty(trim($password))) {
      $pass_usuario = $usuario['pass_usuario'];
    } else {
      $pass_usuario = password_hash($password, PASSWORD_DEFAULT);
    }

    self::editUser($matricula_usuario, $nombre_usuario, $pass_usuario, $id_cargo);
  }

  public static function editUser($matricula_usuario, $nombre_usuario, $password, $id_cargo)
  {
    $query = "UPDATE usuarios SET matricula_usuario = ?, nombre_usuario = ?, pass_usuario = ?, id_cargo = ? WHERE matricula_usuario = ?";
    self::$queryConnection = self::Connection()->getConnection();
    $smnt = self::$queryConnection->prepare($query);
    $smnt->bind_param("issii", $matricula_usuario, $nombre_usuario, $password, $id_cargo, $matricula_usuario);
    $smnt->execute();
    if ($smnt->affected_rows > 0) {
      header("Location: /get/dataUsuarios");
      exit();
    } else {
      echo "No se ha podido editar correctamente al usuario";
    }
  }
}
