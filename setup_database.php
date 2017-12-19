<?php

$conn = new PDO('localhost', 'root', 'toor');
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, 0);
// @todo: draw up diagrams for database
// One user can hold multiple books
// A book can have multiple copies... but would it? Not likely for a personal library
// Then again, I have five versions of The Hobbit. I haven't read any of them since I was about eight.
// Let's keep `book` and `copy_of_book` separate.

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
		CONSTRAINT `access_level` CHECK (`access_level` IN (`user`, `admin`, `master`))
	);

	INSERT INTO users (username, password, access_level) VALUES (\'test\', \'test\', \'user\');

	CREATE TABLE `books` (
		`isbn` INTEGER NOT NULL,
		`title` VARCHAR() NOT NULL,
		`author` VARCHAR() NOT NULL,
		`publisher` VARCHAR() NOT NULL,
		`year` VARCHAR(4) NOT NULL,
		`is_out` BOOLEAN NOT NULL,
		PRIMARY KEY(`isbn`)
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