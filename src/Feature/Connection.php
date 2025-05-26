<?php

namespace RiseTechApps\FusionReportLaravel\Feature;

use Illuminate\Support\Facades\Http;

abstract class Connection
{
    private const Host = "https://fusionreport.app.br/api/v1";

    public static function request($url, $params = []): array
    {
        $token = config('fusion-report.token');

        $response = Http::withHeaders([
            'X-API-KEY' => $token,
        ])->post(Connection::Host . $url, $params);

        if ($response->failed()) {
            return static::errorResponse();
        }

        return static::successResponse($response);
    }

    private static function errorResponse(): array
    {
        return [
            'success' => false,
            'data' => []
        ];
    }

    private static function successResponse(\GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response $response): array
    {
        $_response = $response->json();

        return [
            'success' => $_response['success'],
            'data' => $_response['data'] ?? [],
        ];
    }
}
