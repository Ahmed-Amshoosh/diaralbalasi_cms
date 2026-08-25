<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Setting extends Model
{
    use HasTranslations;

    protected $fillable = ['key', 'value', 'type', 'group'];

    protected $translatable = ['value'];

    public static function get(string $key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public static function set(string $key, $value, string $group = 'general'): void
    {
        $setting = self::firstOrNew(['key' => $key, 'group' => $group]);

        if (is_array($value)) {
            foreach ($value as $locale => $translation) {
                $setting->setTranslation('value', $locale, $translation);
            }
        } else {
            $setting->value = $value;
        }

        $setting->save();
    }

    public static function getGroup(string $group): array
    {
        return self::where('group', $group)->get()->pluck('value', 'key')->toArray();
    }
}
