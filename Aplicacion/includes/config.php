<?php
//namespace es\fdi\ucm\aw;
#require_once __DIR__.'/Aplicacion.php';

define('BD_HOST', 'localhost');
define('BD_NAME', 'tfg');
define('BD_USER', 'tfg');
define('BD_PASS', 'tfg');
/**
* Configuración del soporte de UTF-8, localización (idioma y país) */
ini_set('default_charset', 'UTF-8');
setLocale(LC_ALL, 'es_ES.UTF.8');
date_default_timezone_set('Europe/Madrid');



spl_autoload_register(function ($class) {

    // project-specific namespace prefix
    $prefix = 'es\\fdi\\ucm\\aw\\';

    // base directory for the namespace prefix
    $base_dir = __DIR__ . '/';

    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    // if the file exists, require it

    //print_r ($file);

    if (file_exists($file)) {
        require $file;
    }
});
/* */
/* Inicialización del objeto aplicacion */
/* */
$app = \es\fdi\ucm\aw\Aplicacion::getInstance();
$app->init(array('host'=>BD_HOST, 'bd'=>BD_NAME, 'user'=>BD_USER, 'pass'=>BD_PASS));

?>
