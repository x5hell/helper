<?php

namespace Slov\Helper;


class StringHelper
{
    /** Замена в строке шаблонов на значения
     * @param string $string стоока с шаблонами
     * @param array $replace ассоциативный массив вида: шаблон => значение
     * @return string строка с значениями */
    public static function replacePatterns($string, array $replace)
    {
        return str_replace(
            array_keys($replace),
            array_values($replace),
            $string
        );
    }

    /**
     * @param string $text текст
     * @return string текст с заглавной первой буквой
     */
    public static function upperCaseFirstLetter($text)
    {
        $encoding = mb_internal_encoding();
        mb_internal_encoding("UTF-8");
        $result =
            mb_strtoupper(
                mb_substr($text, 0, 1)
            ).
            mb_substr($text, 1);
        mb_internal_encoding($encoding);
        return $result;
    }

    /** перевод строки из camelCase в snake_case
     * @param string $camelCase строка в camelCase
     * @return string строка в snake_case */
    public static function camelCaseToSnakeCase($camelCase)
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $camelCase, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }

    /** перевод строки из camelCase в SCREAMING_SNAKE_CASE
     * @param string $camelCase строка в camelCase
     * @return string строка в SCREAMING_SNAKE_CASE */
    public static function camelCaseToScreamingSnakeCase($camelCase)
    {
        return strtoupper(self::camelCaseToSnakeCase($camelCase));
    }
}
