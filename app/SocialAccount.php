<?php

namespace Larashop;

use Illuminate\Database\Eloquent\Model;
use Larashop\Models\User;

class SocialAccount extends Model
{
    protected $guarded = [];

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
