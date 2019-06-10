<?php

    function dynamicLangText($index, $contents)
    {
        return vsprintf(LANG_TEXT[$index], $contents);
    }

    function validateRequestType($type)
    {
        if ($_SERVER['REQUEST_METHOD'] != $type)
        {
            header("HTTP/1.0 404 Not Found"); //TODO
            die();
        }
    }

    function validatePostVariables(...$variables)
    {
        $notSet = array();

        foreach($variables as $var)
        {
            if (!isset($_POST[$var]) || trim($_POST[$var]) == false)
            {
                $notSet[] = $var;
            }
        }

        if (sizeof($notSet) > 0)
        {
            //TODO retornar json com erro.
            die();
        }
    }

?>