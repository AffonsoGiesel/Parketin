<?php
    class VehicleController {

        function __construct() {

        }

        function listAll() {
            validateRequestType('GET');

            $result["edit"] = LANG_TEXT['THEME_BTN_EDIT'];
            $result["delete"] = LANG_TEXT['THEME_BTN_DELETE'];

            $result["page"] = LANG_TEXT['VEHICLE_LIST_TITLE'];
            $result["columns"] = [LANG_TEXT['VEHICLE_ID'], LANG_TEXT['VEHICLE_PLATE'], LANG_TEXT['VEHICLE_MODEL'], LANG_TEXT['VEHICLE_COLOR'], LANG_TEXT['VEHICLE_OWNER']];

            $result["list"] = Vehicle::listAll();

            returnJson($result);
        }

        function newForm() {
            validateRequestType('GET');

            $form = ["fields" => [
                ["name" => "plate", "title" => LANG_TEXT['VEHICLE_PLATE'], "type" => "text"],
                ["name" => "owner", "title" => LANG_TEXT['VEHICLE_OWNER'], "type" => "select", "options" => Client::listNames()],
                ["name" => "color", "title" => LANG_TEXT['VEHICLE_COLOR'], "type" => "text"],
                ["name" => "type", "title" => LANG_TEXT['VEHICLE_TYPE'], "type" => "text"],
                ["name" => "manufacture", "title" => LANG_TEXT['VEHICLE_MANUFACTURE'], "type" => "text"],
                ["name" => "model", "title" => LANG_TEXT['VEHICLE_MODEL'], "type" => "text"],
            ]];

            returnJson($form);
        }

        function editForm($id) {
            validateRequestType('GET');

            $vehicle = Vehicle::load($id);

            $form = ["fields" => [
                ["name" => "plate", "title" => LANG_TEXT['EMPLOYEE_NAME'], "type" => "text", "value" => $vehicle->getPlate()],
                ["name" => "owner", "title" => LANG_TEXT['EMPLOYEE_PL'], "type" => "select", "options" => Client::listNames(), "value" => $vehicle->getOwner()],
                ["name" => "color", "title" => LANG_TEXT['EMPLOYEE_RG'], "type" => "text", "value" => $vehicle->getColor()],
                ["name" => "type", "title" => LANG_TEXT['EMPLOYEE_AGE'], "type" => "text", "value" => $vehicle->getType()],
                ["name" => "manufacture", "title" => LANG_TEXT['EMPLOYEE_AGE'], "type" => "text", "value" => $vehicle->getManufacture()],
                ["name" => "model", "title" => LANG_TEXT['EMPLOYEE_AGE'], "type" => "text", "value" => $vehicle->getModel()]
            ]];

            returnJson($form);
        }

        function create() {
            validateRequestType('POST');
            validatePostVariables( 'plate','owner', 'color', 'type', 'manufacture', 'model');

            $vehicle = new Vehicle();

            $vehicle->setPlate($_POST['plate']);
            $vehicle->setOwner($_POST['owner']);
            $vehicle->setColor($_POST['color']);
            $vehicle->setType($_POST['type']);
            $vehicle->setManufacture($_POST['manufacture']);
            $vehicle->setModel($_POST['model']);

            $vehicle->save();

            returnJson(array());
        }

        function update($id) {
            validateRequestType('POST');
            validatePostVariables( 'plate','owner', 'color', 'type', 'manufacture', 'model');

            $vehicle = Vehicle::load($id);

            $vehicle->setPlate($_POST['plate']);
            $vehicle->setOwner($_POST['owner']);
            $vehicle->setColor($_POST['color']);
            $vehicle->setType($_POST['type']);
            $vehicle->setManufacture($_POST['manufacture']);
            $vehicle->setModel($_POST['model']);

            $vehicle->update();

            returnJson(array());
        }

        function delete($id) {
            validateRequestType('DELETE');

            $vehicle = Vehicle::load($id);
            $vehicle->delete();

            returnJson(array());
        }

        function __destruct() {

        }
    }
?>