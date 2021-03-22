DROP TABLE IF EXISTS `pre__settings_config`;
CREATE TABLE `pre__settings_config` (
  `id` char(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '配置ID',
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '配置名称',
  `type` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '配置类型',
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '配置标题',
  `group` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '配置分组',
  `options` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '配置项',
  `remark` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '配置说明',
  `value` text COLLATE utf8mb4_unicode_ci COMMENT '配置值',
  `listorder` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `is_show` tinyint(1) DEFAULT '1' COMMENT '1-显示',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `update_time` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `add_time` int(10) DEFAULT '0' COMMENT '添加时间',
  `add_ip` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '添加IP',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `type` (`type`),
  KEY `group` (`group`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='网站配置';

REPLACE INTO `pre__settings_config` (`id`,`name`,`type`,`title`,`group`,`options`,`remark`,`value`,`listorder`,`is_show`,`status`,`update_time`,`create_time`,`add_time`,`add_ip`) VALUES ('1d7d470b81c6d7965ce6c2eab8b3c2de','upload_thumb_water_alpha','text','水印透明度','upload','','请输入0~100之间的数字，数字越小，透明度越高','50',8,1,1,1552436083,1552435299,0,''),('22cf857d6d5fb38a940ab8e3c1b77746','admin_main','text','后台首页','system','','后台首页链接，默认lake-admin后台首页','',10,1,1,1573398116,1571319251,0,''),('40e0305dbfb74d8eb75a048b2d2cde26','upload_file_ext','text','允许上传的文件后缀','upload','','多个后缀用逗号隔开，不填写则不限制类型','doc,docx,xls,xlsx,ppt,pptx,pdf,wps,txt,rar,zip,gz,bz2,7z',4,1,1,1552436080,1540457659,0,''),('5212d1baa0c8d105bfcde8dd74c93c17','upload_thumb_water_pic','image','水印图片','upload','','只有开启水印功能才生效','7fa0976005ce96f4feb3e0a9511c04cc',6,1,1,1552436081,1552435183,0,''),('87445ce1690defabff5426ab133927f6','upload_driver','radio','上传驱动','upload','{\"public\":\"本地\"}','图片或文件上传驱动','public',9,1,1,1552436085,1541752781,0,''),('90fa5b07881d16206c5c39a1b87e0d09','upload_image_size','text','图片上传大小限制','upload','','0为不限制大小，单位：kb','0',2,1,1,1552436075,1540457656,0,''),('9fe6fa5cbfdb51a866f9150b18bfd0aa','upload_thumb_water_position','select','水印位置','upload','{\"1\":\"左上角\",\"2\":\"上居中\",\"3\":\"右上角\",\"4\":\"左居中\",\"5\":\"居中\",\"6\":\"右居中\",\"7\":\"左下角\",\"8\":\"下居中\",\"9\":\"右下角\"}','只有开启水印功能才生效','9',7,1,1,1552436082,1552435257,0,''),('aa033250e51c3dc21eeb22f506c2d859','admin_allow_ip','textarea','后台允许访问IP','system','','匹配IP段用\"*\"占位，如192.168.*.*，多个IP地址请用英文逗号\",\"分割','',15,1,1,1571319287,1551244957,0,''),('c637bbc27673a8c253807cc19984550f','config_group','array','配置分组','system','{}','字段请不要使用数字','{\"system\":\"系统\",\"upload\":\"上传\"}',5,0,1,1577020289,1494408414,0,''),('da237e7fe5b27b745f00ece22ed2a002','upload_image_ext','text','允许上传的图片后缀','upload','','多个后缀用逗号隔开，不填写则不限制类型','gif,jpg,jpeg,bmp,png',1,1,1,1552436074,1540457657,0,''),('e4de02664583b150c657f33cd484bfb1','upload_thumb_water','switch','添加水印','upload','','','0',5,1,1,1552436080,1552435063,0,''),('e74a14f7239321408b2821de42e4a4cd','upload_file_size','text','文件上传大小限制','upload','','0为不限制大小，单位：kb','0',3,1,1,1552436078,1540457658,0,'');
