<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'paternal_surname',
        'maternal_surname',
        'registration_code',
        'phone_number',
        'photo',
        'email',
        'document_type',
        'document_number',
        'description',
        'is_active',
        'is_doctor',
        'is_authority',
        'specialty_id',
    ];

    protected $appends = [
        'full_name',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_doctor' => 'boolean',
        'is_authority' => 'boolean',
    ];
    
    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->paternal_surname} {$this->maternal_surname}";
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }


    public $headers =  [
        ['text' => "ID", 'value' => "id"],
        ['text' => "Nombre", 'value' => "full_name"],
        ['text' => "Activo", 'value' => "is_active"],
        // ['text' => "Acciones", 'value' => "actions", 'sortable' => false],
    ];

}
