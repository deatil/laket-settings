<?php

declare (strict_types = 1);

namespace Laket\Admin\Settings\Model;

use think\Model;
use think\facade\Cache;
use think\helper\Arr;

/**
 * 配置
 *
 * @create 2021-3-22
 * @author deatil
 */
class Config extends Model
{
    // 设置当前模型对应的数据表名称
    protected $name = 'settings_config';
    
    // 设置主键名
    protected $pk = 'id';
    
    // 时间字段取出后的默认时间格式
    protected $dateFormat = false;

    public static function onBeforeInsert($model)
    {
        $id = md5(mt_rand(10000, 99999) . microtime());
        $model->setAttr('id', $id);
        
        $model->setAttr('add_time', time());
        $model->setAttr('add_ip', request()->ip());
    }

    public static function onAfterUpdate($model)
    {
        static::clearCahce();
    }

    public static function onAfterWrite($model)
    {
        static::clearCahce();
    }

    public static function onAfterDelete($model)
    {
        static::clearCahce();
    }

    public static function onAfterRestore($model)
    {
        static::clearCahce();
    }
    
    public static function getConfig(string $key = null, $default = null)
    {
        $settings = static::getConfigs();
        
        return Arr::get($settings, $key, $default);
    }
    
    public static function getConfigs()
    {
        $cacaheId = md5('laket-settings-config');
        
        $data = Cache::get($cacaheId);
        if (empty($data)) {
            $configs = static::where([
                    ['status', '=', 1]
                ])
                ->select()
                ->toArray();
            
            $newConfigs = [];
            foreach ($configs as $key => $value) {
                if ($value['options'] != '') {
                    $value['options'] = json_decode($value['options'], true);
                }
                switch ($value['type']) {
                    case 'array':
                        $newConfigs[$value['name']] = json_decode($value['value'], true);
                        break;
                    case 'radio':
                        $newConfigs[$value['name']] = isset($value['options'][$value['value']]) ? ['key' => $value['value'], 'value' => $value['options'][$value['value']]] : ['key' => $value['value'], 'value' => $value['value']];
                        break;
                    case 'select':
                        $newConfigs[$value['name']] = isset($value['options'][$value['value']]) ? ['key' => $value['value'], 'value' => $value['options'][$value['value']]] : ['key' => $value['value'], 'value' => $value['value']];
                        break;
                    case 'checkbox':
                        if (empty($value['value'])) {
                            $newConfigs[$value['name']] = [];
                        } else {
                            $valueArr = explode(',', $value['value']);
                            foreach ($valueArr as $v) {
                                if (isset($value['options'][$v])) {
                                    $newConfigs[$value['name']][$v] = $value['options'][$v];
                                } elseif ($v) {
                                    $newConfigs[$value['name']][$v] = $v;
                                }
                            }
                        }
                        break;
                    case 'image':
                        $newConfigs[$value['name']] = empty($value['value']) ? '' : laket_attachment_url($value['value']);
                        break;
                    case 'images':
                        if (!empty($value['value'])) {
                            $images_values = explode(',', $value['value']);
                            foreach ($value['value'] as $val) {
                                $newConfigs[$value['name']][] = laket_attachment_url($val);
                            }
                        } else {
                            $newConfigs[$value['name']] = [];
                        }
                        break;
                    case 'Ueditor':
                        $newConfigs[$value['name']] = htmlspecialchars_decode($value['value']);
                        break;
                    default:
                        $newConfigs[$value['name']] = $value['value'];
                        break;
                }
            }
            
            $data = $newConfigs;
            
            Cache::set($cacaheId, $data);
        }
        
        return $data;
    }
    
    public static function getSettings()
    {
        $cacaheId = md5('laket-settings-config');
        
        $data = Cache::get($cacaheId);
        if (empty($data)) {
            $configs = static::where([
                    ['status', '=', 1]
                ])
                ->select()
                ->toArray();
            
            $data = [];
            foreach ($configs as $config) {
                $data[$config['name']] = $config['value'];
            }
            
            Cache::set($cacaheId, $data);
        }
        
        return $data;
    }

    public static function clearCahce()
    {
        Cache::delete(md5('laket-settings-config'));
    }
    
    public static function hasItem(string $key)
    {
        return static::where(['name' => $key])
            ->find();
    }
    
    public static function getItem(string $key, $default = null)
    {
        $data = static::where(['name' => $key])->find();
        return $data['value'] ?: $default;
    }
    
    public static function setItem(string $key, $value)
    {
        return static::update([
                'value' => $value
            ], ['name' => $key]);
    }
    
    public static function setManyItem(array $settings = [])
    {
        foreach ($settings as $key => $value) {
            static::setItem($key, $value);
        }
    }
    
    public static function removeItem(string $key)
    {
        $deleted = static::where(['name' => $key])
            ->delete();
        return $deleted;
    }
}