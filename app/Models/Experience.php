<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'user_id', 
        'description', 
        'image_url', 
        'rating', 
        'description',
        'lat',
        'lng',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function toArray()
    {
        return [
            'user_id' => $this->user_id,
            'title' => $this->title,
            'description' => $this->description,
            'rating' => $this->rating,
            'price' => $this->price,
            'image_url' => $this->image_url,
            'lat' => $this->lat,
            'lng' => $this->lng,

        ];
    }
}
