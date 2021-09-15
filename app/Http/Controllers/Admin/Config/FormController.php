<?php

namespace App\Http\Controllers\Admin\Config;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Tab;
use App\Admin\Forms\Config;

/**
 * Class FormController
 * @package App\Http\Controllers\Admin\Config
 */
class FormController extends AdminController
{
    /**
     * @param Content $content
     * @return Content
     */
    public function index(Content $content): Content
    {
        return $content
            ->title(__('config.forms'))
            ->body(Tab::forms([
                'basic' => Config\Basic::class
            ]));
    }
}
