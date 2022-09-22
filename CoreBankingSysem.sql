CREATE DATABASE CoreBankingSystem;

USE CoreBankingSystem;

CREATE TABLE Customer(
customerID int not null primary key,
passwords varchar(30) not null,
);

CREATE TABLE CustomerDetails(
customerID int not null foreign key references Customer(customerID) ON UPDATE CASCADE ON DELETE CASCADE,
custFName varchar(100) not null,
custLName varchar(100) not null,
phone int not null,
email varchar(150) not null
);


CREATE TABLE Account(
AccID int not null foreign key references Customer(customerID) ON UPDATE CASCADE ON DELETE CASCADE,
AccName varchar(100) not null,
currency varchar(30) not null,
AccBalance float not null,
AccType varchar(100) not null
);

CREATE TABLE InternalUsers(
IntuserID int not null primary key,
IntuserFName varchar(100) not null,
IntuserLName varchar(100) not null,
IntuserDepartment varchar(30) not null,
);

CREATE TABLE FundsTransfers(
  FundsTransfer_ID int not null primary key AUTOINCREMENT,
  Transfer_creditordebit varchar (1) not null,
  Transfer_Ammount float not null,
  Transfer_type varchar (50),
  Transfer_account int not null FOREIGN KEY REFERENCES Account(AccID) ON UPDATE CASCADE,
  Transfer_Date date,
  Transfer_Time time
);


