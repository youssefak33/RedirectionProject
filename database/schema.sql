CREATE TABLE `user` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`user_id`)
);

CREATE TABLE `link_tracking` (
  `link_id` INT NOT NULL AUTO_INCREMENT,
  `original_link` TEXT NOT NULL,
  `script_head` TEXT NULL,
  `script_body` TEXT NULL,
  `user_account_id` INT NOT NULL,
  PRIMARY KEY (`link_id`),
  FOREIGN KEY (`user_account_id`) REFERENCES `user`(`user_id`) ON DELETE CASCADE
);

CREATE TABLE `url_redirection` (
  `redirection_id` INT NOT NULL AUTO_INCREMENT,
  `link_tracking_id` INT NOT NULL,
  `url_path` VARCHAR(255) NOT NULL UNIQUE,
  PRIMARY KEY (`redirection_id`),
  FOREIGN KEY (`link_tracking_id`) REFERENCES `link_tracking`(`link_id`) ON DELETE CASCADE
);
