SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
CREATE DATABASE IF NOT EXISTS `test_task` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `test_task`;

CREATE TABLE IF NOT EXISTS `News` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ParticipantId` int(11) NOT NULL,
  `NewsTitle` varchar(255) NOT NULL,
  `NewsMessage` text NOT NULL,
  `LikesCounter` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `News` (`ID`, `ParticipantId`, `NewsTitle`, `NewsMessage`, `LikesCounter`) VALUES
(1, 1, 'New agenda!', 'Please visit our site!', 0);

CREATE TABLE IF NOT EXISTS `Participant` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `Participant` (`ID`, `Email`, `Name`) VALUES
(1, 'user@example.com', 'The first user');

CREATE TABLE IF NOT EXISTS `Session` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `TimeOfEvent` datetime NOT NULL,
  `Description` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `Speaker` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `SessionId` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  FOREIGN KEY (`SessionId`) REFERENCES session (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `Speaker` (`ID`, `Name`, `SessionId`) VALUES
(1, 'Watson', 1),
(2, 'Arnold', 1);

create table test_task.allow_to_read_tables
(
    id int auto_increment primary key,
    `table` varchar(255) not null,
    constraint permissionsToRead_table_uindex unique (`table`)
);

