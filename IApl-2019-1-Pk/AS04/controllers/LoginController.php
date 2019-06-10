<?php
    class LoginController {

        function __construct() {

        }

        function home() {
            validateRequestType('GET');
            include('./views/LoginScreen.php');
        }

        function __destruct() {

        }
    }
?>