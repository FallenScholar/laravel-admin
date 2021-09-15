<?php

namespace App\Http\Controllers\Admin;

use Encore\Admin\Controllers\AdminController;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CommonController
 * @package App\Http\Controllers\Admin
 */
abstract class CommonController extends AdminController
{
    /**
     * @var string $title 标题 父级有值，在此清空
     */
    protected $title = '';

    /**
     * @var Model $model 当前控制器的关联模型
     */
    protected $model;

    /**
     * @var string $key 当前控制器的键
     */
    protected $key;

    /**
     * CommonController constructor.
     */
    public function __construct()
    {
        $this->_setKey();
        $this->_setModel();
        $this->_setTitle();
    }

    /**
     * 设置 关键
     */
    private function _setKey()
    {
        if (empty($this->key)) {
            $as = request()->route()->getAction('as'); // 获取路由别名

            if (!empty($as) && strpos($as, 'admin.') === 0) { // 存在别名并且为后台专属别名
                $asArray = explode('.', $as);
                $this->key = empty($asArray[1])?'':$asArray[1]; // 获取路由中携带的关键别名
                unset($asArray);
            }
            unset($as);

            if (empty($this->key)) { // 通过别名的方式没有查找到关键别名，则采用当前控制器名的方式查找
                $controller = request()->route()->getAction('controller'); // 获取路由路径
                $controllerArray = explode('\\', $controller); // 拆分路由路径
                $controller = $controllerArray[count($controllerArray) - 1]; // 获取路由文件级路径及方法名
                $controllerLength = strpos($controller, 'Controller'); // 获取路由后缀的首次出现下标
                $this->key = hump_to_under_line(substr($controller, 0, $controllerLength)); // 截取路由关键并转为小写下划线格式
            }
        }
    }

    /**
     * 设置 模型
     */
    private function _setModel()
    {
        if (!empty($this->key) && empty($this->model)) {
            $modelPrefix = 'App\\Models\\';

            if (class_exists($modelPrefix . under_line_to_hump($this->key))) {
                $model = $modelPrefix . under_line_to_hump($this->key);
                $this->model = new $model();
            }
        } else if (!empty($this->model) && class_exists($this->model)) {
            $model = $this->model;
            $this->model = new $model();
        }
    }

    /**
     * 设置页面标题
     */
    private function _setTitle()
    {
        if (!empty($this->key) && empty($this->title)) {
            $this->title = __('admin.page_title.' . $this->key);
        }
    }
}
