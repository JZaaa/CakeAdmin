<?php
use Migrations\AbstractSeed;

/**
 * AdOptions seed.
 */
class AdOptionsSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $this->execute('set names utf8');

        $data = [
            [
                'id' => '1',
                'name' => '系统名称',
                'field' => 'systemname',
                'value' => 'CakeCMS管理系统',
                'type' => 'system',
                'autoload' => 'yes',
            ],
            [
                'id' => '2',
                'name' => '系统logo',
                'field' => 'systemlogo',
                'value' => 'img/cake-logo.png',
                'type' => 'system',
                'autoload' => 'yes',
            ],
            [
                'id' => '3',
                'name' => '显示系统名称',
                'field' => 'systemnamehide',
                'value' => '1',
                'type' => 'system',
                'autoload' => 'yes',
            ],
            [
                'id' => '4',
                'name' => '起始年份',
                'field' => 'systemyear',
                'value' => '2018',
                'type' => 'system',
                'autoload' => 'yes',
            ],
            [
                'id' => '5',
                'name' => '底部信息',
                'field' => 'systemfoot',
                'value' => 'Copyright © 2018 CakeCMS',
                'type' => 'system',
                'autoload' => 'yes',
            ],
            [
                'id' => '6',
                'name' => '百度地图',
                'field' => 'baidu',
                'value' => '',
                'type' => 'other',
                'autoload' => 'yes',
            ],
            [
                'id' => '7',
                'name' => '云片短信',
                'field' => 'yunpian',
                'value' => '',
                'type' => 'other',
                'autoload' => 'yes',
            ],
            [
                'id' => '8',
                'name' => '站点名称',
                'field' => 'sitename',
                'value' => '',
                'type' => 'site',
                'autoload' => 'yes',
            ],
            [
                'id' => '9',
                'name' => '站点副名称',
                'field' => 'sitefuname',
                'value' => '',
                'type' => 'site',
                'autoload' => 'yes',
            ],
            [
                'id' => '10',
                'name' => '站点描述',
                'field' => 'sitedesc',
                'value' => '',
                'type' => 'site',
                'autoload' => 'yes',
            ],
            [
                'id' => '11',
                'name' => '关键词',
                'field' => 'sitekeywords',
                'value' => '',
                'type' => 'site',
                'autoload' => 'yes',
            ],
            [
                'id' => '12',
                'name' => '版权信息',
                'field' => 'sitecopyright',
                'value' => '',
                'type' => 'site',
                'autoload' => 'yes',
            ],
            [
                'id' => '13',
                'name' => '备案编号',
                'field' => 'siteicpsn',
                'value' => '',
                'type' => 'site',
                'autoload' => 'yes',
            ],
            [
                'id' => '14',
                'name' => '统计代码',
                'field' => 'sitestatistics',
                'value' => '',
                'type' => 'site',
                'autoload' => 'yes',
            ],
            [
                'id' => '15',
                'name' => '登录名称',
                'field' => 'systemlogin',
                'value' => 'CakeCMS管理系统',
                'type' => 'system',
                'autoload' => 'yes',
            ],
            [
                'id' => '16',
                'name' => NULL,
                'field' => 'systemfulltext',
                'value' => '1',
                'type' => 'system',
                'autoload' => 'yes',
            ],
        ];

        $table = $this->table('ad_options');
        $table->insert($data)->save();
    }
}
