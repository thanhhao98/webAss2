CREATE TABLE `Users` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255),
  `email` varchar(255),
  `phone` varchar(255),
  `password` varchar(255),
  `isAdmin` boolean
);

CREATE TABLE `Reservations` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user` int,
  `numPersons` int,
  `status` varchar(255),
  `createTime` datetime,
  `lastUpdatedByAdmin` int
);

CREATE TABLE `ReservationItem` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `reservation` int,
  `dish` int,
  `quantity` int
);

CREATE TABLE `Dishes` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255),
  `price` int,
  `descriptions` varchar(255),
  `image` varchar(255),
  `status` boolean,
  `lastUpdatedByAdmin` int
);

CREATE TABLE `Comments` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user` int,
  `content` varchar(255),
  `createTime` datetime,
  `visibility` boolean,
  `lastUpdatedByAdmin` int
);

CREATE TABLE `Tables` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `quantity` int,
  `isAvailable` boolean,
  `startReser` datetime,
  `lastReser` datetime,
  `reservation` int,
  `lastUpdatedByAdmin` int
);

CREATE TABLE `Infos` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255),
  `content` varchar(255),
  `status` boolean,
  `lastUpdatedByAdmin` int
);

ALTER TABLE `Reservations` ADD FOREIGN KEY (`lastUpdatedByAdmin`) REFERENCES `Users` (`id`);

ALTER TABLE `Dishes` ADD FOREIGN KEY (`lastUpdatedByAdmin`) REFERENCES `Users` (`id`);

ALTER TABLE `Tables` ADD FOREIGN KEY (`lastUpdatedByAdmin`) REFERENCES `Users` (`id`);

ALTER TABLE `Comments` ADD FOREIGN KEY (`lastUpdatedByAdmin`) REFERENCES `Users` (`id`);

ALTER TABLE `Infos` ADD FOREIGN KEY (`lastUpdatedByAdmin`) REFERENCES `Users` (`id`);

ALTER TABLE `Reservations` ADD FOREIGN KEY (`user`) REFERENCES `Users` (`id`);

ALTER TABLE `Comments` ADD FOREIGN KEY (`user`) REFERENCES `Users` (`id`);

ALTER TABLE `ReservationItem` ADD FOREIGN KEY (`reservation`) REFERENCES `Reservations` (`id`);

ALTER TABLE `ReservationItem` ADD FOREIGN KEY (`dish`) REFERENCES `Dishes` (`id`);

ALTER TABLE `Tables` ADD FOREIGN KEY (`reservation`) REFERENCES `Reservations` (`id`);
