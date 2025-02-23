<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'slug',
        'user_id'
    ];

    protected $with = ['user']; // Always load the user relationship

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($blog) {
            if (!$blog->slug) {
                $blog->slug = Str::slug($blog->title);
            }
        });
    }
} 