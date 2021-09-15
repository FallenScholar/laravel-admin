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
                'title' => '控制台',
                'icon' => 'fa-bar-chart',
                'uri' => '/',
                'permission' => '',
                'created_at' => $this->time,
                'updated_at' => $this->time
            ],
            [
                'parent_id' => 0,
                'order' => 14,
                'title' => '系统管理',
                'icon' => 'fa-tasks',
                'uri' => '',
                'permission' => '',
                'created_at' => $this->time,
                'updated_at' => $this->time
            ],
            [
                'parent_id' => 2,
                'order' => 16,
                'title' => '管理员',
                'icon' => 'fa-users',
                'uri' => 'auth/users',
                'permission' => '',
                'created_at' => $this->time,
                'updated_at' => $this->time
            ],
            [
                'parent_id' => 2,
                'order' => 17,
                'title' => '权限组',
                'icon' => 'fa-user',
                'uri' => 'auth/roles',
                'permission' => '',
                'created_at' => $this->time,
                'updated_at' => $this->time
            ],
            [
                'parent_id' => 2,
                'order' => 18,
                'title' => '权限',
                'icon' => 'fa-ban',
                'uri' => 'auth/permissions',
                'permission' => '',
                'created_at' => $this->time,
                'updated_at' => $this->time
            ],
            [
                'parent_id' => 2,
                'order' => 19,
                'title' => '菜单',
                'icon' => 'fa-bars',
                'uri' => 'auth/menu',
                'permission' => '',
                'created_at' => $this->time,
                'updated_at' => $this->time
            ],
            [
                'parent_id' => 2,
                'order' => 20,
                'title' => '操作日志',
                'icon' => 'fa-history',
                'uri' => 'auth/logs',
                'permission' => '',
                'created_at' => $this->time,
                'updated_at' => $this->time
            ],
            [
                'parent_id' => 2,
                'order' => 15,
                'title' => '系统配置',
                'icon' => 'fa-cogs',
                'uri' => 'configs',
                'permission' => '',
                'created_at' => $this->time,
                'updated_at' => $this->time
            ],
            [
                'parent_id' => 0,
                'order' => 13,
                'title' => '配置管理',
                'icon' => 'fa-cog',
                'uri' => 'config',
                'permission' => '',
                'created_at' => $this->time,
                'updated_at' => $this->time
            ],
        ]);
    }
}
