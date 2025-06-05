<?php

namespace RiseTechApps\FusionReportLaravel;

use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class FusionReportLaravelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('fusion-report.php'),
            ], 'config');
        }

        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'fusion');

        $rules = config('rules.forms');

        $rules['report_generate'] = [
            'type' => 'bail|required|string',
            'email' => 'nullable|required_if:send_email,true|email',
            'formats' => 'bail|required|array',
            'send_email' => 'bail|required|boolean',
            'queue' => 'bail|required|boolean',
            'params' => 'bail|array',
            'locale' => 'bail'
        ];

        Config::set('rules.forms', $rules);

        $this->registerMacros();
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'fusion-report');
        $this->app->singleton('fusionReport', function () {
            return new FusionReportLaravel();
        });
    }

    protected function registerMacros(): void
    {

        if(!ResponseFactory::hasMacro('jsonSuccess')){
            ResponseFactory::macro('jsonSuccess', function ($data = []) {
                $response = ['success' => true];
                if (!empty($data)) $response['data'] = $data;
                return response()->json($response);
            });
        }

        if(!ResponseFactory::hasMacro('jsonError')){
            ResponseFactory::macro('jsonError', function ($data = null) {
                $response = ['success' => false];
                if (!is_null($data)) $response['message'] = $data;
                return response()->json($response, 412);
            });
        }

        if(!ResponseFactory::hasMacro('jsonGone')) {
            ResponseFactory::macro('jsonGone', function ($data = null) {
                $response = ['success' => false];
                if (!is_null($data)) $response['message'] = $data;
                return response()->json($response, 410);
            });
        }

        if(!ResponseFactory::hasMacro('jsonNotValidated')) {
            ResponseFactory::macro('jsonNotValidated', function ($message = null, $error = null) {
                $response = ['success' => false];
                if (!is_null($message)) $response['message'] = $message;

                return response()->json($response, 422);
            });
        }
    }
}
