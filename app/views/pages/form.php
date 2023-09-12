<?php

use Vendor\Services\File\File;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="<?php echo asset("css/frameworks/bootstrap.min.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset("css/custom/style.css") ?>">
    <style>
        .row>* {
            margin-top: 1rem;
        }

        label {
            margin-bottom: 1rem;
        }

        .card-body>* {
            padding: 0.5rem 0.5rem;
        }
    </style>
</head>

<body>

    <?php File::require("app/views/containers/navbar.php") ?>

    <main class="bg-overlay">
        <section class="mb-5 pt-lg">
            <section class="row me-0 ms-0">
                <div class="col-md-7">
                    <div class="d-flex justify-content-center">
                        <div class="col-md-8 form-intro p-3">
                            <h1 class="text-overlay text-nowrap">Member Registration Form</h1>
                            <h3 class="text-secondary mt-3">Create a free account</h3>
                            <p class="col-md-10 text-solid mt-3">Hi, thank you for choosing to be part of us. We
                                are
                                delighted to welcome
                                you to our team. Just a few steps to go and we will get you started. Please fill the
                                form bellow</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="col-md-10">
                        <div class="card p-2 mb-5">
                            <div class="card-body">
                                <div class="form-header">
                                    <h6 class="text-center text-muted">Step: 1 out of 2</h6>
                                    <h6 class="text-center"><em class="control-message">Required fields are marked by
                                            *</em>
                                    </h6>
                                    <div class="form-spinner d-none mt-3">
                                        <div class="d-flex justify-content-center align-items-center spinner">
                                            <div class="spinner-border text-primary spinner-border-sm" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="alert alert-danger mt-3 d-none">
                                        <strong>Oops!</strong>
                                        <span class="alert-message">You have entered an incorrect username</span>
                                    </div>

                                </div>
                                <form method="post" id="client-registration-form">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="firstname"><strong>Firstname:</strong></label>
                                            <input type="text" name="firstname" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="lastname"><strong>Lastname:</strong></label>
                                            <input type="text" name="lastname" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="gender"><strong>Gender:</strong></label>
                                            <select name="gender" class="form-select">
                                                <option>Male</option>
                                                <option>Female</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="occupation"><strong>Occupation:</strong></label>
                                            <select name="occupation" class="form-select">
                                                <option>Student</option>
                                                <option>Employed</option>
                                                <option>Self-employed</option>
                                            </select>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="phonenumber"><strong>Phone number:</strong></label>
                                            <input type="number" name="phonenumber" class="form-control">
                                        </div>

                                        <div class="col-md-12">
                                            <label for="email"><strong>Email address:</strong></label>
                                            <input type="email" name="email" class="form-control">
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <button type="submit"
                                                class="btn btn-lg btn-primary shadow-sm w-100">Register</button>
                                        </div>
                                        <div class="col-md-12">
                                            <a class="btn btn-outline-secondary w-100" href="javascript:void(0)">I
                                                already
                                                have an
                                                account</a>
                                        </div>
                                    </div>
                                </form>
                                <div class="form-footer d-flex justify-content-center">
                                    <div class="col-md-6 row">
                                        <div class="col-4">
                                            <h6 class="text-center text-muted text-nowrap">Help</h6>
                                        </div>
                                        <div class="col-4">
                                            <h6 class="text-center text-muted text-nowrap">About</h6>
                                        </div>
                                        <div class="col-4">
                                            <h6 class="text-center text-muted text-nowrap">Privacy</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </main>
    <script src="<?php echo asset("js/frameworks/jquery.js"); ?>"></script>
    <script src="<?php echo asset("js/frameworks/bootstrap.js"); ?>"></script>
    <script src="<?php echo asset("js/custom/dpz.js"); ?>"></script>
    <script src="<?php echo asset("js/custom/dpzexecute.js"); ?>"></script>
</body>

</html>