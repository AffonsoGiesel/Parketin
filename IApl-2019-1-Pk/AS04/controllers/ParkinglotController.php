<?php
    class ParkinglotController {

        function __construct() {

        }

        function listAll() {
            validateRequestType('GET');
            
            $result["edit"] = LANG_TEXT['THEME_BTN_EDIT'];
            $result["delete"] = LANG_TEXT['THEME_BTN_DELETE'];

            $result["page"] = LANG_TEXT['PL_LIST_TITLE'];
            $result["columns"] = [LANG_TEXT['PL_ID'], LANG_TEXT['PL_NAME'], LANG_TEXT['PL_SPACES']];

            $result["list"] = Parkinglot::listAll();

            returnJson($result);
        }

        function newForm() {
            validateRequestType('GET');

            $form = ["fields" => [
                ["name" => "name", "title" => LANG_TEXT['PL_NAME'], "type" => "text"],
                ["name" => "location", "title" => LANG_TEXT['PL_LOCATION'], "type" => "text"],
                ["name" => "spaces", "title" => LANG_TEXT['PL_SPACES'], "type" => "text"]
            ]];

            returnJson($form);
        }

        function editForm($id) {
            validateRequestType('GET');

            $pl = Parkinglot::load($id);

            $form = ["fields" => [
                ["name" => "name", "title" => LANG_TEXT['PL_NAME'], "type" => "text", "value" => $pl->getName()],
                ["name" => "location", "title" => LANG_TEXT['PL_LOCATION'], "type" => "text", "value" => $pl->getLocation()],
                ["name" => "spaces", "title" => LANG_TEXT['PL_SPACES'], "type" => "text", "value" => $pl->getSpaces()]
            ]];

            returnJson($form);
        }

        function create() {
            validateRequestType('POST');
            validatePostVariables('name', 'location', 'spaces');

            $pl = new Parkinglot();

            $pl->setName($_POST['name']);
            $pl->setLocation($_POST['location']);
            $pl->setSpaces($_POST['spaces']);

            $pl->save();

            returnJson(array());
        }

        function update($id) {
            validateRequestType('POST');
            validatePostVariables('name', 'location', 'spaces');

            $pl = Parkinglot::load($id);

            $pl->setName($_POST['name']);
            $pl->setLocation($_POST['location']);
            $pl->setSpaces($_POST['spaces']);

            $pl->update();

            returnJson(array());
        }

        function delete($id) {
            validateRequestType('DELETE');

            $pl = Parkinglot::load($id);
            $pl->delete();

            returnJson(array());
        }

        function __destruct() {

        }
    }
?>