<?php

    class Client {

        protected $_id;
        protected $_name;
        protected $_cpf;

        function __construct() {

        }

        static function load($id) {
            $client = new self();
            $q = $GLOBALS['pdo']->query("SELECT * FROM client WHERE id='$id';");

            if ($q->rowCount() < 1) {
                returnJsonError(401, ERROR_MSG['UNAUTHORIZED']);
                die();
            } else {
                $result = $q->fetch(PDO::FETCH_ASSOC);

                $client->_id = $result['id'];
                $client->_name = $result['name'];
                $client->_cpf = $result['cpf'];
            }

            return $client;
        }

        static function listAll() {
            $q = $GLOBALS['pdo']->query("SELECT id, cpf, name FROM client ORDER BY id;");

            if ($q->rowCount() < 1) {
                return [];
            }
            else {
                return $q->fetchAll(PDO::FETCH_NUM);
            }
        }

        static function listNames() {
            $q = $GLOBALS['pdo']->query("SELECT id as value, name as title FROM client ORDER BY id;");

            if ($q->rowCount() < 1) {
                return [];
            }
            else {
                return $q->fetchAll(PDO::FETCH_ASSOC);
            }
        }

        function getId() { return $this->_id; }
        function getName() { return $this->_name; }
        function getCpf() { return $this->_cpf; }

        function setName($name) { $this->_name = $name; }
        function setCpf($cpf) { $this->_cpf = $cpf; }

        function save() {
            $GLOBALS['pdo']->query("INSERT INTO client (name, cpf) VALUES 
                    ('$this->_name', '$this->_cpf');");
        }

        function update() {
            $GLOBALS['pdo']->query("UPDATE client SET name='$this->_name', cpf='$this->_cpf' WHERE id='$this->_id';");
        }

        function delete() {
            $GLOBALS['pdo']->query("DELETE FROM client WHERE id='$this->_id';");
        }

        function __destruct() {

        }
    }

?>