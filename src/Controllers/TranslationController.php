<?php

namespace Riadh\LaravelLangManager\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class TranslationController extends Controller
{
    /**
     * @title: Display the available translations.
     * @description: Displays all the available translations in the resources/lang directory.
     * @return View
     */
    public function index(): View
    {
        // Get all available languages from the resources/lang directory
        $languages = glob(resource_path('lang/*'), GLOB_ONLYDIR);
        $translations = [];

        foreach ($languages as $languagePath) {
            // Extract the language code (e.g., 'en', 'fr') from the directory name
            $language = basename($languagePath);

            // Get all translation files in the current language directory
            $files = glob($languagePath . '/*.php');
            foreach ($files as $file) {
                // Include the content of each file and store it in the translations array
                $translations[$language][basename($file, '.php')] = include $file;
            }
        }

        // Pass the translations to the view
        return view('lang-manager::translations', compact('translations'));
    }

    /**
     * @title: Update the translation files.
     * @description: Updates the translation files with the new data from the form.
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        // Retrieve the translations and files data from the form
        $data = $request->input('translations', []);
        $files = $request->input('files', []);
        $newKeys = $request->input('new_key', []);
        $newFiles = $request->input('new_file', []);
        $newTranslations = $request->input('new_translations', []);

        // Handle updating existing translations
        foreach ($data as $locale => $fileTranslations) {
            foreach ($fileTranslations as $file => $translations) {
                $this->saveTranslations($locale, $file, $translations);
            }
        }

        // Handle adding new translations
        foreach ($newKeys as $index => $key) {
            foreach ($newTranslations as $locale => $values) {
                $file = $newFiles[$index] ?? 'messages'; // Default to 'messages' if no file is specified
                $path = resource_path("lang/$locale/$file.php");

                // Load existing translations or create a new array
                $existingTranslations = file_exists($path) ? include $path : [];

                // Add the new key-value pair
                $existingTranslations[$key] = $values[$index] ?? '';

                // Save the updated translations
                $this->saveTranslations($locale, $file, $existingTranslations);
            }
        }

        // Redirect back with a success message
        return redirect()->route('lang-manager.index')->with('success', 'Translations updated successfully!');
    }


    /**
     * Save translations to the specified file.
     *
     * @param string $locale
     * @param string $file
     * @param array $translations
     * @return void
     */
    private function saveTranslations(string $locale, string $file, array $translations): void
    {
        $path = resource_path("lang/$locale/$file.php");

        // Generate the PHP content for the translation file
        $content = "<?php\n\nreturn " . var_export($translations, true) . ";\n";

        // Save the content into the translation file
        file_put_contents($path, $content);
    }
}
