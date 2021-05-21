<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class AdminSeeder
 * @package Database\Seeders
 */
class AdminSeeder extends Seeder
{
    /**
     * @var string $time
     */
    protected $time = '';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->time = date('Y-m-d H:i:s');
        $this->adminMenu();
        $this->adminPermissions();
        $this->adminRoleMenu();
        $this->adminRolePermissions();
        $this->adminRoleUsers();
        $this->adminRoles();
        $this->adminUsers();
    }

    /**
     * Laravel-admin 角色组
     */
    private function adminUsers()
    {
        DB::table('admin_users')->insert([
            [
                'username' => 'admin',
                'password' => '$2y$10$osUDoQvdpFRHM6xqIr9eR.sa5ZIEyKcQUNysfYhgjt53H0CzFl/wi',
                'name' => 'Administrator',
                'avatar' => '',
                'remember_token' => '',
                'created_at' => $this->time,
                'updated_at' => $this->time
            ]
        ]);
    }

    /**
     * Laravel-admin 角色组
     */
    private function adminRoles()
    {
        DB::table('admin_roles')->insert([
            [
                'name' => 'Administrator',
                'slug' => 'administrator',
                'created_at' => $this->time,
                'updated_at' => $this->time
            ]
        ]);
    }

    /**
     * Laravel-admin 角色组用户关联
     */
    private function adminRoleUsers()
    {
        DB::table('admin_role_users')->insert([
            [
                'role_id' => 1,
                'user_id' => 1,
                'created_at' => $this->time,
                'updated_at' => $this->time
            ]
        ]);
    }

    /**
     * Laravel-admin 角色组权限关联
     */
    private function adminRolePermissions()
    {
        DB::table('admin_role_permissions')->insert([
            [
                'role_id' => 1,
                'permission_id' => 1,
                'created_at' => $this->time,
                'updated_at' => $this->time
            ]
        ]);
    }

    /**
     * Laravel-admin 角色组菜单显示关联
     */
    private function adminRoleMenu()
    {
        DB::table('admin_role_menu')->insert([
            [
                'role_id' => 1,
                'menu_id' => 2,
                'created_at' => $this->time,
                'updated_at' => $this->time
            ]
        ]);
    }

    /**
     * Laravel-admin 权限管理
     */
    private function adminPermissions()
    {
        DB::table('admin_permissions')->insert([
            [
                'name' => 'Super Administrator',
                'slug' => '*',
                'http_method' => '',
                'http_path' => '*',
                'created_at' => $this->time,
                'updated_at' => $this->time
            ]
        ]);
    }

    /**
     * Laravel-admin 后台菜单
     */
    private function adminMenu()
    {
        DB::table('admin_menu')->insert([
            [
                'parent_id' => 0,
                'order' => 1,
                'title' => 'Dashboard',
                'icon' => 'fa-bar-chart',
                'uri' => '/',
                'permission' => '',
                'created_at' => $this->time,
                'updated_at' => $this->time
            ],
            [
                'parent_id' => 0,
                'order' => 2,
                'title' => 'Admin',
                'icon' => 'fa-tasks',
                'uri' => '',
                'permission' => '',
                'created_at' => $this->time,
                'updated_at' => $this->time
            ],
            [
                'parent_id' => 2,
                'order' => 3,
                'title' => 'Users',
                'icon' => 'fa-users',
                'uri' => 'auth/users',
                'permission' => '',
                'created_at' => $this->time,
                'updated_at' => $this->time
            ],
            [
                'parent_id' => 2,
                'order' => 4,
                'title' => 'Roles',
                'icon' => 'fa-user',
                'uri' => 'auth/roles',
                'permission' => '',
                'created_at' => $this->time,
                'updated_at' => $this->time
            ],
            [
                'parent_id' => 2,
                'order' => 5,
                'title' => 'Permission',
                'icon' => 'fa-ban',
                'uri' => 'auth/permissions',
                'permission' => '',
                'created_at' => $this->time,
                'updated_at' => $this->time
            ],
            [
                'parent_id' => 2,
                'order' => 6,
                'title' => 'Menu',
                'icon' => 'fa-bars',
                'uri' => 'auth/menu',
                'permission' => '',
                'created_at' => $this->time,
                'updated_at' => $this->time
            ],
            [
                'parent_id' => 2,
                'order' => 7,
                'title' => 'Operation log',
                'icon' => 'fa-history',
                'uri' => 'auth/logs',
                'permission' => '',
                'created_at' => $this->time,
                'updated_at' => $this->time
            ],
        ]);
    }
}
