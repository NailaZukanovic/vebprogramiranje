<?php
    $CREATE_ADMIN_TABLE_QUERY = "
    CREATE TABLE `Admins` (
        `id` varchar(128) NOT NULL,
        `name` varchar(32),
        `lastname` varchar(32),
        `gender` tinyint(1),
        `birthDate` date,
        `birthPlace` varchar(64),
        `birthCountry` varchar(64),
        `JMBG` varchar(13),
        `profilePicture` varchar(512),
        `email` varchar(128),
        `username` varchar(32) NOT NULL,
        `password` varchar(64) NOT NULL,
        PRIMARY KEY (`id`),
        UNIQUE KEY `username` (`username`)
       )
    ";

    $CREATE_TRAINER_TABLE_QUERY = "
    CREATE TABLE `Trainers` (
        `id` varchar(128) NOT NULL,
        `name` varchar(32) NOT NULL,
        `lastname` varchar(32) NOT NULL,
        `gender` tinyint(1) NOT NULL,
        `birthDate` date NOT NULL,
        `birthPlace` varchar(64) DEFAULT NULL,
        `birthCountry` varchar(64) NOT NULL,
        `JMBG` varchar(13) NOT NULL,
        `profilePicture` varchar(512) NOT NULL,
        `email` varchar(128) NOT NULL,
        `verified` tinyint(1) NOT NULL,
        `approved` tinyint(1) NOT NULL,
        `username` varchar(32) NOT NULL,
        `password` varchar(64) NOT NULL,
        PRIMARY KEY (`id`),
        UNIQUE KEY `username` (`username`),
        UNIQUE KEY `email` (`email`)
       )
    ";

    $CREATE_BOXERS_TABLE_QUERY = "
    CREATE TABLE `Boxers` (
        `id` varchar(128) NOT NULL,
        `name` varchar(32) NOT NULL,
        `lastname` varchar(32) NOT NULL,
        `gender` tinyint(1) NOT NULL,
        `birthDate` date NOT NULL,
        `birthPlace` varchar(64) DEFAULT NULL,
        `birthCountry` varchar(64) NOT NULL,
        `JMBG` varchar(13) NOT NULL,
        `profilePicture` varchar(512) NOT NULL,
        `email` varchar(128) NOT NULL,
        `verified` tinyint(1) NOT NULL,
        `approved` tinyint(1) NOT NULL,
        `username` varchar(32) NOT NULL,
        `password` varchar(64) NOT NULL,
        `problem` varchar(20),
        PRIMARY KEY (`id`),
        UNIQUE KEY `username` (`username`),
        UNIQUE KEY `email` (`email`)
       )
    ";

    $CREATE_VERIFICATION_TABLE_QUERY = "
        CREATE TABLE `Verification` (
            `id` varchar(64) NOT NULL,
            `for` varchar(64) NOT NULL,
            PRIMARY KEY (`id`)
        )
    ";

    $CREATE_NEWS_TABLE_QUERY = "
    CREATE TABLE `News` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `title` varchar(64) NOT NULL,
        `description` varchar(512) NOT NULL,
        `dateCreated` date NOT NULL,
        `image` varchar(512) NOT NULL,
        `isGeneral` tinyint(1) NOT NULL,
        PRIMARY KEY (`id`)
    )
    ";

    $CREATE_INVITATION_TABLE_QUERY = "
    CREATE TABLE `Invitations` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `createdBy` varchar(128) NOT NULL,
        `createdFor` varchar(128) NOT NULL,
        `description` varchar(64),
        PRIMARY KEY (`id`)
    )
    ";

    $CREATE_IN_TRAINING_TABLE_QUERY = "
    CREATE TABLE `In_Training` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `boxer` varchar(128) NOT NULL,
        `trainer` varchar(128) NOT NULL,
        PRIMARY KEY (`id`)
    )
    ";

    $CREATE_TOURNAMENT_TABLE = "
    CREATE TABLE `Tournament` (
        `id` varchar(128) NOT,
        `title` varchar(64) NOT NULL,
        `description` varchar(512) NOT NULL,
        `dateCreated` date NOT NULL,
        `image` varchar(512) NOT NULL,
        `category` varchar(32) NOT NULL,
        `winner` varchar(128),
        `gender` tinyint(1),
    	PRIMARY KEY (`id`)
    )
    ";

    $CREATE_PARTICIPATING_TABLE = "
    CREATE TABLE `Participating` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `tournament` varchar(128),
        `participant` varchar(128),
        PRIMARY KEY (`id`)
    )
    ";
?>
    