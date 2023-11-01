<?php

use Vendor\Services\File\File;

?>


<header class="miracle__header">
    <?php File::require("app/views/containers/navbar.php") ?>

    <section class="preamble">
        <h1>A lightweight PHP framework for the 21st Century</h1>
        <h6>Miracle is a minimalist <a href="javascript:">PHP framework</a> built on a strong <a
                href="javascript:">MVC</a> architecture.</h6>
        <h6>With over 100 rich <a href="javascript:">bult in libraries</a>, miracle offers you a seemless web
            development experience.</h6>
        <h6>The fun does not stop there, miracle offers you a quick way to <a href="javascript:">deploy your
                application</a>.</h6>

        <h6>We've got tons of features that will get you exited. Lets dive in</h6>

        <div class="links">
            <a href="javascript:">Find out more <img src="<?php echo asset("assets/icons/open.png") ?>"></a>
            <a href="javascript:">Download v1.2.0 <img src="<?php echo asset("assets/icons/downloads.png") ?>"></a>
            <a href="javascript:">Find on Github <img src="<?php echo asset("assets/icons/github.png") ?>"></a>
        </div>

        <div class="info">
            <h6><img src="<?php echo asset("assets/icons/fork.png") ?>"> 200 Forks</h6>
            <h6><img src="<?php echo asset("assets/icons/star.png") ?>"> 50 Stars </h6>
            <h6><img src="<?php echo asset("assets/icons/downloads.png") ?>"> 300 Downloads</h6>
        </div>
    </section>
</header>