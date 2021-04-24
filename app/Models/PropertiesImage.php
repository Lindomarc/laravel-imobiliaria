<?php

namespace App\Models;

use App\Support\Cropper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PropertiesImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'property_id',
        'path',
        'cover'
    ];

    public function getUrlCroppedAttribute($value)
    {
        return Storage::url(Cropper::thumb($this->path,1366,768));
    }
}
