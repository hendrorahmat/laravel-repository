<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['topic_id', 'title', 'content', 'created_by'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:s',
        'updated_at' => 'datetime:Y-m-d H:m:s',
        'deleted_at' => 'datetime:Y-m-d H:m:s'
    ];

    public function topic() {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    public function tags() {
        return $this->hasMany(Tag::class, 'news_id');
    }
}
