<?php
    class ClientController {

        function __construct() {

        }

        function listAll() {
            validateRequestType('GET');

            $result["edit"] = LANG_TEXT['THEME_BTN_EDIT'];
            $result["delete"] = LANG_TEXT['THEME_BTN_DELETE'];

            $result["page"] = LANG_TEXT['CLIENT_LIST_TITLE'];
            $result["columns"] = [LANG_TEXT['CLIENT_ID'], LANG_TEXT['CLIENT_CPF'], LANG_TEXT['CLIENT_NAME']];

            $result["list"] = Client::listAll();

            returnJson($result);
        }

        function newForm() {
            validateRequestType('GET');

            $form = ["fields" => [
                ["name" => "cpf", "title" => LANG_TEXT['CLIENT_CPF'], "type" => "text"],
                ["name" => "name", "title" => LANG_TEXT['CLIENT_NAME'], "type" => "text"]
            ]];

            returnJson($form);
        }

        function editForm($id) {
            validateRequestType('GET');

            $client = Client::load($id);

            $form = ["fields" => [
                ["name" => "cpf", "title" => LANG_TEXT['CLIENT_CPF'], "type" => "text", "value" => $client->getCpf()],
                ["name" => "name", "title" => LANG_TEXT['CLIENT_NAME'], "type" => "text", "value" => $client->getName()]
            ]];

            returnJson($form);
        }

        function create() {
            validateRequestType('POST');
            validatePostVariables('name', 'cpf');

            $client = new Client();

            $client->setName($_POST['name']);
            $client->setCpf($_POST['cpf']);

            $client->save();

            returnJson(array());
        }

        function update($id) {
            validateRequestType('POST');
            validatePostVariables('name', 'cpf');

            $client = Client::load($id);

            $client->setName($_POST['name']);
            $client->setCpf($_POST['cpf']);

            $client->update();

            returnJson(array());
        }

        function delete($id) {
            validateRequestType('DELETE');

            $client = Client::load($id);
            $client->delete();

            returnJson(array());
        }

        function __destruct() {

        }
    }
?>