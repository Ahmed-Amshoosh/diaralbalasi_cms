<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Setting extends Model
{
    use HasTranslations;

    protected $fillable = ['key', 'value', 'type', 'group'];
    protected $translatable = ['value'];
    protected $casts = ['value' => 'array'];

    public static function get(string $key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public static function set(string $key, $value, string $group = 'general'): void
    {
        self::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group]
        );
    }

    public static function getGroup(string $group): array
    {
        return self::where('group', $group)->get()->pluck('value', 'key')->toArray();
    }
}
