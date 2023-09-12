<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form method="post" action="multiple-file-registrar" enctype="multipart/form-data">
        <?php
        for ($x = 0; $x <= 5; $x++) { ?>
        <div class="form-input">
            <label for="image-<?php echo $x ?>" class="form-label"></label>
            <input type="file" name="image-<?php echo $x ?>" id="image-<?php echo $x ?>">
            <?php
        }
        ?>
            <button type="submit" name="submit">Send Images</button>
    </form>

</body>

</html>