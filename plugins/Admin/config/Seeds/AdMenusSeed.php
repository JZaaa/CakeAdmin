<?php
use Migrations\AbstractSeed;

/**
 * AdMenus seed.
 */
class AdMenusSeed extends AbstractSeed
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
                'name' => '系统管理',
                'parent_id' => '0',
                'level' => '1',
                'icon' => 'fa-cogs',
                'target' => '',
                'reload' => '',
                'sort' => '-99',
                'isshow' => '1',
                'created' => '2017-09-22 17:08:36',
                'modified' => '0000-00-00 00:00:00',
                'is_system' => '1',
            ],
            [
                'id' => '2',
                'name' => '系统管理',
                'parent_id' => '1',
                'level' => '2',
                'icon' => 'cogs',
                'target' => '',
                'reload' => '',
                'sort' => '0',
                'isshow' => '1',
                'created' => '2017-09-22 17:08:39',
                'modified' => '0000-00-00 00:00:00',
                'is_system' => '1',
            ],
            [
                'id' => '3',
                'name' => '管理员组',
                'parent_id' => '2',
                'level' => '3',
                'icon' => 'fa-caret-right',
                'target' => 'admin/roles/index',
                'reload' => 'roles',
                'sort' => '0',
                'isshow' => '1',
                'created' => '2017-09-22 17:08:41',
                'modified' => '0000-00-00 00:00:00',
                'is_system' => '1',
            ],
            [
                'id' => '4',
                'name' => '用户管理',
                'parent_id' => '2',
                'level' => '3',
                'icon' => 'fa-caret-right',
                'target' => 'admin/users/index',
                'reload' => 'users',
                'sort' => '0',
                'isshow' => '1',
                'created' => '2017-09-22 17:08:42',
                'modified' => '0000-00-00 00:00:00',
                'is_system' => '1',
            ],
            [
                'id' => '5',
                'name' => '系统设置',
                'parent_id' => '2',
                'level' => '3',
                'icon' => 'fa-caret-right',
                'target' => 'admin/options/index',
                'reload' => 'options',
                'sort' => '0',
                'isshow' => '1',
                'created' => '2017-09-22 17:08:44',
                'modified' => '0000-00-00 00:00:00',
                'is_system' => '1',
            ],
            [
                'id' => '6',
                'name' => '菜单管理',
                'parent_id' => '2',
                'level' => '3',
                'icon' => 'fa-caret-right',
                'target' => 'admin/menus/index',
                'reload' => 'menus',
                'sort' => '0',
                'isshow' => '1',
                'created' => '2017-09-22 17:08:51',
                'modified' => '0000-00-00 00:00:00',
                'is_system' => '1',
            ],
            [
                'id' => '7',
                'name' => '信息管理',
                'parent_id' => '0',
                'level' => '1',
                'icon' => 'fa-list-ul',
                'target' => '',
                'reload' => '',
                'sort' => '1',
                'isshow' => '1',
                'created' => '2017-09-22 17:08:53',
                'modified' => '0000-00-00 00:00:00',
                'is_system' => '1',
            ],
            [
                'id' => '8',
                'name' => '信息管理',
                'parent_id' => '7',
                'level' => '2',
                'icon' => 'list-ul',
                'target' => '',
                'reload' => '',
                'sort' => '0',
                'isshow' => '1',
                'created' => '2017-09-22 17:08:55',
                'modified' => '0000-00-00 00:00:00',
                'is_system' => '1',
            ],
            [
                'id' => '9',
                'name' => '栏目管理',
                'parent_id' => '8',
                'level' => '3',
                'icon' => 'fa-caret-right',
                'target' => 'admin/arctypes/index',
                'reload' => 'arctypes',
                'sort' => '0',
                'isshow' => '1',
                'created' => '2017-09-22 17:08:56',
                'modified' => '0000-00-00 00:00:00',
                'is_system' => '1',
            ],
            [
                'id' => '11',
                'name' => '单页',
                'parent_id' => '8',
                'level' => '3',
                'icon' => 'fa-caret-right',
                'target' => 'admin/articles/one-page-main',
                'reload' => 'onepagemain',
                'sort' => '97',
                'isshow' => '1',
                'created' => '2018-05-15 08:44:56',
                'modified' => '2018-05-16 07:04:18',
                'is_system' => '1',
            ],
            [
                'id' => '12',
                'name' => '文章',
                'parent_id' => '8',
                'level' => '3',
                'icon' => 'fa-caret-right',
                'target' => 'admin/articles/list-page-main',
                'reload' => 'listpagemain',
                'sort' => '99',
                'isshow' => '1',
                'created' => '2018-05-15 08:45:16',
                'modified' => '2018-05-16 07:44:37',
                'is_system' => '1',
            ],
            [
                'id' => '13',
                'name' => '权限管理',
                'parent_id' => '2',
                'level' => '3',
                'icon' => 'fa-caret-right',
                'target' => 'admin/auth-rules/index',
                'reload' => 'authrule',
                'sort' => '0',
                'isshow' => '1',
                'created' => '2018-05-17 15:01:38',
                'modified' => '2018-05-17 15:01:38',
                'is_system' => '1',
            ],
        ];

        $table = $this->table('ad_menus');
        $table->insert($data)->save();
    }
}
