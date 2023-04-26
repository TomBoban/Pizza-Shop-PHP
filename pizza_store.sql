-- vaibhav rudani(8810171), niki soni(8806834)

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `orders` (
  `id` int(5) NOT NULL,
  `order_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `orders` (`id`, `order_id`, `user_id`, `created_on`) VALUES
(1, 0001, 1, '2022-12-16 00:00:01');

CREATE TABLE `order_details` (
  `id` int(5) NOT NULL,
  `order_id` int(5) NOT NULL,
  `book_id` int(5) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `order_details` (`id`, `order_id`, `book_id`, `created_on`) VALUES
(1, 0001, 1, '2022-12-16 00:01:00');

CREATE TABLE `products` (
  `id` int(5) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` double NOT NULL,
  `description` varchar(200) NOT NULL,
  `model_number` varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `manufacture_date` datetime NOT NULL,
  `photo` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
