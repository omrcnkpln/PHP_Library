<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Crop-Ajax</title>

    <link rel="stylesheet" href="css/jquery.Jcrop.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="js/jquery.Jcrop.min.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>

    <style>
        .red {
            background-color: lime;
            color: red;
        }

        .kırp {
            border: 5px solid rebeccapurple;
            width: min-content;
            /* height: min-content; */
        }

        .jcrop-ux-fade-more{
            background-color: red;
        }
    </style>
</head>

<body>

    <?php

    if (!$_POST) {

    ?>
        <form method="post" id="fotoYukle" enctype="multipart/form-data">
            <input type="file" name="foto">
            <input type="submit" value="Yükle" name="fotoButton">
        </form>

        <div class="kırp"></div>
    <?php
    }
    ?>
</body>

</html>