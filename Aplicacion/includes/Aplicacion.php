<?php

namespace es\fdi\ucm\aw;

/*
mi Singleton
sólo exista una instancia del objeto en todo el programa,
 y que sea accesible desde todo el programa
 si no se instancia nunca el objeto, no se crea, con
 lo que no se gasta tiempo ni espacio innecesariamente.
*/
class Aplicacion
{
  private static $instance;
  /*Array con todos los datos necesarios para crear la conexion*/
  private $datosBD;
  private $conn;

  /**
  * is not allowed to call from outside to prevent from creating multiple instances,
  * to use the singleton, you have to obtain the instance from Singleton::getInstance() instead
  */
  private function __construct(){}
  /**
  * Evita que se pueda utilizar el operador clone.
  */

  private function __clone()
  {
    throw new \Exception('No tiene sentido el clonado');
  }

  /**
  * Evita que se pueda utilizar serialize().
  */
  public function __sleep()
  {
    throw new \Exception('No tiene sentido el serializar el objeto');
  }

  /**
  * Evita que se pueda utilizar unserialize().
  */
  public function __wakeup()
  {
    throw new \Exception('No tiene sentido el deserializar el objeto');
  }

  /**
  * gets the instance via lazy initialization (created on first usage)
  */
  public static function getInstance()
  {
    if (  !self::$instance instanceof self) {
      self::$instance = new self;
    }
    return self::$instance;
  }
  /* Ejemplo llamada
  $firstInstance = Singleton::getInstance();
  $secondInstance = new Singleton();
  */

  /*
  */
  public function init($datosBD)
  {
    $this->datosBD = $datosBD;
    session_start();
  }

  /*crea una conexión con el servidor MySQL y devolve,
   o si ya existe una devolver la que ya exista.
   */
  public function conexionbD()
  {
    if (! $this->conn ) {
      $bdHost = $this->datosBD['host'];
      $bdUser = $this->datosBD['user'];
      $bdPass = $this->datosBD['pass'];
      $bd = $this->datosBD['bd'];

      $this->conn = new \mysqli($bdHost, $bdUser, $bdPass, $bd);
      if ( $this->conn->connect_errno ) {
        echo "Error de conexión a la BD: (" . $this->conn->connect_errno . ") " . utf8_encode($this->conn->connect_error);
        exit();
      }
      if ( ! $this->conn->set_charset("utf8mb4")) {
        echo "Error al configurar la codificación de la BD: (" . $this->conn->errno . ") " . utf8_encode($this->conn->error);
        exit();
      }
    }
    return $this->conn;
  }



}
