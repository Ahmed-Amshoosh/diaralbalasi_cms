<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Setting extends Model
{
    use HasTranslations;

    protected $fillable = ['key', 'value', 'type', 'group'];

    protected static array $translatableKeys = [
        'site_name',
        'site_description',
        'company_name',
        'address',
    ];

    public $translatable = ['value'];

    public static function isTranslatable(string $key): bool
    {
        return in_array($key, self::$translatableKeys);
    }

    public static function get(string $key, $default = null, ?string $locale = null)
    {
        $setting = self::where('key', $key)->first();
        if (!$setting) return $default;

        $locale ??= app()->getLocale();

        if ($setting->hasTranslation('value', $locale)) {
            return $setting->getTranslation('value', $locale);
        }
        if ($setting->hasTranslation('value', 'ar')) {
            return $setting->getTranslation('value', 'ar');
        }

        return $default;
    }

    public static function set(string $key, $value, string $group = 'general'): void
    {
        $setting = self::firstOrNew(['key' => $key, 'group' => $group]);

        if (self::isTranslatable($key)) {
            foreach ($value as $locale => $translation) {
                $setting->setTranslation('value', $locale, $translation);
            }
        } else {
            $locales = config('translatable.locales', ['ar', 'en']);
            foreach ($locales as $locale) {
                $setting->setTranslation('value', $locale, $value);
            }
        }

        $setting->save();
    }

    public static function getGroup(string $group): array
    {
        return self::where('group', $group)->get()->mapWithKeys(function ($setting) {
            return [$setting->key => self::get($setting->key)];
        })->toArray();
    }
}
