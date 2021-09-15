<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Config
 * @tablename configs
 * @package App\Models
 */
class Config extends Model
{
    use HasFactory, DefaultDatetimeFormat;

    protected $attributes = [
        'value' => '',
        'help' => '',
        'rules' => ''
    ];

    const TYPE_TEXT = 'text';
    const TYPE_IMAGE = 'image';
    const TYPE_SWITCH = 'switch';

    const GROUP_BASIC = 'basic';
    const GROUP_WXAPP = 'wxapp';
    const GROUP_SMS = 'sms';

    /**
     * 获取类型说明
     *
     * @return array
     */
    public function getTypeTexts(): array
    {
        return [
            self::TYPE_TEXT => __('config.type_texts.text'),
            self::TYPE_IMAGE => __('config.type_texts.image'),
            self::TYPE_SWITCH => __('config.type_texts.switch')
        ];
    }

    /**
     * 获取分组说明
     *
     * @return array
     */
    public function getGroupTexts(): array
    {
        return [
            self::GROUP_BASIC => __('config.group_texts.basic'),
            self::GROUP_WXAPP => __('config.group_texts.wxapp'),
            self::GROUP_SMS => __('config.group_texts.sms')
        ];
    }

    /**
     * 验证规则 访问器
     *
     * @param string $value
     * @return array
     */
    public function getRulesAttribute(string $value): array
    {
        $array = json_decode($value, true);
        return !empty($array)&&is_array($array)?$array:[];
    }

    /**
     * 验证规则 修改器
     *
     * @param array $value
     */
    public function setRulesAttribute(array $value)
    {
        $this->attributes['rules'] = json_encode($value);
    }
}
