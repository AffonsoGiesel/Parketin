<?php
    // Connection configuration

    $host = 'localhost';
    $database = 'parketin';
    $user = 'root';
    $password = '';

    // Connection object

    $pdo = new PDO('mysql:dbname='.$database.';host='.$host.';charset=UTF8', $user, $password);

    // Authenticate

    include_once('AuthWhitelist.php');

    if (!isset($auth_whitelist[strtolower($controller)]) || !in_array(strtolower($action),$auth_whitelist[strtolower($controller)]))
    {
        $auth_email = isset($_POST['auth_email']) ? strtolower(trim($_POST['auth_email'])) : '';
        $auth_session = isset($_POST['auth_session']) ? trim($_POST['auth_session']) : '';

        $user_login = new Login($auth_email);

        if (!$user_login->isValidSession($auth_session)) {
            returnJsonError(401, ERROR_MSG[2]);
            die();
        }
    }

?>