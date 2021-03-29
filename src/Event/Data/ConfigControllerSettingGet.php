<?php

declare (strict_types = 1);

namespace Laket\Admin\Settings\Event\Data;

/**
 * 控制器设置获取时
 */
class ConfigControllerSettingGet
{
    /**
     * @var
     */
    public $configs;

    public function __construct(array $configs)
    {
        $this->configs = $configs;
    }

}
