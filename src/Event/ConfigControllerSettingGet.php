<?php

declare (strict_types = 1);

namespace Laket\Admin\Settings\Event;

/**
 * 控制器设置获取时
 */
class ConfigControllerSettingGet
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
