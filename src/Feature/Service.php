<?php

namespace RiseTechApps\FusionReportLaravel\Feature;

use Illuminate\Http\Request;

class Service extends Connection
{
    public static function generate(string|int $id, string $theme = 'default', bool $queue = false, array $formats = [], string $locale = 'en', array $data = []): array
    {
        return static::request('/generate', [
            'id' => $id,
            'theme' => $theme,
            'queue' => $queue,
            'format' => $formats,
            'data' => $data,
            'locale' => $locale,
        ]);
    }
}
