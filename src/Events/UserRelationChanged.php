<?php

namespace Jason\UserRelation\Events;

/**
 * 用户关系改变之后
 */
class UserRelationChanged
{
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }
}
