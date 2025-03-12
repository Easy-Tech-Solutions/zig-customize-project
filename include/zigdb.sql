CREATE TABLE `user` (
  `ID` INT AUTO_INCREMENT PRIMARY KEY,
  `customer_name` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `customer_mail` varchar(30) NOT NULL,
  `customer_phone` int(10) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;