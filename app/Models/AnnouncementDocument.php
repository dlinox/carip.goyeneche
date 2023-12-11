<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnouncementDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        "announcement_id",
        "name",
        "file",
        "date_published",
        "is_active"
    ];

    protected $casts = [
        "is_active" => "boolean"
    ];

    protected $appends = [
        "file_url"
    ];

    protected $hidden = [
        "file",
        "created_at",
        "updated_at"
    ];

    public function getFileUrlAttribute()
    {
        return asset("storage/" . $this->file);
    }
}
