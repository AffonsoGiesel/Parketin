<?php

    class Login {

        protected $_email;
        protected $_password;
        protected $_session;
        protected $_level;

        function __construct() {

        }

        static function load($email) {
            $login = new self();
            $q = $GLOBALS['pdo']->query("SELECT * FROM login WHERE email='$email';");

            if ($q->rowCount() < 1) {
                returnJsonError(401, ERROR_MSG['UNAUTHORIZED']);
                die();
            } else {
                $login_db = $q->fetch(PDO::FETCH_ASSOC);

                $login->_email = $login_db['email'];
                $login->_level = $login_db['access_level'];
                $login->_password = $login_db['password'];
                $login->_session = $login_db['session'];
            }

            return $login;
        }

        static function listAll() {
            $q = $GLOBALS['pdo']->query("SELECT email, access_level FROM login ORDER BY email;");

            if ($q->rowCount() < 1) {
                return [];
            } else {
                return $q->fetchAll(PDO::FETCH_NUM);
            }
        }

        function getAccessLevel() { return $this->_level; }

        function setEmail($email) { $this->_email = $email; }
        function setPassword($pass) { $this->_password = sha1($pass); }
        function setAccessLevel($level) { $this->_level = $level; }

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

        function save() {
            $GLOBALS['pdo']->query("INSERT INTO login (email, password, access_level) VALUES 
                    ('$this->_email', '$this->_password', '$this->_level');");
        }

        function update() {
            $GLOBALS['pdo']->query("UPDATE login SET password='$this->_password', access_level='$this->_level' email='$this->_email';");
        }

        function delete() {
            $GLOBALS['pdo']->query("DELETE FROM login WHERE email='$this->_email';");
        }

        function __destruct() {

        }
    }

?>