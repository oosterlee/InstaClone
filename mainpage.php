<!DOCTYPE html>
<html>
    <head>
        <?php include_once "main.php"; if (isset($_SESSION["loggedIn"])) {
            if ($_SESSION["loggedIn"] !== true) {
                echo '<meta http-equiv="refresh" content="0;URL=\'index.php\'" />';
            }
        } else {
            echo '<meta http-equiv="refresh" content="0;URL=\'index.php\'" />';
        }
        ?>
        <meta charset="utf-8">
        <title>Main Page</title>
        <style>
            div.gallery {
                margin: 5px;
                border: 1px solid #ccc;
                float: left;
                width: 180px;
                height: 380px;
            }

            div.gallery:hover {
                border: 1px solid #777;
            }

            div.gallery img {
                width: 100%;
                height: 180px;
            }

            div.desc {
                /*padding: 15px;*/
                margin-top: 5px;
                padding-bottom: 5px;
                text-align: center;
                height: 30px;
                overflow-y: scroll;
            }
            h3.uploader {
                margin-left: 10px;
                overflow-wrap: break-word;
            }
            div.date {
                color: grey;
                margin-top: 2px;
                font-size: 12px;
            }
            div.comments {
                height: 30px;
            }
            .inline {
                display: inline-block;
            }
            input[type="text"].inline {
                margin-top: 15px;
                width: 140px;
            }
            ul {
                list-style-type: none;
            }
        </style>
    </head>
    <body>
        <form class="logoutForm" action="index.php" method="post">
            <input type="submit" name="logout" value="Logout">
        </form><br>

        <form class="searchDescription" action="mainpage.php" method="post">
            <input type="text" name="searchDescription" value="" placeholder="Search a description">
            <input type="submit" name="searchSubmit" value="Search">
        </form><br>

        <form class="uploadImage" action="mainpage.php" method="post" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" value="" placeholder="Upload your file" accept="image/x-png,image/gif,image/jpeg,image/jpg,image/png">
            <input type="text" name="imageDescription" value="" placeholder="Your image description">
            <input type="submit" name="submitImageUpload" value="Upload">
        </form>
        
        <?php

        if (isset($_POST["searchDescription"])) {
            listImages(0, 50, $_POST["searchDescription"]);
        } else {
            listImages();
        }

        ?>
    </body>
</html>
