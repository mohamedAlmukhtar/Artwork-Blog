-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 20, 2019 at 08:57 AM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `artblogger`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `ID` int(50) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `date` date NOT NULL,
  `userID` int(20) NOT NULL,
  `postID` int(20) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `user_1` (`userID`),
  KEY `post_1` (`postID`)
) ENGINE=MyISAM AUTO_INCREMENT=189 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`ID`, `text`, `date`, `userID`, `postID`) VALUES
(186, 'Another comment posted by someone else Another comment posted by someone else', '2019-02-20', 22, 142),
(187, 'rfergegw`', '2019-02-20', 0, 154),
(188, 'jmhwmjh', '2019-02-20', 0, 154),
(185, 'This is Second Comment', '2019-02-20', 22, 150),
(184, 'This is the first comment on this new post', '2019-02-20', 1, 148),
(183, 'This is a comment on this post', '2019-02-20', 1, 142),
(182, 'Comment', '2019-02-20', 1, 150);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `ID` int(20) NOT NULL AUTO_INCREMENT,
  `userID` int(20) NOT NULL,
  `postID` int(20) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `user_2` (`userID`),
  KEY `post_2` (`postID`)
) ENGINE=MyISAM AUTO_INCREMENT=713 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`ID`, `userID`, `postID`) VALUES
(712, 22, 140),
(711, 22, 145),
(710, 22, 142),
(709, 22, 146),
(708, 22, 150),
(707, 1, 136),
(706, 1, 148),
(705, 1, 142),
(704, 1, 150);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `ID` int(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `medium` tinyint(11) NOT NULL DEFAULT '0',
  `likes` int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=155 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`ID`, `title`, `description`, `date`, `image`, `medium`, `likes`) VALUES
(131, 'DS Painting', '', '2019-02-20', 'images/FB_IMG_1548513659155.jpg', 0, 0),
(130, 'DS Painting', '', '2019-02-20', 'images/FB_IMG_1548513649641.jpg', 0, 0),
(129, 'DS Painting', '', '2019-02-20', 'images/FB_IMG_1548513642960.jpg', 0, 0),
(128, 'DS Painting', '', '2019-02-20', 'images/FB_IMG_1548513635680.jpg', 0, 0),
(127, 'DS Painting', '', '2019-02-20', 'images/FB_IMG_1548513631123.jpg', 1, 0),
(126, 'DS Painting', '', '2019-02-20', 'images/FB_IMG_1548513619132.jpg', 0, 0),
(122, 'drawing', '', '2019-02-20', 'images/FB_IMG_1548513575859.jpg', 0, 0),
(123, 'drawing', '', '2019-02-20', 'images/FB_IMG_1548513582070.jpg', 0, 0),
(124, 'blue drawing', '', '2019-02-20', 'images/FB_IMG_1548513599216.jpg', 0, 0),
(125, 'DS Painting', '', '2019-02-20', 'images/FB_IMG_1548513611619.jpg', 1, 0),
(121, 'DS Painting', '', '2019-02-20', 'images/FB_IMG_1548513568364.jpg', 1, 0),
(120, 'DS Painting', '', '2019-02-20', 'images/FB_IMG_1548513555071.jpg', 1, 0),
(119, 'Ds Drawing', '', '2019-02-20', 'images/FB_IMG_1548513522924.jpg', 0, 0),
(118, 'drawing', '', '2019-02-20', 'images/FB_IMG_1548513515363.jpg', 1, 0),
(117, 'DS Painting', '', '2019-02-20', 'images/FB_IMG_1548513477353.jpg', 1, 0),
(112, 'DS Painting', '', '2019-02-20', 'images/FB_IMG_1548513425555.jpg', 0, 0),
(113, 'DS Painting', '', '2019-02-20', 'images/FB_IMG_1548513440146.jpg', 1, 0),
(114, 'DS Painting', '', '2019-02-20', 'images/FB_IMG_1548513454149.jpg', 1, 0),
(115, 'DS Painting', '', '2019-02-20', 'images/FB_IMG_1548513458708.jpg', 0, 0),
(116, 'Ds', '', '2019-02-20', 'images/FB_IMG_1548513468628.jpg', 0, 0),
(111, 'DS Painting', '', '2019-02-20', 'images/FB_IMG_1548513417415.jpg', 0, 0),
(109, 'DS Painting', '', '2019-02-20', 'images/FB_IMG_1548513400568.jpg', 1, 0),
(110, 'DS Painting', '', '2019-02-20', 'images/FB_IMG_1548513407017.jpg', 1, 0),
(108, 'DS Painting', '', '2019-02-20', 'images/FB_IMG_1548513396429.jpg', 0, 0),
(107, 'DS Painting', '', '2019-02-20', 'images/FB_IMG_1548513391786.jpg', 1, 0),
(106, 'DS Painting', '', '2019-02-20', 'images/FB_IMG_1548513381333.jpg', 0, 0),
(105, 'DS Painting', '', '2019-02-20', 'images/FB_IMG_1548513373635.jpg', 1, 0),
(104, 'DS Painting', '', '2019-02-20', 'images/FB_IMG_1548513328162.jpg', 0, 0),
(103, 'DS Painting', '', '2019-02-20', 'images/FB_IMG_1548513320094.jpg', 0, 0),
(102, 'DS Painting', '', '2019-02-20', 'images/FB_IMG_1548513299803.jpg', 1, 0),
(101, 'DS Painting', '', '2019-02-20', 'images/FB_IMG_1548513289227.jpg', 0, 0),
(94, 'DS Painting', '', '2019-02-20', 'images/FB_IMG_1548513191475.jpg', 1, 0),
(95, 'DS Painting', '', '2019-02-20', 'images/FB_IMG_1548513197587.jpg', 0, 0),
(96, 'DS Painting', '', '2019-02-20', 'images/FB_IMG_1548513231091.jpg', 0, 0),
(97, 'DS Painting', '', '2019-02-20', 'images/FB_IMG_1548513240374.jpg', 0, 0),
(98, 'DS Painting', '', '2019-02-20', 'images/FB_IMG_1548513264406.jpg', 1, 0),
(99, 'DS Painting', '', '2019-02-20', 'images/FB_IMG_1548513269878.jpg', 0, 0),
(100, 'DS Painting', '', '2019-02-20', 'images/FB_IMG_1548513280130.jpg', 1, 0),
(92, 'DS Painting', '', '2019-02-20', 'images/FB_IMG_1548513179341.jpg', 1, 0),
(93, 'DS Painting', '', '2019-02-20', 'images/FB_IMG_1548513184326.jpg', 1, 0),
(91, 'Red Painting', '', '2019-02-20', 'images/0ZzzGYv.jpg', 1, 0),
(132, 'DS Painting', '', '2019-02-20', 'images/FB_IMG_1548513665234.jpg', 1, 0),
(133, 'DS Painting', '', '2019-02-20', 'images/atna-joy-id-150119.jpg', 0, 0),
(134, 'DS Painting', '', '2019-02-20', 'images/atna-joy-looking-for-special-plant.jpg', 0, 0),
(135, 'DS Painting', '', '2019-02-20', 'images/jorry-rosman-bigdamfinal.jpg', 0, 0),
(136, 'DS Painting', '', '2019-02-20', 'images/meghan-hetrick-minecraft-final-sm.jpg', 1, 1),
(137, 'Fire watch\'s Red mountains', 'The painting of the red mountains of firewatch', '2019-02-20', 'images/firewatch-wallpapers-58958-8122842.png', 1, 0),
(138, 'Night Cold', 'Drawing of the snowy night', '2019-02-20', 'images/tumblr_o4glbznzpn1uc27fxo1_1280.jpg', 1, 0),
(139, 'Blue City', 'Fisheye Placebo\'s Cyber City', '2019-02-20', 'images/yuumei-background-1.jpg', 0, 0),
(140, 'Gloomy Landscape', '', '2019-02-20', 'images/TopBG.jpg', 1, 1),
(141, 'Green Forrest', '', '2019-02-20', 'images/jeremy-fenske-theprocession.jpg', 0, 0),
(142, 'Red riding hood', 'A very realistic red riding hood', '2019-02-20', 'images/jeremy-fenske-streamsketching-redrider.jpg', 0, 2),
(143, 'Structured Beach', '', '2019-02-20', 'images/jeremy-fenske-desertmonoliths.jpg', 1, 0),
(144, 'Fresh Jungle', '', '2019-02-20', 'images/atna-joy-sans-titre-5.jpg', 0, 0),
(145, 'Future Soldiers', 'A traditional piece ', '2019-02-20', 'images/jama-jurabaev-1.jpg', 0, 1),
(146, 'Red Energy', 'Very Viberent and vivid colors in this image', '2019-02-20', 'images/by-tacosauceninja-tacosauceninja-digital-art-landscapes-a-55.jpg', 1, 1),
(147, 'Waves of the sea', '', '2019-02-20', 'images/Wild Waves.jpg', 1, 0),
(148, 'Colorful Painting', 'High Contrasted Clashing beams of color', '2019-02-20', 'images/awesome-painting-art-hd-wallpaper-widescreen-images-artwork-for-windows-illustration-abstract-drawing-painting-art-is-everywhere-artist-2707x1692.jpg', 0, 1),
(149, 'Strong Green', '', '2019-02-20', 'images/Strong Green.jpg', 0, 0),
(150, 'Secret Society ', '', '2019-02-20', 'images/Seceret Society.jpg', 0, 2),
(151, 'Flaming Landscape', 'Painting of a red nature ', '2019-02-20', 'images/Flaming landscape.jpg', 0, 0),
(152, 'maxers default', '', '2019-02-20', 'images/maxers default.jpg', 1, 0),
(153, 'watchtower cloud forest', '', '2019-02-20', 'images/watchtowr cloud forest.jpg', 1, 0),
(154, 'Traditional Art', '', '2019-02-20', 'images/nicolas-petrimaux-freewaychase-finaleb.jpg', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `permit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userID`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `email`, `permit`) VALUES
(1, 'mohamed', '601f1889667efaebb33b8c12572835da3f027f78', 'mohamed@gmail.com', 1),
(2, 'ali', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'ali@gmail.com', 0),
(3, 'ahmed', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'ahmed@gmail.com', 0),
(4, 'Fatma', '369b394d99b9f61730f1e3aba865c48ff6697c23', 'fatma.almukhtar18@gmail.com', 0),
(13, 'sam', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'asds@adfasdqw.com', 0),
(16, 'wefwefw', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'asds@adfaswefwed.com', 0),
(17, 'hhggv', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'mohamedalmukhtar870@gmail.com', 0),
(15, 'mnmnmn', '7b52009b64fd0a2a49e6d8a939753077792b0554', 'asds@adfasd.com', 0),
(14, 'chad', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'asds@adfasasdd.com', 0),
(18, 'musa', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'musa@gmail.com', 0),
(19, 'sami', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'sami@gmail.com', 0),
(20, 'john', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'asds@adfasdqwdd.com', 0),
(21, 'jack', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'asds@adfasdqwd.com', 0),
(22, 'Link', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'asds@adfasdwef.com', 0),
(23, 'bob', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'asdasds@adfasd.com', 0),
(24, 'kyle', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'asdads@adfasd.com', 0),
(25, 'jeff', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'jeff@jeff.com', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
