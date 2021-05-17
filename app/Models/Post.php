<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['identifier', 'title', 'user_id', 'slug', 'content'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function toArray()
    {
        return [
            'identifier' => $this->identifier,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
        ];
    }
}
