<?php

namespace Jason\UserRelation\Traits;

use AsLong\UserRelation\Exceptions\ParentUserException;
use AsLong\UserRelation\Models\UserRelation;

trait UserHasRelations
{

    /**
     * Notes: 创建的监听，转移到这里了
     * @Author: <C.Jason>
     * @Date: 2020/1/13 5:52 下午
     */
    public static function bootHasAccount()
    {
        self::created(function ($model) {
            if (isset($model->parent_id) && is_numeric($model->parent_id) && $model->parent_id != 0) {
                $class  = config('user_relation.user_model');
                $model  = new $class;
                $parent = $model->find($model->parent_id);

                if ($parent) {
                    $model->relation()->create([
                        'parent_id' => $parent->id,
                        'bloodline' => $parent->relation->bloodline . $parent->id . ',',
                        'layer'     => $parent->relation->layer + 1,
                    ]);
                } else {
                    $model->relation()->create([
                        'parent_id' => config('user_relation.default_parent_id'),
                        'bloodline' => config('user_relation.default_parent_id') . ',',
                        'layer'     => 1,
                    ]);
                }
            } else {
                $model->relation()->create([
                    'parent_id' => config('user_relation.default_parent_id'),
                    'bloodline' => config('user_relation.default_parent_id') . ',',
                    'layer'     => 1,
                ]);
            }
        });
    }

    /**
     * 这个参数，是为了给用户创建事件监听模型使用的
     * @var
     */
    public $parent_id;

    /**
     * Notes: 这个方法，是为了给用户创建事件监听模型使用的
     * 目的是去除attribute里面的parent_id参数，防止数据库写入错误
     * @Author: <C.Jason>
     * @Date: 2020/1/13 5:58 下午
     * @param int $parentID
     */
    protected function setParentIdAttribute(int $parentID)
    {
        $this->parent_id = $parentID;
    }

    /**
     * Notes: 用户关联关系
     * @Author: <C.Jason>
     * @Date: 2020/1/13 5:51 下午
     * @return mixed
     */
    public function relation()
    {
        return $this->hasOne(UserRelation::class)->withDefault();
    }

    /**
     * Notes: 上级用户
     * @Author: <C.Jason>
     * @Date: 2020/1/13 5:51 下午
     * @return mixed
     */
    public function parent()
    {
        return $this->relation->parent();
    }

    /**
     * Notes: 按照血缘线，返回所有上级用户
     * @Author: <C.Jason>
     * @Date: 2020/1/13 5:51 下午
     */
    public function parents()
    {
        #todo...
    }

    /**
     * Notes: 所有下级用户
     * @Author: <C.Jason>
     * @Date: 2020/1/13 5:51 下午
     * @return mixed
     */
    public function children()
    {
        return $this->relation->children();
    }

    /**
     * Notes: 修改上级用户
     * @Author: <C.Jason>
     * @Date: 2020/1/13 5:51 下午
     * @param $parentUser
     */
    public function changeParentUser($parentUser)
    {
        $userModel = config('user_relation.user_model');

        if (!($parentUser instanceof $userModel)) {
            throw new ParentUserException('上级用户必须是一个用户模型');
        }

        #todo...
    }

}
