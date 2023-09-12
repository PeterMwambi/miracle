<?php

use Vendor\Services\File\File;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Requested Resource Not Found</title>
    <link rel="stylesheet" type="text/css" href="bootstrap.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" href="favicon.ico">
</head>

<body>

    <?php File::require("app/views/containers/navbar.php"); ?>
    <section class="pt-lg">
        <div class="d-flex justify-content-center">
            <div class="my-3">
                <div class="my-3">
                    <h1 class="text-center">404!</h1>
                </div>
                <div>
                    <h4>Oops! Something unexpected happened</h4>
                </div>
                <div class="my-3">
                    <h6>The Requested resource you were looking for was not found
                </div>
            </div>
        </div>
    </section>


    <script src="bootstrap.js"></script>
    <script src="dpz.js"></script>
    <script src="dpzexecute.js"></script>
</body>

</html>