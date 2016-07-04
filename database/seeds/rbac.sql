/*
SQLyog Enterprise v12.08 (64 bit)
MySQL - 5.7.11 : Database - laravel5_rbac
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `migrations` */

LOCK TABLES `migrations` WRITE;

insert  into `migrations`(`migration`,`batch`) values ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2016_06_29_092226_add_some_cloumns_to_users',1),('2016_06_29_151412_entrust_setup_tables',1),('2016_07_03_152707_add_group_to_permissions',1);

UNLOCK TABLES;

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '待验证的邮箱',
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'token验证标志',
  `created_at` timestamp NOT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `password_resets` */

LOCK TABLES `password_resets` WRITE;

UNLOCK TABLES;

/*Table structure for table `permission_role` */

DROP TABLE IF EXISTS `permission_role`;

CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL COMMENT '权限id',
  `role_id` int(10) unsigned NOT NULL COMMENT '角色id',
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `permission_role` */

LOCK TABLES `permission_role` WRITE;

insert  into `permission_role`(`permission_id`,`role_id`) values (1,1),(2,1),(3,1),(5,1),(7,1),(10,1),(11,1),(14,1),(15,1),(16,1),(17,1),(20,1),(21,1),(22,1),(23,1);

UNLOCK TABLES;

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '权限id',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '权限英文名称',
  `parent_id` int(11) DEFAULT NULL COMMENT '上级分类',
  `is_menu` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否为菜单',
  `sort` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `display_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '权限中文名称',
  `group` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '菜单分组',
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '权限相关描述',
  `left` int(11) DEFAULT NULL COMMENT '左索引',
  `right` int(11) DEFAULT NULL COMMENT '右索引',
  `depth` int(11) DEFAULT NULL COMMENT '深度值',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`),
  KEY `permissions_parent_id_index` (`parent_id`),
  KEY `permissions_left_index` (`left`),
  KEY `permissions_right_index` (`right`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `permissions` */

LOCK TABLES `permissions` WRITE;

insert  into `permissions`(`id`,`name`,`parent_id`,`is_menu`,`sort`,`display_name`,`group`,`description`,`left`,`right`,`depth`,`created_at`,`updated_at`) values (1,'admin.index',NULL,1,0,'首页',0,'',1,4,0,'2016-07-04 08:46:14','2016-07-04 10:57:33'),(2,'admin.user',NULL,1,0,'用户',0,'',5,48,0,'2016-07-04 08:49:46','2016-07-04 12:57:37'),(3,'admin.user.index',2,1,0,'用户列表',1,'展示用户列表信息',6,19,1,'2016-07-04 08:52:29','2016-07-04 12:57:37'),(4,'admin.role.index',2,1,0,'角色列表',1,'展示系统角色列表',20,33,1,'2016-07-04 08:53:08','2016-07-04 12:57:37'),(5,'admin.permission.index',2,1,0,'权限列表',1,'展示系统权限',34,47,1,'2016-07-04 08:53:48','2016-07-04 12:57:37'),(6,'admin.user.create',3,0,0,'新增用户',0,'',7,8,2,'2016-07-04 09:05:52','2016-07-04 10:57:33'),(7,'admin.user.edit',3,0,0,'编辑用户（修改密码）',0,'',9,10,2,'2016-07-04 09:06:05','2016-07-04 10:57:33'),(8,'admin.role.create',4,0,0,'新增角色',0,'',21,22,2,'2016-07-04 09:06:22','2016-07-04 12:57:37'),(9,'admin.role.edit',4,0,0,'编辑角色',0,'',23,24,2,'2016-07-04 09:06:37','2016-07-04 12:57:37'),(10,'admin.user.store',3,0,0,'新增用户操作',0,'',11,12,2,'2016-07-04 09:07:02','2016-07-04 10:57:33'),(11,'admin.user.update',3,0,0,'编辑用户操作',0,'',13,14,2,'2016-07-04 09:07:33','2016-07-04 10:57:33'),(12,'admin.role.store',4,0,0,'新增角色操作',0,'',25,26,2,'2016-07-04 09:08:26','2016-07-04 12:57:37'),(13,'admin.role.update',4,0,0,'编辑操作',0,'',27,28,2,'2016-07-04 09:08:44','2016-07-04 12:57:37'),(14,'admin.permission.create',5,0,0,'新增权限视图',0,'',35,36,2,'2016-07-04 09:09:10','2016-07-04 12:57:37'),(15,'admin.permission.store',5,0,0,'新增权限操作',0,'',37,38,2,'2016-07-04 09:10:05','2016-07-04 12:57:37'),(16,'admin.permission.getCreate',5,0,0,'新增子权限视图',0,'',39,40,2,'2016-07-04 09:20:21','2016-07-04 12:57:37'),(17,'admin.permission.getIndex',5,0,0,'子权限列表',0,'',41,42,2,'2016-07-04 09:20:46','2016-07-04 12:57:37'),(18,'admin.role.show',4,0,0,'角色组拥有权限视图',0,'查看角色组拥有的相关权限',29,30,2,'2016-07-04 09:31:08','2016-07-04 12:57:37'),(19,'admin.role.editPersissionToRole',4,0,0,'编辑用户组权限操作',0,'',31,32,2,'2016-07-04 09:31:39','2016-07-04 12:57:37'),(20,'admin.permission.edit',5,0,0,'编辑权限视图',0,'',43,44,2,'2016-07-04 09:40:46','2016-07-04 12:57:37'),(21,'admin.permission.update',5,0,0,'编辑权限操作',0,'',45,46,2,'2016-07-04 09:40:57','2016-07-04 12:57:37'),(22,'admin.index.index',1,0,0,'查看首页',0,'',2,3,1,'2016-07-04 10:57:33','2016-07-04 10:57:33'),(23,'admin.user.getGroup',3,0,0,'用户授权到组',0,'',15,16,2,'2016-07-04 12:57:19','2016-07-04 12:57:19'),(24,'admin.user.postGroup',3,0,0,'用户授权到组操作',0,'',17,18,2,'2016-07-04 12:57:37','2016-07-04 12:57:37');

UNLOCK TABLES;

/*Table structure for table `role_user` */

DROP TABLE IF EXISTS `role_user`;

CREATE TABLE `role_user` (
  `user_id` int(10) unsigned NOT NULL COMMENT '用户id，关联users表',
  `role_id` int(10) unsigned NOT NULL COMMENT '角色id，关联roles表',
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `role_user` */

LOCK TABLES `role_user` WRITE;

insert  into `role_user`(`user_id`,`role_id`) values (2,1);

UNLOCK TABLES;

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色ID',
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '角色英文名称',
  `display_name` char(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '角色中文名称',
  `description` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '角色简要描述',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `roles` */

LOCK TABLES `roles` WRITE;

insert  into `roles`(`id`,`name`,`display_name`,`description`,`created_at`,`updated_at`) values (1,'test','测试角色组','站点测试角色的权限',NULL,NULL);

UNLOCK TABLES;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户名',
  `real_name` char(10) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户真实姓名',
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户邮箱',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '用户状态 -1禁用 0删除 1正常',
  `gender` tinyint(4) NOT NULL DEFAULT '1' COMMENT '用户性别 0不限 1男 2女',
  `password` char(60) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户密码',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'token',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
