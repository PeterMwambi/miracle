<?php


use Models\Core\App\Database\Queries\Read\Admin;
use Models\Core\App\Database\Queries\Read\Client;
use Models\Core\App\Database\Queries\Read\Student;
use Models\Core\App\Database\Queries\Read\Tutor;
use Models\Core\App\Utilities\Session;
use Models\Core\App\Utilities\Url;

require_once(Url::getPath("app/views/includes/components/renders/renders.php"));

Session::start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once(Url::GetPath("app/views/includes/meta/head.php")); ?>
    <!-- <link type="text/css" rel="stylesheet" href="<?php // echo Url::getReference("resources/css/custom/style.php") ?>"> -->
</head>

<body>


    <!-- Navbar minimalist -->
    <nav class="navbar navbar-expand-sm navbar-light shadow-sm">
        <a class="navbar-brand mt-1 mx-3" href="#"><img
                src="<?php echo Url::getReference("resources/assets/icons/devpzonelogo.png") ?>"
                class="img-fluid devpzone__logo"></a>
        <button class="navbar-toggler d-lg-none me-3" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
            aria-label="Toggle navigation"></button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav ms-auto my-2 my-lg-0">
                <li class="nav-item mx-3">
                    <a class="nav-link mt-3 mt-md-0" href="#">
                        <img src="<?php echo Url::getReference("resources/assets/images/png/user1.png"); ?>"
                            class="img-fluid small">
                        Hi
                        <!-- <?php echo Admin::run()->getFirstname(Session::get("ad_username")) ?> -->
                    </a>
                </li>
                <li class="mx-3">
                    <a class="nav-link my-2 my-md-0" href="javascript:void(0)" data-bs-toggle="offcanvas"
                        data-bs-target="#Id1" aria-controls="Id1">
                        <img src="<?php echo Url::getReference("resources/assets/images/png/menu.png") ?>"
                            class="img-fluid small canvas-toggler ">
                        Options
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Nav bar minimalist with off canvas -->
    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="Id1"
        aria-labelledby="Enable both scrolling & backdrop">
        <div class="offcanvas-header">
            <div class="row">
                <div class="col-md-4">
                    <img src="<?php echo Url::getReference("resources/assets/icons/devpzonelogo.png") ?>"
                        class="img-fluid large">
                </div>
                <div class="col-md-8">
                    <div class="d-flex justify-content-end">
                        <h5 class="offcanvas-title" id="Enable both scrolling & backdrop">Profile options</h5>
                    </div>
                </div>
            </div>


            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <p>Try scrolling the rest of the page to see this option in action.</p>
        </div>
    </div>







    <?php require_once(Url::GetPath("app/views/includes/meta/scripts.php")); ?>

</body>

</html>