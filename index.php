<?php

// Imports the functions file
require_once "functions.php";

// Array that stores all movies
$movies = [];

// Variable used to generate automatic IDs
$nextId = 1;

// Infinite loop to keep the menu running
while (true) {

    // Displays the system menu
    echo "\n===== MOVIE MANAGEMENT SYSTEM =====\n";
    echo "1 - Register movie\n";
    echo "2 - List movies\n";
    echo "3 - Search movie by name\n";
    echo "4 - Edit movie\n";
    echo "5 - Remove movie\n";
    echo "6 - Statistics\n";
    echo "0 - Exit\n";

    // Reads the option typed by the user
    $option = readText("Choose an option: ");

    // Checks which option was selected
    switch ($option) {

        // Registers a new movie
        case "1":

            // Adds the new movie to the movies array
            $movies[] = registerMovie($nextId);

            // Increases the ID for the next movie
            $nextId++;

            break;

        // Lists all registered movies
        case "2":
            listMovies($movies);
            break;

        // Searches movies by name
        case "3":
            searchMovies($movies);
            break;

        // Edits a movie by ID
        case "4":
            editMovie($movies);
            break;

        // Removes a movie by ID
        case "5":
            removeMovie($movies);
            break;

        // Displays system statistics
        case "6":
            showStatistics($movies);
            break;

        // Closes the system
        case "0":

            echo "System closed.\n";

            // Ends the program completely
            exit;

        // Executes when the user types an invalid option
        default:
            echo "Invalid option.\n";
    }
}
