<?php

declare (strict_types = 1);

namespace Laket\Admin\Settings\Controller;

use think\facade\Validate;

use Laket\Admin\Flash\Controller as BaseController;
use Laket\Admin\Settings\Model\Config as ConfigModel;
use Laket\Admin\Settings\Event as SettingsEvent;

/**
 * 系统配置
 *
 * @create 2021-3-22
 * @author deatil
 */
class Config extends BaseController
{
    /**
     * 配置首页
     */
    public function index($group = 'system')
    {
        if ($this->request->isPost()) {
            $list = ConfigModel::field('
                    id,name,title,type,
                    listorder,status,
                    update_time
                ')
                ->where('group', $group)
                ->order('listorder ASC, create_time DESC')
                ->select()
                ->toArray();
                
            return $this->json([
                "code" => 0, 
                "data" => $list
            ]);
        } else {
            $this->assign([
                'groupArray' => ConfigModel::getConfig('config_group'),
                'group' => $group,
            ]);
            
            return $this->fetch('laket-settings::config.index');
        }
    }
    
    /**
     * 全部配置
     */
    public function all()
    {
        if ($this->request->isAjax()) {
            $limit = $this->request->param('limit/d', 20);
            $page = $this->request->param('page/d', 1);
            
            $searchField = $this->request->param('search_field/s', '', 'trim');
            $keyword = $this->request->param('keyword/s', '', 'trim');
            
            $map = [];
            if (!empty($searchField) && !empty($keyword)) {
                $searchField = $searchField;
                $map[] = [$searchField, 'like', "%$keyword%"];
            }
            
            $data = ConfigModel::field('id,name,title,group,type,listorder,status,update_time')
                ->page($page, $limit)
                ->where($map)
                ->order('group ASC, listorder ASC, name ASC, id DESC')
                ->select()
                ->toArray();
            
            $total = ConfigModel::where($map)
                ->count();
            
            $result = [
                "code" => 0, 
                "count" => $total, 
                "data" => $data,
            ];
            return $this->json($result);
        } else {
            $this->assign([
                'groupArray' => ConfigModel::getConfig('config_group'),
                'group' => 'all',
            ]);
            
            return $this->fetch('laket-settings::config.all');
        }
    }
    
    /**
     * 配置设置
     */
    public function setting($group = 'system')
    {
        if ($this->request->isPost()) {
            $data = $this->request->post('item/a');

            // 查询该分组下所有的配置项名和类型
            $items = ConfigModel::where([
                'group' => $group,
                'is_show' => 1,
                'status' => 1,
            ])->column('name,type');
            
            foreach ($items as $item) {
                $name = $item['name'];
                $type = $item['type'];
                
                // 查看是否赋值
                if (!isset($data[$name])) {
                    switch ($type) {
                        // 开关
                        case 'switch':
                            $data[$name] = 0;
                            break;
                        case 'checkbox':
                            $data[$name] = '';
                            break;
                    }
                } else {
                    // 如果值是数组则转换成字符串，适用于复选框等类型
                    if (is_array($data[$name])) {
                        $data[$name] = implode(',', $data[$name]);
                    }
                    switch ($type) {
                        // 开关
                        case 'switch':
                            $data[$name] = 1;
                            break;
                    }
                }
                
                if (isset($data[$name])) {
                
                    ConfigModel::update([
                        'value' => $data[$name],
                    ], [
                        'name' => $name,
                    ]);
                }
            }
            
            return $this->success('设置更新成功');
        } else {
            $configList = ConfigModel::where('group', $group)
                ->where([
                    'is_show' => 1,
                    'status' => 1,
                ])
                ->order('listorder,id desc')
                ->column('name,title,remark,type,value,options');
            foreach ($configList as &$value) {
                if ($value['options'] != '') {
                    $value['options'] = json_decode($value['options'], true);
                }
                if ($value['type'] == 'checkbox') {
                    $value['value'] = empty($value['value']) ? [] : explode(',', $value['value']);
                }
                if ($value['type'] == 'datetime') {
                    $value['value'] = empty($value['value']) ? date('Y-m-d H:i:s') : $value['value'];
                }
            }
            
            // 事件
            $configList = apply_filters('config_controller_setting_get', $configList);
            
            $this->assign([
                'groupArray' => ConfigModel::getConfig('config_group'),
                'fields' => $configList,
                'group' => $group,
            ]);

            return $this->fetch('laket-settings::config.setting');
        }

    }

    /**
     * 新增配置
     */
    public function add()
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();
            
            if (isset($data['status']) 
                && $data['status'] == 1) {
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }
            
            $result = $this->validate($data, 'Laket\\Admin\\Settings\\Validate\\Config');
            if (false === $result) {
                return $this->error($result);
            }
            
            $status = ConfigModel::create($data);
            if (false === $status) {
                return $this->error('配置添加失败！');
            }
            
            return $this->success('配置添加成功！');
        } else {
            // ['name,title,ifoption,ifstring']
            $fieldType = ConfigModel::getFieldType();
            
            $group = $this->request->param('group');
            
            $this->assign([
                'groupArray' => ConfigModel::getConfig('config_group'),
                'fieldType' => $fieldType,
                'group' => $group,
            ]);
            
            return $this->fetch('laket-settings::config.add');
        }
    }
    
    /**
     * 编辑配置
     */
    public function edit()
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();
            $result = $this->validate($data, 'Laket\\Admin\\Settings\\Validate\\Config');
            if (false === $result) {
                return $this->error($result);
            }
            
            if (!isset($data['id']) || empty($data['id'])) {
                return $this->error('配置ID不能为空！');
            }
            
            $id = $data['id'];
            unset($data['id']);
            
            $info = ConfigModel::where([
                'id' => $id,
            ])->find();
            if (empty($info)) {
                return $this->error('信息不存在！');
            }
            
            $status = ConfigModel::update($data, [
                    'id' => $id,
                ]);
            if ($status === false) {
                return $this->error('配置编辑失败！');
            }
            
            return $this->success('配置编辑成功！');
        } else {
            $id = $this->request->param('id');
            if (empty($id) || strlen($id) != 32) {
                return $this->error('参数错误！');
            }
            
            // ['name,title,ifoption,ifstring']
            $fieldType = ConfigModel::getFieldType();
            
            $info = ConfigModel::where([
                'id' => $id,
            ])->find();
            if (empty($info)) {
                return $this->error('信息不存在！');
            }
            
            $this->assign([
                'groupArray' => ConfigModel::getConfig('config_group'),
                'fieldType' => $fieldType,
                'info' => $info,
            ]);
            
            return $this->fetch('laket-settings::config.edit');
        }
    }
    
    /**
     * 删除配置
     */
    public function del()
    {
        $id = $this->request->param('id');
        if (empty($id) || strlen($id) != 32) {
            return $this->error('参数错误！');
        }
        
        $info = ConfigModel::where([
            'id' => $id,
        ])->find();
        if (empty($info)) {
            return $this->error('信息不存在！');
        }
        
        $re = ConfigModel::where([
            'id' => $id,
        ])->delete();
        if ($re === false) {
            return $this->error('删除失败！');
        }
        
        return $this->success('删除成功');
    }
    
    /**
     * 排序
     */
    public function listorder()
    {
        $id = $this->request->param('id');
        if (empty($id) || strlen($id) != 32) {
            return $this->error('参数不能为空！');
        }
        
        $listorder = $this->request->param('value/d', 0);
        if (empty($listorder)) {
            $listorder = 100;
        }
        
        $rs = ConfigModel::where([
                'id' => $id,
            ])->update([
                'listorder' => $listorder,
            ]);
        
        if ($rs === false) {
            return $this->error("排序失败！");
        }
        
        return $this->success("排序成功！");
    }
    
    /**
     * 设置配置状态
     */
    public function setstate($id, $status)
    {
        $id = $this->request->param('id');
        if (empty($id) || strlen($id) != 32) {
            return $this->error('参数不能为空！');
        }
        
        $status = $this->request->param('status/d');
        if ($status != 1) {
            $status = 0;
        }
        
        $rs = ConfigModel::where([
                'id' => $id,
            ])->update([
                'status' => $status,
            ]);
        if ($rs === false) {
            return $this->error('操作失败！');
        }
        
        return $this->success('操作成功！');
    }
    
}
