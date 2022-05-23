<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('admin_permissions')->insert([
            [
                'id' => '1',
                'name' => 'All permission',
                'slug' => '*',
                'http_method' => '',
                'http_path' => '*',
            ],
            [
                'id' => '2',
                'name' => 'Dashboard',
                'slug' => 'dashboard',
                'http_method' => 'GET',
                'http_path' => '/',
            ],
            [
                'id' => '3',
                'name' => 'Login',
                'slug' => 'auth.login',
                'http_method' => '',
                'http_path' => '/auth/login
/auth/logout',
            ],
            [
                'id' => '4',
                'name' => 'User setting',
                'slug' => 'auth.setting',
                'http_method' => 'GET,PUT',
                'http_path' => '/auth/setting',
            ],
            [
                'id' => '5',
                'name' => 'Auth management',
                'slug' => 'auth.management',
                'http_method' => '2',
                'http_path' => '/auth/roles
/auth/permissions
/auth/menu
/auth/logs',
            ],
        ]);

        
        DB::table('admin_menu')->insert([
            [
                'id' => '1',
                'parent_id' => '0',
                'order' => '1',
                'title' => 'Dashboard',
                'icon' => 'fa-bar-chart',
                'uri' => '/',
                'permission' => '',
            ],
            [
                'id' => '2',
                'parent_id' => '0',
                'order' => '2',
                'title' => 'Admin',
                'icon' => 'fa-tasks',
                'uri' => '',
                'permission' => '',
            ],
            [
                'id' => '3',
                'parent_id' => '2',
                'order' => '3',
                'title' => 'Users',
                'icon' => 'fa-users',
                'uri' => 'auth/users',
                'permission' => '',
            ],
            [
                'id' => '4',
                'parent_id' => '2',
                'order' => '2',
                'title' => 'Roles',
                'icon' => 'fa-user',
                'uri' => 'auth/roles',
                'permission' => '',
            ],
            [
                'id' => '5',
                'parent_id' => '2',
                'order' => '5',
                'title' => 'Permission',
                'icon' => 'fa-ban',
                'uri' => 'auth/permissions',
                'permission' => '',
            ],
            [
                'id' => '6',
                'parent_id' => '2',
                'order' => '6',
                'title' => 'Menu',
                'icon' => 'fa-bars',
                'uri' => 'auth/menu',
                'permission' => '',
            ],
            [
                'id' => '7',
                'parent_id' => '2',
                'order' => '7',
                'title' => 'Operation log',
                'icon' => 'fa-history',
                'uri' => 'auth/logs',
                'permission' => '',
            ],
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

        DB::table('admin_roles')->insert([
            [
                'id' => '1',
                'name' => 'Administrator',
                'slug' => 'administrator',
            ]
        ]);

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

        DB::table('admin_role_permissions')->insert([
            [
                'role_id' => '1',
                'permission_id' => '1',
            ]
        ]);

        DB::table('admin_users')->insert([
            [
                'id' => '1',
                'username' => 'admin',
                'password' => '$2y$10$u4ltbf8sFB6tbxByqicq/uGqpX/o2YViIwI6guD1qDTEIP5L01Ac2',
                'name' => 'Administrator',
                'avatar' => '',
                'remember_token' => '',
            ]
        ]);
    
        DB::table('admin_role_users')->insert([
            [
                'role_id' => '1',
                'user_id' => '1',
            ]
        ]);
    }
}
