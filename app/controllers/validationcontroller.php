<?php

namespace App\Controllers;

use Vendor\Services\Validation\Validation;

class ValidationController extends Validation
{

    protected function validateWithDatabase(): self|bool
    {

        return $this;
    }

}