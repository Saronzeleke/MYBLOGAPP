-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2024 at 06:35 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog app`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `blog-id` int(10) NOT NULL,
  `blog-title` text NOT NULL,
  `blog-image` varchar(50) NOT NULL,
  `blog-text` text NOT NULL,
  `author-id` int(10) NOT NULL,
  `posted-date` date NOT NULL,
  `posted-time` time(6) NOT NULL DEFAULT current_timestamp(),
  `author-name` varchar(100) NOT NULL,
  `author-image` varchar(255) NOT NULL,
  `like-count` int(30) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`blog-id`, `blog-title`, `blog-image`, `blog-text`, `author-id`, `posted-date`, `posted-time`, `author-name`, `author-image`, `like-count`) VALUES
(23, 'Exploring the Depths: The Mystery of Ocean Trenches', 'uploads/ocean.jpg', 'Ocean trenches are some of the least explored and most mysterious places on Earth. These vast chasms plunge deep into the ocean floor, reaching depths that rival the heights of the tallest mountains. Despite their extreme conditions—crushing pressure, freezing temperatures, and total darkness—life thrives in these depths, from bizarre deep-sea creatures to unique microbial communities. In this blog post, we\'ll delve into the fascinating world of ocean trenches, exploring their formation, the life they harbor, and the ongoing scientific efforts to unlock their secrets.', 7, '2024-04-21', '00:00:00.000000', 'david', 'uploads/662474f1d571c.jpg', 39),
(24, 'Mastering the Art of Mindfulness: A Beginner\'s Guide', 'uploads/meditation.jpg', 'Mindfulness is a powerful practice that can bring peace, clarity, and a sense of well-being to our lives. Yet, for many beginners, the concept of mindfulness can seem daunting or elusive. In this comprehensive guide, we\'ll break down the fundamentals of mindfulness, from simple breathing exercises to techniques for staying present in the moment. Whether you\'re looking to reduce stress, improve focus, or simply cultivate a greater sense of awareness, this blog post will provide you with the tools and techniques you need to embark on your mindfulness journey.', 7, '2024-04-21', '00:00:00.000000', 'david', 'uploads/662474f1d571c.jpg', 31),
(25, 'Unraveling the Enigma of Dreams: A Psychological Perspective', 'uploads/1692084177258.jpg', 'Dreams have fascinated humanity for millennia, serving as a source of inspiration, insight, and intrigue. But what exactly are dreams, and what do they reveal about the workings of the mind? In this exploration of the psychology of dreams, we\'ll delve into the theories and research behind these enigmatic nighttime experiences. From Freudian interpretations to modern neuroscience, we\'ll examine the role of dreams in processing emotions, consolidating memories, and uncovering unconscious desires. Whether you\'re a skeptic or a dream enthusiast, prepare to have your perceptions challenged as we journey into the realm of the subconscious mind.', 8, '2024-04-21', '00:00:00.000000', 'bereket', 'uploads/66247637932d6.jpg', 16),
(26, 'The Rise of Plant-Based Eating: A Sustainable Revolution', 'uploads/1_XMTzmbcdrO7quv3HDCj3QQ.jpg', 'Plant-based eating is more than just a passing trend—it\'s a sustainable revolution that\'s reshaping the way we think about food and its impact on the planet. In this blog post, we\'ll explore the reasons behind the growing popularity of plant-based diets, from concerns about animal welfare to the environmental benefits of reducing meat consumption. We\'ll also debunk common myths and misconceptions surrounding plant-based eating, offering practical tips and delicious recipes for incorporating more fruits, vegetables, and whole grains into your diet. Whether you\'re a committed vegan or simply curious about the benefits of plant-based living, join us on this journey towards a healthier, more sustainable future.', 8, '2024-04-21', '00:00:00.000000', 'bereket', 'uploads/66247637932d6.jpg', 10),
(27, 'The Art of Storytelling: Crafting Compelling Narratives', 'uploads/0_w7ZAqJhf0ENshgXY.png', 'Stories have the power to captivate, inspire, and transport us to new worlds. But what separates a mediocre story from a truly compelling narrative? In this exploration of the art of storytelling, we\'ll uncover the key elements that make for a memorable tale, from engaging characters and well-paced plots to vivid descriptions and emotional resonance. Drawing on examples from literature, film, and real-life experiences, we\'ll examine the techniques used by master storytellers to create stories that resonate with audiences across cultures and generations. Whether you\'re an aspiring writer or simply a lover of stories, this blog post will deepen your appreciation for the timeless craft of storytelling.', 8, '2024-04-21', '00:00:00.000000', 'bereket', 'uploads/66247637932d6.jpg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `birthdate` date NOT NULL,
  `birthplace` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `education` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `first_name`, `middle_name`, `last_name`, `username`, `birthdate`, `birthplace`, `gender`, `photo`, `education`, `password`) VALUES
(7, 'david', 'getachew', 'shiferaw', 'devido', '2024-04-02', 'Addis ababa', 'male', 'uploads/662474f1d571c.jpg', 'Degree', 'asdf'),
(8, 'bereket', 'kinfe', 'shiferaw', 'bekione', '2024-04-09', 'Addis ababa', 'male', 'uploads/66247637932d6.jpg', 'Degree', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`blog-id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `blog-id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
