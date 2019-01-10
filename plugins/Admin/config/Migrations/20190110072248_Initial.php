<?php
use Migrations\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class Initial extends AbstractMigration
{

    public $autoId = false;

    public function up()
    {
        $this->execute('set names utf8');

        $this->table('ad_arctypes')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'comment' => '自增id',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('name', 'string', [
                'comment' => '栏目名称',
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('parent_id', 'integer', [
                'comment' => '父id',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('level', 'integer', [
                'comment' => '级别',
                'default' => '1',
                'limit' => MysqlAdapter::INT_TINY,
                'null' => false,
            ])
            ->addColumn('sort', 'integer', [
                'comment' => '排序',
                'default' => '0',
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('type', 'integer', [
                'comment' => '类型，1文章列表,2图片列表,3单页面',
                'default' => '1',
                'limit' => MysqlAdapter::INT_TINY,
                'null' => false,
            ])
            ->addColumn('image', 'string', [
                'comment' => '图片',
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('isshow', 'integer', [
                'comment' => '是否显示，1显示，2隐藏',
                'default' => '1',
                'limit' => MysqlAdapter::INT_TINY,
                'null' => false,
            ])
            ->addColumn('keywords', 'string', [
                'comment' => '关键词',
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('description', 'string', [
                'comment' => '描述',
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('href', 'string', [
                'comment' => '跳转链接',
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('enable_columns', 'text', [
                'comment' => '文章开启模块规则,json',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'keywords',
                ],
                ['unique' => true]
            )
            ->create();

        $this->table('ad_articles')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'comment' => '自增id',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('arctype_id', 'integer', [
                'comment' => '栏目id',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('title', 'string', [
                'comment' => '标题',
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('shorttitle', 'string', [
                'comment' => '短标题',
                'default' => null,
                'limit' => 36,
                'null' => true,
            ])
            ->addColumn('color', 'string', [
                'comment' => '颜色',
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->addColumn('description', 'string', [
                'comment' => '描述',
                'default' => null,
                'limit' => 250,
                'null' => true,
            ])
            ->addColumn('keywords', 'string', [
                'comment' => '关键字',
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('content', 'text', [
                'comment' => '内容',
                'default' => null,
                'limit' => 16777215,
                'null' => true,
            ])
            ->addColumn('pubdate', 'datetime', [
                'comment' => '发布时间',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('image', 'string', [
                'comment' => '缩略图',
                'default' => null,
                'limit' => 200,
                'null' => true,
            ])
            ->addColumn('autoimage', 'integer', [
                'comment' => '是否提取图片，1是，2否。提取内容中第一个图片为缩略图',
                'default' => '2',
                'limit' => MysqlAdapter::INT_TINY,
                'null' => true,
            ])
            ->addColumn('tag', 'string', [
                'comment' => '标签',
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('isshow', 'integer', [
                'comment' => '是否显示，1显示，2隐藏',
                'default' => '1',
                'limit' => MysqlAdapter::INT_TINY,
                'null' => true,
            ])
            ->addColumn('istop', 'integer', [
                'comment' => '是否置顶，1是，2否',
                'default' => '2',
                'limit' => MysqlAdapter::INT_TINY,
                'null' => true,
            ])
            ->addColumn('user_id', 'integer', [
                'comment' => '管理员id',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('url', 'string', [
                'comment' => '跳转链接',
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'comment' => '创建时间',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'comment' => '修改时间',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'created',
                ]
            )
            ->create();

        $this->table('ad_auth_rules')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('parent_id', 'integer', [
                'comment' => '父级id',
                'default' => '0',
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('name', 'string', [
                'comment' => '规则唯一标识',
                'default' => null,
                'limit' => 80,
                'null' => false,
            ])
            ->addColumn('title', 'string', [
                'comment' => '规则中文名称',
                'default' => null,
                'limit' => 20,
                'null' => false,
            ])
            ->addColumn('condition', 'string', [
                'comment' => '规则表达式',
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addIndex(
                [
                    'name',
                ],
                ['unique' => true]
            )
            ->create();

        $this->table('ad_menus')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'comment' => '自增id',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('name', 'string', [
                'comment' => '菜单名称',
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('parent_id', 'integer', [
                'comment' => '上级菜单id',
                'default' => '0',
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('level', 'integer', [
                'comment' => '菜单级别',
                'default' => '1',
                'limit' => MysqlAdapter::INT_TINY,
                'null' => true,
            ])
            ->addColumn('icon', 'string', [
                'comment' => '菜单图标',
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('target', 'string', [
                'comment' => '菜单链接',
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('reload', 'string', [
                'comment' => '重新载入某个标签',
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('sort', 'integer', [
                'comment' => '菜单排序',
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'null' => true,
            ])
            ->addColumn('isshow', 'integer', [
                'comment' => '是否显示。1显示，2隐藏',
                'default' => '1',
                'limit' => MysqlAdapter::INT_TINY,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'comment' => '创建时间',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'comment' => '修改时间',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('is_system', 'integer', [
                'comment' => '是否为系统内置',
                'default' => '2',
                'limit' => MysqlAdapter::INT_TINY,
                'null' => false,
            ])
            ->create();

        $this->table('ad_options')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'comment' => '自增id',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('name', 'string', [
                'comment' => '名称',
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('field', 'string', [
                'comment' => '字段名',
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('value', 'text', [
                'comment' => '值',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('type', 'string', [
                'comment' => '所属分类',
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('autoload', 'string', [
                'comment' => '是否自动加载，缓存起来',
                'default' => 'yes',
                'limit' => 20,
                'null' => true,
            ])
            ->create();

        $this->table('ad_roles')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'comment' => '自增id',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('name', 'string', [
                'comment' => '组别名称',
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('menus', 'text', [
                'comment' => '菜单权限',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('rules', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('note', 'string', [
                'comment' => '备注',
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('sort', 'integer', [
                'comment' => '排序id',
                'default' => '0',
                'limit' => 11,
                'null' => true,
            ])
            ->create();

        $this->table('ad_search_index')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('obj_type', 'string', [
                'comment' => '模块类型',
                'default' => null,
                'limit' => 20,
                'null' => false,
            ])
            ->addColumn('obj_id', 'integer', [
                'comment' => '关联id',
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('title', 'text', [
                'comment' => '标题',
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('content', 'text', [
                'comment' => '内容',
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('params', 'text', [
                'comment' => '拓展字段',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('status', 'integer', [
                'comment' => '状态',
                'default' => '1',
                'limit' => MysqlAdapter::INT_TINY,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'obj_type',
                    'obj_id',
                ],
                ['unique' => true]
            )
            ->addIndex(
                [
                    'title',
                    'content',
                ],
                ['type' => 'fulltext']
            )
            ->create();

        $this->table('ad_users')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'comment' => '自增id',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('username', 'string', [
                'comment' => '登录名',
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('password', 'string', [
                'comment' => '登录密码',
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('nickname', 'string', [
                'comment' => '昵称',
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('role_id', 'integer', [
                'comment' => '用户组id',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('state', 'integer', [
                'comment' => '登录状态.1正常，2禁止',
                'default' => '1',
                'limit' => MysqlAdapter::INT_TINY,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'comment' => '创建时间',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'comment' => '修改时间',
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'username',
                ],
                ['unique' => true]
            )
            ->create();
    }

    public function down()
    {
        $this->dropTable('ad_arctypes');
        $this->dropTable('ad_articles');
        $this->dropTable('ad_auth_rules');
        $this->dropTable('ad_menus');
        $this->dropTable('ad_options');
        $this->dropTable('ad_roles');
        $this->dropTable('ad_search_index');
        $this->dropTable('ad_users');
    }
}
