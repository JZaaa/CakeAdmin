<?php
/**
 * 全局函数
 * Created by PhpStorm.
 * User: jzaaa
 * Date: 2018/5/16
 * Time: 10:16
 */

/**
 * 中文字符串替换
 */
if ((!function_exists('str_replace_zh')) &&
    (function_exists('mb_substr')) && (function_exists('mb_strlen')) && (function_exists('mb_strpos'))) {

    function str_replace_zh($search, $replace, $subject)
    {
        if (is_array($subject)) {
            $ret = array();
            foreach ($subject as $key => $val) {
                $ret[$key] = str_replace_zh($search, $replace, $val);
            }
            return $ret;
        }

        foreach ((array)$search as $key => $s) {
            if ($s == '' && $s !== 0) {
                continue;
            }
            $r = !is_array($replace) ? $replace : (array_key_exists($key, $replace) ? $replace[$key] : '');
            $pos = mb_strpos($subject, $s, 0, 'UTF-8');
            while ($pos !== false) {
                $subject = mb_substr($subject, 0, $pos, 'UTF-8') . $r . mb_substr($subject, $pos + mb_strlen($s, 'UTF-8'), 65535, 'UTF-8');
                $pos = mb_strpos($subject, $s, $pos + mb_strlen($r, 'UTF-8'), 'UTF-8');
            }
        }
        return $subject;
    }
}


/**
 * 字符串数据过滤
 * @param string $str 过滤字符串
 * @param array|string $filter 过滤字符
 * @return string
 */
if (!function_exists('str_filter') && function_exists('str_replace_zh')) {
    function str_filter($str, $filter = ["\r\n", "\r", "\n", "'", "\""])
    {
        return str_replace_zh($filter, "", $str);
    }
}

