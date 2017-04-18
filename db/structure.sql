insert into states(id,sname) values(1,"Andhra Pradesh");
insert into states(id,sname) values(2,"Arunachal");
insert into states(id,sname) values(3 ,"Assam");
insert into states(id,sname) values(4 ,"Bihar");
insert into states(id,sname) values(5 ,"Chhattisgarh"); 
insert into states(id,sname) values(6 ,"Goa"); 
insert into states(id,sname) values(7 ,"Gujarat");
insert into states(id,sname) values(8 ,"Haryana");
insert into states(id,sname) values(9 ,"Himachal");
insert into states(id,sname) values(10," Jammu & Kashmir Srinagar");
insert into states(id,sname) values(11 ,"Jharkhand");
insert into states(id,sname) values(12 ,"Karnataka");
insert into states(id,sname) values(13," Kerala");
insert into states(id,sname) values(14 ,"Madhya Pradesh");
insert into states(id,sname) values(15," Maharashtra");
insert into states(id,sname) values(16 ,"Manipur");
insert into states(id,sname) values(17," Meghalaya");
insert into states(id,sname) values(18 ,"Mizoram");
insert into states(id,sname) values(19," Nagaland");
insert into states(id,sname) values(20," Odisha");
insert into states(id,sname) values(21," Punjab");
insert into states(id,sname) values(22," Rajasthan");
insert into states(id,sname) values(23 ,"Sikkim");
insert into states(id,sname) values(24," Tamil Nadu");
insert into states(id,sname) values(25," Tripura");
insert into states(id,sname) values(26 ,"Uttarkhand");
insert into states(id,sname) values(27 ,"Uttar Pradesh");
insert into states(id,sname) values(28," West Bengal");


CREATE table district(
id int(11) PRIMARY KEY AUTO_INCREMENT,
    dname varchar(50),
    state_id int,
    CONSTRAINT fk_states FOREIGN KEY (state_id)
  REFERENCES states(id);



insert into district(dname,state_id) values("Bankura",28); 
insert into district(dname,state_id) values("Barddhaman",28) ;
insert into district(dname,state_id) values("Birbhum",28);
insert into district(dname,state_id) values("cooch Bihar",28);
insert into district(dname,state_id) values("Darjiling",28);
insert into district(dname,state_id) values("East Medinipur",28);
insert into district(dname,state_id) values("Hoogly",28);
insert into district(dname,state_id) values("Hawrah",28);
insert into district(dname,state_id) values("Jalpaiguri",28);
insert into district(dname,state_id) values("Kolkata",28);
insert into district(dname,state_id) values("Malda",28);
insert into district(dname,state_id) values("Murshidabad",28);
insert into district(dname,state_id) values("Nadia",28);
insert into district(dname,state_id) values("North Twenty Four Parganas",28)l
insert into district(dname,state_id) values("North Dinajpur",28);
insert into district(dname,state_id) values("Puruliya",28);
insert into district(dname,state_id) values("South Twenty Four Parganas",28);
insert into district(dname,state_id) values("South Dinajpur",28);
insert into district(dname,state_id) values("west Mednipur",28);
);



CREATE TABLE user_subjects(
    id int(11) PRIMARY KEY AUTO_INCREMENT,
    user_id int(11) not null,
    subject_name varchar(50));
    
    CREATE TABLE subjects(
    id int(11) PRIMARY KEY AUTO_INCREMENT,
    subject_name varchar(50));
    
    INSERT into subjects(subject_name) VALUES("Urdu");
INSERT into subjects(subject_name) VALUES("English");
INSERT into subjects(subject_name) VALUES("History");
INSERT into subjects(subject_name) VALUES("Geography");
INSERT into subjects(subject_name) VALUES("Math");
INSERT into subjects(subject_name) VALUES("Bengali");
INSERT into subjects(subject_name) VALUES("Hindi");
INSERT into subjects(subject_name) VALUES("Life Science");
INSERT into subjects(subject_name) VALUES("Physics");
INSERT into subjects(subject_name) VALUES("Chemisty");
INSERT into subjects(subject_name) VALUES("Biology");
    
    
    CREATE TABLE class(
    id int(11) PRIMARY KEY AUTO_INCREMENT,
    class varchar(50));
    
    INSERT into class(class) VALUES("I to V");
INSERT into class(class) VALUES("VI to X");
INSERT into class(class) VALUES("XI to XII");
INSERT into class(class) VALUES("Graduation");
INSERT into class(class) VALUES("Post Graduation");
    