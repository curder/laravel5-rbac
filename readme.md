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