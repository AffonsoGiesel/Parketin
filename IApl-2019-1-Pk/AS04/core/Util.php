<?php

    function dynamicLangText($index, $contents)
    {
        return vsprintf(LANG_TEXT[$index], $contents);
    }

    function validateRequestType($type)
    {
        if ($_SERVER['REQUEST_METHOD'] != $type)
        {
            header("HTTP/1.0 404 Not Found");
            die();
        }
    }

?>