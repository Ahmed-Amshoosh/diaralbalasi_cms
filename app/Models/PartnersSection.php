<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class PartnersSection extends Model {
    use HasTranslations;
    protected $fillable = ['label', 'heading', 'description'];
    public $translatable = ['label', 'heading', 'description'];
}
