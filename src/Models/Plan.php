<?php
namespace Shengamo\Billing\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use SoftDeletes;

    protected $fillable =[
        'user_id',
        'name',
        'price',
        'duration',
        'max_seats',
        'tagline',
    ];

    public function features(): HasManyThrough
    {
        return $this->hasManyThrough(Feature::class, FeaturePlan::class);
    }
}
