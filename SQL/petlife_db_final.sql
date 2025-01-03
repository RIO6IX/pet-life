-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2024 at 02:14 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petlife_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointment_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `pet_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `service` varchar(255) DEFAULT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time DEFAULT NULL,
  `checkin_date` date DEFAULT NULL,
  `checkout_date` date DEFAULT NULL,
  `vet_id` int(11) DEFAULT NULL,
  `service_freq` varchar(20) DEFAULT NULL,
  `postal_code` int(11) DEFAULT NULL,
  `hostel_type` varchar(50) DEFAULT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointment_id`, `customer_id`, `pet_id`, `service_id`, `service`, `appointment_date`, `appointment_time`, `checkin_date`, `checkout_date`, `vet_id`, `service_freq`, `postal_code`, `hostel_type`, `status`) VALUES
(43, 1005, 10, 503, 'Veterinary care', '2024-10-07', '10:30:00', NULL, NULL, 5014, NULL, 12345, NULL, 'pending'),
(44, 1005, 10, 503, 'Veterinary care', '2024-10-07', '13:30:00', NULL, NULL, 5014, NULL, 12345, NULL, 'pending'),
(45, 1005, 10, 503, 'Veterinary care', '2024-10-07', '10:30:00', NULL, NULL, 5016, NULL, 12345, NULL, 'pending'),
(46, 1005, 10, 503, 'Veterinary care', '2024-10-07', '13:30:00', NULL, NULL, 5016, NULL, 12345, NULL, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `item_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `product_amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`item_id`, `product_id`, `customer_id`, `product_amount`) VALUES
(4, 103, 1004, 3),
(5, 104, 1001, 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `city` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `service_provided` varchar(50) DEFAULT NULL,
  `role` varchar(50) NOT NULL CHECK (`role` in ('admin','staff','manager'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `first_name`, `last_name`, `city`, `street`, `postal_code`, `email`, `password`, `service_provided`, `role`) VALUES
(5000, 'Saman', 'Rathnayake', 'Kaduwela', 'first lane', 10100, 'saman@gmail.com', 'f68920fc122acc487bc4e4191487d03c', 'admin', 'admin'),
(5001, 'Kamal', 'Sampath', 'Homagama', 'second lane', 10200, 'kamal@gmail.com', 'fc9ea3bf4c1c266412e34948a09801a4', 'groom', 'staff'),
(5002, 'Dinithi', 'Weerasekara', 'Kandy', 'third lane', 10300, 'dinithi@gmail.com', '9a011b4a4f64ac17779138796888a2ef', 'walk', 'staff'),
(5003, 'Sayumini', 'Pathirana', 'Monaragala', 'fourth lane', 10400, 'sayumini@gmail.com', '887ed9d400305e823f17d05c7f09179e', 'hostel', 'staff'),
(5004, 'Ziyad', 'Mohomad', 'Matara', 'fifth lane', 10500, 'ziyad@gmail.com', '8dee9814672fe8b4a48d39e4af06a73d', 'manager', 'manager'),
(5005, 'test', 'admin', 'test', 'test', 12345, 'admin@gmail.com', 'c93ccd78b2076528346216b3b2f701e6', 'admin', 'admin'),
(5006, 'manager', 'test', 'test', 'test', 12345, 'manager@gmail.com', 'e89ece7cf3b127d81487c7133d0d911f', 'manager', 'manager'),
(5007, 'John', 'Doe', 'test', 'test', 12345, 'vet@gmail.com', 'f616d4a0d60e79eda97d049746172f3a', 'vet', 'staff'),
(5014, 'John', 'Doe', 'test', 'deegala', 12345, 'test@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'vet', 'staff'),
(5015, 'sanuja', 'rubasinghe', 'kothalawala', 'deegala', 1234, 'manager1@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'manager', 'manager'),
(5016, 'Amantha', 'Perera', 'test', 'test', 1234, 'amantha@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'vet', 'staff');

-- --------------------------------------------------------

--
-- Table structure for table `employee_phone`
--

CREATE TABLE `employee_phone` (
  `emp_id` int(11) NOT NULL,
  `phone_num` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_phone`
--

INSERT INTO `employee_phone` (`emp_id`, `phone_num`) VALUES
(5000, '712345678'),
(5001, '0719876543'),
(5002, '0723456789'),
(5003, '0734567890'),
(5004, '0745678901'),
(5014, '0707181470'),
(5015, '707181470'),
(5016, '0707181470');

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `inquiry_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `inquiry_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `inquiry_type` varchar(50) NOT NULL,
  `inquiry_description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inquiry`
--

INSERT INTO `inquiry` (`inquiry_id`, `customer_id`, `inquiry_date`, `inquiry_type`, `inquiry_description`) VALUES
(1, 1000, '2024-09-29 12:14:22', 'service', 'Do you provide home visits for dog grooming?'),
(2, 1001, '2024-09-29 12:14:22', 'vet', 'I want to change my vet.'),
(3, 1002, '2024-09-29 12:14:22', 'product', 'When will new dog collars be available?');

-- --------------------------------------------------------

--
-- Table structure for table `metrics`
--

CREATE TABLE `metrics` (
  `metric_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `revenue` decimal(10,2) NOT NULL,
  `user_traffic` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `metrics`
--

INSERT INTO `metrics` (`metric_id`, `start_date`, `revenue`, `user_traffic`) VALUES
(1, '2024-09-08 00:00:00', 134545.45, 45),
(2, '2024-09-15 00:00:00', 123435.43, 38),
(3, '2024-09-22 00:00:00', 123446.65, 40),
(4, '2024-09-29 00:00:00', 134540.35, 46),
(5, '2024-10-06 00:00:00', 150050.00, 55);

-- --------------------------------------------------------

--
-- Table structure for table `payment_info`
--

CREATE TABLE `payment_info` (
  `card_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `customer_name` varchar(100) NOT NULL,
  `card_number` varchar(255) NOT NULL,
  `expiry_date` char(5) NOT NULL,
  `card_verification_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_info`
--

INSERT INTO `payment_info` (`card_id`, `customer_id`, `customer_name`, `card_number`, `expiry_date`, `card_verification_code`) VALUES
(1, 1000, 'Sanuja Rubasinghe', 'abeac07d3c28c1bef9e730002c753ed4', '03/25', 'd840cc5d906c3e9c84374c8919d2074e'),
(2, 1001, 'Chanuka Sampath', 'abeac07d3c28c1bef9e730002c753ed4', '06/25', 'd840cc5d906c3e9ssdfsdfc8919d2074e'),
(3, 1002, 'Dinithi Dilshani', 'abeac07d3c34534bef9e730002c753ed4', '03/29', 'd840ccwr45r3e9c84374c8919d2074e'),
(4, 1003, 'S Menurangi', '098fd07d3c28c1bef9e730002c753ed4', '06/30', 'wew345we6c3e9c84374c8919d2074e'),
(5, 1004, 'Javid Mushtan', 'dfgac07d3c2345f9e730002c753ed4', '05/27', 'd678cc5d906c3e9c84354c8919d2074e'),
(6, 1005, 'test', '123456789012345', '03/04', '123');

-- --------------------------------------------------------

--
-- Table structure for table `pet_data`
--

CREATE TABLE `pet_data` (
  `pet_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `breed` varchar(50) NOT NULL,
  `gender` char(1) NOT NULL CHECK (`gender` in ('M','F')),
  `weight` decimal(4,2) NOT NULL,
  `pet_type` varchar(20) NOT NULL,
  `pet_image_path` varchar(255) NOT NULL,
  `pet_note` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pet_data`
--

INSERT INTO `pet_data` (`pet_id`, `owner_id`, `name`, `age`, `breed`, `gender`, `weight`, `pet_type`, `pet_image_path`, `pet_note`) VALUES
(1, 1000, 'Timmy', 2, 'German Shepherd', 'M', 20.50, 'Dog', 'timmy0.jpeg', NULL),
(2, 1001, 'Brownie', 3, 'Labrador Retriever', 'F', 30.00, 'Dog', 'brownie1.jpeg', NULL),
(3, 1002, 'Rose', 6, 'American Longhair', 'F', 4.50, 'Cat', 'rose2.png', NULL),
(4, 1003, 'Luna', 1, 'Lhasa Apso', 'F', 15.70, 'Dog', 'Luna3.jpeg', NULL),
(5, 1004, 'King', 5, 'Maine Coon', 'M', 10.50, 'Cat', 'king4.jpeg', NULL),
(10, 1005, 'Woofer', 3, 'Labrador', 'M', 2.00, 'Dog', 'pet.jpg', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `product_data`
--

CREATE TABLE `product_data` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_rating` int(11) NOT NULL,
  `product_type` varchar(50) NOT NULL,
  `current_stock` int(11) NOT NULL,
  `product_image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_data`
--

INSERT INTO `product_data` (`product_id`, `product_name`, `product_price`, `product_rating`, `product_type`, `current_stock`, `product_image_path`) VALUES
(100, 'Dog Shampoo', 500.99, 5, 'pet_care', 150, 'dog_shampoo.png'),
(101, 'Cat Food', 1000.00, 5, 'pet_food', 100, 'cat_food.jpeg'),
(102, 'Dog Food', 500.00, 4, 'pet_food', 75, 'dog_food.jpeg'),
(103, 'Ground Dog Food', 1500.75, 5, 'pet_food', 50, 'ground_dog_food.jpeg'),
(104, 'hamster Wheel', 2000.00, 5, 'pet_care', 200, 'hamster_wheel.jpeg'),
(119, 'Dog Dewormer', 1000.00, 3, 'medicine', 100, 'm4.jpg'),
(120, 'Cranbites', 1500.00, 4, 'medicine', 100, 'm2.jpeg'),
(121, 'Puppy Forte-A', 2000.00, 3, 'medicine', 100, 'm3.png'),
(122, 'Chelated Petomin Plus', 1500.00, 4, 'medicine', 100, 'm4.jpg'),
(123, 'Milk Bone', 1500.00, 4, 'pet_treat', 100, 'pet_treat_1.jpeg'),
(124, 'Milk Bone - F', 2000.00, 4, 'pet_treat', 100, 'pet_treat_2.jpg'),
(125, 'Cesar softies', 500.00, 3, 'pet_treat', 100, 'pet_treat_5.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int(11) NOT NULL,
  `report_type` varchar(50) NOT NULL,
  `report_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `metric_id` int(11) DEFAULT NULL,
  `manager_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`report_id`, `report_type`, `report_date`, `metric_id`, `manager_id`) VALUES
(1, 'rev_report', '2024-09-02 18:30:00', 1, 5004),
(2, 'usr_report', '2024-10-02 18:30:00', 2, 5004),
(3, 'rev_report', '2024-11-02 18:30:00', 3, 5004),
(4, 'rev_report', '2024-12-02 18:30:00', 1, 5004),
(5, 'usr_report', '2025-01-02 18:30:00', 1, 5004),
(14, 'rev_report', '2024-10-05 18:30:00', 1, 5015),
(15, 'usr_report', '2024-10-05 18:30:00', 2, 5015),
(16, 'rev_report', '2024-10-06 18:30:00', 1, 5015),
(17, 'usr_report', '2024-10-06 18:30:00', 2, 5015);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `service_rate` decimal(10,2) NOT NULL,
  `service_type` varchar(255) NOT NULL,
  `availability_status` char(1) NOT NULL CHECK (`availability_status` = 'Y' or `availability_status` = 'N')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_rate`, `service_type`, `availability_status`) VALUES
(500, 1000.00, 'groom', 'Y'),
(501, 100.00, 'walk', 'Y'),
(502, 1500.00, 'hostel', 'Y'),
(503, 2000.00, 'vet', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `city` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_image_path` varchar(255) NOT NULL,
  `purchase_freq` int(11) NOT NULL,
  `role` varchar(50) NOT NULL CHECK (`role` = 'customer')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`user_id`, `first_name`, `last_name`, `city`, `street`, `postal_code`, `email`, `password`, `user_image_path`, `purchase_freq`, `role`) VALUES
(1000, 'Sanuja', 'Rubasinghe', 'Kaduwela', 'first lane', 10100, 'sanuja@gmail.com', 'f68920fc122acc487bc4e4191487d03c', 'saman.jpeg', 0, 'customer'),
(1001, 'Chanuka', 'Sampath', 'Homagama', 'second lane', 10200, 'chanuka@gmail.com', 'fc9ea3bf4c1c266412e34948a09801a4', 'chanuka.jpeg', 0, 'customer'),
(1002, 'Dinithi', 'Dilshani', 'Kandy', 'third lane', 10300, 'dilshani@gmail.com', '9a011b4a4f64ac17779138796888a2ef', 'dilshani.jpeg', 0, 'customer'),
(1003, 'S', 'Menurangi', 'Monaragala', 'fourth lane', 10400, 'menurangi@gmail.com', '887ed9d400305e823f17d05c7f09179e', 'menurangi.jpeg', 0, 'customer'),
(1004, 'Javid', 'Mushtan', 'Matara', 'fifth lane', 10500, 'javid@gmail.com', '8dee9814672fe8b4a48d39e4af06a73d', 'javid.jpeg', 0, 'customer'),
(1005, 'customer', 'test', 'test', '1st lane', 12345, 'customer@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'backgroundDefault.jpg', 10, 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `user_phone`
--

CREATE TABLE `user_phone` (
  `user_id` int(11) NOT NULL,
  `phone_num` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_phone`
--

INSERT INTO `user_phone` (`user_id`, `phone_num`) VALUES
(1000, '0745863216'),
(1001, '0720857478'),
(1002, '0745493394'),
(1003, '0745345346'),
(1004, '0744534536'),
(1005, '707181470');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `APPOINTMENT_FK_USER_ID` (`customer_id`),
  ADD KEY `APPOINTMENT_FK_PET_ID` (`pet_id`),
  ADD KEY `APPOINTMENT_FK_VET_ID` (`vet_id`),
  ADD KEY `APPOINTMENT_FK_SERVICE_ID` (`service_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `CART_FK_PRODUCT_ID` (`product_id`),
  ADD KEY `CART_FK_USER_ID` (`customer_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `employee_phone`
--
ALTER TABLE `employee_phone`
  ADD PRIMARY KEY (`emp_id`,`phone_num`);

--
-- Indexes for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`inquiry_id`),
  ADD KEY `INQUIRY_FK_USER_ID` (`customer_id`);

--
-- Indexes for table `metrics`
--
ALTER TABLE `metrics`
  ADD PRIMARY KEY (`metric_id`);

--
-- Indexes for table `payment_info`
--
ALTER TABLE `payment_info`
  ADD PRIMARY KEY (`card_id`),
  ADD KEY `PAYMENT_INFO_FK_USER_ID` (`customer_id`);

--
-- Indexes for table `pet_data`
--
ALTER TABLE `pet_data`
  ADD PRIMARY KEY (`pet_id`,`owner_id`),
  ADD KEY `PET_DATA_FK` (`owner_id`);

--
-- Indexes for table `product_data`
--
ALTER TABLE `product_data`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `REPORT_FK_MANAGER_ID` (`manager_id`),
  ADD KEY `REPORT_FK_METRIC_ID` (`metric_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_phone`
--
ALTER TABLE `user_phone`
  ADD PRIMARY KEY (`user_id`,`phone_num`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5017;

--
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `inquiry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `metrics`
--
ALTER TABLE `metrics`
  MODIFY `metric_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment_info`
--
ALTER TABLE `payment_info`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pet_data`
--
ALTER TABLE `pet_data`
  MODIFY `pet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_data`
--
ALTER TABLE `product_data`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=505;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1009;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `APPOINTMENT_FK_PET_ID` FOREIGN KEY (`pet_id`) REFERENCES `pet_data` (`pet_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `APPOINTMENT_FK_SERVICE_ID` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `APPOINTMENT_FK_USER_ID` FOREIGN KEY (`customer_id`) REFERENCES `user_data` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `APPOINTMENT_FK_VET_ID` FOREIGN KEY (`vet_id`) REFERENCES `employee` (`emp_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `CART_FK_PRODUCT_ID` FOREIGN KEY (`product_id`) REFERENCES `product_data` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `CART_FK_USER_ID` FOREIGN KEY (`customer_id`) REFERENCES `user_data` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_phone`
--
ALTER TABLE `employee_phone`
  ADD CONSTRAINT `EMPLOYEE_PHONE_FK` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD CONSTRAINT `INQUIRY_FK_USER_ID` FOREIGN KEY (`customer_id`) REFERENCES `user_data` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment_info`
--
ALTER TABLE `payment_info`
  ADD CONSTRAINT `PAYMENT_INFO_FK_USER_ID` FOREIGN KEY (`customer_id`) REFERENCES `user_data` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pet_data`
--
ALTER TABLE `pet_data`
  ADD CONSTRAINT `PET_DATA_FK` FOREIGN KEY (`owner_id`) REFERENCES `user_data` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `REPORT_FK_MANAGER_ID` FOREIGN KEY (`manager_id`) REFERENCES `employee` (`emp_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `REPORT_FK_METRIC_ID` FOREIGN KEY (`metric_id`) REFERENCES `metrics` (`metric_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_phone`
--
ALTER TABLE `user_phone`
  ADD CONSTRAINT `USER_PHONE_FK` FOREIGN KEY (`user_id`) REFERENCES `user_data` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
