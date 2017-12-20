<?php

$conn = new PDO('localhost', 'root', 'toor');
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, 0);

// A book can have multiple copies... but would it? Not likely for a personal library
// Then again, I have five versions of The Hobbit. I haven't read any of them since I was about eight.
// Let's keep `book` and `copy_of_book` separate.
// At the very least, it could be useful for future dev.
$options = ['cost => 11'];

$sql_strings = '
	CREATE DATABASE
		`book_catalogue`;

	USE
		`book_catalogue`;

	CREATE TABLE `users` (
		`id` INTEGER AUTO_INCREMENT,
		`username` VARCHAR(40) NOT NULL,
		`password` VARCHAR(64) NOT NULL,
		`access_level` VARCHAR(6) NOT NULL,
		PRIMARY KEY (id),
		CONSTRAINT `access_level` CHECK (`access_level` IN (`user`, `admin`))
	);

	INSERT INTO users (username, password, access_level) VALUES (\'user\', \'' . password_hash('test', PASSWORD_BCRYPT, $options) . '\', \'user\'),(\'admin\',\''.password_hash('test', PASSWORD_BCRYPT, $options).'\',\'admin\');

	CREATE TABLE `books` (
		`isbn` VARCHAR(13) NOT NULL,
		`title` VARCHAR() NOT NULL,
		`author` VARCHAR() NOT NULL,
        `genre` VARCHAR(100),
		`publisher` VARCHAR(),
		`year` VARCHAR(4),
		PRIMARY KEY(`isbn`)
	);

    INSERT INTO `books` (
        isbn,
        title,
        author,
        publisher,
        year,
        genre
    ) VALUES (
        \'0000000000001\',
        \'The Hobbit\',
        \'J.R.R. Tolkien\',
        \'\',
        \'\',
        \'High Fantasy\'
    ), (
        \'1234567891233\',
        \'Prelude to Foundation\',
        \'Isaac Asimov\',
        \'Doubleday\',
        \'1988\',
        \'Science Fiction\'
    ), (
        \'978-0-06-105638-3\',
        \'Foundation\'s Fear\',
        \'Gregory Benford\',
        \'Harper Prism\',
        \'1997\',
        \'Science Fiction\'
    ), (
        \'0-553-29335-4\',
        \'Foundation\',
        \'Isaac Asimov\',
        \'Gnome Press\',
        \'1951\',
        \'Science Fiction\'
    ), (
        \'\',
        \'\',
        \'\',
        \'\',
        \'\'
    );

	CREATE TABLE `author` (
		`id`,
		`first_name`,
		`surname`
);

	CREATE TABLE `book_copy` (
		`id`,
		`isbn`,
		`location`,
		`rented_by`
	);
	/* Rented by: 0 for not-rented, otherwise user_id */
	CREATE TABLE `book_author` (
		`id`,
		`isbn`,
		`author_id`
	);

	CREATE TABLE `publisher` (
		`id`,
		`publisher_name`
	);

	CREATE TABLE `user_books` (
		`id`,
		`isbn`,
		`user_id`,
		`has_read`
	);
';

$conn->execute($sql_strings);