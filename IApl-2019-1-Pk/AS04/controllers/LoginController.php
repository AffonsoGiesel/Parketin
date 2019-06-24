<?php
    class LoginController {

        function __construct() {

        }

        function home() {
            validateRequestType('GET');
            include('./views/LoginScreen.php');
        }

        function authenticate() {
            validateRequestType('POST');
            validatePostVariables('email', 'password');

            $email = $_POST['email'];
            $password = $_POST['password'];

            $user_login = Login::load($email);

            if (!$user_login->isValidPassword($password))
            {
                returnJsonError(401, ERROR_MSG['UNAUTHORIZED']);
            }
            else
            {
                $session_id = $user_login->createNewSession();

                returnJson(array("email" => $email, "session_id" => $session_id));
            }
        }

        function homeLoggedIn() {
            validateRequestType("GET");
            include('./views/HomeContent.php');
        }

        function listAll() {
            validateRequestType('GET');

            $result["edit"] = LANG_TEXT['THEME_BTN_EDIT'];
            $result["delete"] = LANG_TEXT['THEME_BTN_DELETE'];

            $result["page"] = LANG_TEXT['LOGIN_LIST_TITLE'];
            $result["columns"] = [LANG_TEXT['LOGIN_EMAIL'], LANG_TEXT['LOGIN_ACCESS_LEVEL']];

            $result["list"] = Login::listAll();

            returnJson($result);
        }

        function newForm() {
            validateRequestType('GET');

            $form = ["fields" => [
                ["name" => "email", "title" => LANG_TEXT['LOGIN_EMAIL'], "type" => "text"],
                ["name" => "password", "title" => LANG_TEXT['LOGIN_PASSWORD'], "type" => "text"],
                ["name" => "access_level", "title" => LANG_TEXT['LOGIN_ACCESS_LEVEL'], "type" => "text"]
            ]];

            returnJson($form);
        }

        function editForm($id) {
            validateRequestType('GET');

            $login = Login::load($id);

            $form = ["fields" => [
                ["name" => "password", "title" => LANG_TEXT['LOGIN_PASSWORD'], "type" => "text", "value" => ""],
                ["name" => "access_level", "title" => LANG_TEXT['LOGIN_ACCESS_LEVEL'], "type" => "text", "value" => $login->getAccessLevel()]
            ]];

            returnJson($form);
        }

        function create() {
            validateRequestType('POST');
            validatePostVariables( 'email','password', 'access_level');

            $login = new Login();

            $login->setEmail($_POST['email']);
            $login->setPassword($_POST['password']);
            $login->setAccessLevel($_POST['access_level']);

            $login->save();

            returnJson(array());
        }

        function update($email) {
            validateRequestType('POST');
            validatePostVariables( 'access_level');

            $login = Login::load($email);

            if (isset($_POST['password']) && strlen(trim($_POST['password'])) > 0)
                $login->setPassword($_POST['password']);
            $login->setAccessLevel($_POST['access_level']);

            $login->update();

            returnJson(array());
        }

        function delete($email) {
            validateRequestType('DELETE');

            $login = Login::load($email);
            $login->delete();

            returnJson(array());
        }

        // Debug function to generate an encrypted password manually
        function sha($pass){
            echo sha1($pass);
        }

        function __destruct() {

        }
    }
?>