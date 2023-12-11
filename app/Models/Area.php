<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'figure',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];


    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public $headers =  [
        ['text' => "ID", 'value' => "id"],
        ['text' => "Nombre", 'value' => "name"],
        ['text' => "Descripción", 'value' => "description"],
        ['text' => "Figura", 'value' => "figure"],
        ['text' => "Activo", 'value' => "is_active"],
    ];

    
}
