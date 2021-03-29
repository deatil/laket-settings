<?php

declare (strict_types = 1);

namespace Laket\Admin\Settings\Event;

/**
 * 模型配置获取设置信息时
 */
class ConfigModelGetConfigs
{
    /**
     * @var
     */
    public $data;

    public function __construct(object $data)
    {
        $this->data = $data;
    }

}
