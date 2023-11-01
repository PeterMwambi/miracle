<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='<?php echo asset("css/custom/test.css") ?>'>
</head>

<body>


    <div class="root"></div>



    <section class="slider">
        <div class="slider-container">
            <div class="slider-body">
                <div class="slider-item"></div>
            </div>
            <div class="slider-body">
                <div class="slider-item"></div>
            </div>
            <div class="slider-body">
                <div class="slider-item"></div>
            </div>
        </div>

        <div class="slider-control">
            <button onclick="pauseSlider()">Pause Slider</button>
        </div>
    </section>



    <script src='<?php echo asset("js/custom/test.js") ?>'></script>

</body>

</html>