-- phpMyAdmin SQL Dump
-- version 4.8.3
-- http://www.phpmyadmin.net
--
-- Customer: localhost: 3306
-- Generated on: Thr 18 July 2019 at 18:24
-- Version of the server: 5.9.42
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- DB :  `gameTest`
--

-- --------------------------------------------------------

--
-- Table Structure `PersonnagesTable`
--

CREATE TABLE `PersonnagesTable` (
  `id` int(10) unsigned NOT NULL,
  `nom` varchar(20) NOT NULL,
  `forcePerso` smallint(3) unsigned NOT NULL,
  `degats` smallint(3) unsigned NOT NULL,
  `niveau` smallint(3) unsigned NOT NULL,
  `experience` smallint(3) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Contents of the table `PersonnagesTable`
--

INSERT INTO `PersonnagesTable` (`id`, `nom`, `forcePerso`, `degats`, `niveau`, `experience`) VALUES
(1, 'DarkVador', 8, 45, 8, 35),
(2, 'LukeSky', 5, 5, 3, 10),
(3, 'PadawanLittle', 10, 20, 5, 20),
(6, 'YodaBoss', 10, 20, 2, 20),
(11, 'YodaBoss', 5, 0, 1, 1),
(13, 'YodaBoss', 5, 0, 1, 1),
(14, 'YodaBoss', 5, 0, 1, 1),
(15, 'YodaBoss', 5, 0, 1, 1);

--
-- Index for exported tables
--

--
-- Index for the table `PersonnagesTable`
--
ALTER TABLE `PersonnagesTable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for exported tables
--

--
-- AUTO_INCREMENT for table `PersonnagesTable`
--
ALTER TABLE `PersonnagesTable`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;