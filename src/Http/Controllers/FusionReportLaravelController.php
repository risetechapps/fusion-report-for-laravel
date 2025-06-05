<?php

namespace RiseTechApps\FusionReportLaravel\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use RiseTechApps\FusionReportLaravel\Events\ReportGenerateEvent;
use RiseTechApps\FusionReportLaravel\Feature\ReportGenerate;
use RiseTechApps\FusionReportLaravel\Feature\Service;
use RiseTechApps\FusionReportLaravel\Http\Requests\FusionGenerateRequest;
use RiseTechApps\FusionReportLaravel\Jobs\ReportGenerateJob;

class FusionReportLaravelController extends Controller
{

    public function generate(FusionGenerateRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();

            $theme = config('fusion-report.theme');
            $type = $data['type'];
            $params = $data['params'];
            $sendEmail = $data['send_email'];
            $queue = $data['queue'] ?? true;

            if ($sendEmail === true) {
                $queue = true;
            }

            if ($queue === false) {

                $response = Service::generate($type, $theme, false, $data['formats'], $data['locale'],
                    ReportGenerate::generate($type, $params));

                if ($response['success']) {

                    event(new ReportGenerateEvent(auth()->user(), $data, $response['data']));

                    logglyInfo()->withRequest($request)->withProperties(['params' => $data, 'response' => $response])->log("Success when generating report");

                    return response()->jsonSuccess($response);
                } else {

                    logglyError()->withRequest($request)->performedOn(self::class)->log("Error when generating report");

                    return response()->jsonGone('Error generate report');
                }
            }

            dispatch(new ReportGenerateJob(auth()->user(), $data));

            logglyInfo()->withRequest($request)->withProperties(['params' => $data])->log("Success when generating report");

            return response()->jsonSuccess(['queue' => true]);

        } catch (\Exception $exception) {

            logglyError()->withRequest($request)->exception($exception)->log("Error when generating report");

            return response()->jsonGone('Error when generating report');
        }
    }
}
