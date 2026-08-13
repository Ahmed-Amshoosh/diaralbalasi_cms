<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class WhyUsItem extends Model {
    use HasTranslations;

    protected $fillable = ['icon', 'title', 'description', 'order', 'is_active'];
    public $translatable = ['title', 'description'];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];
}
