<?php

declare (strict_types = 1);

namespace Laket\Admin\Settings\Validate;

use think\Validate;

/**
 * 配置验证器
 *
 * @create 2021-3-22
 * @author deatil
 */
class Config extends Validate
{
    // 定义验证规则
    protected $rule = [
        'title|配置标题' => 'require|chsAlphaNum',
        'name|配置名称' => 'require|regex:^[a-zA-Z]\w{0,39}$|unique:settings_config',
        'group|配置分组' => 'require',
        'type|配置类型' => 'require|alpha',
        'listorder|排序' => 'number',
    ];
}
