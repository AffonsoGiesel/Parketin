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

        function __destruct() {

        }
    }
?>