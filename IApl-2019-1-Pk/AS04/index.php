<?php

    function __autoload($className) {
         if (file_exists('./controllers/' . $className . '.php')) {
            require_once('./controllers/' . $className . '.php');
        } else {
             header("HTTP/1.0 404 Not Found");
             die();
        }
    }

    $url = isset($_GET['url']) ? $_GET['url']:'login';
    global $url;

    $urlArray = array();
    $urlArray = explode("/",$url);

    $controller = $urlArray[0];
    array_shift($urlArray);
    $action = isset($urlArray[0]) ? strtolower($urlArray[0]) : 'home';
    array_shift($urlArray);

    $controller = ucwords($controller); // Converts to Camelcase
    $controller .= "Controller";
    $instance = new $controller();

    if (method_exists($controller, $action)) {
        call_user_func_array(array($instance,$action),$urlArray);
    } else {
        header("HTTP/1.0 404 Not Found");
        die();
    }

?>