<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'content',
        'subject_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    // 將 content 的資料解密
    // public function getContentAttribute($content)
    // {
    //     return decrypt($content);
    // }

    // 將 content 的資料加密
    // public function setContentAttribute($content)
    // {
    //     $this->attributes['content'] = encrypt($content);
    // }
}
