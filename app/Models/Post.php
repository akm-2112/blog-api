<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;
    protected $fillable=
    [
        'title',
        'context',
    ];

    public function user(){
        return $this->belongsTo(\App\Models\User::class);
    }
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'post_categories');
    }
    public function tags() :BelongsToMany
    {
        return $this->belongsToMany(Tag::class,'post_tags');
    }
}

