<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'category_id',
        'partner_id',
        'order',
        'is_active'
    ];

    public $translatable = ['name', 'description'];

    protected $casts = [
        'price' => 'decimal:2',
        'order' => 'integer',
        'is_active' => 'boolean'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $name = $product->getTranslation('name', 'en');

            $product->slug = Str::slug($name);
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function getMainImageAttribute(): ?string
    {
        $firstImage = $this->images()->first();

        return $firstImage
            ? asset('storage/' . $firstImage->image)
            : null;
    }
}
