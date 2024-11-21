<?php

namespace Riadh\LaravelLangManager\Services;

use Illuminate\Support\Facades\File;

/**
 * Service to manage translations.
 * Handles reading and manipulating translation files.
 */
class TranslationService
{
    /**
     * @Title  Read translations from a file for a specific locale.
     *
     * @param string $locale The locale to load translations for (e.g., 'en', 'fr').
     * @param string $format The format of the file ('json' or 'php').
     * @return array The translations as a key-value array.
     */
    public function readTranslations(string $locale, string $format = 'json'): array
    {
        // Determine the file path based on locale and format
        $path = resource_path("lang/{$locale}.{$format}");

        if (!File::exists($path)) {
            return []; // Return an empty array if the file does not exist
        }

        if ($format === 'json') {
            return json_decode(File::get($path), true) ?? [];
        }

        if ($format === 'php') {
            return File::getRequire($path) ?? [];
        }

        // Unsupported format
        throw new \InvalidArgumentException("Unsupported format: {$format}");
    }
}
