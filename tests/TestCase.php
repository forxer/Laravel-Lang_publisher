<?php

namespace Tests;

use Helldar\LaravelLangPublisher\Contracts\Localization;
use Helldar\LaravelLangPublisher\ServiceProvider;
use Illuminate\Support\Facades\File;
use Orchestra\Testbench\TestCase as BaseTestCase;

use function app;
use function realpath;

abstract class TestCase extends BaseTestCase
{
    protected $default_locale = 'en';

    protected function tearDown(): void
    {
        $this->resetDefaultLangDirectory();
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [ServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app): void
    {
        /** @var \Illuminate\Config\Repository $config */
        $config = $app['config'];

        $config->set('lang-publisher.vendor', $this->pathMainSource());
        $config->set('lang-publisher.exclude.auth', ['failed']);
        $config->set('app.locale', $this->default_locale);
    }

    protected function resetDefaultLangDirectory(): void
    {
        File::copyDirectory(
            $this->pathMainSource($this->default_locale),
            $this->pathTarget($this->default_locale)
        );
    }

    protected function copyFixtures(): void
    {
        File::copy(
            realpath(__DIR__ . '/fixtures/auth.php'),
            $this->pathTarget($this->default_locale, 'auth.php')
        );
    }

    protected function deleteLocales(array $locales): void
    {
        foreach ($locales as $locale) {
            File::deleteDirectory(
                $this->pathTarget($locale)
            );
        }
    }

    protected function localization(): Localization
    {
        return app(Localization::class);
    }

    protected function pathMainSource(string $locale = null, string $filename = null): string
    {
        $locale   = $this->cleanPath($locale);
        $filename = $this->cleanPath($filename);

        return realpath(__DIR__ . '/../vendor/caouecs/laravel-lang/src' . $locale . $filename);
    }

    protected function pathJsonSource(string $locale = null): string
    {
        $locale = $this->cleanPath($locale);
        $locale = $locale ? $locale . '.json' : null;

        return realpath(__DIR__ . '/../vendor/caouecs/laravel-lang/json' . $locale);
    }

    protected function pathTarget(string $locale = null, string $filename = null): string
    {
        $locale   = $this->cleanPath($locale);
        $filename = $this->cleanPath($filename);

        return realpath(__DIR__ . '/../vendor/orchestra/testbench-core/laravel/resources/lang' . $locale . $filename);
    }

    protected function cleanPath(string $path = null): ?string
    {
        return $path
            ? DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR)
            : $path;
    }
}
