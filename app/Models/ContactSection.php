<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ContactSection extends Model {
    use HasTranslations;
    protected $fillable = ['label', 'heading', 'description', 'address', 'phones', 'emails'];
    public $translatable = ['label', 'heading', 'description', 'address'];
    protected $casts = ['phones' => 'array', 'emails' => 'array'];
}
