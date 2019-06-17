<?php
    class ParkinglotController {

        function __construct() {

        }

        function listAll() {
            validateRequestType('GET');

            $q = $GLOBALS['pdo']->query("SELECT id, nome, vagas FROM estacionamento ORDER BY id;");

            $result["new"] = LANG_TEXT[9];
            $result["edit"] = LANG_TEXT[10];
            $result["delete"] = LANG_TEXT[11];

            $result["page"] = LANG_TEXT[12];
            $result["columns"] = [LANG_TEXT[13], LANG_TEXT[14], LANG_TEXT[15]];

            if ($q->rowCount() < 1) {
                $result["list"] = [];
            }
            else {
                $result["list"] = $q->fetchAll(PDO::FETCH_NUM);
            }

            returnJson($result);
        }

        function __destruct() {

        }
    }
?>