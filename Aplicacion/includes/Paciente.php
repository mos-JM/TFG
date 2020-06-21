<?php
    namespace es\fdi\ucm\aw;
#require_once __DIR__ . '/Aplicacion.php';

class Paciente
{

    public static function login($nombreUsuario, $password)
    {
        $user = self::buscaUsuario($nombreUsuario);
        if ($user && $user->compruebaPassword($password)) {
            return $user;
        }
        return false;
    }



    public static function buscaUsuario($nombre, $apellidos)
    {
    $app = Aplicacion::getInstance();
    $conn = $app->conexionBd();
    $query=sprintf("SELECT * FROM Pacientes U WHERE U.nombre = '%s' AND U.apellidos = '%s'", $conn->real_escape_string($nombre), $conn->real_escape_string($apellidos));
	  $rs = $conn->query($query);
    $result = false;
    if ($rs && $rs->num_rows == 1) {
      $fila = $rs->fetch_assoc();
      $user = new Paciente($fila['nombre'], $fila['apellidos'], $fila['dni'], $fila['fechaNacimineto'], $fila['sexo'], $fila['notasMedicas'], $fila['IndiceBarthel']);
      $user->id = $fila['id'];
      $result = $user;
      $rs->free();


    }
    return $result;
  }

    public static function crea($nombre, $apellidos, $dni, $fechaNacimineto, $sexo, $notasMedicas, $IndiceBarthel)
    {
        $user = self::buscaUsuario($nombre, $apellidos);
        if ($user) {
            return false;
        }
        $user = new Paciente($nombre, $apellidos, $dni, $fechaNacimineto, $sexo, $notasMedicas, $IndiceBarthel);
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
        $query=sprintf("INSERT INTO Pacientes(nombre, apellidos, dni, fechaNacimineto, sexo, notasMedicas, IndiceBarthel, idMedico) VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')"
            , $conn->real_escape_string($usuario->nombre)
            , $conn->real_escape_string($usuario->apellidos)
            , $conn->real_escape_string($usuario->dni)
            , $conn->real_escape_string($usuario->fechaNacimineto)
            , $conn->real_escape_string($usuario->sexo)
            , $conn->real_escape_string($usuario->notasMedicas)
            , $conn->real_escape_string($usuario->IndiceBarthel)
            , $conn->real_escape_string($usuario->idMedico));
        if ( $conn->query($query) ) {
            $usuario->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $usuario;
    }


    private $id;

    private $nombre;

    private $apellidos;

    private $dni;

    private $fechaNacimineto;

    private $sexo;

    private $notasMedicas;

    private $IndiceBarthel;

    private $idMedico;

    private function __construct($nombre, $apellidos, $dni, $fechaNacimineto, $sexo, $notasMedicas, $IndiceBarthel)
    {
                            
        $this->nombre= $nombre;
        $this->apellidos = $apellidos;
        $this->dni = $dni;
        $this->fechaNacimineto = $fechaNacimineto;
        $this->sexo= $sexo;
        $this->notasMedicas = $notasMedicas;
        $this->IndiceBarthel = $IndiceBarthel;
        $this->idMedico = $_SESSION['idMedico'];
        
    }





    public function compruebaPassword($password)
    {
        return password_verify($password, $this->password);
    }
}
