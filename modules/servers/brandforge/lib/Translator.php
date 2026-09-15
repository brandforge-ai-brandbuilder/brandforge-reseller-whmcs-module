<?php

namespace BrandForge;

/**
 * Loads client-facing translation strings for the provisioning module.
 *
 * WHMCS has no built-in localisation mechanism for provisioning/server
 * modules (unlike addon modules' automatic lang/{admin language}.php ->
 * $_ADDONLANG) — confirmed against WHMCS's own official sample provisioning
 * module, which ships no lang/ folder at all. So this is a self-built
 * loader: language is decided by the product's own "Client Area Language"
 * config option (see brandforge_ConfigOptions() in brandforge.php), not by
 * anything WHMCS exposes about the client's own language preference.
 */
class Translator
{
    private const DEFAULT_LANGUAGE = 'english';

    /**
     * Always merges the requested language OVER the English baseline, so a
     * language file that's missing (not yet translated) or only partially
     * translated never produces a blank string or a PHP undefined-index
     * notice — every key not present in $language simply renders in
     * English.
     */
    public static function strings(string $language): array
    {
        $english    = self::load(self::DEFAULT_LANGUAGE);
        $normalised = strtolower(trim($language));

        if ($normalised === '' || $normalised === self::DEFAULT_LANGUAGE) {
            return $english;
        }

        return array_merge($english, self::load($normalised));
    }

    private static function load(string $language): array
    {
        // Language codes only ever come from our own ConfigOptions dropdown
        // (never raw user input), but sanitise defensively anyway before
        // touching the filesystem.
        $safe = preg_replace('/[^a-z0-9\-]/', '', $language);
        if ($safe === '') {
            return [];
        }

        $file = __DIR__ . '/../lang/' . $safe . '.php';
        if (!is_file($file)) {
            return [];
        }

        $strings = include $file;
        return is_array($strings) ? $strings : [];
    }
}
