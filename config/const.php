<?php
/**
 * 项目 全局静态变量
 * Created by PhpStorm.
 * User: jzaaa
 * Date: 2018/5/16
 * Time: 16:30
 */

/**
 * 项目bool类型转换
 */
if (!function_exists('getBool')) {
    function getBool($key = null)
    {
        $data = [
            1 => '是',
            2 => '否'
        ];

        if ($key === null) {
            return $data;
        }
        return $data[$key];
    }
}

if (!function_exists('getArtypeType')) {
    /**
     * 获取栏目类型
     * @param null|string $key 键名 ，若null则返回所有
     * @param bool $string 指定键名为string还是key;false为key,返回Key=>label;true为返回keywords => key
     * @return array|string
     */
    function getArtypeType($key = null, $string = false)
    {
        $source = [
            [ 'key' => 1, 'label' => '文章列表(文章)', 'keywords' => 'list' ],
            [ 'key' => 2, 'label' => '图片列表(文章)', 'keywords' => 'pic' ],
            [ 'key' => 3, 'label' => '单页', 'keywords' => 'page' ]
        ];
        $data = [];

        if ($string) {
            foreach ($source as $item) {
                $data[$item['keywords']] = $item['key'];
            }
        } else {
            foreach ($source as $item) {
                $data[$item['key']] = $item['label'];
            }
        }

        if ($key === null) {
            return $data;
        }
        return $data[$key];

    }
}
