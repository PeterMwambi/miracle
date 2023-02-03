<?php

namespace Models\Core\App\Routes\Shell;

use Exception;
use Models\Auth\Input;
use Models\Core\App\Utilities\Url;
use Models\Core\Services\Ajax\Shell\Api as AjaxAPI;

class Register
{

    public function GetHomepage()
    {
        if (file_exists(Url::GetPath("app/views/pages/home.php"))) {
            require_once(Url::GetPath("app/views/pages/home.php"));
            return;
        }
        throw new Exception("Warning: Requested file was not found");

    }

    public function Get404page()
    {
        require_once(Url::GetPath("app/views/pages/404.php"));
    }

    public function GetMemberRegistration()
    {
        if (file_exists(Url::GetPath("app/views/pages/forms/RegistrationForm.php"))) {
            if (Input::Get("form-identifier")) {
                AjaxAPI::RunService(Input::Get("form-identifier"));
                return;
            }
            require_once(Url::GetPath("app/views/pages/forms/RegistrationForm.php"));
            return;
        }
        throw new Exception("Warning: Requested file was not found");
    }

    public function GetMemberLogin()
    {
        if (file_exists(Url::GetPath("app/views/pages/forms/LoginForm.php"))) {
            if (Input::Get("form-identifier")) {
                AjaxAPI::RunService(Input::Get("form-identifier"));
                return;
            }
            require_once(Url::GetPath("app/views/pages/forms/LoginForm.php"));
            return;
        }
        throw new Exception("Warning: Requested file was not found");
    }




}