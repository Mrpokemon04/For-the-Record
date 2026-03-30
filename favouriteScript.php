<?php
    session_start();

    $pythonPath = '"' . __DIR__ . '\\python\\Python\\Python312\\python.exe"';
    $username = $_SESSION['username'];
    $album_id = $_SESSION['album_id'];

    $output = shell_exec("$pythonPath scripts/setFavouriteAlbum.py \"$username\" \"$album_id\"");
    
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
?>