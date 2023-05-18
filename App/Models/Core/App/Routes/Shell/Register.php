<?php

namespace Models\Core\App\Routes\Shell;

use Exception;
use Models\Auth\Input;
use Models\Core\App\Routes\Kernel\Handler;
use Models\Core\App\Utilities\Url;
use Models\Core\Services\Ajax\Shell\Handler\Api as AjaxApi;

class Register extends Handler
{


    /*
    `````````````````````````````````````````````````````````````````````
    REGISTER DEFAULT PROPERTIES
    ````````````````````````````````````````````````````````````````````
    */
    /**
     * Form defaults
     * @param string $url
     * @param string $identifier
     * @throws Exception
     * @return void
     */
    private function setFormDefaults(string $url, string $identifier)
    {
        if (file_exists($url)) {
            if (Input::get($identifier)) {
                AjaxApi::run()->formService(Input::get($identifier));
                return;
            }
            require_once($url);
            return;
        }
        throw new Exception("Warning: Requested file was not found");
    }

    /*
    `````````````````````````````````````````````````````````````````````````
    MISCELLANEOUS PROPERTIES
    `````````````````````````````````````````````````````````````````````````
    */

    /**
     * Get sandbox
     * @return void
     */
    public function getSandbox()
    {
        require_once(Url::getPath("app/views/pages/global/sandbox.php"));
    }

    /**
     * Get homepage
     * @throws Exception
     * @return void
     */

    public function getHomepage()
    {
        if (file_exists(Url::getPath("app/views/pages/home/home.php"))) {
            require_once(Url::getPath("app/views/pages/home/home.php"));
            return;
        }
        throw new Exception("Warning: Requested file was not found");
    }

    /**
     * Get Error page
     * @return void
     */
    public function get404page()
    {
        require_once(Url::getPath("app/views/pages/global/404.php"));
    }

    /**
     * Get logout page
     * @return void
     */
    public function getLogout()
    {
        $url = Url::getPath("app/views/pages/global/logout.php");
        if (file_exists($url)) {
            require_once($url);
        } else {
            die("false");
        }
    }

    public function getServices()
    {
        $url = Url::getPath("app/views/pages/home/services.php");
        if (file_exists($url)) {
            require_once($url);
        } else {
            die("false");
        }
    }


    /*
    ````````````````````````````````````````````````````````````````````
    ADMIN METHODS
    ````````````````````````````````````````````````````````````````````
    */
    /**
     * Get admin page
     * @return string
     */
    private function getAdminPage()
    {
        return Url::GetPath("app/views/pages/admin/controller.php");
    }

    /**
     * get admin views
     * @return void
     */
    public function getAdminViews()
    {
        $url = $this->getAdminPage();
        if (file_exists($url)) {
            require_once($url);
            return;
        }
    }

    /**
     * Get admin forms
     * @return void
     */
    public function getAdminForms()
    {
        $url = $this->getAdminPage();
        $identifier = "form-identifier";
        $this->setFormDefaults($url, $identifier);
    }

    /*
    ````````````````````````````````````````````````````````````````````````
    ATTENDANT METHODS
    ````````````````````````````````````````````````````````````````````````
    */
    /**
     * Get attendants page
     * @return string
     */
    private function getAttendantsPage()
    {
        return Url::getPath("app/views/pages/attendant/controller.php");
    }

    /**
     * Get attendant views
     * @return void
     */
    public function getAttendantViews()
    {
        $url = $this->getAttendantsPage();
        if (file_exists($url)) {
            require_once($url);
            return;
        }
    }
    /**
     * Get attendant forms
     * @return void
     */
    public function getAttendantForms()
    {
        $url = $this->getAttendantsPage();
        $identifier = "form-identifier";
        $this->setFormDefaults($url, $identifier);
    }

    /*
    ````````````````````````````````````````````````````````````````````
    CLIENT PAGES
    ````````````````````````````````````````````````````````````````````
    */
    /**
     * Get client page
     * @return string
     */
    private function getClientPage()
    {
        return Url::getPath("app/views/pages/client/controller.php");
    }

    /**
     * Get client views
     * @return void
     */
    public function getClientViews()
    {
        $url = $this->getClientPage();
        if (file_exists($url)) {
            require_once($url);
            return;
        }
    }

    /**
     * Get client forms
     * @return void
     */
    public function getClientForms()
    {
        $url = $this->getClientPage();
        $identifier = "form-identifier";
        $this->setFormDefaults($url, $identifier);
    }



}