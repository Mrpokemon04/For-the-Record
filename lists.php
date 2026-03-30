<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    $pythonPath = '"' . __DIR__ . '\\python\\Python\\Python312\\python.exe"';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_SESSION['username'];

        $listname = $_POST['listname'];
        $description = $_POST['description'];
        $albums = $_POST['albums'];

        $albums_json = json_encode($albums);

        $escaped_username = escapeshellarg($username);
        $escaped_listname = escapeshellarg($listname);
        $escaped_description = escapeshellarg($description);
        $escaped_albums_json = escapeshellarg($albums_json);

        $command = "$pythonPath scripts/addList.py $escaped_username $escaped_listname $escaped_description $escaped_albums_json";

        $output = shell_exec("$command 2>&1");
    }

    $output2 = shell_exec("$pythonPath scripts/getLists.py");
    $lists = json_decode($output2, true);
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

    <title>Lists - FTR</title>
</head>
<body class="listspage">
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

    <div class="lists_box">
        <div class="freshlists">Fresh lists that you should check out</div>
        <div class="list-instance">
            <div class="albums">
                <div class="albumphoto" style="background: url(./<?php echo $lists[0]['album1_cover'] ?>) no-repeat center center; background-size: cover;"></div>
                <div class="albumphoto" style="background: url(./<?php echo $lists[0]['album2_cover'] ?>) no-repeat center center; background-size: cover;"></div>
                <div class="albumphoto" style="background: url(./<?php echo $lists[0]['album3_cover'] ?>) no-repeat center center; background-size: cover;"></div>
                <div class="albumphoto" style="background: url(./<?php echo $lists[0]['album4_cover'] ?>) no-repeat center center; background-size: cover;"></div>
                <div class="albumphoto" style="background: url(./<?php echo $lists[0]['album5_cover'] ?>) no-repeat center center; background-size: cover;"></div>
            </div>
            <div class="listname"> <?php echo $lists[0]['listname'] ?></div>
            <div class="username"> <?php echo $lists[0]['username'] ?></div>
            <div class="listdescription"> <?php echo $lists[0]['description'] ?></div>
        </div>

        <div class="list-instance">
            <div class="albums">
                <div class="albumphoto" style="background: url(./<?php echo $lists[1]['album1_cover'] ?>) no-repeat center center; background-size: cover;"></div>
                <div class="albumphoto" style="background: url(./<?php echo $lists[1]['album2_cover'] ?>) no-repeat center center; background-size: cover;"></div>
                <div class="albumphoto" style="background: url(./<?php echo $lists[1]['album3_cover'] ?>) no-repeat center center; background-size: cover;"></div>
                <div class="albumphoto" style="background: url(./<?php echo $lists[1]['album4_cover'] ?>) no-repeat center center; background-size: cover;"></div>
                <div class="albumphoto" style="background: url(./<?php echo $lists[1]['album5_cover'] ?>) no-repeat center center; background-size: cover;"></div>
            </div>
            <div class="listname"> <?php echo $lists[1]['listname'] ?></div>
            <div class="username"> <?php echo $lists[1]['username'] ?></div>
            <div class="listdescription"> <?php echo $lists[2]['description'] ?></div>
        </div>
        <div class="list-instance">
            <div class="albums">
                <div class="albumphoto" style="background: url(./<?php echo $lists[2]['album1_cover'] ?>) no-repeat center center; background-size: cover;"></div>
                <div class="albumphoto" style="background: url(./<?php echo $lists[2]['album2_cover'] ?>) no-repeat center center; background-size: cover;"></div>
                <div class="albumphoto" style="background: url(./<?php echo $lists[2]['album3_cover'] ?>) no-repeat center center; background-size: cover;"></div>
                <div class="albumphoto" style="background: url(./<?php echo $lists[2]['album4_cover'] ?>) no-repeat center center; background-size: cover;"></div>
                <div class="albumphoto" style="background: url(./<?php echo $lists[2]['album5_cover'] ?>) no-repeat center center; background-size: cover;"></div>
            </div>
            <div class="listname"> <?php echo $lists[2]['listname'] ?></div>
            <div class="username"> <?php echo $lists[2]['username'] ?></div>
            <div class="listdescription"> <?php echo $lists[2]['description'] ?></div>
        </div>
    </div>

    <form id="listForm" method="post">

        <div class="createlists">
            <div class="createtext">Create your own list</div>
            <div class="listname">
                <label for="listname">List name</label>
                <input type="text" id="listname" name="listname">
            </div>
            <div class="listdescription">
                <label for="description">List description</label>
                <textarea id="description" name="description"></textarea>
            </div>
        </div>

        <?php
            $pythonPath = '"' . __DIR__ . '\\python\\Python\\Python312\\python.exe"';
            $output = shell_exec("$pythonPath scripts/getAlbums.py");
            $albums = json_decode(trim($output), true);
            $albums = array_reverse($albums);

            
        ?>

        <div class="choosealbums">
            <div class="choosetext">Choose albums</div>
            <div class="albumchoices">
                <div class="albumchoice">
                    <label for="album1">Album 1</label>
                    <select id="album1" name="albums[0]">
                        <option value="" selected disabled hidden></option>
                        <?php
                            $i = 1;
                            foreach( $albums as $album ) {
                                echo "<option value=" . $i . ">" . $album['name'] . "</option>";
                                $i++;
                            }
                        ?>
                    </select>
                </div>
                <div class="albumchoice">
                    <label for="album2">Album 2</label>
                    <select id="album2" name="albums[1]">
                        <option value="" selected disabled hidden></option>
                        <?php
                            $i = 1;
                            foreach( $albums as $album ) {
                                echo "<option value=" . $i . ">" . $album['name'] . "</option>";
                                $i++;
                            }
                        ?>
                    </select>
                </div>
                <div class="albumchoice">
                    <label for="album3">Album 3</label>
                    <select id="album3" name="albums[2]">
                        <option value="" selected disabled hidden></option>
                        <?php
                            $i = 1;
                            foreach( $albums as $album ) {
                                echo "<option value=" . $i . ">" . $album['name'] . "</option>";
                                $i++;
                            }
                        ?>
                    </select>
                </div>
                <div class="albumchoice">
                    <label for="album4">Album 4</label>
                    <select id="album4" name="albums[3]">
                        <option value="" selected disabled hidden></option>
                        <?php
                            $i = 1;
                            foreach( $albums as $album ) {
                                echo "<option value=" . $i . ">" . $album['name'] . "</option>";
                                $i++;
                            }
                        ?>
                    </select>
                </div>
                <div class="albumchoice">
                    <label for="album5">Album 5</label>
                    <select id="album5" name="albums[4]">
                        <option value="" selected disabled hidden></option>
                        <?php
                            $i = 1;
                            foreach( $albums as $album ) {
                                echo "<option value=" . $i . ">" . $album['name'] . "</option>";
                                $i++;
                            }
                        ?>
                    </select>
                </div>
            </div>

            <button class="createlist">Create list</button>
        </div>
    </form>
</body>
</html>