-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2018 at 09:19 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chkdcrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `type` enum('Invoice','Shipping','Site','Mailing') NOT NULL,
  `street` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(30) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `country` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `type`, `street`, `city`, `state`, `zip`, `country`) VALUES
(2, 'Mailing', 'Infinite Loop 122', 'Los Angeles', 'California', '700234', 'United States'),
(7, 'Invoice', 'Inifiny Loop 2478', 'Los Angeles', 'California', '091124', 'United States'),
(23, 'Site', 'Mannheimer Str. 20', 'Stuttgart', 'Nordrhein-Westpfalen', '566473', 'Germany'),
(24, 'Mailing', 'StraÃŸe des 18. Oktober 33', 'Leipzig', 'sachsen', '04103', 'Deutschland'),
(25, 'Site', 'Ceske Budejovice', 'Svetie', 'Budvar', '512/4', 'Czech Republic'),
(26, 'Mailing', 'Ceske Budejovice', 'Svetie', 'European Union', '512/422234', 'Czech Republic');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` int(11) NOT NULL,
  `name_de` varchar(150) NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `c_tel` varchar(20) NOT NULL,
  `c_email` varchar(150) NOT NULL,
  `service_region` enum('EU','Western Europe','Germany and German-speaking region','Other') NOT NULL,
  `employee_count` int(8) DEFAULT NULL,
  `registration_nr` varchar(15) DEFAULT NULL,
  `annual_revenue` varchar(20) DEFAULT NULL,
  `c_remark` text,
  `c_date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `member_type` enum('Board','Counsil','Class A','Class B','Automotive Committee','Support','Not') NOT NULL,
  `industry` enum('Agro','Metal','Automobile','Pharma','Finance','Media','Electronics','Logistic','Energy','Other','Publishing','IT','Manufacturing','Trading') NOT NULL,
  `parent_company` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `name_de`, `website`, `c_tel`, `c_email`, `service_region`, `employee_count`, `registration_nr`, `annual_revenue`, `c_remark`, `c_date_added`, `member_type`, `industry`, `parent_company`) VALUES
(1, '', NULL, '', '', '', NULL, NULL, NULL, NULL, '2018-06-16 17:48:38', '', '', NULL),
(2, 'Apple Inc.', 'apple.com', '555002314', 'info@apple.com', 'Other', 50, '---', 'USD 23.000.000.000', 'test no.1', '2018-06-16 17:49:05', 'Not', 'Electronics', 1),
(3, 'Springer Verlag', 'springer.de', '05566978654', 'info@springer.de', 'Germany and German-speaking region', 4200, 'HTG 6054 DHR', 'EUR 50000000', 'test no2', '2018-06-24 11:56:17', 'Support', 'Publishing', 1),
(4, 'Budweiser', 'www.budweiser.cz', '00982222412', 'info@budweiser.de', 'EU', 4000, '---', '---', 'test no 3', '2018-07-04 02:36:38', 'Support', 'Other', 1);

-- --------------------------------------------------------

--
-- Table structure for table `company_address`
--

CREATE TABLE `company_address` (
  `address_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company_address`
--

INSERT INTO `company_address` (`address_id`, `company_id`) VALUES
(2, 2),
(7, 2),
(23, 3),
(25, 4);

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `job_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `department` varchar(45) NOT NULL,
  `position` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`job_id`, `person_id`, `company_id`, `department`, `position`) VALUES
(4, 4, 3, 'Public Relations', 'Manager'),
(5, 5, 4, 'Sales', 'Manager');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `person_id` int(11) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `media_type` enum('German media','Chinese media','Foreign media','Not media') NOT NULL,
  `magazine_sub` tinyint(4) NOT NULL,
  `newsletter_sub` tinyint(4) NOT NULL,
  `birthday` date DEFAULT NULL,
  `priority` enum('High','Medium','Low','None') NOT NULL,
  `p_remark` text,
  `p_date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `p_tel` varchar(20) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) NOT NULL,
  `p_email` varchar(150) NOT NULL,
  `wechat` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`person_id`, `first_name`, `last_name`, `media_type`, `magazine_sub`, `newsletter_sub`, `birthday`, `priority`, `p_remark`, `p_date_added`, `p_tel`, `fax`, `mobile`, `p_email`, `wechat`) VALUES
(4, 'Chaolong', 'Chen', 'Not media', 1, 1, '2018-06-01', 'None', '111', '2018-06-29 01:27:27', '+4917647304836', '03078864550', '+4917647304836', 'chaolong.c@gmail.com', '---'),
(5, 'San', 'Zhang', 'Not media', 0, 0, '1982-01-12', 'Medium', '35435353', '2018-07-04 02:38:00', '009822331012', '009800210047', '011478854447', 'afouhnauhn', '---');

-- --------------------------------------------------------

--
-- Table structure for table `person_address`
--

CREATE TABLE `person_address` (
  `address_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `person_address`
--

INSERT INTO `person_address` (`address_id`, `person_id`) VALUES
(24, 4),
(26, 5);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(45) NOT NULL,
  `opt` varchar(1) DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `opt`) VALUES
(1, 'Admin', 'Y'),
(2, 'Manager', 'Y'),
(3, 'Staff', 'Y'),
(4, 'Intern', 'Y'),
(5, 'External', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` int(11) NOT NULL,
  `task_type` enum('Email','Call','Meeting','Other') NOT NULL,
  `task_desc` text,
  `due` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `task_type`, `task_desc`, `due`) VALUES
(17, 'Meeting', 'errere', '2018-07-18'),
(18, 'Email', 'Tiehaf', '2018-07-14');

-- --------------------------------------------------------

--
-- Table structure for table `task_target`
--

CREATE TABLE `task_target` (
  `task_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `task_target`
--

INSERT INTO `task_target` (`task_id`, `person_id`) VALUES
(17, 4),
(18, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `u_first_name` varchar(45) NOT NULL,
  `u_last_name` varchar(45) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mobile` varchar(45) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `u_first_name`, `u_last_name`, `email`, `mobile`, `username`, `password`) VALUES
(8, 'Chaolong', 'Chen', 'chaolong.c@gmail.com', '+4917647304836', 'admin', '$2y$10$NLlXVdkY7DQKGN2HrmCe8ucyf6/S2m0hTvXENPJQ2v/E1OXLMIdGa'),
(10, 'Manuel', 'Neuer', 'm.neuer@dfb.de', '1', 'admin3', '$2y$10$86wlyp7AiiNGyyBiuHX4pO5PpqX0Bwa9b/Bm.rRNwlSJs5O8Sn/jS'),
(11, 'Toni', 'Kroos', 't.kroos@dfb.de', '8', 'admin2', '$2y$10$K8YROR0NZp075hd8WlT1tuqnfDo/jO69UjYBbGC1buyN9QbThkxF6'),
(13, 'Lionel', 'Messi', 'l.messi@afa.ag', '10', 'admin4', '$2y$10$AktCdiTPCJ0fU/eSXRHkFupL41ej.vJsF49KqHV0tQ9iW82EuCLp.');

-- --------------------------------------------------------

--
-- Table structure for table `user_has_task`
--

CREATE TABLE `user_has_task` (
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_has_task`
--

INSERT INTO `user_has_task` (`user_id`, `task_id`) VALUES
(10, 17),
(8, 18);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_id`, `role_id`) VALUES
(8, 1),
(8, 2),
(10, 2),
(10, 3),
(11, 3),
(11, 4),
(13, 2),
(13, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`),
  ADD KEY `parent_company` (`parent_company`);

--
-- Indexes for table `company_address`
--
ALTER TABLE `company_address`
  ADD PRIMARY KEY (`address_id`,`company_id`),
  ADD KEY `company_address_company_id` (`company_id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`job_id`,`company_id`,`person_id`),
  ADD KEY `job_person_id` (`person_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`person_id`);

--
-- Indexes for table `person_address`
--
ALTER TABLE `person_address`
  ADD PRIMARY KEY (`address_id`,`person_id`),
  ADD KEY `person_id` (`person_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `task_target`
--
ALTER TABLE `task_target`
  ADD PRIMARY KEY (`task_id`,`person_id`),
  ADD KEY `fk_task_has_person_person1` (`person_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_has_task`
--
ALTER TABLE `user_has_task`
  ADD PRIMARY KEY (`task_id`,`user_id`),
  ADD KEY `fk_user_has_task_user1` (`user_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `fk_user_has_role_role1` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `person_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `parent_company` FOREIGN KEY (`parent_company`) REFERENCES `company` (`company_id`) ON DELETE SET NULL;

--
-- Constraints for table `company_address`
--
ALTER TABLE `company_address`
  ADD CONSTRAINT `company_address_address_id` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `company_address_company_id` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE;

--
-- Constraints for table `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `company_id` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_person_id` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`) ON DELETE CASCADE;

--
-- Constraints for table `person_address`
--
ALTER TABLE `person_address`
  ADD CONSTRAINT `person_address_ibfk_1` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `person_id` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`) ON DELETE CASCADE;

--
-- Constraints for table `task_target`
--
ALTER TABLE `task_target`
  ADD CONSTRAINT `fk_task_has_person_person1` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_task_has_person_task1` FOREIGN KEY (`task_id`) REFERENCES `task` (`task_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_has_task`
--
ALTER TABLE `user_has_task`
  ADD CONSTRAINT `fk_user_has_task_task1` FOREIGN KEY (`task_id`) REFERENCES `task` (`task_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_has_task_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION;

--
-- Constraints for table `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `fk_user_has_role_role1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `fk_user_has_role_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
