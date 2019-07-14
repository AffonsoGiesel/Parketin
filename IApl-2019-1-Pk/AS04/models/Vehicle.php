<?php

    class Vehicle {

        protected $_id;
        protected $_plate;
        protected $_owner;
        protected $_color;
        protected $_type;
        protected $_manufacture;
        protected $_model;

        function __construct() {

        }

        static function load($id) {
            $vehicle = new self();
            $q = $GLOBALS['pdo']->query("SELECT * FROM vehicle WHERE id='$id';");

            if ($q->rowCount() < 1) {
                returnJsonError(401, ERROR_MSG['UNAUTHORIZED']);
                die();
            } else {
                $result = $q->fetch(PDO::FETCH_ASSOC);

                $vehicle->_id = $result['id'];
                $vehicle->_plate = $result['plate'];
                $vehicle->_owner = $result['owner'];
                $vehicle->_color = $result['color'];
                $vehicle->_type = $result['type'];
                $vehicle->_manufacture = $result['manufacture'];
                $vehicle->_model = $result['model'];
            }

            return $vehicle;
        }

        static function listAll() {
            $q = $GLOBALS['pdo']->query("SELECT v.id, v.plate, v.model, v.color, c.name FROM vehicle v, `client` c 
                WHERE v.OWNER = c.id ORDER BY id;");

            if ($q->rowCount() < 1) {
                return [];
            }
            else {
                return $q->fetchAll(PDO::FETCH_NUM);
            }
        }

        static function listNames() {
            $q = $GLOBALS['pdo']->query("SELECT id as value, plate as title FROM vehicle ORDER BY id;");

            if ($q->rowCount() < 1) {
                return [];
            }
            else {
                return $q->fetchAll(PDO::FETCH_ASSOC);
            }
        }

        function getId() { return $this->_id; }
        function getPlate() { return $this->_plate; }
        function getOwner() { return $this->_owner; }
        function getColor() { return $this->_color; }
        function getType() { return $this->_type; }
        function getManufacture() { return $this->_manufacture; }
        function getModel() { return $this->_model; }

        function setPlate($plate) { $this->_plate = $plate; }
        function setOwner($owner) { $this->_owner = $owner; }
        function setColor($color) { $this->_color = $color; }
        function setType($type) { $this->_type = $type; }
        function setManufacture($manufacture) { $this->_manufacture = $manufacture; }
        function setModel($model) { $this->_model = $model; }

        function save() {
            $GLOBALS['pdo']->query("INSERT INTO vehicle (plate, owner, color, type, manufacture, model) VALUES 
                    ('$this->_plate', '$this->_owner', '$this->_color', '$this->_type', '$this->_manufacture', '$this->_model');");
        }

        function update() {
            $GLOBALS['pdo']->query("UPDATE vehicle SET plate='$this->_plate', owner='$this->_owner', color='$this->_color',
                    type='$this->_type', manufacture='$this->_manufacture', model='$this->_model' WHERE id='$this->_id';");
        }

        function delete() {
            $GLOBALS['pdo']->query("DELETE FROM vehicle WHERE id='$this->_id';");
        }

        function __destruct() {

        }
    }

?>