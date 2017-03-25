<?php
/**
 * Jakub "Jacob" Kadzielawa
 * programujemy.net
 * 25.03.17
 */

namespace Jacob\Utils;

/**
 * Class Debug
 * @package Jacob\Utils
 */
class Debug
{
    /**
     * @TODO dorobic zapisywane do pliku
     * @param $message
     * @return string
     */
    public static function log($message) {
        $debugText = '<pre>';
        $debugText .= var_dump($message);
        $debugText.='</pre>';
        return $debugText;
    }

    /**
     * @param $message
     * @return string
     */
    public static function showError($message) {
        $debugText = 'OJEJKU, BŁĄD! <pre>';
        $debugText .= var_dump($message);
        $debugText.='</pre>';
        return $debugText;
    }
}