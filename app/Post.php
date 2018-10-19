<?php

namespace Larashop;

use Illuminate\Database\Eloquent\Model;
use Larashop\Models\User;

class Post extends Model{
    public function user(){
    	return $this->belongsTo(User::class);
    }
}
