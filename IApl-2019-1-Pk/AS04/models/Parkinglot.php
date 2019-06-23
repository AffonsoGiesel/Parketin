<?php

    class Parkinglot {

        protected $_id;
        protected $_name;
        protected $_location;
        protected $_spaces;

        function __construct() {

        }

        static function load($id) {
            $pl = new self();
            $q = $GLOBALS['pdo']->query("SELECT * FROM parkinglot WHERE id='$id';");

            if ($q->rowCount() < 1) {
                returnJsonError(401, ERROR_MSG['UNAUTHORIZED']);
                die();
            } else {
                $result = $q->fetch(PDO::FETCH_ASSOC);

                $pl->_id = $result['id'];
                $pl->_name = $result['name'];
                $pl->_location = $result['location'];
                $pl->_spaces = $result['spaces'];
            }

            return $pl;
        }

        static function listAll() {
            $q = $GLOBALS['pdo']->query("SELECT id, name, spaces FROM parkinglot ORDER BY id;");

            if ($q->rowCount() < 1) {
                return [];
            }
            else {
                return $q->fetchAll(PDO::FETCH_NUM);
            }
        }

        static function listNames() {
            $q = $GLOBALS['pdo']->query("SELECT id as value, name as title FROM parkinglot ORDER BY id;");

            if ($q->rowCount() < 1) {
                return [];
            }
            else {
                return $q->fetchAll(PDO::FETCH_ASSOC);
            }
        }

        function getId() { return $this->_id; }
        function getName() { return $this->_name; }
        function getLocation() { return $this->_location; }
        function getSpaces() { return $this->_spaces; }

        function setName($name) { $this->_name = $name; }
        function setLocation($location) { $this->_location = $location; }
        function setSpaces($spaces) { $this->_spaces = $spaces; }

        function save() {
            $GLOBALS['pdo']->query("INSERT INTO parkinglot (name, location, spaces) VALUES 
                ('$this->_name', '$this->_location', '$this->_spaces');");
        }

        function update() {
            $GLOBALS['pdo']->query("UPDATE parkinglot SET name='$this->_name', location='$this->_location',
                spaces='$this->_spaces' WHERE id='$this->_id';");
        }

        function delete() {
            $GLOBALS['pdo']->query("DELETE FROM parkinglot WHERE id='$this->_id';");
        }

        function __destruct() {

        }
    }

?>