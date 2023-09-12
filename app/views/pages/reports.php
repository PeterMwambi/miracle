<?php

use Vendor\Services\Database\Database;
use Vendor\Services\File\File;

$results = Database::query("team_bp")->select("mb_personalInfo", ["UserId", "Firstname", "Lastname", "Gender", "Age", "Nationality", "MaritalStatus"], [], 1)->getResults("object");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="<?php echo asset("css/frameworks/bootstrap.min.css"); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset("css/custom/style.css"); ?>">
</head>

<body>

    <?php File::require("app/views/containers/navbar.php"); ?>
    <?php File::require("app/views/containers/offcanvas.php"); ?>
    <section class="container my-3">
        <div class="table-responsive">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">User Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Age</th>
                        <th scope="col">Nationality</th>
                        <th scope="col">Marital Status</th>
                    </tr>
                <tbody>
                    <?php foreach ($results as $result) { ?>
                    <tr>
                        <td scope="row">
                            <?php echo $result->UserId ?>
                        </td>
                        <td>
                            <?php echo $result->Firstname . " " . $result->Lastname; ?>
                        </td>
                        <td>
                            <?php echo $result->Gender; ?>
                        </td>
                        <td>
                            <?php echo $result->Age; ?>
                        </td>
                        <td>
                            <?php echo $result->Nationality; ?>
                        </td>
                        <td>
                            <?php echo $result->MaritalStatus; ?>
                        </td>

                    </tr>
                    <?php } ?>
                </tbody>
                </thead>
            </table>
        </div>

    </section>

    <script src="<?php echo asset("js/frameworks/jquery.js"); ?>"></script>
    <script src="<?php echo asset("js/frameworks/bootstrap.js"); ?>"></script>
    <script src="<?php echo asset("js/custom/dpz.js"); ?>"></script>
    <script src="<?php echo asset("js/custom/dpzexecute.js"); ?>"></script>
</body>

</html>