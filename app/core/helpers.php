<?php

declare(strict_types=1);

/**
 * Generate a correct public URL for assets
 */
function asset(string $path): string
{
    return '/php/CityEX/public/' . ltrim($path, '/');
}