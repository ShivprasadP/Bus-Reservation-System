-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2024 at 04:05 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bus_system_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `selected_seats` varchar(255) DEFAULT NULL,
  `from_location` varchar(255) DEFAULT NULL,
  `to_location` varchar(255) DEFAULT NULL,
  `price_per_seat` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `bus_number` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `selected_seats`, `from_location`, `to_location`, `price_per_seat`, `total`, `date`, `time`, `bus_number`, `user_id`) VALUES
(1, '1A, 1B, 2A, 2B, 3A, 3B, 4A, 4B', 'Kolhapur', 'Pune', '680.00', '5440.00', '2024-04-01', '10:00:00', 'MH 09 S 8835', 1),
(2, '1A, 1B, 1C, 1D, 2A, 2B, 2C, 2D', 'Gargoti', 'Kolhapur', '112.00', '896.00', '2014-04-03', '11:00:00', 'MH 09 S 8836', 1);

-- --------------------------------------------------------

--
-- Table structure for table `buses`
--

CREATE TABLE `buses` (
  `id` int(11) NOT NULL,
  `bus_num` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `registration` varchar(255) NOT NULL,
  `insurance` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buses`
--

INSERT INTO `buses` (`id`, `bus_num`, `start_date`, `end_date`, `registration`, `insurance`) VALUES
(1, 'MH 09 S 8835', '2023-03-12', '2026-03-12', 'MH 09 S 8835_registration.pdf', 'MH 09 S 8835_insurance.pdf'),
(2, 'MH 09 S 8836', '2023-03-12', '2026-03-12', 'MH 09 S 8836_registration.pdf', 'MH 09 S 8836_insurance.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `bus_feedback`
--

CREATE TABLE `bus_feedback` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `bus_num` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `comments` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bus_feedback`
--

INSERT INTO `bus_feedback` (`id`, `fname`, `lname`, `bus_num`, `city`, `state`, `zip`, `comments`, `date`, `time`) VALUES
(1, 'Shivprasad', 'Patil', 'MH 09 S 8836', 'Bidri', 'Maharashtra', '416208', 'Best', '2024-04-03', '13:03:00'),
(2, 'Shiv', 'Patil', 'MH 09 S 8835', 'Bidri', 'Maharashtra', '416208', 'Good Services', '2024-04-03', '13:06:00'),
(3, 'Shivprasad', 'Patil', 'MH 09 S 8835', 'Bidri', 'Maharashtra', '416208', 'Good', '2024-04-03', '13:08:00'),
(4, 'Rohil', 'Patil', 'MH 09 S 8836', 'Bidri', 'Maharashtra', '416208', 'Good', '2024-04-03', '13:10:00');

-- --------------------------------------------------------

--
-- Table structure for table `bus_schedule`
--

CREATE TABLE `bus_schedule` (
  `id` int(11) NOT NULL,
  `from_location` varchar(255) NOT NULL,
  `to_location` varchar(255) NOT NULL,
  `stops` text DEFAULT NULL,
  `price_increase` decimal(10,2) NOT NULL,
  `driver` varchar(255) NOT NULL,
  `conductor` varchar(255) NOT NULL,
  `departure_time` time NOT NULL,
  `date` date NOT NULL,
  `bus_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bus_schedule`
--

INSERT INTO `bus_schedule` (`id`, `from_location`, `to_location`, `stops`, `price_increase`, `driver`, `conductor`, `departure_time`, `date`, `bus_number`) VALUES
(1, 'Kolhapur', 'Pune', 'Shiroli, Toap, Tandulwadi, Kameri, Peth, Karad, Varade, Umbraj, Kashil, Atit, Satara, Mhasave, Surur, Wele, Kikvi, Pune', '40.00', 'Raju', 'Sonu', '10:00:00', '2024-04-01', 'MH 09 S 8835'),
(2, 'Gargoti', 'Kolhapur', 'Madilge, Kur, Mudal Titta, Bidri, Kasarwada, Turambe, Shelewadi, Nigave, Ispurli, Kalamba, Sambhaji Nagar, Gokhale College, CBS Kolhapur', '8.00', 'Anil', 'Monu', '11:00:00', '2014-04-03', 'MH 09 S 8836');

-- --------------------------------------------------------

--
-- Table structure for table `conductors`
--

CREATE TABLE `conductors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_num` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `aadhar_card` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `conductors`
--

INSERT INTO `conductors` (`id`, `name`, `phone_num`, `email`, `address`, `aadhar_card`) VALUES
(1, 'Monu', '1234567890', 'monu@gmail.com', 'NMSF Colony', '1_aadharCard.pdf'),
(2, 'Sonu', '9876543216', 'sonu3858@gmail.com', 'Sonu Nagar', '2_aadharCard.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `conductor_feedback`
--

CREATE TABLE `conductor_feedback` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `bus_num` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `comments` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `conductor_feedback`
--

INSERT INTO `conductor_feedback` (`id`, `fname`, `lname`, `bus_num`, `city`, `state`, `zip`, `comments`, `date`, `time`) VALUES
(1, 'Shivprasad', 'Patil', 'MH 09 S 8836', 'Bidri', 'Maharashtra', '416208', 'Best Service', '2024-04-03', '13:26:00');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_num` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `license` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `name`, `phone_num`, `email`, `address`, `license`) VALUES
(1, 'Anil', '1234567890', 'gefh123@gmail.com', 'Sonali Road, Bidri, Tal-Kagal, Dist-Kolhapur.\r\nShivshakti Nivas', '1_license.pdf'),
(2, 'Raju', '9876543210', 'abc123@gmail.com', 'XYZ Nagar', '2_license.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `driver_feedback`
--

CREATE TABLE `driver_feedback` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `bus_num` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `comments` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `driver_feedback`
--

INSERT INTO `driver_feedback` (`id`, `fname`, `lname`, `bus_num`, `city`, `state`, `zip`, `comments`, `date`, `time`) VALUES
(1, 'Shivprasad', 'Patil', 'MH 09 S 8835', 'Bidri', 'Maharashtra', '416208', 'Best Service', '2024-04-03', '13:26:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `username` varchar(30) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `username`, `phone_number`, `user_password`, `type`) VALUES
(1, 'Shiv', 'shiv@123', '9403365600', '$2y$10$xkVioPGSG5qIcBjl00kHmeHKeEj4dxR4O2aFtqBWyZ/yaBmrrlKCG', 0),
(2, 'Rohil', 'Rohil@123', '9403365600', '$2y$10$mPbSpv/Di1hTm4FoSvEggO8dyG5Z2JClQB1kLeAfhVxJn73IIF8Ae', 1),
(6, 'Pranav', 'pranav@123', '9403365600', '$2y$10$AcIULBfBa7HcD73D63i7Ge3QA9gI7G6DH.VY3iJI3RpZeVCbkgtS6', 1),
(7, 'Rohan', 'rohan@123', '9403365600', '$2y$10$G.0xHeE6SVPeK5qVrG6TTe3TMiUqdeQ3bANkewsFwwKwlQ9ORVjSG', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `buses`
--
ALTER TABLE `buses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bus_feedback`
--
ALTER TABLE `bus_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bus_schedule`
--
ALTER TABLE `bus_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conductors`
--
ALTER TABLE `conductors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conductor_feedback`
--
ALTER TABLE `conductor_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver_feedback`
--
ALTER TABLE `driver_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `buses`
--
ALTER TABLE `buses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bus_feedback`
--
ALTER TABLE `bus_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bus_schedule`
--
ALTER TABLE `bus_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `conductors`
--
ALTER TABLE `conductors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `conductor_feedback`
--
ALTER TABLE `conductor_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `driver_feedback`
--
ALTER TABLE `driver_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
