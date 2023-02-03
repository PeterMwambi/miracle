<?php

namespace Models\Components;


class SpinnerComponent
{
    public function GetComponent(string $nameSource, $title = "")
    {
        return
            '
            <div class="spinner-' . $nameSource . ' d-none">
                <div class="d-flex justify-content-center spinner-title">        
                    <h5>' . $title . '</h5>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <div class="spinner-grow spinner-grow-sm text-primary mx-2" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow spinner-grow-sm text-primary mx-2" role="status"></div>
                    <div class="spinner-grow spinner-grow-sm text-primary mx-2" role="status"></div>
                    <div class="spinner-grow spinner-grow-sm text-primary mx-2" role="status"></div>
                    <div class="spinner-grow spinner-grow-sm text-primary mx-2" role="status"></div>
                </div>
            </div>';
    }
}