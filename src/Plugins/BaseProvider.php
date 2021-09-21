<?php

/*
 * This file is part of the "andrey-helldar/laravel-lang-publisher" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@ai-rus.com>
 *
 * @copyright 2021 Andrey Helldar
 *
 * @license MIT
 *
 * @see https://github.com/andrey-helldar/laravel-lang-publisher
 */

declare(strict_types=1);

namespace Helldar\LaravelLangPublisher\Plugins;

use Helldar\Contracts\LangPublisher\Provider;
use Helldar\Support\Facades\Helpers\Arr;

abstract class BaseProvider implements Provider
{
    public function resolvePlugins(array $plugins): array
    {
        return Arr::map($plugins, static function (string $plugin) {
            return new $plugin;
        });
    }
}
