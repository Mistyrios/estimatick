<?php

namespace App\Twig;

use App\Enum\LanguageEnum;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class LanguageExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_languages', [$this, 'getLanguages']),
            new TwigFunction('get_current_language', [$this, 'getCurrentLanguage']),
        ];
    }

    /**
     * @return array<string, array{name: string, flag: string}>
     */
    public function getLanguages(): array
    {
        return LanguageEnum::getAllAsArray();
    }

    /**
     * @return array{name: string, flag: string}
     */
    public function getCurrentLanguage(string $locale): array
    {
        $language = LanguageEnum::fromString($locale);

        return [
            'name' => $language->getDisplayName(),
            'flag' => $language->getFlagIcon(),
        ];
    }
}
