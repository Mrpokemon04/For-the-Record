<?php
    session_start();

    $message = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $pythonPath = '"' . __DIR__ . '\\python\\Python\\Python312\\python.exe"';

        $username = $_POST['username'];
        $password = $_POST['password'];

        $check = shell_exec("$pythonPath scripts/login.py $username $password");
        $avatar = shell_exec("$pythonPath scripts/getAvatar.py $username $password");
        $bio = shell_exec("$pythonPath scripts/getBio.py $username $password");

        if((int)$check === 1) {
            $_SESSION['username'] = $username;
            $_SESSION['avatar'] = trim($avatar);
            $_SESSION['bio'] = trim($bio);
            header("Location: welcome.php");
            exit();
        }
        else if((int)$check === 2){
            $message = "Login information is not correct!";
        }
    }
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
    
    <title>Login - FTR</title>
</head>
<body class="loginpage">
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

    <div class="loginbox">
        <div class="text">Log in</div>
        <form class="logindetails" method="post">
            <div class="username">
                <label for="user">Username</label>
                <input type="text" id="user" name="username">
            </div>
            <div class="password">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
            </div>
            <div class="signup" onclick="location.href='register.php'">Don't have an account? Sign up</div>

            <div class="loginmessage"><?php echo $message?></div>

            <div class="confirm">
                <input type="submit" value="Confirm" class="button">
            </div>
        </form>
        
    </div>
</body>
</html>