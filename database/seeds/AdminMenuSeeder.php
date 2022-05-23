<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminMenuSeeder extends Seeder
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
                'id' => '8',
                'parent_id' => '0',
                'order' => '8',
                'title' => 'Posts',
                'icon' => 'fa-newspaper-o',
                'uri' => 'posts',
                'permission' => '*',
            ],
            [
                'id' => '9',
                'parent_id' => '8',
                'order' => '9',
                'title' => 'All Posts',
                'icon' => 'fa-files-o',
                'uri' => 'posts',
                'permission' => '*',
            ],
            [
                'id' => '10',
                'parent_id' => '8',
                'order' => '10',
                'title' => 'Add New',
                'icon' => 'fa-plus-square',
                'uri' => 'posts/create',
                'permission' => '*',
            ],
            [
                'id' => '11',
                'parent_id' => '8',
                'order' => '11',
                'title' => 'Preview',
                'icon' => 'fa-eye   ',
                'uri' => 'preview',
                'permission' => '*',
            ],
        ]);
    }
}
