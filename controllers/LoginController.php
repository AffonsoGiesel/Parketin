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
            echo $_POST['email'] . '<br />' . $_POST['password'];
        }

        function sha($pass){
            echo sha1($pass);
        }

        function __destruct() {

        }
    }
?>