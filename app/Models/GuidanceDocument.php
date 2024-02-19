<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuidanceDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'guide_name',
        'guide_file', //PDF
        'resolution_name',
        'resolution_file', //PDF
        'date_published',
        'is_active',
        'author_id'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $appends = [
        'guide_file_url',
        'resolution_file_url',
    ];

    public function getGuideFileUrlAttribute()
    {
        return $this->guide_file ? asset('uploads/' . $this->guide_file) : null;
    }

    public function getResolutionFileUrlAttribute()
    {
        return $this->resolution_file ? asset('uploads/' . $this->resolution_file) : null;
    }


    public $headers =  [
        ['text' => "ID", 'value' => "id", 'short' => false, 'order' => 'ASC'],
        ['text' => "Guía", 'value' => "guide_name", 'short' => false, 'order' => 'ASC'],
        ['text' => "Documento Guía ", 'value' => "guide_file", 'short' => false, 'order' => 'ASC'],
        ['text' => "Resolución", 'value' => "resolution_name", 'short' => false, 'order' => 'ASC'],
        ['text' => "Documento Resolución", 'value' => "resolution_file", 'short' => false, 'order' => 'ASC'],
        ['text' => "Fecha de publicación", 'value' => "date_published", 'short' => false, 'order' => 'ASC'],
        ['text' => "Estado", 'value' => "is_active", 'short' => false, 'order' => 'ASC'],
    ];
}
