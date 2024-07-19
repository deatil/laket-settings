<?php

declare (strict_types = 1);

namespace Laket\Admin\Settings;

use Laket\Admin\Flash\Menu;
use Laket\Admin\Facade\Flash;
use Laket\Admin\Flash\Service as BaseService;

class Service extends BaseService
{
    /**
     * 包名
     */
    protected $pkg = 'laket/laket-settings';
    
    /**
     * slug
     */
    protected $slug = 'laket-admin.flash.settings';
    
    /**
     * 启动
     */
    public function boot()
    {
        Flash::extend('laket/laket-settings', __CLASS__);
    }
    
    /**
     * 在插件安装、插件卸载等操作时有效
     */
    public function action()
    {
        register_install_hook($this->pkg, [$this, 'install']);
        register_uninstall_hook($this->pkg, [$this, 'uninstall']);
        register_upgrade_hook($this->pkg, [$this, 'upgrade']);
        register_enable_hook($this->pkg, [$this, 'enable']);
        register_disable_hook($this->pkg, [$this, 'disable']);
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
        
        // 添加事件
        $this->addEvents();
    }
    
    /**
     * 安装后
     */
    public function install()
    {
        $slug = $this->slug;
        $menus = include __DIR__ . '/../resources/menus/menus.php';
        
        // 添加菜单
        Menu::create($menus);
        
        // 数据库
        Flash::executeSql(__DIR__ . '/../resources/database/install.sql');
    }
    
    /**
     * 卸载后
     */
    public function uninstall()
    {
        Menu::delete($this->slug);
        
        // 数据库
        Flash::executeSql(__DIR__ . '/../resources/database/uninstall.sql');
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
    
    /**
     * 添加事件
     */
    protected function addEvents()
    {
        // 事件
        add_filter('admin_main_url', function($url) {
            $settingUrl = laket_setting('admin_main');
            if (! empty($settingUrl)) {
                $url = $settingUrl;
            }
            
            return $url;
        });
    }
    
}
