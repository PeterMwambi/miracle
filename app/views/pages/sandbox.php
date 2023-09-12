<?php

use Vendor\Services\Database\Database;
use Vendor\Services\File\File;


Database::query("team_bp");

// File::require("tests/pdfgeneratortest.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php File::require("app/views/meta/head.php"); ?>
</head>

<body>


    <section class="container mt-5">
        <div class="card p-3">
            <div class="row">
                <div class="col-md-7">
                    <div class="d-flex">
                        <span class="text-muted"><small>Message from Admin:</small></span>
                        <h5 class="ms-1">You can generate and download reports...</h5>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="d-flex justify-content-center">
                                <h6 class="text-muted mt-1">Today at 8:30pm</h6>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <a href=""><img src="open.png" class="img-fluid icon-sm open-icon"></a>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <?php File::require("app/views/meta/scripts.php"); ?>
</body>

</html>