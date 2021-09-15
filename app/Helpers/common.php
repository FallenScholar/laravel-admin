<?php

if (!function_exists('under_line_to_hump')) {

    /**
     * 下划线转驼峰
     *
     * @param string $str
     * @return string
     */
    function under_line_to_hump(string $str): string
    {
        $str = trim($str, '_');//去除前后下划线_
        $len = strlen($str);
        $out = strtoupper($str[0]);
        for ($i = 1; $i < $len; $i++) {
            if (ord($str[$i]) == ord('_')) {//如果当前是下划线，去除，并且下一位大写
                $out .= isset($str[$i + 1]) ? strtoupper($str[$i + 1]) : '';
                $i++;
            } else {
                $out .= $str[$i];
            }
        }
        return $out;
    }
}

if (!function_exists('hump_to_under_line')) {
    /**
     * 驼峰转下划线
     * @param string $str
     *
     * @return string
     */
    function hump_to_under_line(string $str): string
    {
        $len = strlen($str);
        $out = strtolower($str[0]);
        for ($i = 1; $i < $len; $i++) {
            if (ord($str[$i]) >= ord('A') && (ord($str[$i]) <= ord('Z'))) {
                $out .= '_' . strtolower($str[$i]);
            } else {
                $out .= $str[$i];
            }
        }
        return $out;
    }
}
