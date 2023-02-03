<?php


namespace Models\Components;

class AlertComponent
{


    private $nameSource;

    public function SetName(string $alertName)
    {
        $this->nameSource = $alertName;
    }



    public function GetComponent()
    {
        return '<div class="form-alert-' . $this->nameSource . ' alert alert-danger d-none" role="alert">
                        <strong class="alert-title">Ooops!</strong>
                        <span class="form-alert-text-' . $this->nameSource . '"></span>
                </div>';
    }



}


?>