/* Modelo de criação de tabela
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `admin` tinyint(1) DEFAULT 0,
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
*/
ALTER TABLE `users` ADD `idNucleo` INT AFTER `password`;

CREATE TABLE `nucleos` (
  `id` INT NOT NULL AUTO_INCREMENT , 
  `sigla` VARCHAR(15) NOT NULL , 
  `descricao` TEXT NULL , 
  `foneContato` VARCHAR(15) NULL , 
  `emailContato` VARCHAR(90) NULL , 
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

INSERT INTO `nucleos`(`sigla`, `descricao`, `foneContato`, `emailContato`) 
VALUES ('NUPETI','Teste','5184564569','email@email.com')

/*****************************************************/

UPDATE `users` SET `idNucleo` = NULL WHERE `users`.`id` = 1

ALTER TABLE `users` ADD CONSTRAINT `fk_users_nucleos` FOREIGN KEY (`idNucleo`) REFERENCES `nucleos`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

