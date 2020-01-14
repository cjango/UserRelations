# 用户关系扩展


### 1.使用方法

> composer require jasonc/user-relation

### 2.创建数据库

> php artisan migrate

### 3.发布配置

> php artisan vendor:publish --tag='relation'

### 4.初始化
此功能，用于已经有用户，初始化原有的用户推荐关系使用
> php artisan user:relation

### 5.在系统中使用

调整User模型，增加属性
```php
use Jason\UserRelation\Traits\UserHasRelations;

class User extends Authenticatable
{
    use UserHasRelations;

    public $guarded = [];
}
```

创建用户时，传入 parent_id 属性即可
```php
User::create([
    'username'  => $username,
    'password'  => $password,
    'parent_id' => PARENT_ID,
]);

$user->relation

$user->parent

$user->children
```
