<?php

namespace RiseTechApps\FusionReportLaravel;



use Illuminate\Support\Facades\Route;
use RiseTechApps\FusionReportLaravel\Http\Controllers\FusionReportLaravelController;

class FusionReportLaravel
{
    public static function routes($options = []): void
    {
        Route::group($options, function () {
            Route::post('/reports/generate/', [FusionReportLaravelController::class, 'generate']);
        });
    }
}
