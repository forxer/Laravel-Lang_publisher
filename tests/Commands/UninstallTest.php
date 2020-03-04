<?php

namespace Tests\Commands;

use Helldar\LaravelLangPublisher\Facades\Path;
use Symfony\Component\Console\Exception\RuntimeException;
use Tests\TestCase;

use function compact;

class UninstallTest extends TestCase
{
    public function testWithoutLanguageAttribute()
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Not enough arguments (missing: "locales")');

        $this->artisan('lang:uninstall');
    }

    public function testUninstall()
    {
        $locales = ['be', 'da', 'gl', 'is'];

        $this->artisan('lang:install', compact('locales'))->assertExitCode(0);

        foreach ($locales as $locale) {
            $this->assertDirectoryExists(
                Path::target($locale)
            );
        }

        $this->artisan('lang:uninstall', compact('locales'))->assertExitCode(0);

        $lang = null;
        try {
            foreach ($locales as $locale) {
                $lang = $locale;

                $this->assertDirectoryNotExists(
                    Path::target($locale)
                );
            }
        }
        catch (\Exception $exception) {
            $path = Path::target($lang);

            dd([
                'dir'         => $path,
                'is_dir'      => is_dir($path),
                'is_file'     => is_file($path),
                'is_link'     => is_link($path),
                'is_readable' => is_readable($path),
                'is_writable' => is_writable($path),
            ]);
        }
    }
}
