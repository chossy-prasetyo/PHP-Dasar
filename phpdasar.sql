-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2021 at 12:23 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpdasar`
--

-- --------------------------------------------------------

--
-- Table structure for table `kader`
--

CREATE TABLE `kader` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `asal` varchar(100) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `goldar` varchar(2) NOT NULL,
  `email` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kader`
--

INSERT INTO `kader` (`id`, `nama`, `asal`, `jurusan`, `goldar`, `email`, `foto`) VALUES
(1, 'Chossy Aulia Prasetyo', 'Pesisir Selatan', 'Teknik Elektro', 'AB', 'chossy@gmail.com', 'chossy.png'),
(2, 'Gorila Prayoga', 'Bengkulu', 'Teknik Sipil', 'AB', 'gorila@gmail.com', 'gorila.jpg'),
(3, 'Chaidirrahman', 'Lebong', 'Teknik Informatika', 'A', 'chai@gmail.com', 'chai.jpg'),
(4, 'Angga Priyono', 'Lebong', 'Teknik Nuklir', 'O', 'priyono@gmail.com', 'priyono.jpg'),
(5, 'Angga Nurhadi', 'Lebong', 'Teknik Mesin', 'A', 'nurhadi@gmail.com', 'nurhadi.jpg'),
(6, 'Azam Ali Ranan', 'Kepahiang', 'Teknik Elektro', 'A', 'azam@gmail.com', 'azam.jpg'),
(7, 'Haredho Akbar', 'Kaur', 'Teknik Sipil', 'B', 'haredho@gmail.com', 'haredho.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(6, 'admin', '$2y$10$DNPPL2ZuqQYpxp6E5d.CE.Ucooi5N6/rOM6N3eIq72BSeLXByeOTi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kader`
--
ALTER TABLE `kader`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kader`
--
ALTER TABLE `kader`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
