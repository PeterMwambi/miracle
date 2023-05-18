<?php

use Models\Core\App\Utilities\Url;
use Views\Includes\Components\Classes\Page;

require_once(Url::getPath("app/views/includes/components/renders/navbar.php"));
?>

<!DOCTYPE html>
<html lang="en">
<?php require_once(Url::getPath("app/views/includes/meta/head.php")); ?>

<body>
    <?php runDefaultNavbarSetup(Page::run()->getTitle()); ?>

    <section class="container-fluid mt-md bg-home">
        <div class="row">
            <div class="col-md-6 mt-5">
                <div class="d-flex justify-content-md-center">
                    <div class="">
                        <h2>Hello, Welcome to Thee Dope Spa</h2>
                        <p><strong>Experience a feeling like never before</strong></p>
                        <p class="col-md-9">We give you full barber, salon and beauty therapy as well spa services.
                        </p>
                        <div class="d-flex">
                            <a class="btn btn-dark" href="services">Our services &raquo;</a>
                            <a class="btn btn-light ms-3" href="#">Find out more &raquo;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container">
        <div class="d-flex justify-content-center">
            <h3 class="my-3">Our location</h3>
        </div>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.0840045340888!2d37.00892071463791!3d-1.099282135760545!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f473aea9a135d%3A0x539834412e915be5!2sThee%20Dope%20Spa%20and%20Barbershop!5e0!3m2!1sen!2ske!4v1680437188136!5m2!1sen!2ske"
            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>

    </section>

    <?php require_once(Url::getPath("app/views/includes/meta/scripts.php")); ?>
</body>

</html>