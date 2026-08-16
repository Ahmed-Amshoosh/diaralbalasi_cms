<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Partner extends Model {
    use HasTranslations;
    protected $fillable = ['name', 'logo', 'order', 'is_active'];
    public $translatable = ['name'];
    protected $casts = ['is_active' => 'boolean', 'order' => 'integer'];

    public function getLogoUrlAttribute(): ?string {
        return $this->logo ? asset('storage/' . $this->logo) : null;
    }
}
