<?php
    class UsageController {

        function __construct() {

        }

        function listAll() {
            validateRequestType('GET');

            $result["edit"] = LANG_TEXT['THEME_BTN_EDIT'];
            $result["delete"] = LANG_TEXT['THEME_BTN_DELETE'];

            $result["page"] = LANG_TEXT['USAGE_LIST_TITLE'];
            $result["columns"] = [LANG_TEXT['USAGE_ID'], LANG_TEXT['USAGE_ENTRY_DATE'], LANG_TEXT['USAGE_EXIT_DATE'], LANG_TEXT['USAGE_EMPLOYEE'], LANG_TEXT['USAGE_PLATE'], LANG_TEXT['USAGE_PRICE']];

            $result["list"] = Usage::listAll();

            returnJson($result);
        }

        function newForm() {
            validateRequestType('GET');

            $form = ["fields" => [
                ["name" => "entry_date", "title" => LANG_TEXT['USAGE_ENTRY_DATE_FORM'], "type" => "text"],
                ["name" => "exit_date", "title" => LANG_TEXT['USAGE_EXIT_DATE_FORM'], "type" => "text"],
                ["name" => "price", "title" => LANG_TEXT['USAGE_PRICE'], "type" => "text"],
                ["name" => "plate", "title" => LANG_TEXT['USAGE_PLATE'], "type" => "select", "options" => Vehicle::listNames()],
                ["name" => "employee", "title" => LANG_TEXT['USAGE_EMPLOYEE'], "type" => "select", "options" => Employee::listNames()],
            ]];

            returnJson($form);
        }

        function editForm($id) {
            validateRequestType('GET');

            $usage = Usage::load($id);

            $form = ["fields" => [
                ["name" => "entry_date", "title" => LANG_TEXT['USAGE_ENTRY_DATE_FORM'], "type" => "text", "value" => $usage->getEntryDate()],
                ["name" => "exit_date", "title" => LANG_TEXT['USAGE_EXIT_DATE_FORM'], "type" => "text", "value" => $usage->getExitDate()],
                ["name" => "price", "title" => LANG_TEXT['USAGE_PRICE'], "type" => "text", "value" => $usage->getPrice()],
                ["name" => "plate", "title" => LANG_TEXT['USAGE_PLATE'], "type" => "select", "options" => Vehicle::listNames(), "value" => $usage->getPlate()],
                ["name" => "employee", "title" => LANG_TEXT['USAGE_EMPLOYEE'], "type" => "select", "options" => Employee::listNames(), "value" => $usage->getEmployee()]
            ]];

            returnJson($form);
        }

        function create() {
            validateRequestType('POST');
            validatePostVariables( 'entry_date','exit_date', 'price', 'plate', 'employee');

            $usage = new Usage();

            $usage->setEntryDate($_POST['entry_date']);
            $usage->setExitDate($_POST['exit_date']);
            $usage->setPrice($_POST['price']);
            $usage->setPlate($_POST['plate']);
            $usage->setEmployee($_POST['employee']);

            $usage->save();

            returnJson(array());
        }

        function update($id) {
            validateRequestType('POST');
            validatePostVariables( 'entry_date','exit_date', 'price', 'plate', 'employee');

            $usage = Usage::load($id);

            $usage->setEntryDate($_POST['entry_date']);
            $usage->setExitDate($_POST['exit_date']);
            $usage->setPrice($_POST['price']);
            $usage->setPlate($_POST['plate']);
            $usage->setEmployee($_POST['employee']);

            $usage->update();

            returnJson(array());
        }

        function delete($id) {
            validateRequestType('DELETE');

            $usage = Usage::load($id);
            $usage->delete();

            returnJson(array());
        }

        function __destruct() {

        }
    }
?>