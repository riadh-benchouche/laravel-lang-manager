<?php

namespace Riadh\LaravelLangManager\Console\Commands;

use Illuminate\Console\Command;

class MakeTranslationFile extends Command
{
    /**
     * Le nom et la signature de la commande.
     *
     * @var string
     */
    protected $signature = 'lang-manager:make {locale} {file}';

    /**
     * La description de la commande.
     *
     * @var string
     */
    protected $description = 'Créer un fichier de traduction pour une langue donnée';

    /**
     * Exécute la commande.
     *
     * @return int
     */
    public function handle()
    {
        $locale = $this->argument('locale');
        $file = $this->argument('file');

        $path = config('lang-manager.lang_path') . "/$locale/$file.php";

        // Vérifier si le dossier existe, sinon le créer
        if (!is_dir(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }

        // Vérifier si le fichier existe déjà
        if (file_exists($path)) {
            $this->warn("Le fichier $path existe déjà.");
            return 1;
        }

        // Créer un fichier PHP vide avec un tableau de traductions
        file_put_contents($path, "<?php\n\nreturn [\n\n];\n");

        $this->info("Le fichier $path a été créé avec succès.");
        return 0;
    }
}
