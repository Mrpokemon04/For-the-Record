<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="images/logo.ico" type="image/ico">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <title>Profile - FTR</title>
</head>
<body class="profilepage">
    <div class="navbar">
        <div class="container">
            <?php
                if(isset($_SESSION['username'])) {
                    echo "<div class=\"logo\" onclick=\"location.href='welcome.php'\">";
                    echo "  <span class=\"ellipse1\"></span>";
                    echo "  <span class=\"ellipse2\"></span>";
                    echo "  <span class=\"ellipse3\"></span>";
                    echo "  <span class=\"text\">FTR</span>";
                    echo "</div>";
                }
                else {
                    echo "<div class=\"logo\" onclick=\"location.href='homepage.php'\">";
                    echo "  <span class=\"ellipse1\"></span>";
                    echo "  <span class=\"ellipse2\"></span>";
                    echo "  <span class=\"ellipse3\"></span>";
                    echo "  <span class=\"text\">FTR</span>";
                    echo "</div>";
                }
            ?>
            
            <div class="searchbar">
                <form class="search" method="post">
                    <input type="text" name="query" placeholder="Search">
                    <input type="submit" value="Search" hidden>
                </form>
            </div>

            <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $pythonPath = '"' . __DIR__ . '\\python\\Python\\Python312\\python.exe"';

                    if(isset($_POST['query'])) {
                        $_SESSION['query'] = $_POST['query'];
                        header("Location: search.php");
                    }
                }
            ?>

            <div class="options">
                <ul class="options">
                    <li class="music"><a href="music.php">Music</a></li>
                    <li class="reviews"><a href="reviews.php">Reviews</a></li>
                    <li class="lists"><a href="lists.php">Lists</a></li>
                    <li class="aboutus"><a href="aboutus.php">About us</a></li>
                </ul>
            </div>

            <?php
                if(isset($_SESSION['username'])) {
                    echo "<div class=\"logout\" onclick=\"location.href='logout.php'\">";
                    echo "  <input type=\"submit\" value=\"\" class=\"button\">";
                    echo "  <span class=\"text\">Log out</span>";
                    echo "</div>";
                    echo "<div class=\"profile\">";
                    echo "  <span class=\"pfp\" onclick=\"location.href='profile.php'\"></span>";
                    echo "</div>";
                    echo "<style>";
                    echo "  .navbar .profile .pfp {";
                    echo "      background: url('./images/" . $_SESSION['avatar'] . "') no-repeat center center;";
                    echo "      background-size: cover;";
                    echo "  }";
                    echo "</style>";
                }

                else {
                    echo "<div class=\"login\" onclick=\"location.href='login.php'\">";
                    echo "  <input type=\"submit\" value=\"\" class=\"button\">";
                    echo "  <span class=\"text\">Log in</span>";
                    echo "</div>";
                }
            ?>

        </div>
    </div>

    <div class="profileinfo">
        <span class="avatar" style="background-image: url('images/<?php echo $_SESSION['avatar']; ?>'); background-size: cover;"></span>
        <div class="name"> <?php echo $_SESSION['username']; ?></div>
        <div class="bio"> <?php echo nl2br($_SESSION['bio']); ?> </div>
    </div>

    <?php
        $pythonPath = '"' . __DIR__ . '\\python\\Python\\Python312\\python.exe"';
        $username = $_SESSION["username"];
        $output = shell_exec("$pythonPath scripts/getFavouriteAlbum.py $username");
        
        $album = json_decode(trim($output), true);
    
        $_SESSION['favourite_album_name'] = $album['name'];
        $_SESSION['favourite_album_artist'] = $album['artist'];
        $_SESSION['favourite_album_cover'] = $album['cover'];
        $redirectName = $_SESSION['favourite_album_name'];
        $redirectName = str_replace(' ', '_', $redirectName);
    ?>

    <div class="favouritealbum">
        <div class="text"><?php echo $_SESSION['username']; ?>'s current favorite album:</div>
        <div class="cover" style="background-image: url('<?php if(isset($_SESSION['favourite_album_cover'])) { echo $_SESSION['favourite_album_cover'] . "'); cursor: pointer; "; } else echo "images/defaultimage.jpg');";?> background-size: cover;" <?php if(isset($_SESSION['favourite_album_cover'])) { echo "onclick=\"location.href='albumpages/$redirectName.php';\"";} ?>></div>
        <div class="name"> <?php if(isset($_SESSION['favourite_album_name'])) { echo $_SESSION['favourite_album_name']; } else { echo ""; }?> </div>
        <div class="artist"> <?php if(isset($_SESSION['favourite_album_artist'])) { echo $_SESSION['favourite_album_artist']; } else { echo ""; }?> </div>
    </div>

    <?php
        $pythonPath = '"' . __DIR__ . '\\python\\Python\\Python312\\python.exe"';

        $username = $_SESSION["username"];
        $output3 = shell_exec("$pythonPath scripts/getReviewsName.py $username");

        $ratings = json_decode($output3, true);

    ?>
    
    <div class="myreviews">
        <div class="text">Ratings</div>
        <div class="reviews">
            <div class="review">
                <div class="cover" <?php if(isset($ratings[0]['album_cover'])) { echo "style=\"background: url(./" . $ratings[0]['album_cover'] . ") no-repeat center center; background-size: cover;\""; }?>></div>
                <div class="rating"> <?php if(isset($ratings[0]['rating'])) {echo $ratings[0]['rating'];} else { echo "x"; } ?>/5 ★</div>
            </div>
            <div class="review">
                <div class="cover" <?php if(isset($ratings[1]['album_cover'])) { echo "style=\"background: url(./" . $ratings[1]['album_cover'] . ") no-repeat center center; background-size: cover;\""; }?>></div>
                <div class="rating"> <?php if(isset($ratings[1]['rating'])) {echo $ratings[1]['rating'];} else { echo "x"; } ?>/5 ★</div>
            </div>
            <div class="review">
                <div class="cover" <?php if(isset($ratings[2]['album_cover'])) { echo "style=\"background: url(./" . $ratings[2]['album_cover'] . ") no-repeat center center; background-size: cover;\""; }?>></div>
                <div class="rating"> <?php if(isset($ratings[2]['rating'])) {echo $ratings[2]['rating'];} else { echo "x"; } ?>/5 ★</div>
            </div>
        </div>
        <div class="seeall" onclick="location.href='reviews.php'">see all</div>
    </div>

    <?php
        $pythonPath = '"' . __DIR__ . '\\python\\Python\\Python312\\python.exe"';

        $username = $_SESSION["username"];
        $output2 = shell_exec("$pythonPath scripts/getListsName.py $username");

        $lists = json_decode($output2, true);
    ?>

    <div class="mylists">
        <div class="text">Lists</div>
        <div class="lists">
            <div class="list">
                <div class="cover" style="background: url(./<?php echo $lists[0]['album1_cover'] ?>) no-repeat center center; background-size: cover;"></div>
                <div class="cover" style="background: url(./<?php echo $lists[0]['album2_cover'] ?>) no-repeat center center; background-size: cover;"></div>
                <div class="cover" style="background: url(./<?php echo $lists[0]['album3_cover'] ?>) no-repeat center center; background-size: cover;"></div>
                <div class="cover" style="background: url(./<?php echo $lists[0]['album4_cover'] ?>) no-repeat center center; background-size: cover;"></div>
                <div class="cover" style="background: url(./<?php echo $lists[0]['album5_cover'] ?>) no-repeat center center; background-size: cover;"></div>
                <div class="listname"> <?php if(isset($lists[0])){echo $lists[0]['listname'];} ?></div>
            </div>
            <div class="list">
                <div class="cover" style="background: url(./<?php echo $lists[1]['album1_cover'] ?>) no-repeat center center; background-size: cover;"></div>
                <div class="cover" style="background: url(./<?php echo $lists[1]['album2_cover'] ?>) no-repeat center center; background-size: cover;"></div>
                <div class="cover" style="background: url(./<?php echo $lists[1]['album3_cover'] ?>) no-repeat center center; background-size: cover;"></div>
                <div class="cover" style="background: url(./<?php echo $lists[1]['album4_cover'] ?>) no-repeat center center; background-size: cover;"></div>
                <div class="cover" style="background: url(./<?php echo $lists[1]['album5_cover'] ?>) no-repeat center center; background-size: cover;"></div>
                <div class="listname"> <?php if(isset($lists[1])) {echo $lists[1]['listname'];} ?></div>
            </div>
        </div>
        <div class="seeall" onclick="location.href='lists.php'">see all</div>
    </div>
</body>
</html>