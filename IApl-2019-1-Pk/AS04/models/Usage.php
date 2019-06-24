<?php

    class Usage {

        protected $_id;
        protected $_entryDate;
        protected $_exitDate;
        protected $_price;
        protected $_plate;
        protected $_employee;

        function __construct() {

        }

        static function load($id) {
            $usage = new self();
            $q = $GLOBALS['pdo']->query("SELECT * FROM pl_usage WHERE id='$id';");

            if ($q->rowCount() < 1) {
                returnJsonError(401, ERROR_MSG['UNAUTHORIZED']);
                die();
            } else {
                $result = $q->fetch(PDO::FETCH_ASSOC);

                $usage->_id = $result['id'];
                $usage->_entryDate = $result['entry_date'];
                $usage->_exitDate = $result['exit_date'];
                $usage->_price = $result['price'];
                $usage->_plate = $result['vehicle'];
                $usage->_employee = $result['employee'];
            }

            return $usage;
        }

        static function listAll() {
            $q = $GLOBALS['pdo']->query("SELECT u.id, u.entry_date, u.exit_date, e.name, v.plate, u.price
                FROM pl_usage u, employee e, vehicle v
                WHERE e.cpf = u.employee AND u.vehicle = v.id
                ORDER BY u.entry_date DESC");

            if ($q->rowCount() < 1) {
                return [];
            } else {
                return $q->fetchAll(PDO::FETCH_NUM);
            }
        }

        function getId() { return $this->_id; }
        function getEntryDate() { return $this->_entryDate; }
        function getExitDate() { return $this->_exitDate; }
        function getPrice() { return $this->_price; }
        function getPlate() { return $this->_plate; }
        function getEmployee() { return $this->_employee; }

        function setEntryDate($date) { $this->_entryDate = $date; }
        function setExitDate($date) { $this->_exitDate = $date; }
        function setPrice($price) { $this->_price = $price; }
        function setPlate($plate) { $this->_plate = $plate; }
        function setEmployee($employee) { $this->_employee = $employee; }

        function save() {
            $GLOBALS['pdo']->query("INSERT INTO pl_usage (entry_date, exit_date, price, vehicle, employee) VALUES 
                    ('$this->_entryDate', '$this->_exitDate', '$this->_price', '$this->_plate', '$this->_employee');");
        }

        function update() {
            $GLOBALS['pdo']->query("UPDATE pl_usage SET entry_date='$this->_entryDate', exit_date='$this->_exitDate',
                    price='$this->_price', vehicle='$this->_plate', employee='$this->_employee' WHERE id='$this->_id';");
        }

        function delete() {
            $GLOBALS['pdo']->query("DELETE FROM pl_usage WHERE id='$this->_id';");
        }

        function __destruct() {

        }
    }

?>