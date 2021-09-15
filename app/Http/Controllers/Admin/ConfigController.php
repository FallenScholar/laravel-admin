<?php

namespace App\Http\Controllers\Admin;

use Encore\Admin\Form;
use Encore\Admin\Grid;

/**
 * Class ConfigController
 * @package App\Http\Controllers\Admin
 */
class ConfigController extends CommonController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid($this->model);

        $grid->filter(function ($filter) {
            $filter->disableIdFilter(); // 去掉默认的id过滤器
            $filter->equal('group', __($this->key . '.group'))->select($this->model->getGroupTexts());
            $filter->equal('type', __($this->key . '.type'))->select($this->model->getTypeTexts());
            $filter->like('key', __($this->key . '.key'));
        });

        $grid->column('id', __('ID'))->sortable()->hide();
        $grid->column('group', __($this->key . '.group'))
            ->using($this->model->getGroupTexts());
        $grid->column('type', __($this->key . '.type'))
            ->using($this->model->getTypeTexts());
        $grid->column('key', __($this->key . '.key'));
        $grid->column('created_at', __('admin.created_at'))->sortable();
        $grid->column('updated_at', __('admin.updated_at'))->sortable()->hide();

        $grid->disableExport(); // 禁用导出数据按钮
        $grid->actions(function ($actions) {
            $actions->disableView(); // 去掉查看
        });

        return $grid;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form(): Form
    {
        $form = new Form($this->model);

        $form->tools(function (Form\Tools $tools) {
            $tools->disableView(); // 去掉`查看`按钮
        });

        $form->select('group', __($this->key.'.group'))
            ->required()
            ->options($this->model->getGroupTexts());
        $form->select('type', __($this->key.'.type'))
            ->required()
            ->options($this->model->getTypeTexts());
        $form->text('key', __($this->key . '.key'))
            ->creationRules(['required', "unique:" . $form->model()->getTable()])
            ->updateRules(['required', "unique:" . $form->model()->getTable() .",key,{{id}}"]);
        $form->text('help', __($this->key . '.help'))
            ->rules('max:100');
        $form->list('rules', __($this->key . '.rules'))
            ->rules('max:100');

        $form->saving(function (Form $form) {
            if (empty($form->help)) $form->help = '';
            if (empty($form->rules)) $form->rules = [];
        });

        $form->footer(function ($footer) {
            $footer->disableViewCheck(); // 去掉`查看`checkbox
        });

        return $form;
    }
}
