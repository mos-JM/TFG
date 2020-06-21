<?php
namespace es\fdi\ucm\aw;

#require_once __DIR__.'/Form.php';
#require_once __DIR__.'/Usuario.php';

class FormularioPaciente extends Form
{
    public function __construct() {
        parent::__construct('formRegistro');
    }
    
    protected function generaCamposFormulario($datos)
    {
        $nombre = '';
        $apellidos = '';
        $dni = '';
        $fechaNacimineto = '';
        $notasMedicas = '';

      



        if ($datos) {
            $nombre = isset($datos['nombre']) ? $datos['nombre'] : $nombre;
            $apellidos = isset($datos['apellidos']) ? $datos['apellidos'] : $apellidos;
        }
        $html = <<<EOF
        <fieldset>
        <div class="form-group">
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-label-group">
                        <input id="name" class="form-control" type="text" placeholder="Nombre" required="required" autofocus="autofocus" name="nombre" value="$nombre" />
                        <label for="name">Nombre</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-label-group">
                        <input id="lastName" class="form-control" type="text" placeholder="First name" required="required" name="apellidos" value="$apellidos" >
                        <label for="lastName">Apellidos</label>
                    </div>
                </div>
            </div>
        </div>
		<div class="form-group">
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-label-group">
                        <input id="FechNac" class="form-control" type="text" placeholder="FechaNacimiento" required="required"  name="fechaNacimineto" value="$fechaNacimineto" />
                        <label for="FechNac">FechaNacimiento (yyyy-mm-dd)</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-label-group">
                        <input id="dni" class="form-control" type="text" placeholder="DNI" required="required" name="dni" value="$dni" >
                        <label for="dni">DNI</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
        <label>Seleccione el genero</label>
            <div class="form-row">
                <div class="col-md-2">
                    <div class="form-label-group">
                        <select class="form-control" name="genero" >
                            <option value = masculino>Masculino</option>
                            <option value = femenino>Femenino</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
        <label>Seleccione el grado de dependencia marcado por el indice de Barthel</label>
            <div class="form-row">
                <div class="col-md-2">
                    <div class="form-label-group">
                        <select class="form-control" name="iBarthel">
                            <option value = total>Total</option>
                            <option value = grave>Grave</option>
                            <option value = moderada>Moderada</option>
                            <option value = leve>Leve</option>
                            <option value = independiente>Independiente</option>
                        </select>
                    </div>
                </div>  
            </div>
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="col-md-12">
                    <div class="form-label-group">
                        <input id="note" class="form-control" type="text" placeholder="Notas" required="required"  name="notasMedicas" value="$notasMedicas" />
                        <label for="note">Notas</label>
                    </div>
                </div>
            </div>
        </div>
		
        <button class="btn btn-primary btn-block" type="submit" name="paciente">Registrar nuevo paciente</button>
            
        </fieldset>
        
EOF;
       
        return $html;
    }

    protected function procesaFormulario($datos)
    {
        $result = array();

        $user = Paciente::crea($datos['nombre'], $datos['apellidos'], $datos['dni'], $datos['fechaNacimineto'], $datos['genero'], $datos['notasMedicas'], $datos['iBarthel']);
        

        if ( ! $user ) {
            $result[] = "El paciente ya existe";
        } 
        
        return $result;
    }
}