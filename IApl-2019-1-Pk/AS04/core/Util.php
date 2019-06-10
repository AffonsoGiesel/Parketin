<?php

    function dynamicLangText($index, $contents)
    {
        return vsprintf(LANG_TEXT[$index], $contents);
    }

    function validateRequestType($type)
    {
        if ($_SERVER['REQUEST_METHOD'] != $type)
        {
            returnJsonError(404, ERROR_MSG[0]);
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
            returnJsonError(400, ERROR_MSG[1], array("fields" => $notSet));
            die();
        }
    }

    function returnJson($data)
    {
        returnJsonError(200, "", $data);
    }

    function returnJsonError($code, $message, $data = array())
    {
        $json = ["code" => $code, "error" => $message, "data" => $data];

        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode($json);
    }

?>