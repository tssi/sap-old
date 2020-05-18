-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 18, 2020 at 08:25 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sap_200518`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` char(2) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `alias` varchar(10) DEFAULT NULL,
  `esp` decimal(6,2) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `alias`, `esp`, `order`, `created`, `modified`) VALUES
('GS', 'G.School', 'Grade School', 'GS', '2017.00', 4, '2018-02-12 16:18:47', '2018-10-18 08:12:03'),
('HS', 'H.School', 'High School', 'HS', '2017.00', 1, '2018-02-12 16:19:06', '2018-10-18 08:12:03'),
('PS', 'P.School', 'Pre School', 'PS', '2017.00', 3, '2018-02-12 16:18:27', '2018-10-18 08:12:03'),
('SH', 'S.High', 'Senior HS', 'SH', '2017.00', 2, '2018-02-12 16:19:41', '2018-10-18 08:12:03');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_lists`
--

CREATE TABLE `maintenance_lists` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `path` varchar(30) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `maintenance_lists`
--

INSERT INTO `maintenance_lists` (`id`, `name`, `description`, `path`, `order`, `created`, `modified`) VALUES
(1, 'Program', 'List of Programs', 'programs', 3, '2018-06-21 10:09:31', '2018-06-21 10:09:31'),
(3, 'Department', 'List of Departments', 'educ_levels', NULL, '2018-06-21 10:57:29', '2018-06-21 19:50:37'),
(4, 'Modules', 'List of Modules', 'modules', NULL, '2018-06-21 19:44:03', '2018-06-21 19:44:03'),
(5, 'Maintenance', 'List of Maintenance', 'maintenance_lists', NULL, '2018-06-21 19:44:26', '2018-06-21 19:44:26'),
(6, 'User Grant', 'List of User Grants', 'user_grants', NULL, '2018-06-21 19:51:34', '2018-06-21 19:51:34'),
(7, 'System Default', 'List of System Defaults', 'master_configs', NULL, '2018-06-21 21:04:59', '2018-06-21 21:05:37'),
(8, 'Periods', 'List of Grading Periods', 'master_periods', NULL, '2018-06-21 21:08:09', '2018-06-21 21:08:09'),
(9, 'User Type', 'List of User Types', 'user_types', NULL, '2018-07-02 16:40:06', '2018-07-02 16:40:06'),
(10, 'Rubrics', 'List Of Rubrics', 'rubrics', 10, '2018-08-24 04:43:41', '2018-08-24 04:43:41'),
(11, 'Rubric Items', 'List of Rubric Items', 'rubric_items', NULL, '2018-08-24 04:44:57', '2018-08-24 04:44:57'),
(12, 'Rubric Rules', 'List of Rubric Rules', 'rubric_rules', NULL, '2018-08-24 04:45:23', '2018-08-24 04:45:23'),
(14, 'Calendars', 'List Of Calendars', 'calendars', NULL, '2018-08-24 04:46:40', '2018-08-24 04:46:40'),
(15, 'Curriculums', 'List of Curriculums', 'curriculums', NULL, '2018-08-24 04:49:20', '2018-08-24 04:49:20'),
(16, 'Curriculum Details', 'List of Curriculum Details', 'curriculum_details', NULL, '2018-08-24 04:51:27', '2018-08-24 04:51:27'),
(17, 'School Days', 'List of School Days', 'school_days', NULL, '2018-08-28 09:41:55', '2018-08-28 09:41:55'),
(18, 'Section Curriculum', 'List of Curriculums for Sections', 'curriculum_sections', NULL, '2018-08-29 06:05:06', '2018-08-29 06:05:06'),
(19, 'Users', 'List of Users', 'users', NULL, '2018-09-26 02:10:02', '2018-09-26 02:10:02'),
(22, 'Signatories', 'List of Signatories', 'master_signatories', 1, '2018-10-08 05:34:58', '2018-10-08 05:34:58'),
(26, 'Letter Grades', 'List of Letter Grades', 'letter_grades', NULL, '2018-10-08 05:56:16', '2018-10-08 05:56:16'),
(27, 'Report Card', 'Report Card', 'registrar/report_card', NULL, '2019-03-27 14:44:43', '2019-03-27 14:44:43'),
(28, 'Titles', 'List of titles', 'master_titles', NULL, '2020-05-11 17:48:45', '2020-05-11 17:48:45');

-- --------------------------------------------------------

--
-- Table structure for table `master_configs`
--

CREATE TABLE `master_configs` (
  `id` int(11) NOT NULL,
  `sys_key` char(20) DEFAULT NULL,
  `sys_value` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_configs`
--

INSERT INTO `master_configs` (`id`, `sys_key`, `sys_value`, `created`, `modified`) VALUES
(1, 'SCHOOL_NAME', 'PROTOTYPE', '2018-06-21 06:21:23', '2018-06-21 06:21:23'),
(2, 'SCHOOL_ALIAS', 'DU', '2018-06-21 06:21:36', '2018-06-21 06:21:36'),
(3, 'SCHOOL_LOGO', 'logo.jpg', '2018-06-21 06:21:51', '2018-06-21 06:21:51'),
(4, 'SCHOOL_ADDRESS', 'STO.TOMAS BATANGAS', '2018-06-21 06:22:05', '2018-06-21 06:22:05'),
(5, 'START_SY', '2013', '2018-06-21 06:22:18', '2018-06-21 06:22:18'),
(6, 'ACTIVE_SY', '2019', '2018-06-21 06:22:28', '2018-06-21 06:22:28'),
(7, 'DEFAULT_', '{\r\n   \"PRECISION\":0,\r\n   \"FLOOR_GRADE\":70,\r\n   \"CEIL_GRADE\":100,\r\n   \"PERIOD\":{\r\n      \"id\":3,\r\n      \"key\":\"THRDGRDG\",\r\n      \"alias\":{\r\n         \"short\":\"MID\",\r\n         \"full\":\"Midterm\"\r\n      }\r\n   },\r\n   \"SEMESTER\":{\r\n      \"id\":45,\r\n      \"key\":\"SCNDSEMS\",\r\n      \"alias\":{\r\n         \"short\":\"2st\",\r\n         \"full\":\"Second Sem\"\r\n      }\r\n   }\r\n}', NULL, NULL),
(8, 'SCHOOL_ID', 'DU', NULL, NULL),
(9, 'ACTIVE_DEPT', 'SH', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_modules`
--

CREATE TABLE `master_modules` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `link` varchar(50) DEFAULT NULL,
  `is_parent` tinyint(1) DEFAULT NULL,
  `is_child` tinyint(1) DEFAULT NULL,
  `sequence` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` varchar(10) DEFAULT NULL,
  `modified_by` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_modules`
--

INSERT INTO `master_modules` (`id`, `name`, `link`, `is_parent`, `is_child`, `sequence`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(1, 'Adviser', '', 1, 0, 1, '2018-06-21 05:11:52', '2020-05-11 17:31:04', NULL, NULL),
(2, 'Conso', 'advisory/grade', 0, 1, 7, '2018-06-21 05:19:28', '2020-05-11 17:31:04', '', ''),
(3, 'Conduct', 'advisory/conduct', 0, 1, 4, '2018-06-21 05:20:05', '2020-05-11 17:31:04', '', ''),
(4, 'Attendance', 'advisory/attendance', 0, 1, 2, '2018-06-21 05:20:33', '2020-05-11 17:31:04', '', ''),
(5, 'Class List', '', 1, 0, 9, '2018-06-21 05:21:25', '2020-05-11 17:31:04', '', ''),
(6, 'Block', 'classlist/block', 0, 1, 10, '2018-06-21 05:21:52', '2020-05-11 17:31:04', '', ''),
(7, 'Irregular', 'classlist/irregular', 0, 1, 11, '2018-06-21 05:22:16', '2020-05-11 17:31:04', '', ''),
(8, 'Club Members', 'classlist/club_members', 0, 1, 13, '2018-06-21 05:25:41', '2020-05-11 17:31:04', '', ''),
(9, 'Student', '', 1, 0, 14, '2018-06-21 05:26:48', '2020-05-11 17:31:04', '', ''),
(10, 'Student Info', 'student/student_info', 0, 1, 15, '2018-06-21 05:27:28', '2020-05-11 17:31:04', '', ''),
(11, 'Academic History', 'student/academic_history', 0, 1, 16, '2018-06-21 05:28:01', '2020-05-11 17:31:04', '', ''),
(12, 'Principal', '', 1, 0, 17, '2018-06-21 05:28:33', '2020-05-11 17:31:04', '', ''),
(13, 'Calendar', 'principal/calendar', 0, 1, 18, '2018-06-21 05:29:04', '2020-05-11 17:31:04', '', ''),
(14, 'Curriculum', 'principal/curriculum', 0, 1, 19, '2018-06-21 05:29:41', '2020-05-11 17:31:04', '', ''),
(15, 'Conduct Rubrics', 'principal/rubrics', 0, 1, 20, '2018-06-21 05:30:32', '2020-05-11 17:31:04', '', ''),
(16, 'Subject/Club List', 'principal/subject_club_list', 0, 1, 21, '2018-06-21 05:31:00', '2020-05-11 17:31:04', '', ''),
(17, 'Faculty', '', 1, 0, 29, '2018-06-21 05:31:31', '2020-05-11 17:31:04', '', ''),
(18, 'Advisory', 'faculty/advisory_loads', 0, 1, 30, '2018-06-21 05:32:04', '2020-05-11 17:31:04', '', ''),
(19, 'Teacher Info', 'faculty/teacher_info', 0, 1, 31, '2018-06-21 05:32:44', '2020-05-11 17:31:04', '', ''),
(20, 'Admin', '', 1, 0, 37, '2018-06-21 05:33:05', '2020-05-11 17:31:04', '', ''),
(21, 'List Maintenance', 'maintenance/list', 0, 1, 39, '2018-06-21 05:33:36', '2020-05-11 17:31:04', '', ''),
(22, 'Curriculum One', 'principal/curriculum_one', 0, 1, 40, '2018-06-21 05:33:55', '2020-05-11 17:31:04', '', ''),
(23, 'Teaching Loads', 'faculty/teaching_loads', 0, 1, 33, '2018-10-09 04:22:54', '2020-05-11 17:31:04', NULL, NULL),
(24, 'Recordbook', 'faculty/recordbook', 0, 1, 34, '2018-10-30 04:38:08', '2020-05-11 17:31:04', NULL, NULL),
(25, 'Scholastic Records', 'advisory/scholastic_record', 0, 1, 6, '2018-12-05 10:25:41', '2020-05-11 17:31:04', NULL, NULL),
(26, 'Report Card', 'registrar/report_card', 0, 1, 44, NULL, '2020-05-11 17:31:04', NULL, NULL),
(27, 'Registrar', '', 1, 0, 43, '2019-03-27 14:47:05', '2020-05-11 17:31:04', NULL, NULL),
(28, 'DepEd Forms', 'registrar/deped_forms', 0, 1, 45, '2019-04-26 10:45:13', '2020-05-11 17:31:04', NULL, NULL),
(29, 'Posting Status', 'registrar/posting_status', 0, 1, 46, '2019-04-26 10:45:34', '2020-05-11 17:31:04', NULL, NULL),
(30, 'File Uploads', 'maintenance/upload', 0, 1, 32, '2019-10-09 05:28:33', '2020-05-11 17:31:04', NULL, NULL),
(31, 'Teacher', NULL, 1, 0, 41, '2019-10-21 12:25:47', '2020-05-11 17:31:04', NULL, NULL),
(32, 'File Upload', 'maintenance/upload', 0, 1, 42, '2019-10-21 12:25:58', '2020-05-11 17:31:04', NULL, NULL),
(33, 'Account Info', 'faculty/account_info', 0, 1, 36, '2019-10-21 13:07:34', '2020-05-11 17:31:04', NULL, NULL),
(34, 'Templates', 'principal/templates', 0, 1, 26, '2019-11-05 19:34:47', '2020-05-11 17:31:04', NULL, NULL),
(35, 'Attendance Master', 'advisory/attendance_master', 0, 1, 3, '2019-12-03 18:56:57', '2020-05-11 17:31:04', NULL, NULL),
(37, 'Recorbook Master', 'faculty/recordbook_master_042800', 0, 1, 35, '2019-12-03 20:53:00', '2020-05-11 17:31:04', NULL, NULL),
(38, 'Conso Master', 'advisory/grade_master_042800', 0, 1, 8, '2019-12-05 21:09:08', '2020-05-11 17:31:04', NULL, NULL),
(39, 'Conduct Master', 'advisory/conduct_master', 0, 1, 5, '2019-12-12 18:59:24', '2020-05-11 17:31:04', NULL, NULL),
(40, 'Remedial', 'principal/remedial', 0, 1, 22, '2020-01-15 01:06:34', '2020-05-11 17:31:04', NULL, NULL),
(41, 'Honor Students', 'principal/honor_students', 0, 1, 23, NULL, '2020-05-11 17:31:04', NULL, NULL),
(42, 'Grade Report', 'registrar/report_card_view', 0, 1, 27, '2020-02-27 02:56:06', '2020-05-11 17:31:04', NULL, NULL),
(43, 'Wrong Rankings', 'principal/ranking', 0, 1, 25, '2020-02-27 06:11:52', '2020-05-11 17:31:04', NULL, NULL),
(44, 'Student Rankings', 'principal/all_ranking', 0, 1, 24, '2020-03-10 03:06:33', '2020-05-11 17:31:04', NULL, NULL),
(45, 'Templates', 'principal/templates', 0, 1, 28, '2020-04-20 10:37:46', '2020-05-11 17:31:04', NULL, NULL),
(46, 'Special Subjects', 'classlist/special_subjects', 0, 1, 12, '2020-05-08 17:46:20', '2020-05-11 17:31:04', NULL, NULL),
(47, 'User Managmenet', 'maintenance/user_management', 0, 1, 38, '2020-05-11 17:30:40', '2020-05-11 17:31:04', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_periods`
--

CREATE TABLE `master_periods` (
  `id` char(2) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `alias` varchar(50) DEFAULT NULL,
  `key` varchar(8) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_periods`
--

INSERT INTO `master_periods` (`id`, `name`, `description`, `alias`, `key`, `created`, `modified`) VALUES
('1', 'Midterm First Sem', '', '{\"short\":\"MID\",\"full\":\"Midterm\"}', 'FRSTGRDG', NULL, NULL),
('2', 'Finals First Sem', NULL, '{\"short\":\"FIN\",\"full\":\"Finals\"}', 'SCNDGRDG', NULL, NULL),
('3', 'Midterm Second Sem', NULL, '{\"short\":\"MID\",\"full\":\"Midterm\"}', 'THRDGRDG', NULL, NULL),
('4', 'Finals Second Sem', NULL, '{\"short\":\"FIN\",\"full\":\"Finals\"}', 'FRTHGRDG', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_type_id` char(5) DEFAULT NULL,
  `username` varchar(15) DEFAULT NULL,
  `department_id` char(2) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `status` char(5) DEFAULT NULL,
  `login_failed` int(11) DEFAULT NULL,
  `ip_failed` varchar(20) DEFAULT NULL,
  `login_success` int(11) DEFAULT NULL,
  `ip_success` varchar(20) DEFAULT NULL,
  `password_changed` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type_id`, `username`, `department_id`, `password`, `status`, `login_failed`, `ip_failed`, `login_success`, `ip_success`, `password_changed`, `created`, `modified`) VALUES
(1, 'admin', 'admin', NULL, '4ce71e1333aa3530897db9193d218dd8196cfe8f', 'ACTIV', 1, '::1', NULL, '', '2020-05-18 08:16:00', '2020-05-18 08:16:55', '2020-05-18 08:16:55');

-- --------------------------------------------------------

--
-- Table structure for table `user_grants`
--

CREATE TABLE `user_grants` (
  `id` int(11) NOT NULL,
  `user_type_id` char(5) DEFAULT NULL,
  `master_module_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_grants`
--

INSERT INTO `user_grants` (`id`, `user_type_id`, `master_module_id`, `created`, `modified`) VALUES
(1, 'admin', 1, '2018-06-21 05:27:37', '2018-06-21 05:27:37'),
(2, 'admin', 2, '2018-06-21 20:06:20', '2018-06-21 20:06:20'),
(3, 'admin', 3, '2018-06-21 20:06:28', '2018-06-21 20:06:28'),
(4, 'admin', 4, '2018-06-21 20:06:40', '2018-06-21 20:06:40'),
(5, 'admin', 5, '2018-06-21 20:06:46', '2018-06-21 20:06:46'),
(6, 'admin', 6, '2018-06-21 20:35:03', '2018-06-21 20:35:03'),
(8, 'admin', 20, '2018-06-21 20:37:19', '2018-06-21 20:37:19'),
(9, 'admin', 21, '2018-06-21 20:37:27', '2018-06-21 20:37:27'),
(10, 'admin', 7, '2018-08-17 04:09:27', '2018-08-17 04:09:27'),
(11, 'admin', 8, '2018-08-17 04:09:40', '2018-08-17 04:10:47'),
(12, 'admin', 12, '2018-08-22 04:11:56', '2018-08-22 04:11:56'),
(13, 'admin', 16, '2018-08-22 04:12:04', '2018-08-22 04:12:04'),
(14, 'admin', 14, '2018-08-24 04:52:31', '2018-08-24 04:52:31'),
(15, 'admin', 15, '2018-08-24 04:52:47', '2018-08-24 04:52:47'),
(16, 'admin', 13, '2018-08-24 04:52:53', '2018-08-24 04:52:53'),
(17, 'admin', 17, '2018-08-29 03:51:15', '2018-08-29 03:51:15'),
(18, 'admin', 18, '2018-08-29 03:51:30', '2018-08-29 03:51:30'),
(19, 'admin', 2, '2018-08-31 03:33:38', '2018-08-31 03:33:38'),
(27, 'admin', 9, '2018-09-20 03:31:24', '2018-09-20 03:31:24'),
(28, 'admin', 10, '2018-09-20 03:31:30', '2018-09-20 03:31:30'),
(29, 'admin', 19, '2018-10-09 04:21:15', '2018-10-09 04:21:15'),
(30, 'admin', 23, '2018-10-09 06:52:37', '2018-10-09 06:52:37'),
(33, 'admin', 25, '2018-12-05 10:26:56', '2018-12-05 10:26:56'),
(34, 'admin', 27, '2019-04-26 10:44:29', '2019-04-26 10:44:29'),
(35, 'admin', 26, '2019-04-26 10:46:10', '2019-04-26 10:46:10'),
(36, 'admin', 29, '2019-04-26 10:46:29', '2019-04-26 10:46:29'),
(37, 'admin', 28, '2019-04-26 10:46:33', '2019-04-26 10:46:33'),
(38, 'admin', 30, '2019-10-09 05:29:28', '2019-10-09 05:29:28'),
(43, 'tcher', 31, '2019-10-21 12:30:07', '2019-10-21 12:30:07'),
(44, 'tcher', 32, '2019-10-21 12:30:14', '2019-10-21 12:30:14'),
(45, 'tcher', 33, '2019-10-21 13:08:34', '2019-10-21 13:08:34'),
(46, 'demo', 17, '2019-11-05 19:35:55', '2019-11-05 19:35:55'),
(47, 'demo', 24, '2019-11-05 19:36:12', '2019-11-05 19:36:12'),
(48, 'demo', 12, '2019-11-05 19:36:20', '2019-11-05 19:36:20'),
(49, 'demo', 34, '2019-11-05 19:36:36', '2019-11-05 19:36:36'),
(51, 'tcher', 17, '2019-11-12 15:54:57', '2019-11-12 15:54:57'),
(54, 'staff', 5, '2019-11-14 21:29:03', '2019-11-14 21:29:03'),
(55, 'staff', 7, '2019-11-14 21:29:10', '2019-11-14 21:29:10'),
(61, 'staff', 31, '2019-11-14 21:36:20', '2019-11-14 21:36:20'),
(62, 'staff', 33, '2019-11-14 21:36:37', '2019-11-14 21:36:37'),
(63, 'tcher', 1, '2019-11-18 21:03:27', '2019-11-18 21:03:27'),
(64, 'tcher', 2, '2019-11-18 21:03:36', '2019-11-18 21:03:36'),
(66, 'staff', 17, '2019-11-24 21:36:53', '2019-11-24 21:36:53'),
(67, 'staff', 19, '2019-11-24 21:37:01', '2019-11-24 21:37:01'),
(68, 'staff', 23, '2019-11-24 21:37:15', '2019-11-24 21:37:15'),
(71, 'tcher', 3, '2019-11-26 20:52:04', '2019-11-26 20:52:04'),
(73, 'admin', 35, '2019-12-03 19:00:00', '2019-12-03 19:00:00'),
(74, 'admin', 37, '2019-12-03 20:55:08', '2019-12-03 20:55:08'),
(77, 'admin', 38, '2019-12-05 21:10:54', '2019-12-05 21:10:54'),
(82, 'atten', 1, '2019-12-11 10:37:03', '2019-12-11 10:37:03'),
(83, 'atten', 35, '2020-01-15 12:08:32', '2020-01-15 12:08:32'),
(85, 'atten', 31, '2019-12-11 13:23:57', '2019-12-11 13:23:57'),
(86, 'atten', 33, '2019-12-11 13:24:09', '2019-12-11 13:24:09'),
(88, 'admin', 39, '2019-12-12 19:01:20', '2019-12-12 19:01:20'),
(92, 'admin', 40, '2020-01-15 01:10:29', '2020-01-15 01:10:29'),
(95, 'admin', 41, '2020-02-05 05:04:37', '2020-02-05 05:04:37'),
(96, 'staff', 12, '2020-02-05 14:43:43', '2020-02-05 14:43:43'),
(97, 'staff', 41, '2020-02-05 14:43:46', '2020-02-05 14:43:58'),
(98, 'admin', 42, '2020-02-27 03:03:04', '2020-02-27 03:03:04'),
(100, 'admin', 44, '2020-03-10 03:08:14', '2020-03-10 03:08:14'),
(101, 'admin', 45, '2020-04-20 10:39:17', '2020-04-20 10:39:17'),
(111, 'tcher', 24, '2020-05-01 22:17:51', '2020-05-01 22:17:51'),
(112, 'admin', 46, '2020-05-08 17:48:22', '2020-05-08 17:48:22'),
(113, 'admin', 47, '2020-05-11 17:33:34', '2020-05-11 17:33:34');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` char(5) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `name`, `created`, `modified`) VALUES
('admin', 'Admin', '2017-02-12 01:23:45', '2017-02-12 01:23:45'),
('advsr', 'Adviser', '2018-02-22 03:03:48', '2018-02-22 03:03:48'),
('atten', 'Attendance Encoder', '2019-12-11 10:35:55', '2019-12-11 10:35:55'),
('clbad', 'Club Adviser', '2018-02-22 03:03:35', '2018-02-22 03:03:35'),
('dcoor', 'Department Coordinator', '2018-02-22 02:56:59', '2018-02-22 02:56:59'),
('demo', 'Demo', '2019-11-05 19:33:19', '2019-11-05 19:33:19'),
('guest', 'Guest', '2018-07-02 16:40:57', '2018-07-02 16:40:57'),
('itech', 'IT', '2018-02-22 02:58:36', '2018-02-22 02:58:36'),
('prncp', 'Principal', '2018-02-22 02:57:49', '2018-02-22 02:57:49'),
('rgstr', 'Registrar', '2018-02-22 02:59:06', '2018-07-02 16:40:47'),
('rstaf', 'Registrar Staff', '2020-03-03 08:21:01', '2020-03-03 08:21:01'),
('scoor', 'Subject Coordinator', '2018-02-22 02:56:41', '2018-02-22 02:56:41'),
('secre', 'Secretary', '2019-11-14 21:24:45', '2019-11-14 21:24:45'),
('staff', 'Staff', '2019-11-14 21:25:30', '2019-11-14 21:27:50'),
('tcher', 'Teacher', '2018-02-22 02:56:05', '2018-02-22 02:56:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maintenance_lists`
--
ALTER TABLE `maintenance_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_configs`
--
ALTER TABLE `master_configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_modules`
--
ALTER TABLE `master_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_periods`
--
ALTER TABLE `master_periods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_grants`
--
ALTER TABLE `user_grants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_grn_usr` (`user_type_id`),
  ADD KEY `FK_grn_mod` (`master_module_id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `maintenance_lists`
--
ALTER TABLE `maintenance_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `master_configs`
--
ALTER TABLE `master_configs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `master_modules`
--
ALTER TABLE `master_modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_grants`
--
ALTER TABLE `user_grants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
