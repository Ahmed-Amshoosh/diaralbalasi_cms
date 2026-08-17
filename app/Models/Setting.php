<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Setting extends Model
{
    use HasTranslations;

    protected $fillable = ['key', 'value', 'type', 'group'];

    // هذا السطر هو المحرك الرئيسي: يخبر Laravel بحفظ واسترجاع هذا الحقل كـ JSON متعدد اللغات
    protected $translatable = ['value'];

    // ⚠️ مهم جداً: لا تضع 'value' => 'array' هنا أبداً لتجنب التعارض مع Spatie

    public static function get(string $key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public static function set(string $key, $value, string $group = 'general'): void
    {
        self::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value, // Spatie ستقوم بتشفير المصفوفة كـ JSON تلقائياً
                'group' => $group
            ]
        );
    }

    public static function getGroup(string $group): array
    {
        return self::where('group', $group)->get()->pluck('value', 'key')->toArray();
    }
}
