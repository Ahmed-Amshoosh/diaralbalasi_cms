<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Testimonial extends Model {
    use HasTranslations;
    protected $fillable = ['name', 'role', 'content', 'rating', 'order', 'is_active'];
    public $translatable = ['name', 'role', 'content'];
    protected $casts = ['rating' => 'integer', 'order' => 'integer', 'is_active' => 'boolean'];
}
