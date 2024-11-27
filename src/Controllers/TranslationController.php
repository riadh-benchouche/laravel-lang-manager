<?php

namespace Riadh\LaravelLangManager\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class TranslationController extends Controller
{
    /**
     * Affiche les traductions disponibles.
     *
     * @return View
     */
    public function index(): View
    {
        // Récupérer toutes les langues disponibles dans resources/lang
        $languages = glob(resource_path('lang/*'), GLOB_ONLYDIR);
        $translations = [];

        foreach ($languages as $languagePath) {
            $language = basename($languagePath);
            $files = glob($languagePath . '/*.php');
            foreach ($files as $file) {
                $translations[$language][basename($file, '.php')] = include $file;
            }
        }

        return view('lang-manager::translations', compact('translations'));
    }

    /**
     * Met à jour les fichiers de traduction.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        // Récupérer les données du formulaire
        $data = $request->input('translations', []);

        foreach ($data as $locale => $files) {
            foreach ($files as $file => $translations) {
                $path = resource_path("lang/$locale/$file.php");

                // Générer le contenu PHP
                $content = "<?php\n\nreturn " . var_export($translations, true) . ";\n";

                // Sauvegarder dans le fichier
                file_put_contents($path, $content);
            }
        }

        return redirect()->route('lang-manager.index')->with('success', 'Translations updated successfully!');
    }
}
