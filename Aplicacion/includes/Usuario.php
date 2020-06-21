<?php
namespace es\fdi\ucm\aw;
#require_once __DIR__ . '/Aplicacion.php';

class Usuario
{

    public static function login($nombreUsuario, $password)
    {
        $user = self::buscaUsuario($nombreUsuario);
        if ($user && $user->compruebaPassword($password)) {
            return $user;
        }
        return false;
    }

    public static function getId($nombreUsuario)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query=sprintf("SELECT * FROM Usuarios U WHERE U.nombreUsuario = '%s'", $conn->real_escape_string($nombreUsuario));
        $rs = $conn->query($query);
        $result = false;
        if ($rs && $rs->num_rows == 1) {
            $fila = $rs->fetch_assoc();
            $user = new Usuario($fila['nombreUsuario'], $fila['nombre'], $fila['password'], $fila['rol']);
            $user->id = $fila['id'];
        }
        return $user->id;
    }

    public static function buscaUsuario($nombreUsuario)
  {
    $app = Aplicacion::getInstance();
    $conn = $app->conexionBd();
    $query=sprintf("SELECT * FROM Usuarios U WHERE U.nombreUsuario = '%s'", $conn->real_escape_string($nombreUsuario));
	  $rs = $conn->query($query);
    $result = false;
    if ($rs && $rs->num_rows == 1) {
      $fila = $rs->fetch_assoc();
      $user = new Usuario($fila['nombreUsuario'], $fila['nombre'], $fila['password'], $fila['rol']);
      $user->id = $fila['id'];
      $result = $user;
      $rs->free();


    }
    return $result;
  }

    public static function crea($nombreUsuario, $nombre, $password, $rol)
    {
        $user = self::buscaUsuario($nombreUsuario);
        if ($user) {
            return false;
        }
        $user = new Usuario($nombreUsuario, $nombre, password_hash($password, PASSWORD_DEFAULT), $rol);
        return self::guarda($user);
    }
    public static function guarda($usuario)
    {
        if ($usuario->id !== null) {
            return self::actualiza($usuario);
        }
        return self::inserta($usuario);
    }

    private static function inserta($usuario)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO Usuarios(nombreUsuario, nombre, password, rol) VALUES('%s', '%s', '%s', '%s')"
            , $conn->real_escape_string($usuario->nombreUsuario)
            , $conn->real_escape_string($usuario->nombre)
            , $conn->real_escape_string($usuario->password)
            , $conn->real_escape_string($usuario->rol));
        if ( $conn->query($query) ) {
            $usuario->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $usuario;
    }







    private $id;

    private $nombreUsuario;

    private $nombre;

    private $password;

    private $rol;

    private function __construct($nombreUsuario, $nombre, $password, $rol)
    {
        $this->nombreUsuario= $nombreUsuario;
        $this->nombre = $nombre;
        $this->password = $password;
        $this->rol = $rol;
    }





    public function compruebaPassword($password)
    {
        return password_verify($password, $this->password);
    }
}
