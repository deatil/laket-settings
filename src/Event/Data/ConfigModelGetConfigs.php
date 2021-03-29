<?php

declare (strict_types = 1);

namespace Laket\Admin\Settings\Event\Data;

/**
 * 模型配置获取设置信息时
 */
class ConfigModelGetConfigs
{
    /**
     * @var
     */
    public $configs;

    /**
     * @var
     */
    public $newConfigs;

    public function __construct(array $configs, array $newConfigs)
    {
        $this->configs = $configs;
        
        $this->newConfigs = $newConfigs;
    }

}
