<?php


namespace Models\Core\Services\Ajax\Shell;

use Exception;
use Models\Core\App\Data\DataSettings as Data;

class Api
{

    public static function RunService(string $identifier)
    {
        $ajaxService = new Service;
        $ajaxService->SetFormIdentifier($identifier);
        if ($ajaxService->VerifyFormIdentifier()) {
            Data::SetForm($ajaxService->GetForm());
            $ajaxService->WriteAction(Data::GetAction());
            $ajaxService->WriteRulePath(Data::GetRulePath());
            $ajaxService->WriteErrorPath(Data::GetErrorPath());
            $ajaxService->WriteMethod(Data::GetMethodHandler());
            $ajaxService->WriteData(Data::GetData());
            $ajaxService->WriteFinalSuccessMessage(Data::GetSuccessMessage());
            $ajaxService->WriteFinalErrorMessage(Data::GetErrorMessage());
            $ajaxService->WriteNextAction(Data::GetNextStep());
            if (!empty(Data::GetFinalMethod())) {
                $ajaxService->WriteFinalMethod(Data::GetFinalMethod());
            }
            $ajaxService->RunService();
            return;
        } else {
            throw new Exception("Warning: Ajax service failed");
        }
    }
}