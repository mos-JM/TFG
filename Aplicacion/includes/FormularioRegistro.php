<?php
namespace es\fdi\ucm\aw;

#require_once __DIR__.'/Form.php';
#require_once __DIR__.'/Usuario.php';

class FormularioRegistro extends Form
{
    public function __construct() {
        parent::__construct('formRegistro');
    }
    
    protected function generaCamposFormulario($datos)
    {
        $nombreUsuario = '';
        $nombre = '';
        if ($datos) {
            $nombreUsuario = isset($datos['nombreUsuario']) ? $datos['nombreUsuario'] : $nombreUsuario;
            $nombre = isset($datos['nombre']) ? $datos['nombre'] : $nombre;
        }
        $html = <<<EOF
        <fieldset>
        <div class="form-group">
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-label-group">
                        <input id="firstName" class="form-control" type="email" placeholder="First name" required="required" autofocus="autofocus" name="nombreUsuario" value="$nombreUsuario" />
                        <label for="firstName">Email address</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-label-group">
                        <input id="nombre" class="form-control" type="text" placeholder="First name" required="required" name="nombre" value="$nombre" >
                        <label for="nombre">Nombre completo</label>
                    </div>
                </div>
            </div>
        </div>
		<div class="form-group">
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-label-group">	
                        <input id="inputPassword" class="form-control" type="password" placeholder="Password" required="required" name="password" >
                        <label for="inputPassword">Password</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-label-group">
                        <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm password" required="required" name="password2" >
                        <label for="confirmPassword">Confirm password</label>
                    </div>
                </div>
            </div>
        </div>
		
		<button class="btn btn-primary btn-block" type="submit" name="registro">Registrar</button></div>
		</fieldset>
EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        $result = array();
        
        $nombreUsuario = isset($datos['nombreUsuario']) ? $datos['nombreUsuario'] : null;
        
        if ( empty($nombreUsuario) || mb_strlen($nombreUsuario) < 5 ) {
            $result[] = "El nombre de usuario tiene que tener una longitud de al menos 5 caracteres.";
        }
        
        $nombre = isset($datos['nombre']) ? $datos['nombre'] : null;
        if ( empty($nombre) || mb_strlen($nombre) < 5 ) {
            $result[] = "El nombre tiene que tener una longitud de al menos 5 caracteres.";
        }
        
        $password = isset($datos['password']) ? $datos['password'] : null;
        if ( empty($password) || mb_strlen($password) < 5 ) {
            $result[] = "El password tiene que tener una longitud de al menos 5 caracteres.";
        }
        $password2 = isset($datos['password2']) ? $datos['password2'] : null;
        if ( empty($password2) || strcmp($password, $password2) !== 0 ) {
            $result[] = "Los passwords deben coincidir";
        }
        
        if (count($result) === 0) {
            $user = Usuario::crea($nombreUsuario, $nombre, $password, 'user');
            if ( ! $user ) {
                $result[] = "El usuario ya existe";
            } else {
                $_SESSION['login'] = true;
                $_SESSION['nombre'] = $nombreUsuario;
                $result = 'login.php';
            }
        }
        return $result;
    }
}