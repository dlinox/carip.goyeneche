<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalService extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'specialty_id',
        'worker_id',
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
        'image_url',
        'specialty_name',
    ];

    public function getImageUrlAttribute()
    {
        return asset('uploads/' . $this->image);
    }

    public function getSpecialtyNameAttribute()
    {
        return $this->specialty ? $this->specialty->name : '';
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    public $headers =  [
        ['text' => "ID", 'value' => "id", 'short' => false, 'order' => 'ASC'],
        ['text' => "Nombre", 'value' => "name", 'short' => false, 'order' => 'ASC'],
        ['text' => "Imagen", 'value' => "image_url", 'short' => false, 'order' => 'ASC'],
        ['text' => "Estado", 'value' => "is_active", 'short' => false, 'order' => 'ASC'],
    ];
}
