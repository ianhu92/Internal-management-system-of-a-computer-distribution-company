create database infsci2710;
use infsci2710;

create table employee(
	employeeID int(5) primary key not null unique auto_increment,
	firstName varchar(30) not null,
	lastName varchar(30) not null,
	jobTitle varchar(14) not null default 'salesman',
	street varchar(200),
	city varchar(200),
	state varchar(10),
	zipcode int(5),
	email varchar(200),
	salary decimal(7,2)
) ENGINE=InnoDB;

create table login(
	employeeID int(5) primary key not null unique,
	password varchar(15) not null,
	userType varchar(14) not null,
	foreign key (employeeID) references employee (employeeID)
	-- foreign key (userType) references employee (jobTitle)
) ENGINE=InnoDB;

create table region(
	regionID int primary key not null unique,
	name varchar(30) not null,
	regionManagerID int(5) not null,
	foreign key (regionManagerID) references employee (employeeID)
) ENGINE=InnoDB;

create table store(
	storeID int primary key not null unique,
	managerID int(5) unique not null,
	regionID int not null,
	name varchar(30) not null,
	street varchar(200),
	city varchar(200),
	state varchar(10),
	zipcode int(5),
	salesmanNumber int not null default 0,
	foreign key (managerID) references employee (employeeID),
	foreign key (regionID) references region (regionID)
) ENGINE=InnoDB;

create table storeEmployee(
	employeeID int(5) primary key not null unique,
	assignedStoreID int not null,
	foreign key (employeeID) references employee (employeeID),
	foreign key (assignedStoreID) references store (storeID)
) ENGINE=InnoDB;

create table customer(
	customerID int primary key not null unique auto_increment,
	name varchar(100) not null,
	street varchar(200),
	city varchar(200),
	state varchar(10),
	zipcode int(5),
	customerType varchar(10) not null default 'individual'
) ENGINE=InnoDB;

create table businessCustomer(
	customerID int primary key not null unique,
	category varchar(30) not null,
	grossAnnualIncome decimal(10,2),
	foreign key (customerID) references customer (customerID)
) ENGINE=InnoDB;

create table individualCustomer(
	customerID int primary key not null unique,
	gender varchar(6),
	age int,
	annualIncome decimal(10,2),
	marriageStatus varchar(10),
	foreign key (customerID) references customer (customerID)
) ENGINE=InnoDB;

create table product(
	productID int primary key not null unique,
	name varchar(100) not null,
	unitCost decimal(6,2) not null,
	referenceUnitPrice decimal(6,2) not null,
	productType varchar(4),
	category  varchar(30),
	series varchar(30),
	imageFileName varchar(20)
) ENGINE=InnoDB;

create table inventory(
	storeID int not null,
	productID int not null,
	number int,
	primary key (storeID, productID),
	foreign key (storeID) references store (storeID),
	foreign key (productID) references product (productID)
) ENGINE=InnoDB;

create table orders(
	orderID int primary key not null unique auto_increment,
	customerID int not null,
	salesmanID int(5) not null,
	storeID int not null,
	date date not null,
	status varchar(20) not null default 'unfinished',
	foreign key (customerID) references customer (customerID),
	foreign key (salesmanID) references storeEmployee (employeeID),
	foreign key (storeID) references store (storeID)
) ENGINE=InnoDB;

create table orderDetail(
	orderDetailID int primary key not null unique auto_increment,
	orderID int not null,
	productID int not null,
	number int not null,
	unitPrice decimal(6,2) not null,
	foreign key (OrderID) references orders (OrderID),
	foreign key (productID) references product (productID)
) ENGINE=InnoDB;

create table inventoryOrder(
	inventoryOrderID int primary key unique not null auto_increment,
	orderID int not null,
	date date not null,
	status varchar(11) not null default 'unsent',
	foreign key (orderID) references orders (orderID)
) ENGINE=InnoDB;

create table inventoryOrderDetail(
	inventoryOrderDetailID int primary key unique not null auto_increment,
	inventoryOrderID int not null,
	productID int not null,
	storeID int not null,
	numberChanged int not null,
	foreign key (inventoryOrderID) references inventoryOrder (inventoryOrderID),
	foreign key (productID) references product (productID),
	foreign key (storeID) references store (storeID)
) ENGINE=InnoDB;

create table orderPayment(
	orderID int primary key not null unique auto_increment,
	amountShouldPay decimal(10,2) not null default 0.00,
	amountPaid decimal(10,2) not null default 0.00,
	status varchar(10) not null default 'unfinished',
	foreign key (orderID) references orders (orderID)
) ENGINE=InnoDB;

create table orderPaymentTransaction(
	orderPaymentTransactionID int primary key not null unique auto_increment,
	orderID int not null,
	paymentAmount decimal(10,2) default 0.00 not null,
	foreign key (orderID) references orders (orderID)
) ENGINE=InnoDB;