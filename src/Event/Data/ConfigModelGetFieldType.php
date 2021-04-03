<?php

declare (strict_types = 1);

namespace Laket\Admin\Settings\Event\Data;

/**
 * 模型配置获取配置类型
 */
class ConfigModelGetFieldType
{
    /**
     * @var
     */
    public $fieldType;

    public function __construct(array $fieldType)
    {
        $this->fieldType = $fieldType;
    }

    public function __toString()
    {
        return $this->fieldType;
    }

}
