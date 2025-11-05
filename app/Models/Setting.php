<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value_json',
        'description',
    ];

    protected $casts = [
        'value_json' => 'array',
    ];

    /**
     * Get a setting value by key.
     */
    public static function getValue(string $key, $default = null)
    {
        $setting = static::where('key', $key)->first();

        return $setting ? $setting->value_json : $default;
    }

    /**
     * Set a setting value by key.
     */
    public static function setValue(string $key, $value, string $description = null): self
    {
        return static::updateOrCreate(
            ['key' => $key],
            [
                'value_json' => $value,
                'description' => $description,
            ]
        );
    }

    /**
     * Check if a setting exists.
     */
    public static function has(string $key): bool
    {
        return static::where('key', $key)->exists();
    }

    /**
     * Delete a setting by key.
     */
    public static function remove(string $key): bool
    {
        return static::where('key', $key)->delete() > 0;
    }
}
