# lravel-admin

### 简介:<br />
 基于laravel5.5开发管理后台，集成adminlte模板，包含权限管理和目录设置。
 包含DingoApi搭建的Restful API接口，开箱即用。


### 环境要求:<br />
* PHP > 7.0.0
* Mysql > 5.6

### 功能模块
- 用户管理：
	- 用户可以配置权限
- 角色管理
	- 角色可以配置用户
	- 角色可以配置权限 
- 权限管理：
	- 不需要在代码上进行权限控制；
	- 在权限管理里可以控制controller类的访问；
	- 权限控制可以控制get/post请求，也可以控制某个方法请求；
	- 权限控制的控制也可以上边两种请求的多种结合，可精确某个一请求的控制。
- 菜单管理：
	- 菜单可以对应url前缀、controller类；
	- 可以控制哪些角色可以看到；
	- 菜单的位置可以直接通过拖拽排序。
	

### 安装步骤:  <br />
- composer install  
- npm install
- 修改.env配置
- php artisan migrate
- composer dump-autoload
- php artisan db:seed  <br />
登录用户：admin
登录密码：123456


### 插件

#### 表单提交

- 说明：

> 根据laravel路由restful规则，数据更新Cotroller有两个方法，分别是store，update；store是新数据存储，update是数据修改；在请求参数里的_method=POST对应Controller的store方法，PUT对应Controller的update方法。

- 提交方式：

> 表单以.post方式提交，默认增加参数_method=POST，如果提交的表单有id参数，且id值>0，_method=PUT。

- 参数说明：

```
class ： _submit_，有此class，则使用表单提交插件
data-form-id ：必填，指定要提交的form ID
data-url：选填，以post提交form的URL，如果不填，使用form的action，url遵循store方法的restful规则，如果是数据修改，自动会在url上加上id参数，不需要自己增加；
data-refresh-url：选填，提交成功后跳转的url，如果不填，则当前页面刷新
```
- 插件使用：

```
//提交#form /menu/1的请求，且_method=PUT，提交成功后跳转到/
<form id="form" action='/menu'>
<input type="hidden" name="id" value="1" />
<button type="submit" class="_submit_" data-form-id="form" data-refresh-url="/">提交</button>
```

#### 列表删除

- 说明：

> 根据laravel路由restful规则，数据删除使用的是Controller里的destroy方法，请求参数里有_method=DELETE则会使用到Controller的destroy方法。

- 参数说明：

```
class ： _delete_，有此class，则使用列表数据删除插件
data-url：必填，以post提交此URL，url规则遵循restful
```
- 插件使用：

```
//提交/menu/1请求，且_method=DELETE，提交成功后刷新当前页
<a href="#" class="_delete_" data-url="/menu/1">删除</a>
```


###所做修改（仅供参考）
* `app/Http/Kernel.php` 添加中间件，进行权限控制
* `config/app.php` 注册Admin别名
* `config/auth.php` 添加guards.admin,providers.admin分离前后台用户
* 添加admin路由组



