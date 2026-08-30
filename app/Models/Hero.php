<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Hero extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title', 'description', 'sub_title',
        'bg_image',
    ];

    public $translatable = ['title', 'description', 'sub_title'];

    public function getBgImageUrlAttribute(): ?string
    {
        return $this->bg_image ? asset('storage/' . $this->bg_image) : null;
    }

}
