<?php

namespace RiseTechApps\FusionReportLaravel\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
//use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use RiseTechApps\FusionReportLaravel\Events\ReportGenerateEvent;
use RiseTechApps\FusionReportLaravel\Feature\ReportGenerate;
use RiseTechApps\FusionReportLaravel\Feature\Service;

class ReportGenerateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Authenticatable $auth;
    protected array $data;

    public function __construct(Authenticatable $auth, array $data)
    {
        $this->data = $data;
        $this->auth = $auth;
    }

    public function handle(): void
    {
        try {

            $theme = config('fusion-report.theme');

            $response = Service::generate($this->data['type'], $theme, false, $this->data['formats'], $this->data['locale'],
                ReportGenerate::generate($this->data['type'], $this->data['params']));

            if($response['success'] === true){
                $dataResponse = $response['data'];
                event(new ReportGenerateEvent($this->auth, $this->data, $dataResponse));
            }
        } catch (\Exception $e) {
            $this->fail($e);
        }
    }
}
