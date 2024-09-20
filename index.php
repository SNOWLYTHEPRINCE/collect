<?php

namespace Collect;

require_once 'vendor/autoload.php';

$records =
    [
        'id' => 2135,
        'first_name' => 'John',
        'last_name' => 'Doe',
    ];


collection($records)->each(function ($value, $key, $arg) {
var_dump($value,$key,$arg);
}, 1000);
