<?php
use Migrations\AbstractSeed;

/**
 * AdAuthRules seed.
 */
class AdAuthRulesSeed extends AbstractSeed
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
                'parent_id' => '0',
                'name' => 'admin/articles/listPageMain',
                'title' => '文章管理',
                'condition' => NULL,
            ],
            [
                'id' => '2',
                'parent_id' => '0',
                'name' => 'admin/articles/onePageMain',
                'title' => '单页管理',
                'condition' => NULL,
            ],
            [
                'id' => '3',
                'parent_id' => '1',
                'name' => 'admin/articles/picPageManage',
                'title' => '图片列表管理',
                'condition' => NULL,
            ],
            [
                'id' => '4',
                'parent_id' => '1',
                'name' => 'admin/articles/listPageManage',
                'title' => '文章列表关联',
                'condition' => NULL,
            ],
            [
                'id' => '5',
                'parent_id' => '2',
                'name' => 'admin/articles/onePageManage',
                'title' => '单页面内容管理',
                'condition' => NULL,
            ],
            [
                'id' => '6',
                'parent_id' => '1',
                'name' => 'admin/articles/add',
                'title' => '添加',
                'condition' => NULL,
            ],
            [
                'id' => '7',
                'parent_id' => '1',
                'name' => 'admin/articles/delete',
                'title' => '删除',
                'condition' => NULL,
            ],
            [
                'id' => '8',
                'parent_id' => '1',
                'name' => 'admin/articles/edit',
                'title' => '编辑',
                'condition' => NULL,
            ],
            [
                'id' => '9',
                'parent_id' => '0',
                'name' => 'admin/arctypes/index',
                'title' => '栏目管理',
                'condition' => NULL,
            ],
            [
                'id' => '10',
                'parent_id' => '9',
                'name' => 'admin/arctypes/add',
                'title' => '新增',
                'condition' => NULL,
            ],
            [
                'id' => '11',
                'parent_id' => '9',
                'name' => 'admin/arctypes/edit',
                'title' => '编辑',
                'condition' => NULL,
            ],
            [
                'id' => '12',
                'parent_id' => '9',
                'name' => 'admin/arctypes/delete',
                'title' => '删除',
                'condition' => NULL,
            ],
            [
                'id' => '13',
                'parent_id' => '0',
                'name' => 'admin/roles/index',
                'title' => '管理员组',
                'condition' => NULL,
            ],
            [
                'id' => '14',
                'parent_id' => '13',
                'name' => 'admin/roles/add',
                'title' => '新增',
                'condition' => NULL,
            ],
            [
                'id' => '15',
                'parent_id' => '13',
                'name' => 'admin/roles/edit',
                'title' => '编辑',
                'condition' => NULL,
            ],
            [
                'id' => '16',
                'parent_id' => '13',
                'name' => 'admin/roles/delete',
                'title' => '删除',
                'condition' => NULL,
            ],
            [
                'id' => '17',
                'parent_id' => '13',
                'name' => 'admin/roles/manage',
                'title' => '菜单权限管理',
                'condition' => NULL,
            ],
            [
                'id' => '18',
                'parent_id' => '0',
                'name' => 'admin/users/index',
                'title' => '用户管理',
                'condition' => NULL,
            ],
            [
                'id' => '19',
                'parent_id' => '18',
                'name' => 'admin/users/add',
                'title' => '添加',
                'condition' => NULL,
            ],
            [
                'id' => '20',
                'parent_id' => '18',
                'name' => 'admin/users/edit',
                'title' => '编辑',
                'condition' => NULL,
            ],
            [
                'id' => '21',
                'parent_id' => '18',
                'name' => 'admin/users/delete',
                'title' => '删除',
                'condition' => NULL,
            ],
            [
                'id' => '22',
                'parent_id' => '0',
                'name' => 'admin/options/index',
                'title' => '系统设置',
                'condition' => NULL,
            ],
            [
                'id' => '23',
                'parent_id' => '0',
                'name' => 'admin/menus/index',
                'title' => '菜单管理',
                'condition' => NULL,
            ],
            [
                'id' => '24',
                'parent_id' => '23',
                'name' => 'admin/menus/add',
                'title' => '新增',
                'condition' => NULL,
            ],
            [
                'id' => '25',
                'parent_id' => '23',
                'name' => 'admin/menus/edit',
                'title' => '编辑',
                'condition' => NULL,
            ],
            [
                'id' => '26',
                'parent_id' => '23',
                'name' => 'admin/menus/delete',
                'title' => '删除',
                'condition' => NULL,
            ],
            [
                'id' => '27',
                'parent_id' => '0',
                'name' => 'admin/authRoles/index',
                'title' => '权限管理',
                'condition' => NULL,
            ],
            [
                'id' => '28',
                'parent_id' => '27',
                'name' => 'admin/authRoles/add',
                'title' => '新增',
                'condition' => NULL,
            ],
            [
                'id' => '29',
                'parent_id' => '27',
                'name' => 'admin/authRoles/edit',
                'title' => '编辑',
                'condition' => NULL,
            ],
            [
                'id' => '30',
                'parent_id' => '27',
                'name' => 'admin/authRoles/delete',
                'title' => '删除',
                'condition' => NULL,
            ],
            [
                'id' => '31',
                'parent_id' => '0',
                'name' => 'admin/upload/fileupload',
                'title' => '图片上传',
                'condition' => NULL,
            ],
            [
                'id' => '32',
                'parent_id' => '31',
                'name' => 'admin/upload/comm',
                'title' => '公共方法',
                'condition' => NULL,
            ],
        ];

        $table = $this->table('ad_auth_rules');
        $table->insert($data)->save();
    }
}
