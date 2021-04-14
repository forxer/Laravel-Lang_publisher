<?php

namespace Helldar\LaravelLangPublisher\Facades;

use Helldar\LaravelLangPublisher\Support\Locales as Support;
use Illuminate\Support\Facades\Facade;

/**
 * @method static array available(bool $all = false)
 * @method static array installed()
 * @method static array protects()
 * @method static bool isAvailable(string $locale)
 * @method static bool isInstalled(string $locale)
 * @method static bool isProtected(string $locale)
 * @method static string getDefault()
 * @method static string getFallback()
 * @method static void validate(string $locale)
 */
final class Locales extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Support::class;
    }
}