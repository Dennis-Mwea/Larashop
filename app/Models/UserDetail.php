<?php

namespace Larashop\Models;

use Illuminate\Database\Eloquent\Model;

class userDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'phone_number',
        'email',
        'address',
        'country',
        'zip',
        'city',
        'state',
    ];


    public function user() {
        return $this->belongsTo(UserDetail::class);
    }
}
