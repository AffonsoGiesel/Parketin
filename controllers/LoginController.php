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
                //TODO retornar erro de usuário não encontrado
                echo "Unauthorized";
            }
            else
            {
                $user_login = new Login($email);
                $session_id = $user_login->createNewSession();

                echo $session_id; //TODO
            }
        }

        // Debug function to generate an encrypted password manually
        function sha($pass){
            echo sha1($pass);
        }

        function __destruct() {

        }
    }
?>