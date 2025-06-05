<?php

namespace RiseTechApps\FusionReportLaravel\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use RiseTechApps\FormRequest\Traits\hasFormValidation\hasFormValidation;
use RiseTechApps\FormRequest\ValidationRuleRepository;

class FusionGenerateRequest extends FormRequest
{
    use hasFormValidation;

    protected ValidationRuleRepository $repository;

    protected array $rules = [];
    protected array $messages = [];

    public function __construct(ValidationRuleRepository $ruleRepository, array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $this->repository = $ruleRepository;

        $data = $this->repository->getRules('report_generate');

        $this->rules = $data['rules'];
        $this->messages = $data['messages'];
    }

    public function rules(): array
    {
        return $this->rules;
    }

    public function messages(): array
    {
        return array_map(function ($value) {
            return __('fusion::validation.' . $value);
        }, $this->result['messages']);
    }

    public function authorize(): bool
    {
        return auth()->check();
    }
}
