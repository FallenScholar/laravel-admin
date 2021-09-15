<?php

namespace App\Admin\Forms\Config;

use App\Models\Config;
use App\Servers\ConfigServer;
use Encore\Admin\Widgets\Form;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

/**
 * Class Common
 * @package App\Admin\Forms\Config
 */
abstract class Common extends Form
{
    /**
     * @var string $key 分组键
     */
    protected $key;

    /**
     * @var Config $model 模型
     */
    protected $model;

    /**
     * Common constructor.
     * @param array $data
     */
    public function __construct($data = [])
    {
        parent::__construct($data);

        $this->model = new Config();
        $className = get_class($this);
        $classNameArray = explode('\\', $className);
        $this->key = strtolower($classNameArray[count($classNameArray) - 1]);
        $this->title = __('config.group_texts.' . $this->key);
        unset($classNameArray);
        unset($className);
    }

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function handle(Request $request): RedirectResponse
    {
        try {
            $configs = $this->model->where('group', $this->key)->get();
            foreach ($configs as $config) {
                if ($request->exists($config->key)) {
                    if ($config->type === Config::TYPE_IMAGE) {
                        $file = $request->file($config->key);
                        if ($file->isValid()) $config->value = $file->store('images');
                    } else {
                        $config->value = $request->get($config->key);
                    }

                    if (empty($config->value)) $config->value = '';
                    $config->save();
                }
            }
            ConfigServer::fresh($this->key);

            admin_success('更新配置成功');
        } catch (Exception $exception) {
            admin_error('更新配置错误', $exception->getMessage());
        }
        return back();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $config = $this->model->where('group', $this->key)->get();

        foreach ($config as $item) {
            $type = $item->type;
            if ($type == 'image') {
                $this->image($item->key, __('config.form_texts.' . $item->key))
                    ->rules($item->rules)
                    ->help(__('config.help_texts.' . $item->help))
                    ->uniqueName();
            } else {
                $this->$type($item->key, __('config.form_texts.' . $item->key))
                    ->rules($item->rules)
                    ->help(__('config.help_texts.' . $item->help));
            }
        }
    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data(): array
    {
        return collect($this->model->where('group', $this->key)->pluck('value', 'key'))->toArray();
    }
}
