<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MarqueeItem extends Model {
    use HasTranslations;

    protected $fillable = ['text', 'order', 'is_active'];

    public $translatable = ['text'];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];
}
