/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.7.19 : Database - cakeadmin
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cakeadmin` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `cakeadmin`;

/*Table structure for table `ad_arctypes` */

DROP TABLE IF EXISTS `ad_arctypes`;

CREATE TABLE `ad_arctypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `name` varchar(50) DEFAULT NULL COMMENT '栏目名称',
  `parent_id` int(11) DEFAULT NULL COMMENT '父id',
  `level` tinyint(3) NOT NULL DEFAULT '1' COMMENT '级别',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '类型，1文章列表,2图片列表,3单页面',
  `image` varchar(50) DEFAULT NULL COMMENT '图片',
  `isshow` tinyint(2) NOT NULL DEFAULT '1' COMMENT '是否显示，1显示，2隐藏',
  `keywords` varchar(255) DEFAULT NULL COMMENT '关键词',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  `href` varchar(255) DEFAULT NULL COMMENT '跳转链接',
  `enable_columns` text COMMENT '文章开启模块规则,json',
  PRIMARY KEY (`id`),
  UNIQUE KEY `KEYWORDS` (`keywords`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='栏目表';

/*Data for the table `ad_arctypes` */

insert  into `ad_arctypes`(`id`,`name`,`parent_id`,`level`,`sort`,`type`,`image`,`isshow`,`keywords`,`description`,`href`,`enable_columns`) values (1,'首页',0,1,0,3,'',1,NULL,'','','{\"description\":\"1\",\"keywords\":\"1\",\"content\":\"1\",\"image\":\"1\"}'),(2,'幻灯片',1,2,0,2,'',1,NULL,'','','{\"description\":\"1\",\"keywords\":\"1\",\"image\":\"1\",\"istop\":\"1\",\"url\":\"1\"}'),(3,'新闻',0,1,0,1,'',1,NULL,'','','{\"shorttitle\":\"1\",\"color\":\"1\",\"description\":\"1\",\"keywords\":\"1\",\"content\":\"1\",\"image\":\"1\",\"istop\":\"1\"}'),(4,'关于我们',0,1,0,3,'',1,NULL,'','','{\"description\":\"1\",\"keywords\":\"1\",\"content\":\"1\"}');

/*Table structure for table `ad_articles` */

DROP TABLE IF EXISTS `ad_articles`;

CREATE TABLE `ad_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `arctype_id` int(11) DEFAULT NULL COMMENT '栏目id',
  `title` varchar(100) DEFAULT NULL COMMENT '标题',
  `shorttitle` varchar(36) DEFAULT NULL COMMENT '短标题',
  `color` varchar(10) DEFAULT NULL COMMENT '颜色',
  `description` varchar(250) DEFAULT NULL COMMENT '描述',
  `keywords` varchar(100) DEFAULT NULL COMMENT '关键字',
  `content` mediumtext COMMENT '内容',
  `pubdate` datetime DEFAULT NULL COMMENT '发布时间',
  `image` varchar(200) DEFAULT NULL COMMENT '缩略图',
  `autoimage` tinyint(2) DEFAULT '2' COMMENT '是否提取图片，1是，2否。提取内容中第一个图片为缩略图',
  `tag` varchar(100) DEFAULT NULL COMMENT '标签',
  `isshow` tinyint(2) DEFAULT '1' COMMENT '是否显示，1显示，2隐藏',
  `istop` tinyint(2) DEFAULT '2' COMMENT '是否置顶，1是，2否',
  `user_id` int(11) DEFAULT NULL COMMENT '管理员id',
  `url` varchar(255) DEFAULT NULL COMMENT '跳转链接',
  `created` datetime DEFAULT NULL COMMENT '创建时间',
  `modified` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `created` (`created`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='文章表';

/*Data for the table `ad_articles` */

insert  into `ad_articles`(`id`,`arctype_id`,`title`,`shorttitle`,`color`,`description`,`keywords`,`content`,`pubdate`,`image`,`autoimage`,`tag`,`isshow`,`istop`,`user_id`,`url`,`created`,`modified`) values (1,2,'幻灯片1','sdf','#891b1b','bbbbbbbbbb','aaaaaa','<p>\r\n	<img src=\"/github/cakecms-2.0/webroot/assets/b-jui/BJUI/plugins/kindeditor/attached/image/20180517/20180517044357_60705.png\" alt=\"\" />\r\n</p>\r\n<p>\r\n	dsfsdf\r\n</p>','2018-05-17 10:42:10','assets/b-jui/BJUI/plugins/kindeditor/attached/image/20180517/20180517044357_60705.png',1,NULL,2,1,1,'df','2018-05-17 10:44:04','2018-05-17 10:44:04'),(4,3,'新闻12','12','#42821c','','','','2018-05-17 13:39:59','files/20180522/vi127di3.png',2,NULL,1,1,1,NULL,'2018-05-17 13:40:10','2018-05-22 14:43:29'),(3,2,'sdf1','','','','','','2018-05-17 11:41:42','files/20180517/ebu2p72s.png',2,NULL,1,2,1,'','2018-05-17 11:41:49','2018-05-17 11:50:44'),(8,4,'关于我们123213',NULL,NULL,'','123123','','2018-05-17 14:25:39',NULL,2,NULL,1,2,1,NULL,'2018-05-17 14:25:44','2018-05-17 14:25:47');

/*Table structure for table `ad_auth_rules` */

DROP TABLE IF EXISTS `ad_auth_rules`;

CREATE TABLE `ad_auth_rules` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父级id',
  `name` varchar(80) NOT NULL COMMENT '规则唯一标识',
  `title` varchar(20) NOT NULL COMMENT '规则中文名称',
  `condition` varchar(100) DEFAULT NULL COMMENT '规则表达式',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COMMENT='规则表';

/*Data for the table `ad_auth_rules` */

insert  into `ad_auth_rules`(`id`,`parent_id`,`name`,`title`,`condition`) values (1,0,'admin/articles/listPageMain','文章管理',NULL),(2,0,'admin/articles/onePageMain','单页管理',NULL),(3,1,'admin/articles/picPageManage','图片列表管理',NULL),(4,1,'admin/articles/listPageManage','文章列表关联',NULL),(5,2,'admin/articles/onePageManage','单页面内容管理',NULL),(6,1,'admin/articles/add','添加',NULL),(7,1,'admin/articles/delete','删除',NULL),(8,1,'admin/articles/edit','编辑',NULL),(9,0,'admin/arctypes/index','栏目管理',NULL),(10,9,'admin/arctypes/add','新增',NULL),(11,9,'admin/arctypes/edit','编辑',NULL),(12,9,'admin/arctypes/delete','删除',NULL),(13,0,'admin/roles/index','管理员组',NULL),(14,13,'admin/roles/add','新增',NULL),(15,13,'admin/roles/edit','编辑',NULL),(16,13,'admin/roles/delete','删除',NULL),(17,13,'admin/roles/manage','菜单权限管理',NULL),(18,0,'admin/users/index','用户管理',NULL),(19,18,'admin/users/add','添加',NULL),(20,18,'admin/users/edit','编辑',NULL),(21,18,'admin/users/delete','删除',NULL),(22,0,'admin/options/index','系统设置',NULL),(23,0,'admin/menus/index','菜单管理',NULL),(24,23,'admin/menus/add','新增',NULL),(25,23,'admin/menus/edit','编辑',NULL),(26,23,'admin/menus/delete','删除',NULL),(27,0,'admin/authRoles/index','权限管理',NULL),(28,27,'admin/authRoles/add','新增',NULL),(29,27,'admin/authRoles/edit','编辑',NULL),(30,27,'admin/authRoles/delete','删除',NULL),(31,0,'admin/upload/fileupload','图片上传',NULL),(32,31,'admin/upload/comm','公共方法',NULL);

/*Table structure for table `ad_menus` */

DROP TABLE IF EXISTS `ad_menus`;

CREATE TABLE `ad_menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `name` varchar(50) DEFAULT NULL COMMENT '菜单名称',
  `parent_id` int(11) DEFAULT '0' COMMENT '上级菜单id',
  `level` tinyint(3) DEFAULT '1' COMMENT '菜单级别',
  `icon` varchar(20) DEFAULT NULL COMMENT '菜单图标',
  `target` varchar(50) DEFAULT NULL COMMENT '菜单链接',
  `reload` varchar(20) DEFAULT NULL COMMENT '重新载入某个标签',
  `sort` tinyint(3) DEFAULT '0' COMMENT '菜单排序',
  `isshow` tinyint(2) DEFAULT '1' COMMENT '是否显示。1显示，2隐藏',
  `created` datetime DEFAULT NULL COMMENT '创建时间',
  `modified` datetime DEFAULT NULL COMMENT '修改时间',
  `is_system` tinyint(2) NOT NULL DEFAULT '2' COMMENT '是否为系统内置',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='菜单表';

/*Data for the table `ad_menus` */

insert  into `ad_menus`(`id`,`name`,`parent_id`,`level`,`icon`,`target`,`reload`,`sort`,`isshow`,`created`,`modified`,`is_system`) values (1,'系统管理',0,1,'fa-cogs','','',-99,1,'2017-09-22 17:08:36','0000-00-00 00:00:00',1),(2,'系统管理',1,2,'cogs','','',0,1,'2017-09-22 17:08:39','0000-00-00 00:00:00',1),(3,'管理员组',2,3,'fa-caret-right','admin/roles/index','roles',0,1,'2017-09-22 17:08:41','0000-00-00 00:00:00',1),(4,'用户管理',2,3,'fa-caret-right','admin/users/index','users',0,1,'2017-09-22 17:08:42','0000-00-00 00:00:00',1),(5,'系统设置',2,3,'fa-caret-right','admin/options/index','options',0,1,'2017-09-22 17:08:44','0000-00-00 00:00:00',1),(6,'菜单管理',2,3,'fa-caret-right','admin/menus/index','menus',0,1,'2017-09-22 17:08:51','0000-00-00 00:00:00',1),(7,'信息管理',0,1,'fa-list-ul','','',1,1,'2017-09-22 17:08:53','0000-00-00 00:00:00',1),(8,'信息管理',7,2,'list-ul','','',0,1,'2017-09-22 17:08:55','0000-00-00 00:00:00',1),(9,'栏目管理',8,3,'fa-caret-right','admin/arctypes/index','arctypes',0,1,'2017-09-22 17:08:56','0000-00-00 00:00:00',1),(11,'单页',8,3,'fa-caret-right','admin/articles/one-page-main','onepagemain',97,1,'2018-05-15 08:44:56','2018-05-16 07:04:18',1),(12,'文章',8,3,'fa-caret-right','admin/articles/list-page-main','listpagemain',99,1,'2018-05-15 08:45:16','2018-05-16 07:44:37',1),(13,'权限管理',2,3,'fa-caret-right','admin/auth-rules/index','authrule',0,1,'2018-05-17 15:01:38','2018-05-17 15:01:38',1);

/*Table structure for table `ad_options` */

DROP TABLE IF EXISTS `ad_options`;

CREATE TABLE `ad_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `name` varchar(50) DEFAULT NULL COMMENT '名称',
  `field` varchar(50) DEFAULT NULL COMMENT '字段名',
  `value` text COMMENT '值',
  `type` varchar(50) DEFAULT NULL COMMENT '所属分类',
  `autoload` varchar(20) DEFAULT 'yes' COMMENT '是否自动加载，缓存起来',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='系统配置表';

/*Data for the table `ad_options` */

insert  into `ad_options`(`id`,`name`,`field`,`value`,`type`,`autoload`) values (1,'系统名称','systemname','CakeCMS管理系统','system','yes'),(2,'系统logo','systemlogo','img/cake-logo.png','system','yes'),(3,'显示系统名称','systemnamehide','1','system','yes'),(4,'起始年份','systemyear','2018','system','yes'),(5,'底部信息','systemfoot','Copyright © 2018 CakeCMS','system','yes'),(6,'百度地图','baidu','','other','yes'),(7,'云片短信','yunpian','','other','yes'),(8,'站点名称','sitename','','site','yes'),(9,'站点副名称','sitefuname','','site','yes'),(10,'站点描述','sitedesc','','site','yes'),(11,'关键词','sitekeywords','','site','yes'),(12,'版权信息','sitecopyright','','site','yes'),(13,'备案编号','siteicpsn','','site','yes'),(14,'统计代码','sitestatistics','','site','yes'),(15,'登录名称','systemlogin','CakeCMS管理系统','system','yes'),(16,NULL,'systemfulltext','1','system','yes');

/*Table structure for table `ad_roles` */

DROP TABLE IF EXISTS `ad_roles`;

CREATE TABLE `ad_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `name` varchar(50) DEFAULT NULL COMMENT '组别名称',
  `menus` text COMMENT '菜单权限',
  `rules` text,
  `note` varchar(100) DEFAULT NULL COMMENT '备注',
  `sort` int(11) DEFAULT '0' COMMENT '排序id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理员组表';

/*Data for the table `ad_roles` */

insert  into `ad_roles`(`id`,`name`,`menus`,`rules`,`note`,`sort`) values (1,'管理员组','[\"7\",\"8\",\"12\",\"11\",\"9\",\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"13\"]','[\"1\",\"3\",\"4\",\"6\",\"7\",\"8\",\"2\",\"5\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\",\"21\",\"22\",\"23\",\"24\",\"25\",\"26\",\"27\",\"28\",\"29\",\"30\"]','',2);

/*Table structure for table `ad_search_index` */

DROP TABLE IF EXISTS `ad_search_index`;

CREATE TABLE `ad_search_index` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `obj_type` varchar(20) NOT NULL COMMENT '模块类型',
  `obj_id` int(11) unsigned NOT NULL COMMENT '关联id',
  `title` text NOT NULL COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `params` text COMMENT '拓展字段',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `object` (`obj_type`,`obj_id`),
  FULLTEXT KEY `content` (`title`,`content`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='全文索引';

/*Data for the table `ad_search_index` */

/*Table structure for table `ad_users` */

DROP TABLE IF EXISTS `ad_users`;

CREATE TABLE `ad_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `username` varchar(50) DEFAULT NULL COMMENT '登录名',
  `password` varchar(100) DEFAULT NULL COMMENT '登录密码',
  `nickname` varchar(50) DEFAULT NULL COMMENT '昵称',
  `role_id` int(11) DEFAULT NULL COMMENT '用户组id',
  `state` tinyint(2) DEFAULT '1' COMMENT '登录状态.1正常，2禁止',
  `created` datetime DEFAULT NULL COMMENT '创建时间',
  `modified` datetime NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理员表';

/*Data for the table `ad_users` */

insert  into `ad_users`(`id`,`username`,`password`,`nickname`,`role_id`,`state`,`created`,`modified`) values (1,'admin','$2y$10$v5bE3wc3AASZSK05CLUvf.hhjWxWEfXZGz.1LAVtNn/70n6DsVFOi','管理员',1,1,'2017-09-22 15:16:50','2018-05-16 01:40:42');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
