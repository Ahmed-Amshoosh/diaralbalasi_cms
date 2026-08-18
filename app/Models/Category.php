<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model {
    use HasTranslations;

    protected $fillable = ['name', 'icon', 'image', 'order', 'is_active'];
    public $translatable = ['name'];
    protected $casts = ['order' => 'integer', 'is_active' => 'boolean'];

    public function products() {
        return $this->hasMany(Product::class);
    }

    public function getImageUrlAttribute(): ?string {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}
