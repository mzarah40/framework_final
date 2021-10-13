<?php 

require 'vendor/autoload.php';
require 'config/config.php';



$defaultController = DEFAULT_CONTROLLER . 'Controller';
$defaultMethod     = DEFAULT_METHOD;
$params            = [];


if ( isset( $_GET['url'] ) ) {
    
    $urlParts = explode('/', $_GET['url']);

    if ( isset($urlParts[0]) && $urlParts[0] != '') {
        $defaultController = ucfirst($urlParts[0]).'Controller';
    }

    array_shift($urlParts);

    if ( isset($urlParts[0]) && $urlParts[0] != '' ) {
        $defaultMethod = strtolower($urlParts[0]);
    }

    array_shift($urlParts);


    if( count($urlParts) > 0 ) {
        $params = $urlParts;
    }

}



try {


    if (class_exists('\App\Controller\\' . $defaultController)) {
        

        $class = "\App\Controller\\" . $defaultController;

        if ( method_exists($class, $defaultMethod) ) {
        
            call_user_func_array([new $class, $defaultMethod], $params);
        
        } else {
            
            echo "Pagina inexistente";
        
        }

    } else {
        
        echo "Pagina não encontrada."; 
    
    }


} catch (Exception $e) {
    
    echo "Código: " . $e->getMessage();

}




