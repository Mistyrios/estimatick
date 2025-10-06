<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

#[AsEventListener(event: KernelEvents::REQUEST, priority: 20)]
class LocaleListener
{
    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();

        // Ne traiter que les requêtes principales
        if (!$event->isMainRequest()) {
            return;
        }

        // Si une locale est spécifiée dans l'URL, l'utiliser
        if ($locale = $request->attributes->get('locale')) {
            if (is_string($locale)) {
                $request->setLocale($locale);
                // Sauvegarder en session pour les futures requêtes sans locale
                $request->getSession()->set('_locale', $locale);
            }
        } else {
            // Pour les URLs sans locale, utiliser celle sauvée en session
            $savedLocale = $request->getSession()->get('_locale', 'fr');
            if (is_string($savedLocale)) {
                $request->setLocale($savedLocale);
            }
        }
    }
}
