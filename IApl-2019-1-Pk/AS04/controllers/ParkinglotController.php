<?php
    class ParkinglotController {

        function __construct() {

        }

        function listAll() {
            validateRequestType('GET');

            $q = $GLOBALS['pdo']->query("SELECT id, name, spaces FROM parkinglot ORDER BY id;");

            $result["edit"] = LANG_TEXT['THEME_BTN_EDIT'];
            $result["delete"] = LANG_TEXT['THEME_BTN_DELETE'];

            $result["page"] = LANG_TEXT['PL_LIST_TITLE'];
            $result["columns"] = [LANG_TEXT['PL_ID'], LANG_TEXT['PL_NAME'], LANG_TEXT['PL_SPACES']];

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