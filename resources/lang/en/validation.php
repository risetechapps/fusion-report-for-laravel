<?php

return [

    "type" => [
        "required" => "You need to select the type of report",
        "string" => "You need to select the type of report",
    ],
    "email" => [
        "required" => "You must enter your email address.",
        "required_if" => "You must enter your email address.",
        "email" => "You must enter a valid email address.",
    ],
    "formats" => [
        "required" => "Report format must be selected",
        "array" => "Report format must be selected",
    ],
    "queue" => [
        "required" => "You must select whether you want to generate the report now or later.",
        "boolean" => "You must select whether you want to generate the report now or later.",
    ],
    "params" => [
        "required" => "It is necessary to pass the parameters",
        "array" => "It is necessary to pass the parameters",
    ]
    
];
