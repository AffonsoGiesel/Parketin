<?php

    include_once('./core/Util.php');

    function __autoload($className) {
        if (file_exists('./controllers/' . $className . '.php')) {
            require_once('./controllers/' . $className . '.php');
        } else if (file_exists('./models/' . $className . '.php')) {
            require_once('./models/' . $className . '.php');
        } else {
            http_response_code(404);
            die();
        }
    }

    $url = isset($_GET['url']) ? $_GET['url'] : '';
    global $url;

    $urlArray = array();
    $urlArray = explode("/",$url);

    $lang = isset($urlArray[0]) && trim($urlArray[0]) != false ? strtolower($urlArray[0]) : 'br';
    define('LANG', $lang);
    array_shift($urlArray);
    $controller = isset($urlArray[0]) && trim($urlArray[0]) != false ? strtolower($urlArray[0]) : 'login';
    array_shift($urlArray);
    $action = isset($urlArray[0]) && trim($urlArray[0]) != false ? strtolower($urlArray[0]) : 'home';
    array_shift($urlArray);

    if (file_exists('./language/' . $lang . '.php')) {
        require_once('./language/' . $lang . '.php');
        define('LANG_TEXT', $lang_text);
        define('ERROR_MSG', $error_msg);
    } else {
        http_response_code(404);
        die();
    }

    include_once('./core/Database.php');

    $controller = ucwords($controller); // Converts to Camelcase
    $controller .= "Controller";
    $instance = new $controller();

    if (method_exists($controller, $action)) {
        try {
            call_user_func_array(array($instance, $action), $urlArray);
        } catch (ArgumentCountError $e) {
            returnJsonError(400, ERROR_MSG['PARAMS']);
        }
    } else {
        http_response_code(404);
        die();
    }

?>