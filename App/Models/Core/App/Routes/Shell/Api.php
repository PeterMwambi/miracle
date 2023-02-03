<?php

namespace Models\Core\App\Routes\Shell;


class Api
{

    public static function RunService()
    {
        $route = new Dispatch;
        if ($route->VerifyRoute() && $route->VerifyRequest()) {
            $route->ProcessRoute();
            return;
        } else {
            $route->RedirectTo404();
            return;
        }
    }
}