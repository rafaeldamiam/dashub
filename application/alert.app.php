<?php

/**
 * 
 */
class Alert
{
    
    public static function alertInit()
    {
        if(!isset($_SESSION["alert"])){
            $_SESSION["alert"] = array();
        }
    }

    public static function alertGetMessages()
    {
        if(!empty($_SESSION["alert"])){
            return $_SESSION["alert"];
        }
    }

    public static function showAlert($msg, $level = "danger")
    {
        $_SESSION["alertLevel"] = $level;
        $_SESSION["alert"][] = $msg;
    }

    public static function alertClear()
    {
        $_SESSION["alert"] = array();
        $_SESSION["alertLevel"] = "danger";
    }

    public static function alertComponentRender()
    {
        if(!empty($_SESSION["alert"])){
            $msgs = implode(',', $_SESSION["alert"]);
        $alertLevel = $_SESSION["alertLevel"];

        $html = '<div class="alert alert-' . $alertLevel . '" role="alert">';
        $html .= '<strong>' . $msgs . '</strong>';
        $html .= '</div>';

        alertClear();

        echo $html;
        }
    }

    public static function jsCaution($text)
    {
        echo "<script>alert('{$text}');</script>";
    }
}

Alert::alertInit();