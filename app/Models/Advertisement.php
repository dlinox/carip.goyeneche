<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'image',
        'more_info_url',
        'author_id',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $appends = [
        'image_url',
    ];

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('uploads/' . $this->image) : null;
    }

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public $headers =  [
        ['text' => "ID", 'value' => "id"],
        ['text' => "Título", 'value' => "title"],
        ['text' => "Imagen", 'value' => "image_url"],
        ['text' => "URL", 'value' => "more_info_url"],
        ['text' => "Activo", 'value' => "is_active"],
    ];
}
