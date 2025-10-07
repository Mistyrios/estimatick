<?php

namespace App\Controller\Api;

use App\Enum\LanguageEnum;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LocaleController extends AbstractController
{
    #[Route('/api/locale', name: 'api_set_locale', methods: ['POST'])]
    public function setLocale(Request $request): JsonResponse
    {
        // Fix for line 20: Add proper type checking and validation
        $data = $request->getPayload()->all();

        // Ensure 'locale' key exists and is a string
        if (!isset($data['locale']) || !is_string($data['locale'])) {
            return new JsonResponse(['error' => 'Invalid locale parameter'], Response::HTTP_BAD_REQUEST);
        }

        $locale = $data['locale'];

        // Validate against enabled locales from enum
        if (!LanguageEnum::isValid($locale)) {
            return new JsonResponse(['error' => 'Unsupported locale'], Response::HTTP_BAD_REQUEST);
        }

        // Fix for line 28: Now $locale is guaranteed to be a string
        $request->setLocale($locale);

        // Optional: Store in session for persistence
        $request->getSession()->set('_locale', $locale);

        return new JsonResponse(['locale' => $locale]);
    }
}
