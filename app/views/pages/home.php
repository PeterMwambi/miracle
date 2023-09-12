<?php

declare(strict_types=1);

use Vendor\Services\File\File;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="icon" href="favicon.ico">
    <link rel="stylesheet" type="text/css" href="<?php echo asset("css/frameworks/bootstrap.min.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset("css/custom/style.css") ?>">
</head>

<body>
    <header>
        <?php File::require("app/views/containers/navbar.php") ?>
        <?php File::require("app/views/containers/offcanvas.php") ?>
    </header>



    <section class="container">
        <div class="my-3">
            <h1>Hi Peter, welcome</h1>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="d-flex">
                            <div>
                                <h5 class="mt-1">My Account</h5>
                            </div>
                            <div class="ms-1">
                                <span class="badge badge-pill bg-primary">50</span>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                <a class="" href="client-registration">Update profile</a>
                            </div>
                            <div class="col-6">
                                <div class="d-flex justify-content-end">
                                    Preferences &raquo;
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="d-flex">
                            <div>
                                <h5 class="mt-1">My Projects</h5>
                            </div>
                            <div class="ms-1">
                                <span class="badge badge-pill bg-primary">5</span>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                All projects
                            </div>
                            <div class="col-6">
                                <div class="d-flex justify-content-end">
                                    Deployed &raquo;
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="d-flex">
                            <div>
                                <h5 class="mt-1">My Blogs</h5>
                            </div>
                            <div class="ms-1">
                                <span class="badge badg-pill bg-primary">130</span>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                All blogs
                            </div>
                            <div class="col-6">
                                <div class="d-flex justify-content-end">
                                    Write blog &raquo;
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <script src="<?php echo asset("js/frameworks/jquery.js"); ?>"></script>
    <script src="<?php echo asset("js/frameworks/bootstrap.js"); ?>"></script>
    <script src="<?php echo asset("js/custom/dpz.js"); ?>"></script>
    <script src="<?php echo asset("js/custom/dpzexecute.js"); ?>"></script>
</body>

</html>