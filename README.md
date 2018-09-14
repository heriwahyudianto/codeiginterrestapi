# codeigniter rest api

simple codeigniter restapi with banking information system example

require chriskacerguis/codeigniter-restserver

## customer api

get all customers: http://localhost/v1/customers

insert new customer with post method: http://localhost/v1/customers

get cusomer by id: http://localhost/v1/customer/id/1

## transaction api

get all transactions: http://localhost/v1/transactions

get all transaction by customer id: http://localhost/v1/transaction/customerid/1

insert new transaction with post method: http://localhost/v1/transactions


### transfer api
insert new transfer with post method: http://localhost/v1/transfers

payload body : fromcustomerid,  amount, toaccountnumber

### owner api
get grand total saldo: http://localhost/v1/owner


## tools
composer, git, npm, sublime text, postman, firefox, heidisql, grunt

## database schema

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `accountnumber` varchar(13) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` text NOT NULL,
  `name` varchar(20) NOT NULL,
  `phone` varchar(13) DEFAULT NULL,
  `address` varchar(128) DEFAULT NULL,
  `type` smallint(6) DEFAULT '1',
  `descr` text,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `customerid` int(11) NOT NULL,
  `type` smallint(6) DEFAULT '1' COMMENT '1=nabung, 2=tarik, 3=transfer',
  `debet` float NOT NULL DEFAULT '0',
  `credit` float NOT NULL DEFAULT '0',
  `descr` text,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `accountnumber` (`accountnumber`);

ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
