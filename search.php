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
    
    <title>Search - FTR</title>
</head>
<body class="searchpage">
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

    <?php
        $pythonPath = '"' . __DIR__ . '\\python\\Python\\Python312\\python.exe"';

        $query = $_SESSION['query'];

        $output = shell_exec("$pythonPath scripts/search.py $query");
        $searches = json_decode($output, true);
    ?>

    <div class="searchtext">Search results for "<?php echo $_SESSION['query']; ?>" </div>
    <div class="searches">
        <?php
            if(!empty($searches)) {
                foreach($searches as $search) {
                    $redirectName = $search['name'];
                    $encodedName = str_replace(' ', '_', $redirectName);
                    $encodedName = urlencode($encodedName);
                    echo '<div class="result">';
                    echo '  <span class="cover" onclick="location.href=\'albumpages/' . $encodedName . '.php\';" style="background: url(./' . $search['cover'] . ') no-repeat center center; background-size: cover; cursor: pointer;"></span>';
                    echo '  <div class="name">' . $search['name'] . '</div>';
                    echo '  <div class="artist">' . $search['artist'] . '</div>';
                    echo '</div>';
                }
            }
        ?>
    </div>

</body>
</html>