<?php

namespace Models\Core\App\Validation\Shell;

use Models\Core\App\Validation\Kernel\Service;

/**
 * @author Peter Mwambi
 * @content Validation API
 * @date Mon May 24 2021 01:10:58 GMT+0300 (East Africa Time)
 * @updated Sat Dec 03 2022 14:07:51 GMT+0300 (East Africa Time)
 *
 * Receives and Processes form requests
 */

class Gateway extends Service
{
    public function RunRequest(array $data)
    {
        parent::SetData($data);
        parent::Execute();
    }
}