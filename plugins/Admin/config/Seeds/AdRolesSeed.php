<?php
use Migrations\AbstractSeed;

/**
 * AdRoles seed.
 */
class AdRolesSeed extends AbstractSeed
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
                'name' => '管理员组',
                'menus' => '["7","8","12","11","9","1","2","3","4","5","6","13"]',
                'rules' => '["1","3","4","6","7","8","2","5","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30"]',
                'note' => '',
                'sort' => '2',
            ],
        ];

        $table = $this->table('ad_roles');
        $table->insert($data)->save();
    }
}
