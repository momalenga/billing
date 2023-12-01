<?php

namespace Shengamo\Billing\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feature extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'consumable',
        'duration',
        'description',
    ];

    public function plans(): HasManyThrough
    {
        return $this->hasManyThrough(Plan::class, FeaturePlan::class);
    }
}
