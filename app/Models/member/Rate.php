<?php

namespace App\Models\member;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\Blog;
use App\Models\User;
class Rate extends Model
{
    use HasFactory;
    protected $table = 'rates';
    protected $fillable = [
        'blog_id',
        'user_id',
        'rate',
    ];
    public $timestamps = true;

    public function blog()
    {
        return $this->belongsTo(Blog::class,'blog_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
