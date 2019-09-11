-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Sep 11, 2019 at 01:38 AM
-- Server version: 5.7.26
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `pear`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
                         `id` int(11) NOT NULL,
                         `firstname` varchar(255) NOT NULL,
                         `lastname` varchar(255) NOT NULL,
                         `email` varchar(255) NOT NULL,
                         `created` datetime DEFAULT NULL,
                         `modified` datetime DEFAULT NULL,
                         `role` varchar(255) DEFAULT NULL,
                         `password` varchar(255) NOT NULL,
                         `verified` int(11) DEFAULT NULL,
                         `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `created`, `modified`, `role`, `password`, `verified`, `token`) VALUES
(5, '123', '123', '123@123.com', '2019-09-10 05:01:25', '2019-09-10 05:01:25', '1', '$2y$10$KJCW5aocI22rDD9ALeoXJOXvoa/Q5cACp37utqaQJO8pZuYvwX/iO', NULL, NULL),
(6, 'Jianheng', 'Huang', 'jhua216@student.monash.edu', '2019-09-10 10:44:11', '2019-09-10 10:44:11', NULL, '$2y$10$Rrg9Y7ditXY0gQT9i.vIDOAKqKRVKBpa10386qWZnjLYRResIrzfe', NULL, NULL),
(7, 'w', 'w', '888@888.com', '2019-09-10 10:57:23', '2019-09-10 10:57:23', NULL, '$2y$10$GL53wyLf0uaopEeZRD4ecerR7fstk7zJaAJV.eaF1FQHE16JzshXS', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
