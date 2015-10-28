-- Ex 1. --
-- Suppose database college is already created --

create table student (
	id INTEGER PRIMARY KEY,
	name VARCHAR(10) NOT NULL,
	year TINYINT NOT NULL DEFAULT 1,
	dept_no INTEGER NOT NULL,
	major VARCHAR(20) NOT NULL
);

create table department (
	dept_no INTEGER PRIMARY KEY AUTO_INCREMENT,
	dept_name VARCHAR(20) NOT NULL UNIQUE,
	office VARCHAR(20) NOT NULL,
	office_tel VARCHAR(13)
);

alter table student change major major VARCHAR(40);
alter table student add column gender VARCHAR(1);
alter table department change dept_name dept_name VARCHAR(40);
alter table department change office office VARCHAR(30);

-- Ex 2. --
alter table student drop column gender;

insert into department (dept_name, office, office_tel)
	values ('Computer Science', 'Engineering building', '02-3290-0123');
insert into department (dept_name, office, office_tel)
	values ('Electronic Engineering', 'Engineering building', '02-3290-2345');
insert into department (dept_name, office, office_tel)
	values ('Law', 'Law building', '02-3290-7896');
insert into department (dept_name, office, office_tel)
	values ('Business Administration', 'Administration building', '02-3290-1112');
insert into department (dept_name, office, office_tel)
	values ('English Literature', 'Literature building', '02-3290-4412');

insert into student values (20070002, 'James Bond', 3, 4, 'Business Administration');
insert into student values (20060001, 'Queenie', 4, 4, 'Business Administration');
insert into student values (20030001, 'Reonardo', 4, 2, 'Electronic Engineering');
insert into student values (20040003, 'Julia', 3, 2, 'Electronic Engineering');
insert into student values (20060002, 'Roosevelt', 3, 1, 'Computer Science');
insert into student values (20100002, 'Fearne', 3, 4, 'Business Administration');
insert into student values (20110001, 'Chloe', 2, 1, 'Computer Science');
insert into student values (20080003, 'Amy', 4, 3, 'Law');
insert into student values (20040002, 'Selina', 4, 5, 'English Literature');
insert into student values (20070001, 'Ellen', 4, 4, 'Business Administration');
insert into student values (20100001, 'Kathy', 3, 4, 'Business Administration');
insert into student values (20110002, 'Lucy', 2, 2, 'Electronic Engineering');
insert into student values (20030002, 'Michelle', 5, 1, 'Computer Science');
insert into student values (20070003, 'April', 4, 3, 'Law');
insert into student values (20070005, 'Alicia', 2, 5, 'English Literature');
insert into student values (20100003, 'Yullia', 3, 1, 'Computer Science');
insert into student values (20070007, 'Ashlee', 2, 4, 'Business Administration');

-- Ex 3. --
update department set dept_name='Electronic and Electrical Engineering'
	where dept_name='Electronic engineering';
insert into department (dept_name, office, office_tel)
	values ('Education', 'Education Building', '02-3290-2347');
update student set dept_no=6 where name='Chleo';
delete from student where name='Michelle';
delete from student where name='Fearne';

-- Ex 4. --
select * from student where major='Computer Science';
select id, year, major from student;
select * from student where year=3;
select * from student where year=2 or year=3;
select * from student where dept_no=
	(select dept_no from department where dept_name='Business Administration');

-- Ex 5. --
select * from student where id like '%2007%';
select * from student order by id;
select major, avg(year) from student group by major having avg(year)>3;
select * from student where id like '%2007%' and major='Business Administration' limit 2;



















