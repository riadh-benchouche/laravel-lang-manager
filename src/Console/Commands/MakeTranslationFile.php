<?php

namespace Riadh\LaravelLangManager\Console\Commands;

use Illuminate\Console\Command;

class MakeTranslationFile extends Command
{
    /**
     * @title: The name and signature of the command.
     * @description: The signature of the command.
     * @var string
     */
    protected $signature = 'lang-manager:make {locale} {file}';

    /**
     * @title: The console command description.
     * @description: Create a translation file for a specific language.
     * @var string
     */
    protected $description = 'Create a translation file for a specific language';

    /**
     * @title: Execute the console command to create a new translation file.
     * @description: Creates a new translation file for a specific language.
     * @return int
     */
    public function handle(): int
    {
        // Get the arguments: locale and file name
        $locale = $this->argument('locale');
        $file = $this->argument('file');

        // Define the path to the translation file
        $path = config('lang-manager.lang_path') . "/$locale/$file.php";

        // Check if the directory exists; create it if it doesn't
        if (!is_dir(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }

        // Check if the file already exists
        if (file_exists($path)) {
            $this->warn("The file $path already exists.");
            return 1;
        }

        // Create an empty PHP file with an empty translations array
        file_put_contents($path, "<?php\n\nreturn [\n\n];\n");

        // Display a success message
        $this->info("The file $path has been successfully created.");
        return 0;
    }
}
