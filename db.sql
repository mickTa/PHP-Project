-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8888
-- Generation Time: Jan 20, 2024 at 01:06 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(535) NOT NULL,
  `questionStatus` varchar(20) NOT NULL,
  `quizzscore` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `email`, `password`, `questionStatus`, `quizzscore`) VALUES
(40, 'admin', '$2y$10$4bzipLqgKmUeubmqao8bUObT7lQ/O3kngo0HrWNpllUrfwvDk7hJK', 'true', 2),
(41, 'john.doe@example.com', '$2y$10$RVT6rjxpXwUyqdhABEGVce110EuKTS7tUmXg69AZQpaEWKJL.naCK', 'true', 1),
(42, 'alice.smith@gmail.com', '$2y$10$ohvFI2SUIhguFjJuQ/5Z4uRJ99C96XzmbrM1QuDWic2DtSO5Dn/Oy', 'NULL', 0),
(44, 'emily.williams@hotmail.com', '$2y$10$V32/RtbSd5dW/khCKMwd/Og0kEhM8Yya3o6sN0WdSFPZ7RdisdKvy', 'NULL', 0),
(45, 'david.brown@outlook.com', '$2y$10$1X7vOxa6UdJXzaE9YkOBV.82hQYn5aU/6nj8tOjYE.uPiMxBjaAAe', 'NULL', 0),
(46, 'sophie.white@example.org', '$2y$10$uDn0KZ9fuLXVg4Zx1csq3Oi9P2ci/UFM8m4omC.0.sgjcQOrhUBKO', 'NULL', 0),
(47, 'michael.jackson@gmail.com', '$2y$10$I8hUisGmoVwTfCNBiUoWsOeYgUmhUX28IlgMmGD3A9lxf7TkyMffG', 'NULL', 0),
(48, 'olivia.green@yahoo.co.uk', '$2y$10$5kIamETZ/068q..YmsbZcezsrKm76II3WY6wCv4FV7O4nagbrRyEG', 'NULL', 0),
(49, 'samuel.robinson@hotmail.fr', '$2y$10$x.5orOQpL0Uu/oV8iPKMAeCGRxW5iMnm9AXeR8WzK3vWEp.Rekqha', 'NULL', 0),
(50, 'lily.jones@example.net', '$2y$10$DUk.fU8FbYMrEi7c1C2RzOLLYjz.PCZoDAbFU2gtkPkK8YNOpVhDe', 'NULL', 0);

-- --------------------------------------------------------

--
-- Table structure for table `avisfilm`
--

CREATE TABLE `avisfilm` (
  `pseudo` varchar(30) NOT NULL,
  `nomFilm` varchar(255) NOT NULL,
  `note` int(11) NOT NULL,
  `commentaire` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `avisfilm`
--

INSERT INTO `avisfilm` (`pseudo`, `nomFilm`, `note`, `commentaire`) VALUES
('Mick', 'Le règne animal', 5, 'J\'ai passé un excellent moment !'),
('Mick', 'Forest Gump', 5, 'COUR FOREST COUR'),
('Mick', 'Pulp Fiction', 1, 'Traumatiser par la scène du savon ;(');

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

CREATE TABLE `film` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `annee` int(4) NOT NULL,
  `realisateur` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`id`, `nom`, `annee`, `realisateur`) VALUES
(4, 'Le règne animal', 2023, 'Pauline Munier'),
(6, '3 jours max', 2023, 'Tarek Boudali'),
(7, 'La voie de la justice', 2020, 'Destin Daniel Cretton'),
(8, 'L\'ascension', 2017, 'Ludovic Bernard'),
(59, 'The Shawshank Redemption', 1994, 'Frank Darabont'),
(60, 'The Godfather', 1972, 'Francis Ford Coppola'),
(61, 'Pulp Fiction', 1994, 'Quentin Tarantino'),
(62, 'The Dark Knight', 2008, 'Christopher Nolan'),
(63, 'Schindler\'s List', 1993, 'Steven Spielberg'),
(64, 'Forrest Gump', 1994, 'Robert Zemeckis'),
(65, 'Inception', 2010, 'Christopher Nolan'),
(67, 'The Silence of the Lambs', 1991, 'Jonathan Demme'),
(68, 'The Lord of the Rings: The Fellowship of the Ring', 2001, 'Peter Jackson'),
(69, 'La La Land', 2016, 'Damien Chazelle'),
(70, 'Avatar', 2009, 'James Cameron'),
(71, 'Gravity', 2013, 'Alfonso Cuarón'),
(72, 'The Grand Budapest Hotel', 2014, 'Wes Anderson'),
(73, 'The Revenant', 2015, 'Alejandro G. Iñárritu'),
(74, 'Django Unchained', 2012, 'Quentin Tarantino'),
(75, 'The Shape of Water', 2017, 'Guillermo del Toro'),
(76, 'Mad Max: Fury Road', 2015, 'George Miller'),
(77, 'Birdman', 2014, 'Alejandro G. Iñárritu'),
(78, '12 Years a Slave', 2013, 'Steve McQueen'),
(79, 'The Social Network', 2010, 'David Fincher'),
(80, 'Eternal Sunshine of the Spotless Mind', 2004, 'Michel Gondry'),
(81, 'The Departed', 2006, 'Martin Scorsese'),
(82, 'Amélie', 2001, 'Jean-Pierre Jeunet'),
(83, 'Whiplash', 2014, 'Damien Chazelle'),
(84, 'Dune', 2021, 'Denis Villeneuve'),
(85, 'La ligne verte', 1990, 'unknow');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `email` varchar(535) NOT NULL,
  `permission` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `email`, `permission`) VALUES
(30, 'admin', 'admin'),
(31, 'john.doe@example.com', 'none'),
(32, 'alice.smith@gmail.com', 'none'),
(33, 'robert.jones@yahoo.com', 'none'),
(34, 'emily.williams@hotmail.com', 'none'),
(35, 'david.brown@outlook.comazerty', 'none'),
(36, 'sophie.white@example.org', 'none'),
(37, 'michael.jackson@gmail.com', 'none'),
(38, 'olivia.green@yahoo.co.uk', 'none'),
(39, 'samuel.robinson@hotmail.fr', 'none'),
(40, 'lily.jones@example.net', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `idQuest` int(11) NOT NULL,
  `title` varchar(535) NOT NULL,
  `respons` varchar(535) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`idQuest`, `title`, `respons`) VALUES
(1, 'Comment s appelle le hero dans Pulp Fiction', 'Vincent Vega'),
(2, 'En qu elle année est sortie DUNE ', '1984'),
(3, 'De quelle façon dans Inception les personnages savent si ils sont dans un rèves', 'Un totem'),
(4, 'Dans quelle conditgion physique est le hero dans avatar', 'En fauteuil roulant'),
(5, 'Qui a réalisé Forest Gump', 'Robert Zemeckis');

-- --------------------------------------------------------

--
-- Table structure for table `realisateur`
--

CREATE TABLE `realisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `age` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `realisateur`
--

INSERT INTO `realisateur` (`id`, `nom`, `prenom`, `age`) VALUES
(1, 'Cameron', 'James', 67),
(2, 'Tarantino', 'Quentin', 59),
(3, 'Nolan', 'Christopher', 51),
(6, 'Zemeckis', 'Robert', 69),
(7, 'Wachowski', 'Lana', 0),
(8, 'Wachowski', 'Lilly', 0),
(9, 'Demme', 'Jonathan', 73),
(10, 'Jackson', 'Peter', 60),
(11, 'Chazelle', 'Damien', 37),
(12, 'Cuarón', 'Alfonso', 60),
(13, 'Anderson', 'Wes', 53),
(14, 'Iñárritu', 'Alejandro G.', 58),
(15, 'Miller', 'George', 76),
(16, 'Scorsese', 'Martin', 79),
(17, 'Jeunet', 'Jean-Pierre', 68),
(18, 'Gondry', 'Michel', 58),
(19, 'Fincher', 'David', 59),
(20, 'del Toro', 'Guillermo', 57),
(21, 'McQueen', 'Steve', 52),
(22, 'Gibson', 'Mel', 66),
(23, 'Howard', 'Ron', 68),
(24, 'Villeneuve', 'Denis', 54),
(25, 'Coen', 'Joel', 67),
(26, 'Coen', 'Ethan', 65),
(27, 'Spike Lee', 'NULL', 65),
(28, 'Cuaron', 'Jonás', 39),
(29, 'Linklater', 'Richard', 61),
(30, 'Aronofsky', 'Darren', 53),
(35, 'talidec', 'mickael', 18);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`idQuest`);

--
-- Indexes for table `realisateur`
--
ALTER TABLE `realisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `film`
--
ALTER TABLE `film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `idQuest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `realisateur`
--
ALTER TABLE `realisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
