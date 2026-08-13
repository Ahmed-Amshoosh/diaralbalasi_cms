<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class AboutSection extends Model {
    use HasTranslations;

    protected $fillable = [
        'label', 'heading', 'description', 'main_image', 'secondary_image',
        'experience_number', 'experience_text', 'features'
    ];

    public $translatable = ['label', 'heading', 'description', 'experience_text'];

    protected $casts = [
        'features' => 'array',
    ];

    public function getMainImageUrlAttribute(): ?string {
        return $this->main_image ? asset('storage/' . $this->main_image) : null;
    }

    public function getSecondaryImageUrlAttribute(): ?string {
        return $this->secondary_image ? asset('storage/' . $this->secondary_image) : null;
    }
}
