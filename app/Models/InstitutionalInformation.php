<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstitutionalInformation extends Model
{
    use HasFactory;

    protected $table = 'institutional_information';

    protected $fillable = [
        'name',
        'description',
        'address',
        'phone',
        'email',
        'ruc',
        'parties_table',
        'about_us',
        'mission',
        'vision',
        'values',
        'motto',
        'organigram',
        'history',
        'logo',
        'favicon',
        'facebook',
        'twitter',
        'instagram',
        'youtube',
        'whatsapp',
    ];

    protected $appends = [
        'logo_url',
        'favicon_url',
        'organigram_url'
    ];

    public function getLogoUrlAttribute()
    {
        
        return $this->logo ? asset('uploads/' . $this->logo) : null;
    }

    public function getFaviconUrlAttribute()
    {
        return $this->favicon ? asset('uploads/' . $this->favicon) : null;
    }

    public function getOrganigramUrlAttribute()
    {
        return $this->organigram ? asset('uploads/' . $this->organigram) : null;
    }
}
