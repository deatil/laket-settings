<?php

// 类型
return [
    [
        "name" => "number",
        "title" => "数字",
        "default_define" => "int(10) UNSIGNED NOT NULL DEFAULT '0'",
        "type" => "int",
        "ifoption" => 0,
        "ifstring" => 0,
        "vrule" => "",
        "pattern" => ""
    ],
    [
        "name" => "text",
        "title" => "输入框",
        "default_define" => "varchar(255) NOT NULL DEFAULT ''",
        "type" => "varchar",
        "ifoption" => 0,
        "ifstring" => 1,
        "vrule" => "",
        "pattern" => ""
    ],
    [
        "name" => "textarea",
        "title" => "多行文本",
        "default_define" => "varchar(255) NOT NULL DEFAULT ''",
        "type" => "varchar",
        "ifoption" => 0,
        "ifstring" => 1,
        "vrule" => "",
        "pattern" => ""
    ],
    [
        "name" => "radio",
        "title" => "单选按钮",
        "default_define" => "varchar(10) NOT NULL DEFAULT ''",
        "type" => "varchar",
        "ifoption" => 1,
        "ifstring" => 0,
        "vrule" => "",
        "pattern" => ""
    ],
    [
        "name" => "checkbox",
        "title" => "复选按钮",
        "default_define" => "varchar(32) NOT NULL DEFAULT ''",
        "type" => "varchar",
        "ifoption" => 1,
        "ifstring" => 0,
        "vrule" => "",
        "pattern" => ""
    ],
    [
        "name" => "switch",
        "title" => "开关",
        "default_define" => "tinyint(2) UNSIGNED NOT NULL DEFAULT '0'",
        "type" => "tinyint",
        "ifoption" => 0,
        "ifstring" => 0,
        "vrule" => "isBool",
        "pattern" => ""
    ],
    [
        "name" => "select",
        "title" => "下拉框",
        "default_define" => "varchar(10) NOT NULL DEFAULT ''",
        "type" => "varchar",
        "ifoption" => 1,
        "ifstring" => 0,
        "vrule" => "",
        "pattern" => ""
    ],
    [
        "name" => "array",
        "title" => "数组",
        "default_define" => "varchar(512) NOT NULL DEFAULT ''",
        "type" => "varchar",
        "ifoption" => 0,
        "ifstring" => 0,
        "vrule" => "",
        "pattern" => ""
    ],
    [
        "name" => "image",
        "title" => "单张图",
        "default_define" => "varchar(32) NOT NULL DEFAULT ''",
        "type" => "varchar",
        "ifoption" => 0,
        "ifstring" => 0,
        "vrule" => "",
        "pattern" => ""
    ],
    [
        "name" => "images",
        "title" => "多张图",
        "default_define" => "text NOT NULL DEFAULT ''",
        "type" => "text",
        "ifoption" => 0,
        "ifstring" => 0,
        "vrule" => "",
        "pattern" => ""
    ],
    [
        "name" => "color",
        "title" => "颜色值",
        "default_define" => "varchar(7) NOT NULL DEFAULT ''",
        "type" => "varchar",
        "ifoption" => 0,
        "ifstring" => 0,
        "vrule" => "",
        "pattern" => ""
    ],
    [
        "name" => "date",
        "title" => "日期",
        "default_define" => "int(10) UNSIGNED NOT NULL DEFAULT '0'",
        "type" => "int",
        "ifoption" => 0,
        "ifstring" => 0,
        "vrule" => "",
        "pattern" => ""
    ],
    [
        "name" => "datetime",
        "title" => "日期和时间",
        "default_define" => "int(10) UNSIGNED NOT NULL DEFAULT '0'",
        "type" => "int",
        "ifoption" => 0,
        "ifstring" => 0,
        "vrule" => "",
        "pattern" => ""
    ],
    [
        "name" => "file",
        "title" => "单文件",
        "default_define" => "varchar(32) NOT NULL DEFAULT ''",
        "type" => "varchar",
        "ifoption" => 0,
        "ifstring" => 0,
        "vrule" => "",
        "pattern" => ""
    ],
    [
        "name" => "files",
        "title" => "多文件",
        "default_define" => "text NOT NULL DEFAULT ''",
        "type" => "text",
        "ifoption" => 0,
        "ifstring" => 0,
        "vrule" => "",
        "pattern" => ""
    ],
    [
        "name" => "hidden",
        "title" => "隐藏值",
        "default_define" => "varchar(255) NOT NULL DEFAULT ''",
        "type" => "varchar",
        "ifoption" => 0,
        "ifstring" => 1,
        "vrule" => "",
        "pattern" => ""
    ],
    [
        "name" => "password",
        "title" => "密码",
        "default_define" => "varchar(255) NOT NULL DEFAULT ''",
        "type" => "varchar",
        "ifoption" => 0,
        "ifstring" => 1,
        "vrule" => "",
        "pattern" => ""
    ],
    [
        "name" => "tags",
        "title" => "标签",
        "default_define" => "varchar(255) NOT NULL DEFAULT ''",
        "type" => "varchar",
        "ifoption" => 0,
        "ifstring" => 1,
        "vrule" => "",
        "pattern" => ""
    ]
];