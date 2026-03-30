<?php
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $reviewText = $_POST['reviewtext'];
        $rating = floatval(pathinfo($_POST['rating'], PATHINFO_FILENAME));
        $pythonPath = '"' . __DIR__ . '\\python\\Python\\Python312\\python.exe"';

        $username = $_SESSION['username'];
        $album_id = $_SESSION['album_id'];
        
        var_dump($_POST);

        // $output = shell_exec("$pythonPath scripts/addReview.py $username $album_id $rating $reviewText")
    }
?>