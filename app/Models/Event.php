<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    
    protected $fillable=[
        'title',
        'description',
        'slug',
        'image',
        'content',
        'date_publish',
        'external_link',
        'author_id', 
        'is_featured',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',

    ];

    protected $with = [
        
        'author'
    ];


    protected $appends = [
        'image_url',
    ];

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    public $headers =  [
        ['text' => "ID", 'value' => "id", 'short' => false, 'order' => 'ASC'],
        ['text' => "Título", 'value' => "title", 'short' => false, 'order' => 'ASC'],
        ['text' => "Descripción", 'value' => "description", 'short' => false, 'order' => 'ASC'],
        ['text' => "Fecha de publicación", 'value' => "date_publish", 'short' => false, 'order' => 'ASC'],
        ['text' => "Enlace externo", 'value' => "external_link", 'short' => false, 'order' => 'ASC'],
        ['text' => "Destacado", 'value' => "is_featured", 'short' => false, 'order' => 'ASC'],
        ['text' => "Estado", 'value' => "is_active", 'short' => false, 'order' => 'ASC'],
        // ['text' => "Autor", 'value' => "author_id", 'short' => false, 'order' => 'ASC'],
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
