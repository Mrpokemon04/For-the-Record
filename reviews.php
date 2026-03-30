<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    $pythonPath = '"' . __DIR__ . '\\python\\Python\\Python312\\python.exe"';

    $output2 = shell_exec("$pythonPath scripts/getReviews.py");
    $ratings = json_decode($output2, true);
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
    
    <title>Reviews - FTR</title>
</head>
<body class="reviewspage">
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

    <div class="reviewbox">
        <div class="reviewsyoumightlike">Reviews you might like </div>
        <div class="reviewinstance">
            <div class="albumphoto" style="background: url(./<?php echo $ratings[0]['album_cover'] ?>) no-repeat center center; background-size: cover;"></div>
            <div class="albumname"> <?php echo $ratings[0]['album_name']?> </div>
            <div class="inputartistname"> <?php echo $ratings[0]['artist_name']?> </div>
            <div class="username"> <?php echo $ratings[0]['username']?> </div>
            <div class="rating"> <?php echo $ratings[0]['rating']?>/5★</div>
            <div class="showreview"> <?php echo $ratings[0]['review']?> </div>
        </div>
        <div class="reviewinstance">
            <div class="albumphoto" style="background: url(./<?php echo $ratings[1]['album_cover'] ?>) no-repeat center center; background-size: cover;"></div>
            <div class="albumname"> <?php echo $ratings[1]['album_name']?> </div>
            <div class="inputartistname"> <?php echo $ratings[1]['artist_name']?> </div>
            <div class="username"> <?php echo $ratings[1]['username']?> </div>
            <div class="rating"> <?php echo $ratings[1]['rating']?>/5★</div>
            <div class="showreview"> <?php echo $ratings[1]['review']?> </div>
        </div>
        <div class="reviewinstance">
            <div class="albumphoto" style="background: url(./<?php echo $ratings[2]['album_cover'] ?>) no-repeat center center; background-size: cover;"></div>
            <div class="albumname"> <?php echo $ratings[2]['album_name']?> </div>
            <div class="inputartistname"> <?php echo $ratings[2]['artist_name']?> </div>
            <div class="username"> <?php echo $ratings[2]['username']?> </div>
            <div class="rating"> <?php echo $ratings[2]['rating']?>/5★</div>
            <div class="showreview"> <?php echo $ratings[2]['review']?> </div>
        </div>
    </div>

    <div class="findalbum">
        <div class="wantrate">Want to rate and/or review an album yourself?</div>
        <button onclick="location.href='music.php'">Find an album</button>
    </div>

</body>
</html>