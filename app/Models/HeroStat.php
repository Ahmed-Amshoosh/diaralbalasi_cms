<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class HeroStat extends Model {
    use HasTranslations;

    protected $fillable = ['number', 'label', 'order', 'is_active'];

    public $translatable = ['label'];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];
}
