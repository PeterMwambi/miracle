<?php

namespace Vendor\Services\Exceptions;


class DataExceptions extends Exceptions
{
    public static function invalidArrayKeysCount()
    {
        return parent::runTimeException("Warning: Invalid array keys count");
    }
}