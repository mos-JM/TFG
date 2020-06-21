<?php
#require_once __DIR__.'/Form.php';
#require_once __DIR__.'/Usuario.php';

namespace es\fdi\ucm\aw;


class FormularioLogin extends Form
{
  public function __construct() {
        parent::__construct('formLogin');
    }

    protected function generaCamposFormulario($datos)
    {
        $nombreUsuario = '';
        if ($datos) {
            $nombreUsuario = isset($datos['nombreUsuario']) ? $datos['nombreUsuario'] : $nombreUsuario;
        }
        $html = <<<EOF
        <fieldset>
            <div class="form-group">
                <div class="form-label-group">
                    <input type="text" id="inputEmail" class="form-control" placeholder="Email address" required="required" autofocus="autofocus" name="nombreUsuario" value="$nombreUsuario"/>
                    <label for="inputEmail">Email address</label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-label-group">
                    <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="required" name="password" />
                    <label for="inputPassword">Password</label>
                </div>
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me">
                        Remember Password
                    </label>
                </div>
            </div> 
            <button class="btn btn-primary btn-block" type="submit" name="login">Entrar</button>

        </fieldset>
        <div class="text-center">
          <a class="d-block small mt-3" href="register.php">Register an Account</a>
          <a class="d-block small" href="forgot-password.php">Forgot Password?</a>
        </div>
EOF;
        return $html;
    }

    protected function procesaFormulario($datos)
    {
        $result = array();

        $nombreUsuario = isset($datos['nombreUsuario']) ? $datos['nombreUsuario'] : null;

        if ( empty($nombreUsuario) ) {
            $result[] = "El nombre de usuario no puede estar vacío";
        }

        $password = isset($datos['password']) ? $datos['password'] : null;
        if ( empty($password) ) {
            $result[] = "El password no puede estar vacío.";
        }

        if (count($result) === 0) {
            $usuario = Usuario::login($nombreUsuario, $password);
            $idMed = Usuario::getId($nombreUsuario);
            if ( ! $usuario ) {
                // No se da pistas a un posible atacante
                $result[] = "El usuario o el password no coinciden";
            } else {
                $_SESSION['login'] = true;
                $_SESSION['nombre'] = $nombreUsuario;
                $_SESSION['idMedico'] = $idMed;
                $_SESSION['esAdmin'] = strcmp($fila['rol'], 'admin') == 0 ? true : false;
                $result = 'index.php';
            }
        }
        return $result;
    }
  }
