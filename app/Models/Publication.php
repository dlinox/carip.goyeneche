<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'author_id',
        'is_active',
        'slug'

    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $appends = [
        'image_url',
        'area_name',
    ];

    public function getAreaNameAttribute()
    {
        return $this->author->area->name;
    }


    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getImageUrlAttribute()
    {

        return $this->image ? asset('uploads/' . $this->image) : null;
    }

    public $headers =  [
        ['text' => "ID", 'value' => "id", 'short' => false, 'order' => 'ASC'],
        ['text' => "Nombre", 'value' => "name", 'short' => false, 'order' => 'ASC'],
        ['text' => "Documentos", 'value' => "documents", 'short' => false, 'order' => 'ASC'],
        ['text' => "Area", 'value' => "area_name", 'short' => false, 'order' => 'ASC'],


        ['text' => "Estado", 'value' => "is_active", 'short' => false, 'order' => 'ASC'],
    ];

    protected $with = [
        'documents',
        'author'
    ];

    public function documents()
    {
        return $this->hasMany(PublicationDocument::class, 'publication_id');
    }
}
