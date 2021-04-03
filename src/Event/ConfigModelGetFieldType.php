<?php

declare (strict_types = 1);

namespace Laket\Admin\Settings\Event;

/**
 * 模型配置获取配置类型
 */
class ConfigModelGetFieldType
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
