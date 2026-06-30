<?php

declare(strict_types=1);

/**
 * Get base URL dynamically (NO hardcoding)
 */
function base_url(): string
{
    // Detect script path dynamically
    $scriptName = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));

    return rtrim($scriptName, '/');
}

/**
 * Generate internal URL
 */
function url(string $path = ''): string
{
    $base = base_url();

    if ($path === '') {
        return $base ?: '/';
    }

    return $base . '/' . ltrim($path, '/');
}

/**
 * Asset helper
 */
function asset(string $path): string
{
    return url($path);
}