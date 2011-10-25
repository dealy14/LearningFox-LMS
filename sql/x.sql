# MySQL dump 8.16
#
# Host: localhost    Database: lt
#--------------------------------------------------------
# Server version	3.23.42

#
# Table structure for table 'course'
#

DROP TABLE IF EXISTS course;
CREATE TABLE course (
  modified date default '0000-00-00',
  created date default '0000-00-00',
  name varchar(50) NOT NULL default '',
  type varchar(20) NOT NULL default '',
  ID int(11) NOT NULL auto_increment,
  status enum('active','not active') default 'not active',
  description blob NOT NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

#
# Table structure for table 'course_history'
#

DROP TABLE IF EXISTS course_history;
CREATE TABLE course_history (
  last_usage date default '0000-00-00',
  start_date date default '0000-00-00',
  course_status varchar(40) NOT NULL default 'Incomplete',
  course_ID int(4) NOT NULL default '0',
  lesson int(4) NOT NULL default '0',
  topic int(4) NOT NULL default '0',
  last_au int(15) NOT NULL default '0',
  completed_aus varchar(250) NOT NULL default '',
  user_ID int(15) NOT NULL default '0',
  total_time varchar(50) NOT NULL default '',
  total_score int(3) NOT NULL default '0',
  start_time varchar(50) NOT NULL default '',
  ID int(11) NOT NULL auto_increment,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

#
# Table structure for table 'courses_r'
#

DROP TABLE IF EXISTS courses_r;
CREATE TABLE courses_r (
  course_name varchar(50) NOT NULL default '',
  course_ID int(11) NOT NULL default '0',
  lesson_name varchar(50) NOT NULL default '',
  lesson_ID int(11) NOT NULL default '0',
  ID int(11) NOT NULL auto_increment,
  lesson_order int(11) NOT NULL default '0',
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

#
# Table structure for table 'groups'
#

DROP TABLE IF EXISTS groups;
CREATE TABLE groups (
  name varchar(225) NOT NULL default '',
  sname varchar(225) NOT NULL default '',
  ID int(11) NOT NULL auto_increment,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

#
# Table structure for table 'lesson'
#

DROP TABLE IF EXISTS lesson;
CREATE TABLE lesson (
  modified date default '0000-00-00',
  created date default '0000-00-00',
  name varchar(50) NOT NULL default '',
  ID int(11) NOT NULL auto_increment,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

#
# Table structure for table 'lessons_r'
#

DROP TABLE IF EXISTS lessons_r;
CREATE TABLE lessons_r (
  lesson_name varchar(50) NOT NULL default '',
  lesson_ID int(11) NOT NULL default '0',
  topic_name varchar(50) NOT NULL default '',
  topic_ID int(11) NOT NULL default '0',
  ID int(11) NOT NULL auto_increment,
  topic_order int(11) NOT NULL default '0',
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

#
# Table structure for table 'objectives'
#

DROP TABLE IF EXISTS objectives;
CREATE TABLE objectives (
  course_ID varchar(50) NOT NULL default '',
  objective varchar(220) NOT NULL default '',
  link varchar(50) NOT NULL default '',
  ID int(11) NOT NULL auto_increment,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

#
# Table structure for table 'questions'
#

DROP TABLE IF EXISTS questions;
CREATE TABLE questions (
  question blob NOT NULL,
  qname varchar(225) NOT NULL default '',
  question_type enum('TF','MC','SA') NOT NULL default 'MC',
  choice_1 varchar(225) NOT NULL default '',
  choice_2 varchar(225) NOT NULL default '',
  choice_3 varchar(225) NOT NULL default '',
  choice_4 varchar(225) NOT NULL default '',
  correct_answ varchar(225) NOT NULL default '',
  ID int(11) NOT NULL auto_increment,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

#
# Table structure for table 'reg_form'
#

DROP TABLE IF EXISTS reg_form;
CREATE TABLE reg_form (
  field_name varchar(50) NOT NULL default '',
  status varchar(10) NOT NULL default '',
  forder int(5) NOT NULL default '0',
  stored enum('y','n') NOT NULL default 'n',
  ID int(11) NOT NULL auto_increment,
  display varchar(50) NOT NULL default '',
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

#
# Table structure for table 'students'
#

DROP TABLE IF EXISTS students;
CREATE TABLE students (
  date_of_reg date default '0000-00-00',
  date_of_mod date default '0000-00-00',
  date_of_hire date default '0000-00-00',
  fname varchar(50) NOT NULL default '',
  lname varchar(50) NOT NULL default '',
  mname varchar(10) NOT NULL default '',
  orgID varchar(50) default NULL,
  user_group varchar(70) NOT NULL default '',
  user_subgroup varchar(50) NOT NULL default '',
  date_of_birth varchar(10) NOT NULL default '',
  sex enum('m','f','na') NOT NULL default 'na',
  phone varchar(15) NOT NULL default '',
  email varchar(50) NOT NULL default '',
  address varchar(100) NOT NULL default '',
  city varchar(50) NOT NULL default '',
  state varchar(5) NOT NULL default '',
  zip varchar(20) NOT NULL default '',
  username varchar(50) NOT NULL default '',
  password varchar(50) NOT NULL default '',
  userlevel int(3) NOT NULL default '0',
  ID int(11) NOT NULL auto_increment,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

#
# Table structure for table 'subgroups'
#

DROP TABLE IF EXISTS subgroups;
CREATE TABLE subgroups (
  sub_name varchar(225) NOT NULL default '',
  sub_sname varchar(225) NOT NULL default '',
  ID int(11) NOT NULL auto_increment,
  group_ID int(15) default NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

#
# Table structure for table 'tests'
#

DROP TABLE IF EXISTS tests;
CREATE TABLE tests (
  name varchar(225) NOT NULL default '',
  type varchar(30) NOT NULL default '',
  randomize enum('Y','N') NOT NULL default 'N',
  ID int(11) NOT NULL auto_increment,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

#
# Table structure for table 'tests_r'
#

DROP TABLE IF EXISTS tests_r;
CREATE TABLE tests_r (
  test_ID int(11) NOT NULL default '0',
  question_ID int(11) NOT NULL default '0',
  question_order int(11) NOT NULL default '0',
  ID int(11) NOT NULL auto_increment,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

#
# Table structure for table 'topic'
#

DROP TABLE IF EXISTS topic;
CREATE TABLE topic (
  modified date default '0000-00-00',
  created date default '0000-00-00',
  name varchar(50) NOT NULL default '',
  time_limit varchar(50) NOT NULL default '',
  time_req varchar(50) NOT NULL default '',
  topic_type varchar(50) NOT NULL default '',
  content_location enum('local','remote') NOT NULL default 'local',
  content_link varchar(50) NOT NULL default '',
  content blob NOT NULL,
  test_link int(11) NOT NULL default '0',
  ID int(11) NOT NULL auto_increment,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

