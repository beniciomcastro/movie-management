<?php

function readText(string $message): string
{
    echo $message;
    return trim(fgets(STDIN));
}

function readRequiredString(string $message): string
{
    do {
        $value = readText($message);

        if ($value === "") {
            echo "This field is required.\n";
        }
    } while ($value === "");

    return $value;
}

function readInteger(string $message): int
{
    do {
        $value = readText($message);

        if (!filter_var($value, FILTER_VALIDATE_INT)) {
            echo "Please enter a valid integer number.\n";
            continue;
        }

        return (int) $value;
    } while (true);
}

function readBoolean(string $message): bool
{
    do {
        $value = strtolower(readText($message . " (y/n): "));

        if ($value === "y") {
            return true;
        }

        if ($value === "n") {
            return false;
        }

        echo "Please enter only y or n.\n";
    } while (true);
}

function registerMovie(int $id): array
{
    echo "\n--- Register movie ---\n";

    $name = readRequiredString("Movie name: ");
    $year = readInteger("Release year: ");
    $rating = readInteger("Rating from 0 to 10: ");

    while ($rating < 0 || $rating > 10) {
        echo "The rating must be between 0 and 10.\n";
        $rating = readInteger("Rating from 0 to 10: ");
    }

    $watched = readBoolean("Have you watched it?");

    echo "Movie registered successfully.\n";

    return [
        "id" => $id,
        "name" => $name,
        "year" => $year,
        "rating" => $rating,
        "watched" => $watched
    ];
}

function listMovies(array $movies): void
{
    echo "\n--- Movie list ---\n";

    if (empty($movies)) {
        echo "No movies registered.\n";
        return;
    }

    usort($movies, function ($a, $b) {
        return strcasecmp($a["name"], $b["name"]);
    });

    foreach ($movies as $movie) {
        showMovie($movie);
    }
}

function showMovie(array $movie): void
{
    echo "\nID: " . $movie["id"] . "\n";
    echo "Name: " . $movie["name"] . "\n";
    echo "Year: " . $movie["year"] . "\n";
    echo "Rating: " . $movie["rating"] . "\n";
    echo "Watched: " . ($movie["watched"] ? "Yes" : "No") . "\n";
}

function searchMovies(array $movies): void
{
    echo "\n--- Search movie ---\n";

    $search = strtolower(readRequiredString("Enter part of the movie name: "));
    $foundMovies = [];

    foreach ($movies as $movie) {
        if (str_contains(strtolower($movie["name"]), $search)) {
            $foundMovies[] = $movie;
        }
    }

    if (empty($foundMovies)) {
        echo "No movies found.\n";
        return;
    }

    foreach ($foundMovies as $movie) {
        showMovie($movie);
    }
}

function editMovie(array &$movies): void
{
    echo "\n--- Edit movie ---\n";

    $id = readInteger("Enter the movie ID: ");

    foreach ($movies as &$movie) {
        if ($movie["id"] === $id) {
            showMovie($movie);

            $newName = readText("New name, press Enter to keep current: ");
            if ($newName !== "") {
                $movie["name"] = $newName;
            }

            $newYear = readText("New release year, press Enter to keep current: ");
            if ($newYear !== "") {
                if (filter_var($newYear, FILTER_VALIDATE_INT)) {
                    $movie["year"] = (int) $newYear;
                } else {
                    echo "Invalid year. Current value kept.\n";
                }
            }

            $newRating = readText("New rating, press Enter to keep current: ");
            if ($newRating !== "") {
                if (
                    filter_var($newRating, FILTER_VALIDATE_INT) &&
                    $newRating >= 0 &&
                    $newRating <= 10
                ) {
                    $movie["rating"] = (int) $newRating;
                } else {
                    echo "Invalid rating. Current value kept.\n";
                }
            }

            $newWatched = strtolower(readText("Have you watched it? y/n, press Enter to keep current: "));
            if ($newWatched === "y") {
                $movie["watched"] = true;
            } elseif ($newWatched === "n") {
                $movie["watched"] = false;
            }

            echo "Movie updated successfully.\n";
            return;
        }
    }

    echo "Movie not found.\n";
}

function removeMovie(array &$movies): void
{
    echo "\n--- Remove movie ---\n";

    $id = readInteger("Enter the movie ID: ");

    foreach ($movies as $index => $movie) {
        if ($movie["id"] === $id) {
            showMovie($movie);

            $confirmation = strtolower(readText("Are you sure you want to delete this movie? y/n: "));

            if ($confirmation === "y") {
                unset($movies[$index]);
                $movies = array_values($movies);
                echo "Movie removed successfully.\n";
            } else {
                echo "Deletion canceled.\n";
            }

            return;
        }
    }

    echo "Movie not found.\n";
}

function showStatistics(array $movies): void
{
    echo "\n--- Statistics ---\n";

    if (empty($movies)) {
        echo "No data available.\n";
        return;
    }

    $total = count($movies);
    $ratingSum = 0;
    $watchedCount = 0;

    foreach ($movies as $movie) {
        $ratingSum += $movie["rating"];

        if ($movie["watched"]) {
            $watchedCount++;
        }
    }

    $averageRating = $ratingSum / $total;
    $notWatchedCount = $total - $watchedCount;

    echo "Total movies: $total\n";
    echo "Average rating: " . number_format($averageRating, 2, ".", ",") . "\n";
    echo "Watched movies: $watchedCount\n";
    echo "Unwatched movies: $notWatchedCount\n";
}