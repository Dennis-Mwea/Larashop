<?php

namespace Larashop\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Larashop\Models\Category;
use Larashop\Models\User;

class Brand extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get the products for the brand.
     */
    public function products()
    {
        return $this->hasMany('Larashop\Models\Product','brand_id','id');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     *
     */
    public function categories() {
        return $this->hasMany(Category::class);
    }
}
