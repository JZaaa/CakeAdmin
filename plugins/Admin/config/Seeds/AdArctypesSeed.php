<?php
use Migrations\AbstractSeed;

/**
 * AdArctypes seed.
 */
class AdArctypesSeed extends AbstractSeed
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
                'name' => '首页',
                'parent_id' => '0',
                'level' => '1',
                'sort' => '0',
                'type' => '3',
                'image' => '',
                'isshow' => '1',
                'keywords' => NULL,
                'description' => '',
                'href' => '',
                'enable_columns' => '{"description":"1","keywords":"1","content":"1","image":"1"}',
            ],
            [
                'id' => '2',
                'name' => '幻灯片',
                'parent_id' => '1',
                'level' => '2',
                'sort' => '0',
                'type' => '2',
                'image' => '',
                'isshow' => '1',
                'keywords' => NULL,
                'description' => '',
                'href' => '',
                'enable_columns' => '{"description":"1","keywords":"1","image":"1","istop":"1","url":"1"}',
            ],
            [
                'id' => '3',
                'name' => '新闻',
                'parent_id' => '0',
                'level' => '1',
                'sort' => '0',
                'type' => '1',
                'image' => '',
                'isshow' => '1',
                'keywords' => NULL,
                'description' => '',
                'href' => '',
                'enable_columns' => '{"shorttitle":"1","color":"1","description":"1","keywords":"1","content":"1","image":"1","istop":"1"}',
            ],
            [
                'id' => '4',
                'name' => '关于我们',
                'parent_id' => '0',
                'level' => '1',
                'sort' => '0',
                'type' => '3',
                'image' => '',
                'isshow' => '1',
                'keywords' => NULL,
                'description' => '',
                'href' => '',
                'enable_columns' => '{"description":"1","keywords":"1","content":"1"}',
            ],
        ];

        $table = $this->table('ad_arctypes');
        $table->insert($data)->save();
    }
}
