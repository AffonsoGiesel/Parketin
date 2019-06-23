<?php
    class UsageController {

        function __construct() {

        }

        function listAll() {
            validateRequestType('GET');

            $q = $GLOBALS['pdo']->query("SELECT u.id, u.entry_date, u.exit_date, e.name, v.plate, u.price
                FROM pl_usage u, employee e, vehicle v
                WHERE e.cpf = u.employee AND u.vehicle = v.id
                ORDER BY u.entry_date DESC");

            $result["edit"] = LANG_TEXT['THEME_BTN_EDIT'];
            $result["delete"] = LANG_TEXT['THEME_BTN_DELETE'];

            $result["page"] = LANG_TEXT['USAGE_LIST_TITLE'];
            $result["columns"] = [LANG_TEXT['USAGE_ID'], LANG_TEXT['USAGE_ENTRY_DATE'], LANG_TEXT['USAGE_EXIT_DATE'], LANG_TEXT['USAGE_EMPLOYEE'], LANG_TEXT['USAGE_PLATE'], LANG_TEXT['USAGE_PRICE']];

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