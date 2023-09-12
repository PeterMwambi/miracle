<?php

use Vendor\Services\File\Classes\FileSystem;

?>


<nav class="navbar navbar-expand-sm navbar-light bg-light shadow-sm fixed-top">
    <a class="navbar-brand" href="home">
        <img src="<?php echo asset("assets/logo/dpz.png") ?>" class="img-fluid dpz__logo ms-3"></a>
    <button class="navbar-toggler d-lg-none me-3" data-bs-toggle="collapse" data-bs-target="#dpz__navbar"
        aria-expanded="false" aria-controls="dpz__navbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse" id="dpz__navbar">
        <ul class="navbar-nav ms-md-auto d-flex">
            <li class="nav-item mx-3">
                <a class="nav-link" href="">Peter Mwambi</a>
            </li>

            <li class="nav-item dropdown mx-3">
                <a href="javascript:void(0)" class="nav-link dropdown-toggle" id="projects" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">Projects</a>
                <div class="dropdown-menu" aria-labelledby="projects">
                    <a class="dropdown-item" href="https://localhost/projects/adeptdesigners.co.ke/"
                        target="blank">Adept designers</a>
                    <hr class="dropdown-divider">
                    <a class="dropdown-item" href="https://localhost/projects/tutorspoint/app/home"
                        target="blank">Tutors Point</a>
                    <hr class="dropdown-divider">
                    <a class="dropdown-item" href="https://localhost/projects/dopespa/app/home" target="blank">Dope
                        spa</a>
                    <hr class="dropdown-divider">
                    <a class="dropdown-item" href="https://localhost/projects/luxurybnbs/app/home" target="blank">Luxury
                        bnbs</a>
                    <hr class="dropdown-divider">
                    <a class="dropdown-item" href="https://localhost/projects/everready/" target="blank">Everready</a>
                    <hr class="dropdown-divider">
                    <a class="dropdown-item" href="https://localhost/projects/teambp/app/home" target="blank">Teambp</a>
                    <hr class="dropdown-divider">
                    <a class="dropdown-item" href="https://localhost/projects/faq/app/public/?page=home&auth=guest"
                        target="blank">Live
                        FAQ</a>
                    <hr class="dropdown-divider">
                    <a class="dropdown-item" href="https://localhost/projects/caddy--clone/pages/" target="blank">Caddy
                        Server
                        Clone</a>
                </div>
            </li>

            <li class="nav-item dropdown mx-3">
                <a href="javascript:void(0)" class="nav-link dropdown-toggle" id="tests" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">Services</a>
                <div class="dropdown-menu" aria-labelledby="tests">
                    <a class="dropdown-item" href="sandbox">Sandbox</a>
                    <a class="dropdown-item" href="test">Tests</a>
                    <a class="dropdown-item" href="reports">Reports</a>
                </div>
            </li>
            <li class="nav-item mx-3">
                <a class="nav-link me-3" href="javascript:" data-bs-toggle="offcanvas" data-bs-target="#dpz__sidenavbar"
                    aria-controls="dpz__sidenavbar">
                    Menu
                </a>
            </li>
            <li class="nav-item mx-3 me-5 dropdown">
                <a class="nav-link" href="javascript:void(0)" id="dpz__theme-switch">
                    <img src="lightmode.png" class="img-fluid icon-sm switch-icon light mb-1"
                        id="dpz__theme-switch-icon">
                </a>
            </li>
        </ul>
    </div>
</nav>