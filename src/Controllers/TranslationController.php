<?php

namespace Riadh\LaravelLangManager\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller;
use Riadh\LaravelLangManager\Services\TranslationService;

/**
 * Controller to handle translation management endpoints.
 */
class TranslationController extends Controller
{
    protected TranslationService $service;

    /**
     * @Title : TranslationController constructor.
     *
     * @param TranslationService $service The translation service for managing translations.
     */
    public function __construct(TranslationService $service)
    {
        $this->service = $service;
    }

    /**
     * @Title : Display translations for a given locale.
     *
     * @param string $locale The locale to display translations for (e.g., 'en', 'fr').
     * @return JsonResponse A JSON response containing the translations.
     */
    public function show(string $locale): JsonResponse
    {
        $translations = $this->service->readTranslations($locale);

        return Response::json($translations);
    }
}
