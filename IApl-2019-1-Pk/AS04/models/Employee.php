<?php

    class Employee {

        protected $_cpf;
        protected $_name;
        protected $_rg;
        protected $_age;
        protected $_parkinglot;

        function __construct() {

        }

        static function load($cpf) {
            $employee = new self();
            $q = $GLOBALS['pdo']->query("SELECT * FROM employee WHERE cpf='$cpf';");

            if ($q->rowCount() < 1) {
                returnJsonError(401, ERROR_MSG['UNAUTHORIZED']);
                die();
            } else {
                $result = $q->fetch(PDO::FETCH_ASSOC);

                $employee->_cpf = $result['cpf'];
                $employee->_name = $result['name'];
                $employee->_rg = $result['rg'];
                $employee->_age = $result['age'];
                $employee->_parkinglot = $result['parkinglot'];
            }

            return $employee;
        }

        static function listAll() {
            $q = $GLOBALS['pdo']->query("SELECT e.cpf, e.name, pl.name AS parkinglot FROM employee e, parkinglot pl 
                WHERE e.parkinglot = pl.id ORDER BY e.name;");

            if ($q->rowCount() < 1) {
                return [];
            }
            else {
                return $q->fetchAll(PDO::FETCH_NUM);
            }
        }

        function getCpf() { return $this->_cpf; }
        function getName() { return $this->_name; }
        function getRg() { return $this->_rg; }
        function getAge() { return $this->_age; }
        function getParkinglot() { return $this->_parkinglot; }

        function setCpf($cpf) { $this->_cpf = $cpf; }
        function setName($name) { $this->_name = $name; }
        function setRg($rg) { $this->_rg = $rg; }
        function setAge($age) { $this->_age = $age; }
        function setParkinglot($pl) { $this->_parkinglot = $pl; }

        function save() {
            $GLOBALS['pdo']->query("INSERT INTO employee (cpf, name, rg, age, parkinglot) VALUES 
                        ('$this->_cpf', '$this->_name', '$this->_rg', '$this->_age', '$this->_parkinglot');");
        }

        function update() {
            $GLOBALS['pdo']->query("UPDATE employee SET name='$this->_name', rg='$this->_rg', age='$this->_age', parkinglot='$this->_parkinglot' WHERE cpf='$this->_cpf';");
        }

        function delete() {
            $GLOBALS['pdo']->query("DELETE FROM employee WHERE cpf='$this->_cpf';");
        }

        function __destruct() {

        }
    }

?>