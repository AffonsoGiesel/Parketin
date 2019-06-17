<?php
    class LoginController {

        function __construct() {

        }

        function home() {
            validateRequestType('GET');
            include('./views/LoginScreen.php');
        }

        function authenticate() {
            validateRequestType('POST');
            validatePostVariables('email', 'password');

            $email = $_POST['email'];
            $password = $_POST['password'];

            $user_login = new Login($email);

            if (!$user_login->isValidPassword($password))
            {
                returnJsonError(401, ERROR_MSG[2]);
            }
            else
            {
                $user_login = new Login($email);
                $session_id = $user_login->createNewSession();

                returnJson(array("email" => $email, "session_id" => $session_id));
            }
        }

        function homeLoggedIn() {
            validateRequestType("GET");
            include('./views/HomeContent.php');
        }

        // Debug function to generate an encrypted password manually
        function sha($pass){
            echo sha1($pass);
        }

        function __destruct() {

        }
    }
?>