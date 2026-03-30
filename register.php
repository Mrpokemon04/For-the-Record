<?php
    session_start();

    $message = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $pythonPath = '"' . __DIR__ . '\\python\\Python\\Python312\\python.exe"';

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confpassword = $_POST['confpassword'];
        $displayname = $_POST['displayname'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $bio = $_POST['bio'];
        $tandc = $_POST['tandc'];
        $avatar = $_POST['avatar'];

        $bio = str_replace("\n", "{{{newline}}}", $_POST['bio']);

        if ($password === $confpassword && $tandc === "on") {
            shell_exec("$pythonPath scripts/register.py \"$username\" \"$email\" \"$password\" \"$displayname\" \"$gender\" \"$dob\" \"$bio\" \"$avatar\"");
            $_SESSION['avatar'] = $avatar;
            header("Location: success.php");
            exit();
        } 
        if ($password !== $confpassword) {
            $message .= "Passwords don't match!<br>";
        }
        if ($tandc === "off") {
            $message .= "Please accept the terms and conditions!<br>";
        } else 
            $message .= "big problem\n";
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
    
    <title>Register - FTR</title>
</head>
<body class="registerpage">
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

    <div class="createacc">
        <div class="create">
            <form class="accountcreation" method="post">
                <div class="account">
                    <div class="text">1. Create an account</div>
                    <div class="username">
                        <label for="username">Username</label>
                        <input type="username" id="username" name="username">
                    </div>
                    <div class="email">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email">
                    </div>
                    <div class="password">
                        <label for="password">Create password</label>
                        <input type="password" id="password" name="password">
                    </div>
                    <div class="confpassword">
                        <label for="confpassword">Confirm password</label>
                        <input type="password" id="confpassword" name="confpassword">
                    </div>
                </div>
                <div class="build">
                    <div class="text">2. Build your profile</div>
                    <div class="pfp">
                        <label for="avatar1">Select an avatar</label>
                        <input type="radio" id="avatar1" name="avatar" value="avatar1.jpg">

                        <label for="avatar2" hidden>Select an avatar</label>
                        <input type="radio" id="avatar2" name="avatar" value="avatar2.jpg">

                        <label for="avatar3" hidden>Select an avatar</label>
                        <input type="radio" id="avatar3" name="avatar" value="avatar3.jpg">
                    </div>
                    <div class="displayname">
                        <label for="displayname">Display name</label>
                        <input type="username" id="displayname" name="displayname">
                    </div>
                    <div class="gender">
                        <label for="gender">Gender</label>
                        <select name="gender" id="gender" name="gender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="bio">
                        <label for="bio">Bio</label>
                        <textarea type="textarea" id="bio" name="bio"></textarea>
                    </div>
                    <div class="dob">
                        <label for="dob">Date of birth</label>
                        <input type="date" id="dob" name="dob">
                    </div>
                    <div class="tandc">
                        <label for="terms">I agree with Terms and Conditions</label>
                        <input type="hidden" name="tandc" value="off">
                        <input type="checkbox" id="terms" name="tandc" value="on">
                    </div>

                    <div class="registermessage"><?php echo $message?></div>

                    <div class="register">
                        <input type="submit" value="Create account" class="button">
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>