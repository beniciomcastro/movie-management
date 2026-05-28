<?php
require_once "functions.php";

$movies = [];
$nextId = 1;

while (true) {
    echo "\n===== MOVIE MANAGEMENT SYSTEM =====\n";
    echo "1 - Register movie\n";
    echo "2 - List movies\n";
    echo "3 - Search movie by name\n";
    echo "4 - Edit movie\n";
    echo "5 - Remove movie\n";
    echo "6 - Statistics\n";
    echo "0 - Exit\n";

    $option = readText("Choose an option: ");

    switch ($option) {
        case "1":
            $movies[] = registerMovie($nextId);
            $nextId++;
            break;

        case "2":
            listMovies($movies);
            break;

        case "3":
            searchMovies($movies);
            break;

        case "4":
            editMovie($movies);
            break;

        case "5":
            removeMovie($movies);
            break;

        case "6":
            showStatistics($movies);
            break;

        case "0":
            echo "System closed.\n";
            exit;

        default:
            echo "Invalid option.\n";
    }
}