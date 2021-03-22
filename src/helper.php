<?php

use Laket\Admin\Settings\Model\Config as ConfigModel;

if (! function_exists('laket_setting')) {
    /**
     * 获取设置信息
     * @param string $key 取值key
     * @param mix $default 默认值
     * @return mix
     */
    function laket_setting(string $key = null, $default = null) {
        return ConfigModel::getConfig($key, $default);
    }
}
