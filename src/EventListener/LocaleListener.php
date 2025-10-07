<?php

namespace App\EventListener;

use App\Enum\LanguageEnum;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

#[AsEventListener(event: KernelEvents::REQUEST, priority: 20)]
class LocaleListener
{
    public function __invoke(RequestEvent $event): void
    {
        $request = $event->getRequest();
        $enabledLocales = LanguageEnum::getAllCodes();

        // Try to get locale from session first
        $locale = $request->getSession()->get('_locale');

        // If no locale in session, try to get from request attributes
        if (!$locale) {
            $locale = $request->attributes->get('_locale');
        }

        // If still no locale, try to get from query parameter
        if (!$locale) {
            $locale = $request->query->get('locale');
        }

        // Fix for line 24: Validate that locale is string and supported
        if (!is_string($locale) || !in_array($locale, $enabledLocales, true)) {
            $locale = LanguageEnum::getDefault()->value;
        }

        // Now $locale is guaranteed to be a valid string
        $request->setLocale($locale);
    }
}
