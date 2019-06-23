<?php

    class Usage {

        protected $_id;
        protected $_name;
        protected $_cpf;

        function __construct() {

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

        function __destruct() {

        }
    }

?>