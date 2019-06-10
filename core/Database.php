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

        $q = $pdo->query("SELECT * FROM login WHERE email='$auth_email';");

        if (!$q)
            echo "Falha ao comunicar com o banco de dados.";
        else if ($q->rowCount() < 1) {
            header("HTTP/1.0 401 Unauthorized");
            die();
        }
        else {
            $login = $q->fetch(PDO::FETCH_ASSOC);

            if ($login['session'] != $auth_session)
            {
                header("HTTP/1.0 401 Unauthorized");
                die();
            }
        }
    }

?>