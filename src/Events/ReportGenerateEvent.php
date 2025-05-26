<?php

namespace RiseTechApps\FusionReportLaravel\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReportGenerateEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $data;
    public array $response;
    public Authenticatable $auth;

    public function __construct(Authenticatable $auth, array $data, array $response)
    {
        $this->auth = $auth;
        $this->data = $data;
        $this->response = $response;
    }
}
