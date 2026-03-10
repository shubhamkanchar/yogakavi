<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gallery extends Model
{
    protected $fillable = [
        'uuid', 'type', 'youtube_link', 'image', 'title', 'description', 'is_active'
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    public function getImageUrlAttribute()
    {
        if ($this->type === 'youtube') {
            return $this->youtube_thumbnail;
        }
        return asset($this->image);
    }

    public function getYoutubeThumbnailAttribute()
    {
        if ($this->type === 'youtube' && $this->youtube_link) {
            // Extract the video ID from common YouTube URLs
            preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $this->youtube_link, $match);
            $videoId = $match[1] ?? null;
            
            if ($videoId) {
                return "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg";
            }
        }
        return null;
    }
}
