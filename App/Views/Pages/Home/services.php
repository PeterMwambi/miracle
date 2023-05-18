<?php

use Models\Core\App\Utilities\Session;
use Models\Core\App\Utilities\Url;
use Views\Includes\Components\Classes\Page;

require_once(Url::getPath("app/views/includes/components/renders/navbar.php"));
require_once(Url::getPath("app/views/includes/components/renders/page.php"));




Session::start();

processClientBooking();



?>

<!DOCTYPE html>
<html lang="en">
<?php require_once(Url::getPath("app/views/includes/meta/head.php")); ?>

<body>
    <?php
    if (session::exists("cl_username")) {
        runClientNavbarSetUp(Page::run()->getRequest());
    } else {
        runDefaultNavbarSetup(Page::run()->getRequest());
    }
    ?>


    <section class="container-fluid mt-md">

        <div class="d-flex justify-content-center my-4">
            <h3 class="mt-4">Our services</h3>
        </div>
        <div class="row">
            <?php foreach (getServices() as $service): ?>
                <div class="col-md-3 mt-3">
                    <div class="card  h-100">
                        <div class="card-body p-0">
                            <div>
                                <img src="<?php echo Url::getReference("uploads/services/" . $service["sd_image"]) ?>"
                                    class="img-fluid card-height">
                            </div>
                            <div class="mt-3 p-2">
                                <h5><strong>
                                        <?php echo $service["sd_name"] ?>
                                    </strong></h5>
                                <p>
                                    <?php echo $service["sd_description"] ?>
                                </p>
                            </div>
                        </div>
                        <div class="p-2">
                            <div class="row">
                                <div class="col-7">
                                    <h6><strong>Attendant:</strong>
                                        <?php echo getAttendantName($service["at_id"]); ?>
                                    </h6>
                                    <h6><strong>Price:</strong>
                                        <?php echo number_format($service["sd_price"]) ?>ksh
                                    </h6>
                                </div>
                                <div class="col-5">
                                    <div class="d-flex justify-content-end">
                                        <a class="btn btn-dark mt-2 me-2" href="?sid=<?php echo $service["s_id"] ?>">Book
                                            now &raquo;</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </section>

    <?php require_once(Url::getPath("app/views/includes/meta/scripts.php")); ?>
</body>

</html>