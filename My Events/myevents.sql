-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2016 at 01:51 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `myevents`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `location` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `description` text NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `location`, `date`, `description`, `userid`) VALUES
(3, 'Bandana''s Birthday', 'Persian Grill', '2016-02-17', 'Bring your friends!', 2),
(4, 'Prom', 'Hilton Hotel', '2016-01-15', 'Come with your partner!', 9),
(5, 'nahors birthday party', 'center city', '2016-02-14', 'ibzan not invited!', 10),
(6, 'ibzan''s party', 'the crib', '2016-01-01', 'nahor not invited', 9),
(7, '', '', '0000-00-00', '', 0),
(8, '', '', '0000-00-00', '', 0),
(9, '', '', '0000-00-00', '', 0),
(10, ' Graduation', 'Chestnutt Hill College', '2016-12-16', 'Congratulations', 30),
(11, 'Bandana''s Birthday', 'Philly', '2016-02-17', 'Bring Gifts', 32),
(12, 'bandana''s birthday', 'philly', '2016-01-01', 'bring gifts', 32),
(13, 'Nahor''s Graduation', 'Chestnut Hill College', '2017-12-12', 'Congratulations!!', 32),
(14, 'Barsha''s Graduation', 'Temple University', '2016-12-01', 'Congratulations', 33);

-- --------------------------------------------------------

--
-- Table structure for table `events_participants`
--

CREATE TABLE IF NOT EXISTS `events_participants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `events_participants`
--

INSERT INTO `events_participants` (`id`, `event_id`, `participant_id`, `userid`) VALUES
(1, 0, 0, 9),
(2, 0, 0, 9),
(3, 0, 0, 9),
(4, 0, 0, 9),
(5, 0, 0, 9),
(6, 0, 0, 9),
(7, 0, 0, 9),
(8, 4, 0, 9),
(9, 4, 0, 9),
(10, 4, 0, 9),
(11, 4, 0, 9),
(12, 4, 0, 9),
(13, 4, 0, 9),
(14, 4, 0, 9),
(15, 0, 0, 9),
(16, 4, 0, 9),
(17, 4, 0, 9),
(18, 0, 0, 9),
(19, 0, 0, 9),
(20, 0, 0, 9),
(21, 4, 1, 9),
(22, 4, 1, 9),
(23, 4, 1, 9),
(24, 0, 3, 9),
(25, 0, 0, 9),
(26, 0, 0, 9),
(27, 0, 0, 9),
(28, 0, 0, 9);

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE IF NOT EXISTS `participants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`id`, `fullname`, `email`, `userid`) VALUES
(1, 'barsha', 'b@gmail.com', 9),
(2, 'bib', 'bib@gmail.com', 9),
(3, 'bandana', 'bmoktan@gmail.com', 11),
(4, 'Bandana Moktan', 'bmoktan@gmail.com', 9);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) NOT NULL,
  `phonenumber` varchar(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `picture` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `phonenumber`, `username`, `password`, `email`, `picture`) VALUES
(1, 'ban ban', '2132132134', 'aaaaa', 'bbbbb', 'abcd@gg', NULL),
(2, 'bandana moktan', '484-636-94', 'bmoktan', 'bmoktan', 'moktanb@chc.edu', NULL),
(3, 'ibzan J', '2157899000', 'ibzaan', 'pass', 'ibzaan@gmail.com', NULL),
(4, 'sharif', '2159211587', 'md', '$2y$10$8Jf31Zbx7igw0TdLmkPgSOCfkRUeFm/biZImAEYd3Jhx51G9XEyoy', 'md@gmail.com', NULL),
(5, 'silu', '4846369446', 'silu', '$2y$10$tQBBiN79M9x0WgXGl.s.N.11i7KrSXsRPqIHBKiLNyDA8aw45.uEC', 'silu@gmail.com', NULL),
(6, 'Silu Moktan', '484-484-48', 'silu712', '$2y$10$oh6sMbdKMD0GN2rtBzotRe9GUVADogRj7X72GEjLsfV93zYFlVB7e', 'silu712@gmail.com', NULL),
(7, 'silu moktan', '666666666', 'silu moktan', '$2y$10$mQZf3fhYplJ5nVeI7L9qxumfXJqy9ZjecziktwFwwJBNYm/dUDe6m', 'silu@gmail.com', NULL),
(8, 'BandanaM', '4846369446', 'BandanaM', '$2y$10$Naw5yKKXQHjXgcS0JIM3HOL3sZFZMCfHYIoWCKQzfKZTqlXEvWROm', 'bmoktan@gmail.com', NULL),
(9, 'bob', '222222', 'bob', '$2y$10$dLMlkrtatQ7C7y4uy3bip.isTl.LRPay0iI67CxmQOkmscCH00vaK', 'bob@gmail.com', NULL),
(10, 'nahor1', '4444444444', 'nahor1', '$2y$10$KNsZpBCICByhFbrmk/4NfeIrpcy0SVcQXkNxZN9.Z/vLtZaDJU2KK', 'nahor@gmail.com', NULL),
(11, 'Bandana Moktan', '4444444444', 'Bandana', '$2y$10$d/SzNwZ11CpLfcQ70tHuE.HnKvJG5A3M14PA.hFjNa16BOTwXdN8G', 'b@gmail.com', NULL),
(12, 'bibek', '1111111111', 'bibek', '$2y$10$pZ2am9Jn90Rl7XrViP/MSu8HN2W01UZU7uywno/LdZBC2bgU.9P86', 'bibek@gmail.com', ''),
(24, 'moktan1', '7777777777', 'moktan1', '$2y$10$Rx30zDEES1XrFPVJ6tTPcO3Y2k86q2SJ3ZgCQfE7KZ0qQpBQw2LX.', 'm@gmail.com', 'bread.jpg'),
(25, 'vv', '8888888888', 'vv', '$2y$10$/FTBdSxwkgmo8.k.XawEtum9067RwqItetwp.CSEnbYMDIGOHPf0S', 'vv@gmail.com', 'bread.jpg'),
(26, 'ii', '0000000000', 'ii', '$2y$10$AG4O6YMxKE9yG7EcKIKVwuWN4qSFi9u.j7RBu7pc4CD7/YajO/uOi', 'ii@hotmail.com', 'bread.jpg'),
(27, 'oo', '0000000000', 'oo', '$2y$10$HGAwC2nM151vDP2MKi.9COAAWudwULK6wiyjLejtDvTpCbq.3k1Nq', 'oo@gmaill.com', 'bread.jpg'),
(28, 'nn', '9999999999', 'nn', '$2y$10$SzXAz49HZWPVeZc8KB90f.qRMCC3u9UXmgU8DxKk829S91Fy.rqim', 'nn@gmail.com', 'bread.jpg'),
(29, 'va', '2222222222', 'va', '$2y$10$0XFwO/VF2Sld17oOGtl0reBEDujimQ3uWAg0yWT6rnvRr6DMZEptO', 'va@kr', 'bread.jpg'),
(30, 'bandana moktan ', '1111111111', 'moktanb', '$2y$10$ant6pMbVLnM7ZLxFc6QV9euzOa1EY0mt42Q87W1Ka7p0vmHP0nyea', 'moktanb@chc.edu', 'bread.jpg'),
(31, 'kkewjgnjkagn', '3333333333', 'bandanaaaa', '$2y$10$XGuOfzSm//DNwjeHPIY0cubwt4Y1OR6aOFyH61yH4flaam30SexMy', 'b@khng', 'bread.jpg'),
(32, 'bandana moktan', '1111111111', 'bandana123', '$2y$10$lnFEs4kmSkEYLJrDwuJtU.0x.kRvhkuDIVFq9enGSpm3SSMVokvPG', 'b@gmail.com', 'bread.jpg'),
(33, 'Barsha Moktan ', '4846364153', 'Barsha Moktan', '$2y$10$EFJe42CMNNiOg2Z7d5jlpOcR2NWr5cPj8isSgPTLF8DutcG7Wi8Mq', 'b@gmai.com', 'bread.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
