<?php

namespace App\Enum;

enum LanguageEnum: string
{
    case ENGLISH = 'en';
    case FRENCH = 'fr';
    case SPANISH = 'es';

    /**
     * Get the display name for the language.
     */
    public function getDisplayName(): string
    {
        return match ($this) {
            self::ENGLISH => 'English',
            self::FRENCH => 'Français',
            self::SPANISH => 'Español'
        };
    }

    /**
     * Get the flag icon for the language.
     */
    public function getFlagIcon(): string
    {
        return match ($this) {
            self::ENGLISH => 'emojione:flag-for-united-kingdom',
            self::FRENCH => 'emojione:flag-for-france',
            self::SPANISH => 'emojione:flag-for-spain'
        };
    }

    /**
     * Get all languages as associative array (code => info).
     *
     * @return array<string, array{name: string, flag: string}>
     */
    public static function getAllAsArray(): array
    {
        $languages = [];
        foreach (self::cases() as $language) {
            $languages[$language->value] = [
                'name' => $language->getDisplayName(),
                'flag' => $language->getFlagIcon(),
            ];
        }

        return $languages;
    }

    /**
     * Get all available language codes as array.
     *
     * @return array<int, string>
     */
    public static function getAllCodes(): array
    {
        return array_map(static fn (LanguageEnum $language) => $language->value, self::cases());
    }

    /**
     * Get the default language.
     */
    public static function getDefault(): self
    {
        return self::FRENCH;
    }

    /**
     * Check if a locale code is valid.
     */
    public static function isValid(string $locale): bool
    {
        return in_array($locale, self::getAllCodes(), true);
    }

    /**
     * Get Language enum from string, with fallback to default.
     */
    public static function fromString(string $locale): self
    {
        return self::tryFrom($locale) ?? self::getDefault();
    }
}
