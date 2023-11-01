<?php

use Vendor\Services\File\File;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Miracle (A Lightweight PHP framework for the 21st Century)</title>
    <link rel="icon" href="<?php echo asset("assets/logos/miraclev1.2.0.png") ?>">
    <link rel="stylesheet" href="<?php echo asset("css/custom/style.css") ?>">
</head>

<body>

    <?php File::require("app/views/containers/header.php") ?>




    <script src="<?php echo asset("js/custom/slider.js") ?>"></script>
    <script src="<?php echo asset("js/custom/navbar.js") ?>"></script>
</body>

</html>