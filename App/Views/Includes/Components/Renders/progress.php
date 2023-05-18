<?php

use Views\Includes\Components\Classes\ProgressBar;

function runProgressBarSetup()
{
    $progressBar = new ProgressBar;
    $progressBar->setName("dopespa");
    $progressBar->setIsAnimated(true);
    $progressBar->setColor("dark");
    $progressBar->setRole("progressbar");
    $progressBar->setMinWidth(0);
    $progressBar->setWidth(50);
    $progressBar->setMaxWidth(100);
    $progressBar->setAdditionalClasses("mt-5");
    $progressBar->setDescription("Step 1 out of 2");
    $progressBar->runSetup();
}