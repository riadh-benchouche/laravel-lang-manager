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
     * @title: Update the translation files.`
     * @description: Updates the translation files with the new data from the form.
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        // Retrieve the translations data from the form
        $data = $request->input('translations', []);

        foreach ($data as $locale => $files) {
            foreach ($files as $file => $translations) {
                // Define the path to the translation file
                $path = resource_path("lang/$locale/$file.php");

                // Generate the PHP content for the translation file
                $content = "<?php\n\nreturn " . var_export($translations, true) . ";\n";

                // Save the content into the translation file
                file_put_contents($path, $content);
            }
        }

        // Redirect back to the translation index page with a success message
        return redirect()->route('lang-manager.index')->with('success', 'Translations updated successfully!');
    }
}
