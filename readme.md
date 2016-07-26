### Larval 5.2 Rbac 示例
#### 说明
- 这只是一个基于Laravel5.2 和 [zizaco/entrust](https://github.com/Zizaco/entrust "zizaco/entrust")实现的RBAC的简单示例应用，可以扩展一下应用到实际项目中。

- 参考了[yuansir/laravel5-rbac-example](https://github.com/yuansir/laravel5-rbac-example) 的一些实现。

- 超级管理员默认ID为1。

- `permissions`表中有一个`group`字段标识后台菜单分组，数值对应`<project>/config/menu.php`文件的配置。

#### 安装步骤

- **clone**代码到本地, `git clone git@github.com:curder/laravel5_rbac.git`

- 项目目录下执行 `composer install`

- 配置 `.env` 中数据库连接信息

- 执行 `php artisan key`

- 项目目录下执行 `php artisan migrate`和`php artisan db:seed`，填充默认的数据库表结构和RBAC相关数据
	- 如果使用mac系统使用mamp环境，执行 `php artisan migrate`的时候可能出现错误，如下：
	```
		[PDOException]                                    
		SQLSTATE[HY000] [2002] No such file or directory
	```
	解决方案，参考这里：[ Getting this error? [PDOException] SQLSTATE[HY000] [2002] No such file or directory](http://www.johnshipp.com/php-artisan-migrate-laravel-5-pdoexception-sqlstatehy000-2002-no-such-file-or-directory-on-a-mac-using-mamp/)
	
    - 如果在安装过程中报如下错误
    > ```
    **FatalErrorException** in `Container.php` line 698:
Maximum function nesting level of '100' reached, aborting!
      ```
	>修改`php.ini`文件`xdebug.max_nesting_level=500`,参考这里：[fatal-error-maximum-function-nesting-level-of-100](http://stackoverflow.com/questions/8656089/solution-for-fatal-error-maximum-function-nesting-level-of-100-reached-abor)

- 项目目录下执行 `php artisan serve` 使用默认的 `http://localhost:8000`访问首页

- 默认后台账号: `admin@admin.com` 密码 : `aaaaaa`

### 以下是截图

#### 普通测试用户权限

![](https://raw.githubusercontent.com/curder/laravel5_rbac/master/public/static/admin/images/01.jpg)

![](https://raw.githubusercontent.com/curder/laravel5_rbac/master/public/static/admin/images/forbidden.jpg)


#### 管理员授权

![](https://raw.githubusercontent.com/curder/laravel5_rbac/master/public/static/admin/images/02.jpg)
![](https://raw.githubusercontent.com/curder/laravel5_rbac/master/public/static/admin/images/03.jpg)


### 感谢开源