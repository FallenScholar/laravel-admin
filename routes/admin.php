<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('admin.home');

Route::get('config', 'Config\FormController@index'); // 数据表单 配置管理
Route::resource('configs', 'ConfigController')
    ->except(['show'])
    ->names('config'); // 配置管理

/** ====== Laravel-admin 用户鉴权登陆注册 ======   */
Route::get('auth/login', 'AuthController@getLogin')->name('admin.login');
Route::post('auth/login', 'AuthController@postLogin');
Route::get('auth/logout', 'AuthController@getLogout')->name('admin.logout');
Route::get('auth/setting', 'AuthController@getSetting')->name('admin.setting');
Route::put('auth/setting', 'AuthController@putSetting');

/** ====== Laravel-admin 权限管理及操作 ======   */
Route::namespace('\Encore\Admin\Controllers')->group(function (Router $router) {
    $router->resource('auth/users', 'UserController')->names('admin.auth.users');
    $router->resource('auth/roles', 'RoleController')->names('admin.auth.roles');
    $router->resource('auth/permissions', 'PermissionController')->names('admin.auth.permissions');
    $router->resource('auth/menu', 'MenuController', ['except' => ['create']])->names('admin.auth.menu');
    $router->resource('auth/logs', 'LogController', ['only' => ['index', 'destroy']])->names('admin.auth.logs');

    $router->post('_handle_form_', 'HandleController@handleForm')->name('admin.handle-form');
    $router->post('_handle_action_', 'HandleController@handleAction')->name('admin.handle-action');
    $router->get('_handle_selectable_', 'HandleController@handleSelectable')->name('admin.handle-selectable');
    $router->get('_handle_renderable_', 'HandleController@handleRenderable')->name('admin.handle-renderable');
});
