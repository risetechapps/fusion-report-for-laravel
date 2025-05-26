<?php

namespace RiseTechApps\FusionReportLaravel\Contracts;

interface ReportGenerateContract
{
    public static function generate($params = []): array;
}
