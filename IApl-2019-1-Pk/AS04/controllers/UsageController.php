<?php
    class UsageController {

        function __construct() {

        }

        function listAll() {
            validateRequestType('GET');

            $q = $GLOBALS['pdo']->query("SELECT u.id, u.dataEntrada, u.dataSaida, f.nome, v.placa, u.valorPagamento 
                FROM uso_do_estacionamento u, funcionario f, veiculo v
                WHERE f.cpf = u.funcionario AND u.veiculo = v.id
                ORDER BY dataEntrada DESC ");

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