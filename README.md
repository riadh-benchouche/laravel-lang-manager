# Laravel Lang Manager

Laravel Lang Manager is a lightweight package for managing translations in Laravel projects. It allows developers to
easily view, edit, and manage translation files directly through an intuitive interface.

## Features

- 📂 View and Edit Translations: Manage translations directly from the browser.
- 🌍 Multi-Language Support: Add and edit translations for multiple languages.
- 🚀 Dynamic Management: Update translation files dynamically without deploying new code.
- 🎨 Customizable Views and Assets: Tailor the UI to fit your project.

## Installation

1. Install the package via Composer:

```bash
composer require riadh-benchouche/laravel-lang-manager
```

2. Publish the configuration and views (optional):

```bash
php artisan vendor:publish --tag=lang-manager-config
php artisan vendor:publish --tag=lang-manager-views
php artisan vendor:publish --tag=lang-manager-assets
```

- `lang-manager-config`: Publishes the configuration file to `config/lang-manager.php`.
- `lang-manager-views`: Publishes the views to `resources/views/vendor/lang-manager`.
- `lang-manager-assets`: Publishes the assets to `public/css/lang-manager.css`.

3. Run the Package:

- Visit `/lang-manager` in your browser to access the translation manager.

## Configuration

After publishing the configuration file, you can customize the package settings in `config/lang-manager.php`. Here are
some of the available options:

```
return [
    'locales' => ['en', 'fr'],  // Supported languages
    'dynamic_translations' => true,  // Enable/Disable dynamic translations
    'lang_path' => resource_path('lang'),  // Path to language files
    'route_prefix' => 'lang-manager',  // Route prefix for the package
];
```

## Usage

1. Managing Translations:`

- Navigate to `/lang-manager` to view and edit translations.
- Use the intuitive table interface to update translation keys and values.

2. Adding New Translations:
   Use the Artisan command to create new translation files:

```bash
php artisan lang:add en
```

### Example

```php
php artisan lang-manager:make en messages
```

This will create resources/lang/en/messages.php if it doesn't already exist.

## Contributing

Contributions are welcome! Please feel free to submit a pull request or open an issue if you encounter any problems.

## License

This package is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Credits

This package was created by [Riadh Benchouche](https://riadhben.com).
<br>
Laravel Fullstack Developer
<br>
[Linkedin](https://www.linkedin.com/in/riadh-benchouche/) | [GitHub](https://www.github.com/riadh-benchouche)











