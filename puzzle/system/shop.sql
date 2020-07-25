
create table product (
	id int auto_increment primary key, 
	name varchar(200) not null, 
	price int not null
);


create table customer (
	id int auto_increment primary key, 
	name varchar(100) not null, 
	address varchar(200) not null, 
	login varchar(100) not null unique, 
	password varchar(100) not null
);


create table review (
        id int auto_increment primary key,
	customer_id int not null, 
	product_id int not null,
        customer_review varchar(255) not null,
	foreign key(customer_id) references customer(id) on delete cascade on update cascade, 
	foreign key(product_id) references product(id) on delete cascade on update cascade
);


create table favorite (
	customer_id int not null, 
	product_id int not null, 
	primary key(customer_id, product_id), 
	foreign key(customer_id) references customer(id) on delete cascade on update cascade, 
	foreign key(product_id) references product(id) on delete cascade on update cascade
);
