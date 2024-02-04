<?php

/**
 *  CLASSE DebugUtility -> Armazena funções para uso de depuração, para chamar essa função basta digitar DebugUtility::dd($VARIAVEL);
 */
class Debug
{
    public static function dd($data) {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
        die();
    }

    public static function dump($data) {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
        echo '<br>';
    }
}