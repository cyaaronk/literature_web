/* COMP3311 Lab 7 lab7.sql */

/* Drop all existing constraints */
select 'alter table '||u.table_name||' drop constraint '||c.constraint_name  
from user_tables u, user_constraints c
where u.table_name=c.table_name;


/* NOTE: Drop order is important */
drop table enrolls_in;
drop table facility;
drop table student;
drop table course;
drop table department;

/* NOTE: Create order is important */
create table department (
	department_id	varchar2(4) primary key,
	department_name varchar2(40),
	room_number		number(4)
);

create table student (
	student_id      varchar2(8) primary key,
	first_name      varchar2(20) not null,
	last_name       varchar2(25) not null,
	email           varchar2(30) not null,
	phone_number    varchar2(8),
	cga             number(4,2),
	department_id   varchar2(4) not null references department(department_id) on delete set null,
	admission_date	date,
	constraint cga_check check (cga between 0.00 and 12.00)
);

create table course (
	course_id       varchar2(8) primary key,
	department_id   varchar2(4) not null references department(department_id) on delete cascade,
	department_name varchar2(40),
	credits         int,
	instructor      varchar2(30) not null
);

create table enrolls_in (
 	student_id  varchar2(8) references student(student_id) on delete cascade,
	course_id   varchar2(8) references course(course_id) on delete cascade,
	grade       number(4,1),
	primary key(student_id, Course_id),
	constraint grade_check check (grade between 0.0 and 100.0)
);

create table facility ( 
  	department_id       varchar2(4) primary key references department(department_id) on delete cascade,
	department_name     varchar2(40),
	no_of_projectors    number(4),
	no_of_computers     number(5)
);

create unique index email_index on student (email);

insert into department values ('COMP', 'Computer Science', 3528);
insert into department values ('MATH', 'Mathematics', 3461);
insert into department values ('ELEC', 'Electronic Engineering', 2528);
insert into department values ('BUS', 'Business', 4528);
insert into department values ('HUMA','Humanities',1200);

insert into student values ('13455789', 'Harry', 'Potter', 'cs_hpx', '23581234', 7.94, 'COMP', '03-SEP-13');
insert into student values ('15456789', 'Leonardo', 'Da Vinci', 'cs_ldv', '23585678', 7.65, 'COMP', '01-SEP-14');
insert into student values ('13556789', 'Legolas', 'Greenleaf', 'ma_lgx', '23582468', 10.82, 'MATH', '02-SEP-15');
insert into student values ('13456789', 'Rita', 'Lai', 'cs_rlx', '23581234', 8, 'COMP', '03-SEP-15');
insert into student values ('15678989', 'Maria', 'Yip', 'cs_mya', '23589876', 7.24, 'COMP', '01-SEP-15');
insert into student values ('15678901', 'Albert', 'Yip', 'cs_ayx', '23585678', 6.64, 'COMP', '01-SEP-14');
insert into student values ('16789012', 'Robert', 'Ko', 'ma_rkx', '23582468', 6.86, 'MATH', '01-SEP-15');
insert into student values ('14567890', 'Julius', 'Caeser', 'ee_jcx', '23589876', 2.82, 'ELEC', '03-SEP-13');
insert into student values ('99987654', 'Lazy', 'Lazy', 'lz_llx', '23581357', 1.8, 'COMP', '03-SEP-15');
insert into student values ('26184624', 'Bruce', 'Wayne', 'ee_bwab', '28261057', 6.21, 'ELEC', '01-SEP-13');
insert into student values ('26184444', 'Donald', 'Trump', 'bs_dt', '28255057', 1, 'BUS', '01-SEP-14');
insert into student values ('26186666', 'Warren', 'Buffet', 'bs_wb', '28266027', 11, 'BUS', '01-SEP-15');
insert into student values ('66666666', 'Ferris', 'Bueller', 'bs_fb', '28282727', null, 'BUS', '01-SEP-14');

insert into course values ('COMP3311', 'COMP', 'Database Management Systems', 3, 'Chen Lei');
insert into course values ('COMP4021', 'COMP', 'Internet Computing', 3, 'David Rossiter');
insert into course values ('ELEC3100', 'ELEC', 'Signal Processing and Communications', 4, 'Electronic Man');
insert into course values ('MATH2421', 'MATH', 'Probability', 4, 'Isaac Newton');
insert into course values ('HUMA1020', 'HUMA', 'Chinese Writing and Culture', 3, 'Human Man');

--students enrolled in COMP3311
insert into enrolls_in values ('13455789', 'COMP3311', 85.6);
insert into enrolls_in values ('15456789', 'COMP3311', 77.9);
insert into enrolls_in values ('13556789', 'COMP3311', 89.5);
insert into enrolls_in values ('14567890', 'COMP3311', 60.4);
insert into enrolls_in values ('99987654', 'COMP3311', 50.0);
insert into enrolls_in values ('13456789', 'COMP3311', 66.9);
insert into enrolls_in values ('15678989', 'COMP3311', 71.8);
insert into enrolls_in values ('15678901', 'COMP3311', 64.3);
insert into enrolls_in values ('26184624', 'COMP3311', 62.1);
insert into enrolls_in values ('26184444', 'COMP3311', 52.1);
insert into enrolls_in values ('26186666', 'COMP3311', 82.1);
--students enrolled in COMP4021
insert into enrolls_in values ('13455789', 'COMP4021', 61.3);
insert into enrolls_in values ('15456789', 'COMP4021', 65.9);
insert into enrolls_in values ('13556789', 'COMP4021', 83.1);
insert into enrolls_in values ('14567890', 'COMP4021', 56.8);
insert into enrolls_in values ('13456789', 'COMP4021', 71.3);
insert into enrolls_in values ('15678989', 'COMP4021', 55.2);
insert into enrolls_in values ('15678901', 'COMP4021', 82.1);
insert into enrolls_in values ('16789012', 'COMP4021', 75.3);
insert into enrolls_in values ('26184624', 'COMP4021', 77.1);
insert into enrolls_in values ('26186666', 'COMP4021', 92.1);
--students enrolled in ELEC3100
insert into enrolls_in values ('13455789', 'ELEC3100', 74.1);
insert into enrolls_in values ('15456789', 'ELEC3100', 60.0);
insert into enrolls_in values ('13556789', 'ELEC3100', 86.2);
insert into enrolls_in values ('14567890', 'ELEC3100', 59.1);
insert into enrolls_in values ('99987654', 'ELEC3100', 58.3);
insert into enrolls_in values ('13456789', 'ELEC3100', 68.3);
insert into enrolls_in values ('15678989', 'ELEC3100', 74.6);
insert into enrolls_in values ('15678901', 'ELEC3100', 72.9);
insert into enrolls_in values ('26184624', 'ELEC3100', 83.7);
insert into enrolls_in values ('26184444', 'ELEC3100', 55.6);
insert into enrolls_in values ('26186666', 'ELEC3100', 95.1);
--students enrolled in HUMA1020
insert into enrolls_in values ('13455789', 'HUMA1020', 82.4);
insert into enrolls_in values ('15456789', 'HUMA1020', 95.2);
insert into enrolls_in values ('13556789', 'HUMA1020', 88.4);
insert into enrolls_in values ('14567890', 'HUMA1020', 56.2);
insert into enrolls_in values ('99987654', 'HUMA1020', 50.2);
insert into enrolls_in values ('13456789', 'HUMA1020', 91.6);
insert into enrolls_in values ('15678989', 'HUMA1020', 99.0);
--students enrolled in MATH2421
insert into enrolls_in values ('13455789', 'MATH2421', 73.5);
insert into enrolls_in values ('15456789', 'MATH2421', 77.2);
insert into enrolls_in values ('14567890', 'MATH2421', 57.5);
insert into enrolls_in values ('13556789', 'MATH2421', 88.3);
insert into enrolls_in values ('13456789', 'MATH2421', 84.3);
insert into enrolls_in values ('15678989', 'MATH2421', 73.1);
insert into enrolls_in values ('15678901', 'MATH2421', 66.4);
insert into enrolls_in values ('16789012', 'MATH2421', 68.4);
insert into enrolls_in values ('26184624', 'MATH2421', 55.1);
insert into enrolls_in values ('26184444', 'MATH2421', 42.1);
insert into enrolls_in values ('26186666', 'MATH2421', 83.5);

insert into facility values ('COMP', 'Computer Science', 5, 150);
insert into facility values ('MATH', 'Mathematics', 5, 30);
insert into facility values ('ELEC', 'Electronic Engineering', 5, 150);
insert into facility values ('BUS', 'Business', 5, 30);

commit;