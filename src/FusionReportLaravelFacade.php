<?php

namespace RiseTechApps\FusionReportLaravel;

use Illuminate\Support\Facades\Facade;

/**
 * @see \RiseTechApps\FusionReportLaravel\Skeleton\SkeletonClass
 * @method routes($options = [])
 */
class FusionReportLaravelFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'fusionReport';
    }
}
