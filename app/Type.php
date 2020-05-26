<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
        'name',
        'sort'
    ];

    // 無法連上
    public function animals() {
        return $this->hasMany('App\Animal');
    }
}
