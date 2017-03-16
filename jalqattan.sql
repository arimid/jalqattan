SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+03:00";
DROP DATABASE IF EXISTS jalqattan;
CREATE DATABASE IF NOT EXISTS jalqattan DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE jalqattan;
CREATE TABLE Users(
    ID INT(3) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(40) NOT NULL,
    Birth_Date DATE NOT NULL,
    ID_Number INT(20) NOT NULL UNIQUE KEY,
    Password INT(15) NOT NULL,
    -- Image BLOB NOT NULL,
    Expiry_Date DATE NOT NULL,
    Quli ENUM('إبتداى','متوسط','ثانوى','دبلوم','بكالوريس','دبلوم عالى','ماجستير','دكتوراه') NOT NULL,
    Courses VARCHAR(200) NOT NULL,
    Job_Name VARCHAR(13) NOT NULL,
    Rank INT(1) NOT NULL DEFAULT 1,
    PRE INT(4) NOT NULL DEFAULT 1111
) DEFAULT CHARSET=UTF8 ;
INSERT INTO `users` (`ID`, `Name`, `Birth_Date`, `ID_Number`, `Password`, `Expiry_Date`, `Quli`, `Courses`, `Job_Name`, `Rank`, `PRE`) VALUES
(1, 'مدير', '2017-03-15', 12345, 1234, '2017-03-15', 'دكتوراه', '', '', 0, 9999);
INSERT INTO `users` (`ID`, `Name`, `Birth_Date`, `ID_Number`, `Password`, `Expiry_Date`, `Quli`, `Courses`, `Job_Name`, `Rank`, `PRE`) VALUES
(2, 'موظف', '2017-03-15', 123456, 1234, '2017-03-15', 'دكتوراه', '', '', 0, 9999);
/*
ENGINE = INNODB
CREATE TABLE loans(
    Employee_ID INT(3) NOT NULL ,
    Amount INT(9) NOT NULL DEFAULT 0,
    Paid INT(9) NOT NULL DEFAULT 0,
    Resi INT(9) NOT NULL,
    FOREIGN KEY (Employee_ID)
        REFERENCES Employees(ID)
        ON UPDATE CASCADE 
        ON DELETE CASCADE
) ENGINE = INNODB DEFAULT CHARSET=UTF8;
CREATE TABLE Salaries(
    Employee_ID INT(3) NOT NULL,
    funds INT(9) NOT NULL DEFAULT 0,
    others INT(9) NOT NULL DEFAULT 0,
    foes INT(9) NOT NULL DEFAULT 0,
    Debt INT(9) NOT NULL,
    INDEX(Debt),
    CONSTRAINT Bind_ID
    FOREIGN KEY (Employee_ID)
        REFERENCES Employees(ID)
        ON UPDATE CASCADE 
        ON DELETE CASCADE
    ) ENGINE = INNODB DEFAULT CHARSET=UTF8;*/
CREATE TABLE Vacas(
    User_ID INT(3) NOT NULL,
    order_ID INT(3) NOT NULL,
    kind TEXT(20) NOT NULL,
    Dur INT(4) NOT NULL DEFAULT 0,
    vDate DATE,
    Status INT(1) DEFAULT 0,
    FOREIGN KEY (User_ID)
    REFERENCES Users(ID)
        ON UPDATE CASCADE 
        ON DELETE CASCADE
) ENGINE = INNODB DEFAULT CHARSET=UTF8;

INSERT INTO Vacas (User_ID,order_ID,kind,Dur,vDate) VALUES (2,1,'pe',4,CURRENT_DATE());