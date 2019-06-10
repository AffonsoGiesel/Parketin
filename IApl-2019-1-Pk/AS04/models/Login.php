<?php

    class Login {

        protected $_email;
        protected $_password;
        protected $_session;
        protected $_level;

        function __construct($email) {
            $q = $GLOBALS['pdo']->query("SELECT * FROM login WHERE email='$email';");

            if ($q->rowCount() < 1) {
               header("HTTP/1.0 401 Unauthorized"); //TODO
               die();
            }
            else {
                $login = $q->fetch(PDO::FETCH_ASSOC);

                $this->_email = $login['email'];
                $this->_level = $login['nivel'];
                $this->_password = $login['senha'];
                $this->_session = $login['session'];
            }
        }

        function isValidPassword($pass) {
            return $this->_password == sha1($pass);
        }

        function isValidSession($session_id) {
            return $this->_session == $session_id;
        }

        function createNewSession() {
            $this->_session = md5(uniqid(rand(), true));

            $GLOBALS['pdo']->query("UPDATE login SET `session` = '$this->_session' WHERE `email` = '$this->_email'");

            return $this->_session;
        }

        function __destruct() {

        }
    }

?>