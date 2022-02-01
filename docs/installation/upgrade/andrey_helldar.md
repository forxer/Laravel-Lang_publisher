# From `andrey-helldar/laravel-lang-publisher`

1. Replace `"andrey-helldar/laravel-lang-publisher": "^10.0"` with `"laravel-lang/publisher": "^11.0"` in the `composer.json` file;
2. Replace the `Helldar\LaravelLangPublisher` namespace prefix with `LaravelLang\Publisher` in your application;
3. Remove the `Helldar\PrettyArray\Contracts\Caseable` from `config/lang-publisher.php` file;
4. Remove the `plugins` section from `config/lang-publisher.php` file;
5. Call the `composer update` console command.