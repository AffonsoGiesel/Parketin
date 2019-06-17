<?php
    class UsageController {

        function __construct() {

        }

        function listAll() {
            validateRequestType('GET');

            $q = $GLOBALS['pdo']->query("SELECT dataEntrada, dataSaida, f.nome, v.placa, valorPagamento 
                FROM uso_do_estacionamento u, funcionario f, veiculo v
                WHERE f.cpf = u.funcionario AND u.veiculo = v.id
                ORDER BY dataEntrada DESC ");

            $result["new"] = LANG_TEXT[9];
            $result["edit"] = LANG_TEXT[10];
            $result["delete"] = LANG_TEXT[11];

            $result["page"] = LANG_TEXT[17];
            $result["columns"] = [LANG_TEXT[18], LANG_TEXT[19], LANG_TEXT[20], LANG_TEXT[21], LANG_TEXT[22]];

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