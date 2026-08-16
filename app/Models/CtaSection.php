<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class CtaSection extends Model {
    use HasTranslations;

    protected $fillable = ['heading', 'description', 'button_text', 'image'];

    public $translatable = ['heading', 'description', 'button_text'];

    public function getImageUrlAttribute(): ?string {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}
