CREATE DATABASE ecobankcbsdb;

USE ecobankcbsdb;

CREATE TABLE Customer(
passwords varchar(30) not null,
customerID int not null primary key AUTO_INCREMENT = 1001,   
custFName varchar(100) not null,
custLName varchar(100) not null,
phone int not null,
email varchar(150) not null,
);

CREATE TABLE Account(
AccID int not null primary key AUTO_INCREMENT = 10000001,
AccCustomerID int not null,
AccName varchar(100) not null,
currency varchar(30) not null,
AccStatus varchar(30) not null,
AccBalance float,
AccType varchar(100) not null,
foreign key (AccCustomerID) references Customer(customerID) ON UPDATE CASCADE
);

CREATE TABLE InternalUsers(
IntuserID int not null primary key AUTOINCREMENT,
passwords varchar(30) not null,
IntuserFName varchar(100) not null,
IntuserLName varchar(100) not null,
IntuserDepartment varchar(30) not null,
IntuserRole varchar(30) not null
);

CREATE TABLE FundsTransfers(
FundsTransfer_ID int not null primary key AUTO_INCREMENT,
Transfer_creditordebit varchar (6) not null,
Transfer_Ammount float,
Transfer_initiator varchar (100),
Transfer_type varchar (50) not null,
Transfer_account varchar (100) not null,
Transfer_Date date not null,
Transfer_Time time not null,
FOREIGN KEY (Transfer_account) REFERENCES Account(AccName) ON UPDATE CASCADE ON DELETE NO ACTION,
FOREIGN KEY (Transfer_initiator) REFERENCES InternalUsers(IntuserLName) ON UPDATE CASCADE ON DELETE NO ACTION
);