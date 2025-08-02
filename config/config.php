<?php
    // define('BASE_URL', '/WebSistemC_P/');
    // define('BASE_URL', 'http://localhost:8080/');
    // define('BASE_URL', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/');
    // define('BASE_URL', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/');
    $https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') 
          || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');

    define('BASE_URL', ($https ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/');

    define('ROOT_PATH', realpath(__DIR__ . '/..') . '/');

?>