<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\member\Rate;
use App\Models\member\Comment;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';
    protected $fillable = [
        'title',
        'image',
        'description',
        'content'
    ];
    public $timestamps = true;

    public function rates()
    {
        return $this->hasMany(Rate::class, 'blog_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'blog_id', 'id');
    }
}
