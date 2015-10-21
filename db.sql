-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 21 Okt 2015 pada 15.31
-- Versi Server: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `stadiumreservation`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_userid` int(11) DEFAULT NULL,
  `book_date` date DEFAULT NULL,
  `book_time` int(11) DEFAULT NULL,
  `book_createddate` datetime DEFAULT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data untuk tabel `book`
--

INSERT INTO `book` (`book_id`, `book_userid`, `book_date`, `book_time`, `book_createddate`) VALUES
(6, 2, '2015-10-23', 7, '2015-10-21 09:29:25'),
(8, 2, '2015-10-24', 7, '2015-10-21 09:39:30'),
(9, 1, '2015-10-24', 9, '2015-10-21 09:39:32'),
(19, 1, '2015-10-21', 9, '2015-10-21 16:33:12'),
(20, 1, '2015-10-30', 7, '2015-10-21 17:05:05'),
(21, 1, '2015-11-05', 7, '2015-10-21 17:09:45'),
(25, 1, '2015-11-06', 8, '2015-10-21 17:11:12'),
(26, 1, '2015-11-05', 10, '2015-10-21 17:11:14'),
(27, 1, '2015-11-05', 9, '2015-10-21 17:11:16'),
(28, 1, '2015-10-23', 13, '2015-10-21 17:24:32'),
(29, 1, '2015-10-25', 10, '2015-10-21 20:21:53'),
(30, 1, '2015-10-30', 9, '2015-10-21 20:21:57'),
(31, 2, '2015-10-23', 9, '2015-10-21 20:25:09'),
(32, 2, '2015-10-31', 8, '2015-10-21 20:25:15'),
(33, 2, '2015-10-29', 10, '2015-10-21 20:25:17'),
(34, 2, '2015-11-05', 8, '2015-10-21 20:25:26'),
(35, 1, '2015-10-22', 7, '2015-10-21 20:26:39'),
(36, 3, '2015-10-23', 8, '2015-10-21 20:28:48'),
(37, 3, '2016-01-28', 8, '2015-10-21 20:29:07'),
(39, 4, '2015-12-18', 11, '2015-10-21 20:30:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(50) DEFAULT NULL,
  `user_password` varchar(50) DEFAULT NULL,
  `user_created` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `user_email`, `user_password`, `user_created`) VALUES
(1, 'ferdinand_pradana@yahoo.com', '123456', '2015-10-14 00:00:00'),
(2, 'a@aa.com', '1', '2015-10-21 19:54:46'),
(3, 'b@bb.com', '2', '2015-10-21 20:28:34'),
(4, 'demo@demo.com', 'demo', '2015-10-21 20:30:29');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
