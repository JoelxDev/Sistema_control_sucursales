<?php
    // define('BASE_URL', '/WebSistemC_P/');
    // define('BASE_URL', 'http://localhost:8080/');
    // -------------------------------------------------------------------------------------------------------
    // $https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') 
    // || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');
    
    // define('BASE_URL', ($https ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/');
    
    // define('ROOT_PATH', realpath(__DIR__ . '/..') . '/');
    // -------------------------------------------------------------------------------------------------------
    // Localhost -- ELIMINAR AL HACER UN PUSH
    // define('BASE_URL', '/WebSistemC_P/');
    define('BASE_URL', 'http://localhost:8080/');
    define('ROOT_PATH', realpath(__DIR__ . '/..') . '/');

?>