# 用户关系扩展


### 1.使用方法

> composer require jasonc/user-relation

### 2.初始化

> php artisan user:relation

### 3.在系统中使用

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
```
