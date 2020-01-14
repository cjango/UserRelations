<?php

namespace Jason\UserRelation\Models;

use Illuminate\Database\Eloquent\Model;

class UserRelation extends Model
{

    const UPDATED_AT = null;

    protected $guarded = [];

    protected $primaryKey = 'user_id';

    public function parent()
    {
        return $this->belongsTo(config('relation.user_model'), 'parent_id');
    }

    public function children()
    {
        return $this->hasManyThrough(config('relation.user_model'), UserRelation::class, 'parent_id', 'id', 'user_id', 'user_id');
    }

    public function getBloodlineAttribute($value)
    {
        return $value ?: config('relation.default_parent_id') . ',';
    }
}
