<?php

use think\facade\Route;
use Laket\Admin\Facade\Flash;
use Laket\Admin\Settings\Controller\Config;

/**
 * 路由
 */
Flash::routes(function() {
    Route::get('settings/index', Config::class . '@index')->name('admin.settings.index');
    Route::post('settings/index', Config::class . '@index')->name('admin.settings.index-post');
    Route::get('settings/all', Config::class . '@all')->name('admin.settings.all');
    Route::post('settings/all', Config::class . '@all')->name('admin.settings.all-post');
    Route::get('settings/setting', Config::class . '@setting')->name('admin.settings.setting');
    Route::post('settings/setting', Config::class . '@setting')->name('admin.settings.setting-post');
    Route::get('settings/add', Config::class . '@add')->name('admin.settings.add');
    Route::post('settings/add', Config::class . '@add')->name('admin.settings.add-post');
    Route::get('settings/edit', Config::class . '@edit')->name('admin.settings.edit');
    Route::post('settings/edit', Config::class . '@edit')->name('admin.settings.edit-post');
    Route::post('settings/del', Config::class . '@del')->name('admin.settings.del-post');
    Route::post('settings/listorder', Config::class . '@listorder')->name('admin.settings.listorder-post');
    Route::post('settings/setstate', Config::class . '@setstate')->name('admin.settings.setstate-post');
});