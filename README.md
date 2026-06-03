# movie-management

A terminal-based management system developed in pure PHP without frameworks.

This project was created to demonstrate core programming concepts such as:

* associative arrays;
* CRUD operations;
* input validation;
* modular code organization;
* interactive terminal menus;
* data manipulation and statistics.

---

## Features

* Register new records;
* List all records alphabetically;
* Search records by name with partial and case-insensitive matching;
* Edit existing records while keeping current values when pressing Enter;
* Remove records with confirmation before deletion;
* Display statistics generated from stored data;
* Automatic unique ID generation;
* Infinite loop menu until the user exits the system.

---

## Technologies

* PHP;
* CLI Terminal;
* Pure PHP without frameworks.

---

## Project Structure

```bash
.
├── index.php
└── functions.php
```

---

## How to Run

Make sure PHP is installed on your machine.

Run the following command in the project folder:

```bash
php index.php
```

---

## Example Menu

```text
===== MOVIE MANAGEMENT SYSTEM =====

1 - Register movie
2 - List movies
3 - Search movie by name
4 - Edit movie
5 - Remove movie
6 - Statistics
0 - Exit
```

---

## Data Structure

The system stores data using an array of associative arrays.

Example:

```php
[
    [
        "id" => 1,
        "name" => "Inception",
        "year" => 2010,
        "rating" => 9,
        "watched" => true
    ]
]
```

---

## Validation Rules

* Required fields cannot be empty;
* Integer fields accept only valid integers;
* Ratings must be between 0 and 10;
* Boolean fields accept only y/n input.

---

## Author

Benicio Castro
