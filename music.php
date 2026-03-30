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
    
    <title>Music - FTR</title>
</head>
<body class="musicpage">
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

    <div class="popularbox">
        <div class="popularthisweek">Popular this week</div>
        <div class="albums">
        <?php
            $pythonPath = '"' . __DIR__ . '\\python\\Python\\Python312\\python.exe"';
            $output = shell_exec("$pythonPath scripts/getNewAlbums.py");
            $albums = json_decode(trim($output), true);

            foreach($albums as $album) {
                $cover = $album['cover'];
                $name = $album['name'];
                $artist = $album['artist'];
                $redirectName = $name;
                $redirectName = str_replace(' ', '_', $redirectName);

                echo "<div class=\"albuminfo\">";
                echo "<div class=\"albumphoto\" style=\"background-image: url('" . $cover . "');\" onclick=\"location.href='albumpages/" . $redirectName . ".php';\"></div>";
                echo "  <style>";
                echo "      .musicpage .popularbox .albumphoto {";
                echo "          display: flex;";
                echo "          position: relative;";
                echo "          width: 200px;";
                echo "          height: 200px;";
                echo "          left: 111px;";
                echo "          top: 127px;";
                echo "          cursor: pointer;";
                echo "          background-size: cover";
                echo "      }";
                echo "  </style>";
                echo "  <div class=\"albumname\">" . $name . "</div>";
                echo "  <div class=\"artistname\">" . $artist . "</div>";
                echo "</div>";
            }
        ?>
        </div>
    </div>

    <div class="recentbox">
        <div class="recentlyadded">Recently added</div>
        <div class="albums">
            <?php
                $pythonPath = '"' . __DIR__ . '\\python\\Python\\Python312\\python.exe"';
                $output = shell_exec("$pythonPath scripts/getRecentAlbums.py");
                $albums = json_decode(trim($output), true);

                foreach($albums as $album) {
                    $cover = $album['cover'];
                    $name = $album['name'];
                    $artist = $album['artist'];
                    $redirectName = $name;
                    $redirectName = str_replace(' ', '_', $redirectName);

                    echo "<div class=\"albuminfo\">";
                    echo "  <div class=\"albumphoto\" style=\"background-image: url(" . $cover . ")\" onclick=\"location.href='albumpages/" . $redirectName . ".php';\"></div>";
                    echo "  <style>";
                    echo "      .musicpage .recentbox .albumphoto {";
                    echo "          display: flex;";
                    echo "          position: relative;";
                    echo "          width: 200px;";
                    echo "          height: 200px;";
                    echo "          left: 111px;";
                    echo "          top: 127px;";
                    echo "          cursor: pointer;";
                    echo "          background-size: cover";
                    echo "      }";
                    echo "  </style>";
                    echo "  <div class=\"albumname\">" . $name . "</div>";
                    echo "  <div class=\"artistname\">" . $artist . "</div>";
                    echo "</div>";
                }
            ?>
        </div>
        <div class="seeall" onclick="location.href='allalbums.php'" style="cursor: pointer">see all</div>
    </div>
    
</body>
</html>