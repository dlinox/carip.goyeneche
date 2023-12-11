<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseAndService extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'url_information',
        'icon',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public $headers =  [
        ['text' => "ID", 'value' => "id", 'short' => false, 'order' => 'ASC'],
        ['text' => "Url", 'value' => "url_information", 'short' => false, 'order' => 'ASC'],
        ['text' => "Activo", 'value' => "is_active", 'short' => false, 'order' => 'ASC'],
    ];

    protected $appends = [
        'iconPath',
    ];

    public function getIconPathAttribute()
    {
        return asset('storage/' . $this->icon);
    }
}
