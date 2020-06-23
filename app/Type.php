<?php

namespace App;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    // protected $dateFormat = 'Y-m-d H:i:s';

    protected $fillable = [
        'name',
        'sort'
    ];

    protected $guarded = [];

    protected $hidden = [
        'deleted_at'
    ];

    // 將輸出的 timestamp 重新格式化
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    // https://laravel.com/docs/7.x/eloquent-mutators#attribute-casting
    // protected $casts = [];

    public function animals() {
        return $this->hasMany('App\Animal');
    }
}
