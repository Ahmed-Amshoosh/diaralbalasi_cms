<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'image',
        'order',
        'is_active'
    ];

    public $translatable = ['name'];

    protected $casts = [
        'order' => 'integer',
        'is_active' => 'boolean'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $name = $category->getTranslation('name', 'en');

            $category->slug = Str::slug($name);
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}
