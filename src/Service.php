<?php

declare (strict_types = 1);

namespace Laket\Admin\Settings;

use Laket\Admin\Flash\Menu;
use Laket\Admin\Facade\Flash;
use Laket\Admin\Flash\Service as BaseService;

class Service extends BaseService
{
    /**
     * composer
     */
    public $composer = __DIR__ . '/../composer.json';
    
    protected $slug = 'laket-admin.flash.settings';
    
    /**
     * 启动
     */
    public function boot()
    {
        Flash::extend('laket/laket-settings', __CLASS__);
    }
    
    /**
     * 开始，只有启用后加载
     */
    public function start()
    {
        // 配置
        $this->mergeConfigFrom(__DIR__ . '/../resources/config/field_type.php', 'field_type');
        
        // 路由
        $this->loadRoutesFrom(__DIR__ . '/../resources/routes/admin.php');
        
        // 视图
        $this->loadViewsFrom(__DIR__ . '/../resources/view', 'laket-settings');
        
        // 引入函数
        $this->loadFilesFrom(__DIR__ . "/helper.php");
    }
    
    /**
     * 安装后
     */
    public function install()
    {
        $menus = include __DIR__ . '/../resources/menus/menus.php';
        
        // 添加菜单
        Menu::create($menus);
        
        // 数据库
        Flash::importSql(__DIR__ . '/../resources/database/install.sql');
    }
    
    /**
     * 卸载后
     */
    public function uninstall()
    {
        Menu::delete($this->slug);
        
        // 数据库
        Flash::importSql(__DIR__ . '/../resources/database/uninstall.sql');
    }
    
    /**
     * 更新后
     */
    public function upgrade()
    {}
    
    /**
     * 启用后
     */
    public function enable()
    {
        Menu::enable($this->slug);
    }
    
    /**
     * 禁用后
     */
    public function disable()
    {
        Menu::disable($this->slug);
    }
    
}
