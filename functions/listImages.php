<?php

function listImages($limitFrom = 0, $limitTo = 50, $desc = "%%") {
    $conn = SQL('instaclone');
    $query = "SELECT * FROM `imagedata` WHERE `description` LIKE (?) ORDER BY `date` DESC LIMIT ".$limitFrom.",".$limitTo;
    $sql = $conn->prepare($query);
    $t = "1";
    $desc = "%".$desc."%";
    $sql->bind_param("s", $desc);
    $sql->execute();
    $result = $sql->get_result();
    $row = $result->fetch_array(MYSQLI_ASSOC);

    if (count($row) > 0) {
        $comments = "";
        $commentsArray = explode(",", $row["Comments"]);
        for ($i=1; $i < count($commentsArray); $i++) {
            $arr = explode("#%#^",$commentsArray[$i]);
            $comments .= "<li><b>".$arr[0]."</b>: ".$arr[1]."</li>";
        }
        echo
        '<div class="gallery">
            <h3 class="uploader">'.$row["username"].'</h3>
            <a target="_blank" href="'.$row["imageName"].'">
                <img src="'.$row["imageName"].'" alt="Some uploaded image" width="300px" height="200px">
            </a>
            <div class="desc">'.$row["description"].'</div>
            <div class="comments"><ul style="height: 40px; overflow-y: scroll;">'.$comments.'</ul></div>
            <form action="mainpage.php" method="POST">
                <input type="text" name="commentText" placeholder="Add your comment" class="inline" />
                <input type="submit" name="submitComment" value=">" class="inline" />
                <input type="text" name="imgid" value="'.$row["id"].'" hidden />
            </form>
            <div class="date"><strong>Date upload: </strong>'.$row["date"].'</div>
        </div>';
        while ($row = $result->fetch_assoc()) {
            $comments = "";
            $commentsArray = explode(",", $row["Comments"]);
            for ($i=1; $i < count($commentsArray); $i++) {
                $arr = explode("#%#^",$commentsArray[$i]);
                $comments .= "<li><b>".$arr[0]."</b>: ".$arr[1]."</li>";
            }
            echo
            '<div class="gallery">
                <h3 class="uploader">'.$row["username"].'</h3>
                <a target="_blank" href="'.$row["imageName"].'">
                    <img src="'.$row["imageName"].'" alt="Some uploaded image" width="300px" height="200px">
                </a>
                <div class="desc">'.$row["description"].'</div>
                <div class="comments"><ul style="height: 40px; overflow-y: scroll;">'.$comments.'</ul></div>
                <form action="mainpage.php" method="POST">
                    <input type="text" name="commentText" placeholder="Add your comment" class="inline" />
                    <input type="submit" name="submitComment" value=">" class="inline" />
                    <input type="text" name="imgid" value="'.$row["id"].'" hidden />
                </form>
                <div class="date"><strong>Date upload: </strong>'.$row["date"].'</div>
            </div>';
        }
    } else {
        // No images.
        echo "<h2>No images where found.<h2>";
    }
}

?>
