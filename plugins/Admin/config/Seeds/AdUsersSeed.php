<?php
use Migrations\AbstractSeed;

/**
 * AdUsers seed.
 */
class AdUsersSeed extends AbstractSeed
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
                'username' => 'admin',
                'password' => '$2y$10$v5bE3wc3AASZSK05CLUvf.hhjWxWEfXZGz.1LAVtNn/70n6DsVFOi',
                'nickname' => '管理员',
                'role_id' => '1',
                'state' => '1',
                'created' => '2017-09-22 15:16:50',
                'modified' => '2018-05-16 01:40:42',
            ],
        ];

        $table = $this->table('ad_users');
        $table->insert($data)->save();
    }
}
