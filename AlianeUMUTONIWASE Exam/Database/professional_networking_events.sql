-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 10:29 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `professional_networking_events`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendees`
--

CREATE TABLE `attendees` (
  `attendee_id` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendees`
--

INSERT INTO `attendees` (`attendee_id`, `id`, `event_id`) VALUES
(2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `eventcategories`
--

CREATE TABLE `eventcategories` (
  `eventcategory_id` int(11) NOT NULL,
  `eventcategory_name` varchar(255) DEFAULT NULL,
  `eventcategory_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eventcategories`
--

INSERT INTO `eventcategories` (`eventcategory_id`, `eventcategory_name`, `eventcategory_description`) VALUES
(1, 'election party', NULL),
(2, 'election party', 'only adults'),
(3, 'election party', 'only adults'),
(4, 'election party', 'only adults');

-- --------------------------------------------------------

--
-- Table structure for table `eventregistrations`
--

CREATE TABLE `eventregistrations` (
  `registration_id` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eventregistrations`
--

INSERT INTO `eventregistrations` (`registration_id`, `id`, `event_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 9, 9),
(6, 7, 5);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `organizer_id` int(11) DEFAULT NULL,
  `event_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `organizer_id`, `event_name`) VALUES
(1, 1, 'birthday party'),
(2, 2, 'meeting');

-- --------------------------------------------------------

--
-- Table structure for table `eventsessions`
--

CREATE TABLE `eventsessions` (
  `session_id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `session_title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eventsessions`
--

INSERT INTO `eventsessions` (`session_id`, `event_id`, `session_title`) VALUES
(1, 1, 'lunch'),
(2, 2, 'dinner');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `id`, `event_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 3, 3),
(5, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `networking_opportunities`
--

CREATE TABLE `networking_opportunities` (
  `networking_opportunity_id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `networking_opportunities`
--

INSERT INTO `networking_opportunities` (`networking_opportunity_id`, `event_id`, `title`) VALUES
(1, 1, 'birthday party'),
(2, 2, 'funerals'),
(6, 3, 'weddings');

-- --------------------------------------------------------

--
-- Table structure for table `organizer`
--

CREATE TABLE `organizer` (
  `organizer_id` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `organization_name` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organizer`
--

INSERT INTO `organizer` (`organizer_id`, `id`, `organization_name`, `contact_email`) VALUES
(1, 1, 'liver hotel', 'liverhotel@gmail.com'),
(2, 2, 'igiti bank', 'igitibank@gmail.com'),
(3, 3, 'inyangeindustry', 'inyange@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `profile_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `bio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`profile_id`, `id`, `bio`) VALUES
(1, 1, 'good');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `email`, `telephone`, `password`, `creationdate`, `activation_code`, `is_activated`) VALUES
(1, 'aline', 'umuhoza', 'aline123', 'aline@gmail.com', '0987654321', '$2y$10$3yfbzQ2PTdF7sy6bTDZ9huef.JV7HpJNVRX9TEmKnqk.sGxaRtxxa', '2024-05-21 20:26:14', '123', 0),
(2, 'Aliana', 'umutoniwase', 'aliane', 'aliane@gmail.com', '0987654321', '$2y$10$u6bqJzdndQtS3km3tMhwuujxVhDhECFUXbCZy9rVObW8AT4FEP4Ny', '2024-05-21 20:37:32', '123', 0),
(3, 'beula', 'mugisha', 'beula', 'beula@gmail.com', '0987654345', '$2y$10$kjxWDVIoQK3HA3w920j6heJJS2HR5fzd/.PT5.I9Hvrlv8/vSwJpK', '2024-05-21 20:41:04', '123', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendees`
--
ALTER TABLE `attendees`
  ADD PRIMARY KEY (`attendee_id`);

--
-- Indexes for table `eventcategories`
--
ALTER TABLE `eventcategories`
  ADD PRIMARY KEY (`eventcategory_id`);

--
-- Indexes for table `eventregistrations`
--
ALTER TABLE `eventregistrations`
  ADD PRIMARY KEY (`registration_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `eventsessions`
--
ALTER TABLE `eventsessions`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `networking_opportunities`
--
ALTER TABLE `networking_opportunities`
  ADD PRIMARY KEY (`networking_opportunity_id`);

--
-- Indexes for table `organizer`
--
ALTER TABLE `organizer`
  ADD PRIMARY KEY (`organizer_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`profile_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendees`
--
ALTER TABLE `attendees`
  MODIFY `attendee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `eventcategories`
--
ALTER TABLE `eventcategories`
  MODIFY `eventcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `eventregistrations`
--
ALTER TABLE `eventregistrations`
  MODIFY `registration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `eventsessions`
--
ALTER TABLE `eventsessions`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `networking_opportunities`
--
ALTER TABLE `networking_opportunities`
  MODIFY `networking_opportunity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `organizer`
--
ALTER TABLE `organizer`
  MODIFY `organizer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
