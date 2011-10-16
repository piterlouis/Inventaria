
create table `departments` (
  `id` int(10) not null auto_increment primary key,
  `name` varchar(255) not null,
  `pass` varchar(40),
  constraint name_unique unique(`name`) 
) engine = myIsam;

create table `materials` (
  `id` int(10) not null auto_increment primary key,
  `name` varchar(255) not null,
  `units` int(10),
  `signDate` date not null,
  `outDate` date
) engine = myIsam;