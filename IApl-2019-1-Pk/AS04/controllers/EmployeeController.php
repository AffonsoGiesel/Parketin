<?php
    class EmployeeController {

        function __construct() {

        }

        function listAll() {
            validateRequestType('GET');

            $result["edit"] = LANG_TEXT['THEME_BTN_EDIT'];
            $result["delete"] = LANG_TEXT['THEME_BTN_DELETE'];

            $result["page"] = LANG_TEXT['EMPLOYEE_LIST_TITLE'];
            $result["columns"] = [LANG_TEXT['EMPLOYEE_CPF'], LANG_TEXT['EMPLOYEE_NAME'], LANG_TEXT['EMPLOYEE_PL'], ];

            $result["list"] = Employee::listAll();

            returnJson($result);
        }

        function newForm() {
            validateRequestType('GET');

            $form = ["fields" => [
                ["name" => "cpf", "title" => LANG_TEXT['EMPLOYEE_CPF'], "type" => "text"],
                ["name" => "name", "title" => LANG_TEXT['EMPLOYEE_NAME'], "type" => "text"],
                ["name" => "rg", "title" => LANG_TEXT['EMPLOYEE_RG'], "type" => "text"],
                ["name" => "age", "title" => LANG_TEXT['EMPLOYEE_AGE'], "type" => "text"],
                ["name" => "pl", "title" => LANG_TEXT['EMPLOYEE_PL'], "type" => "select", "options" => Parkinglot::listNames()]
            ]];

            returnJson($form);
        }

        function editForm($id) {
            validateRequestType('GET');

            $employee = Employee::load($id);

            $form = ["fields" => [
                ["name" => "name", "title" => LANG_TEXT['EMPLOYEE_NAME'], "type" => "text", "value" => $employee->getName()],
                ["name" => "rg", "title" => LANG_TEXT['EMPLOYEE_RG'], "type" => "text", "value" => $employee->getRg()],
                ["name" => "age", "title" => LANG_TEXT['EMPLOYEE_AGE'], "type" => "text", "value" => $employee->getAge()],
                ["name" => "pl", "title" => LANG_TEXT['EMPLOYEE_PL'], "type" => "select", "options" => Parkinglot::listNames(), "value" => $employee->getParkinglot()],
            ]];

            returnJson($form);
        }

        function create() {
            validateRequestType('POST');
            validatePostVariables( 'cpf','name', 'rg', 'age', 'pl');

            $employee = new Employee();

            $employee->setCpf($_POST['cpf']);
            $employee->setName($_POST['name']);
            $employee->setRg($_POST['rg']);
            $employee->setAge($_POST['age']);
            $employee->setParkinglot($_POST['pl']);

            $employee->save();

            returnJson(array());
        }

        function update($cpf) {
            validateRequestType('POST');
            validatePostVariables('name', 'rg', 'age', 'pl');

            $employee = Employee::load($cpf);

            $employee->setName($_POST['name']);
            $employee->setRg($_POST['rg']);
            $employee->setAge($_POST['age']);
            $employee->setParkinglot($_POST['pl']);

            $employee->update();

            returnJson(array());
        }

        function delete($cpf) {
            validateRequestType('DELETE');

            $employee = Employee::load($cpf);
            $employee->delete();

            returnJson(array());
        }

        function __destruct() {

        }
    }
?>