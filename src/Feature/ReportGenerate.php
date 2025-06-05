<?php

namespace RiseTechApps\FusionReportLaravel\Feature;

use Illuminate\Support\Facades\Log;
use RiseTechApps\FusionReportLaravel\Contracts\ReportGenerateContract;

class ReportGenerate
{

    public static function generate(mixed $type, mixed $params): array
    {
        try {
            $config = config('fusion-report.reports');

            if(!array_key_exists($type, $config)){
                return [];
            }

            $class = $config[$type];

            if (!is_subclass_of($class, ReportGenerateContract::class)) {
                return [];
            }

            $data = $class::generate($params);

            if(gettype($data) == 'array'){

                return $data;
            }

            return [];
        } catch (\Exception $exception) {

            logglyError()->exception($exception)->withProperties(['type' => $type, 'params' => $params])->log("Error when generating report");
            return [];
        }

    }
}
