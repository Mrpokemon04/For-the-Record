<?php
    session_start();

    $pythonPath = "C:\\Users\\Vlad Preda\\XAMPP\\python\\Python\\Python312\\python.exe";
    $name = basename(__FILE__, '.php');
    $name = str_replace('_', ' ', $name);

    $command = "$pythonPath ../scripts/getID.py $name";
    $id = shell_exec($command);
    $_SESSION['album_id'] = $id;
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

    <title>{album}</title>
</head>
<body class="albumpage">
    <div class="navbar">
        <div class="container">
            <?php
                if(isset($_SESSION['username'])) {{
                    echo '<div class=\"logo\" onclick=\"location.href=\'welcome.php\'">';
                    echo '  <span class=\"ellipse1\"></span>';
                    echo '  <span class=\"ellipse2\"></span>';
                    echo '  <span class=\"ellipse3\"></span>';
                    echo '  <span class=\"text\">FTR</span>';
                    echo '</div>';
                }}
                else {{
                    echo '<div class=\"logo\" onclick=\"location.href=\'homepage.php\'">';
                    echo '  <span class=\"ellipse1\"></span>';
                    echo '  <span class=\"ellipse2\"></span>';
                    echo '  <span class=\"ellipse3\"></span>';
                    echo '  <span class=\"text\">FTR</span>';
                    echo '</div>';
                }}
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
                    echo '<div class=\"logout\" onclick=\"location.href=\'logout.php\'">';
                    echo '  <input type=\"submit\" value=\"\" class=\"button\">';
                    echo '  <span class=\"text\">Log out</span>';
                    echo '</div>';
                    echo '"<div class="profile" onclick="location.href=\'profile.php\'">\';>';
                    echo '  <span class="pfp"></span>';
                    echo '</div>';
                    echo '<style>';
                    echo '  .navbar .profile .pfp {{';
                    echo '      background: url(\'../images/' . $_SESSION['avatar'] . '\') no-repeat center center;';
                    echo '      background-size: cover;';
                    echo '  }}';
                    echo '</style>';
                }
                else {
                    echo '<div class=\"login\" onclick=\"location.href=\'login.php\'">';
                    echo '  <input type=\"submit\" value=\"\" class=\"button\">';
                    echo '  <span class=\"text\">Log in</span>';
                    echo '</div>';
                }
            ?>
        </div>
    </div>

    <div class="albumphoto"></div>
    <style>
        .albumpage .albumphoto {
            background-image: url(../{cover});
            background-size: cover;
        }
    </style>

    <div class="albumname">{album}</div>
    
    <div class="albuminfo">
        <div class="artistname">Artist(s): </div>
        <div class="releasedate">Release date: </div>
        <div class="genre">Genres: </div>

        <div class="inputartistname">{artist}</div>
        <div class="inputreleasedate">{date}</div>
        <div class="inputgenre">{genre}</div>
    </div>

    <div class="rating">
        <div class="rate">Rate this album:</div>
        <div class="stars">★:</div>
        <button class="favourite" onclick="location.href='favouriteScript.php'">Set as favourite</button>
    </div>

    <div class="review">
        <div class="intro">Review:</div>
        <div class="reviewtext">ssssssssssss s s s s sss s s s s s s ssssssss s s sssss s sssssss s s ssss s s s s s ssssssssss s s s s s s s s s s s s s sssssss s s sssssss s s s s s s s s s s s s s s s ssssss s ssss s ssss s ss s s sss s s s s sss s sssssss s s ssss s s s sssssssss s s s s ssss s s sssss s s s s s s s s s ssssssss s s s s s s s s s s s s sssssssssss s s s s s ssssssssss s s s s s s s ssssssss s s sssssss s s ssss s ssssss s sssssssss sssssssss s s s s s s s s sssssssss s s sss s sss s ss s s ssssssssss s s s s s s s s s s s sssssssss s s s s s s sss s sssss sss ssssss ss ssssssss sssss s s s sssssssss s s s s ssssssssssssss s sss s sss ssss s sss s s s s s s s s s sssss ssssssssssss s s s s sss s s s s s s ssssssss s s sssss s sssssss s s ssss s s s s s ssssssssss s s s s s s s s s s s s s sssssss s s sssssss s s s s s s s s s s s s s s s ssssss s ssss s ssss s ss s s sss s s s s sss s ssssssss</div>
    </div>
</body>
</html>