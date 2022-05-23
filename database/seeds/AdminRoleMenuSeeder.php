<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminRoleMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_role_menu')->insert([
            [
                'role_id' => '1',
                'menu_id' => '2',
            ],
            [
                'role_id' => '1',
                'menu_id' => '8',
            ],
            [
                'role_id' => '1',
                'menu_id' => '9',
            ],
            [
                'role_id' => '1',
                'menu_id' => '10',
            ],
            [
                'role_id' => '1',
                'menu_id' => '11',
            ],
        ]);
    }
}
