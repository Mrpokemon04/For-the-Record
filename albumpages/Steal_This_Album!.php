
    <?php
        session_start();

        $pythonPath = '"' . dirname(__DIR__) . '\\python\\Python\\Python312\\python.exe"';
        $name = basename(__FILE__, '.php');
        $name = str_replace('_', ' ', $name);

        $command = "$pythonPath ../scripts/getID.py \"$name\"";
        $id = shell_exec("$command");
    
        $_SESSION['album_id'] = trim($id);

        $message = '';
        if($_SERVER['REQUEST_METHOD'] === "POST") {

            if(!empty($_POST['rating'])) {
                $username = $_SESSION['username'];
                $albumid = $_SESSION['album_id'];
                $rating = $_POST['rating'];
                $review = $_POST['review'];

                $review = str_replace("\n", "{{{newline}}}", $_POST['review']);

                $command = "$pythonPath ../scripts/addReview.py \"$username\" \"$albumid\" \"$rating\" \"$review\"";

                $output = shell_exec("$command 2>&1");            
            }
            else {
                $message = "Please submit a rating!";
            }
        }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" href="../images/logo.ico" type="image/ico">
        <link rel="stylesheet" href="../css/styles.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <title>Steal This Album!</title>
    </head>
    <body class="albumpage">
        <div class="navbar">
            <div class="container">
                <?php
                    if(isset($_SESSION['username'])) {
                        echo '<div class="logo" onclick="location.href=\'../welcome.php\'">';
                        echo '  <span class="ellipse1"></span>';
                        echo '  <span class="ellipse2"></span>';
                        echo '  <span class="ellipse3"></span>';
                        echo '  <span class="text">FTR</span>';
                        echo '</div>';
                    }
                    else {
                        echo '<div class="logo" onclick="location.href=\'../homepage.php\'">';
                        echo '  <span class="ellipse1"></span>';
                        echo '  <span class="ellipse2"></span>';
                        echo '  <span class="ellipse3"></span>';
                        echo '  <span class="text">FTR</span>';
                        echo '</div>';
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
                        $pythonPath = '"' . dirname(__DIR__) . '\\python\\Python\\Python312\\python.exe"';

                        if(isset($_POST['query'])) {
                            $_SESSION['query'] = $_POST['query'];
                            header("Location: ../search.php");
                        }
                    }
                ?>

                <div class="options">
                    <ul class="options">
                        <li class="music"><a href="../music.php">Music</a></li>
                        <li class="reviews"><a href="../reviews.php">Reviews</a></li>
                        <li class="lists"><a href="../lists.php">Lists</a></li>
                        <li class="aboutus"><a href="../aboutus.php">About us</a></li>
                    </ul>
                </div>

                <?php
                    if(isset($_SESSION['username'])) {
                        echo '<div class="logout" onclick="location.href=\'../logout.php\'">';
                        echo '  <input type="submit" value="" class="button">';
                        echo '  <span class="text">Log out</span>';
                        echo '</div>';
                        echo '<div class="profile" onclick="location.href=\'../profile.php\'">';
                        echo '  <span class="pfp"></span>';
                        echo '</div>';
                        echo '<style>';
                        echo '  .navbar .profile .pfp {';
                        echo '      background: url(\'../images/' . $_SESSION['avatar'] . '\') no-repeat center center;';
                        echo '      background-size: cover;';
                        echo '  }';
                        echo '</style>';
                    }
                    else {
                        echo '<div class="login" onclick="location.href=\'../login.php\'">';
                        echo '  <input type="submit" value="" class="button">';
                        echo '  <span class="text">Log in</span>';
                        echo '</div>';
                    }
                ?>
            </div>
        </div>

        <div class="albumphoto"></div>
        <style>
            .albumpage .albumphoto {
                background-image: url(../covers/stealthisalbum.jpg);
                background-size: cover;
            }
        </style>

        <div class="albumname">Steal This Album!</div>
        
        <div class="albuminfo">
            <div class="artistname">Artist(s): </div>
            <div class="releasedate">Release date: </div>
            <div class="genre">Genres: </div>

            <div class="inputartistname">System of a Down</div>
            <div class="inputreleasedate">2002-11-26</div>
            <div class="inputgenre">alternative metal</div>
        </div>

        <div class="rating">
            <div class="rate">Rate this album:</div>
            <div class="stars">★:</div>
            <button class="favourite" onclick="location.href='../favouriteScript.php'">Set as favourite</button>
        </div>

        <form class="ratingreview" method="post">
            <div class="rating">
                <div class="rate">Rate this album:</div>
                <div class="stars">
                    <div class="star-row">
                        <button type="button" name="rating" class="star" onclick="changeStarImage(0.5)">0.5 stars</button>
                        <button type="button" name="rating" class="star" onclick="changeStarImage(1)">1 star</button>
                        <button type="button" name="rating" class="star" onclick="changeStarImage(1.5)">1.5 stars</button>
                        <button type="button" name="rating" class="star" onclick="changeStarImage(2)">2 stars</button>
                        <button type="button" name="rating" class="star" onclick="changeStarImage(2.5)">2.5 stars</button>
                    </div>
                    <div class="star-row">
                        <button type="button" name="rating" class="star" onclick="changeStarImage(3)">3 stars</button>
                        <button type="button" name="rating" class="star" onclick="changeStarImage(3.5)">3.5 stars</button>
                        <button type="button" name="rating" class="star" onclick="changeStarImage(4)">4 stars</button>
                        <button type="button" name="rating" class="star" onclick="changeStarImage(4.5)">4.5 stars</button>
                        <button type="button" name="rating" class="star" onclick="changeStarImage(5)">5 stars</button>
                    </div>
                </div>
                <input type="hidden" name="rating" id="ratingInput" value="">
                <img class="starimage" id="starimage" src="../images/default.jpg"></img>
                <button class="favourite" onclick="location.href='../favouriteScript.php'">Set as favourite</button>
            </div>

            <div class="review">
                <div class="intro">Review:</div>
                <textarea class="reviewtext" name="review"></textarea>
            </div>

            <div class="errortext"> <?php echo $message; ?> </div>
            <input id="submitButton" type="submit" value="Submit Review">

        </form>

        <script>
            function changeStarImage(rating) {
                const starImage = document.getElementById('starimage');
                const ratingInput = document.getElementById('ratingInput');
                const path = `../images/${rating}stars.jpg`;
                starImage.src = path;
                ratingInput.value = rating;
            }
        </script>

    </body>
    </html>
            