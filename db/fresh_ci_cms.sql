-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2020 at 09:56 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fresh_ci_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_panel_information`
--

CREATE TABLE `tbl_admin_panel_information` (
  `id` int(11) NOT NULL,
  `website_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prefix_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `developed_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `developer_website_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_one` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_one_width` int(11) DEFAULT NULL,
  `logo_one_height` int(11) DEFAULT NULL,
  `logo_two` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_two_width` int(11) DEFAULT NULL,
  `logo_two_height` int(11) DEFAULT NULL,
  `fav_icon` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fav_icon_width` int(11) DEFAULT NULL,
  `fav_icon_height` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_admin_panel_information`
--

INSERT INTO `tbl_admin_panel_information` (`id`, `website_name`, `prefix_title`, `website_title`, `developed_by`, `developer_website_link`, `logo_one`, `logo_one_width`, `logo_one_height`, `logo_two`, `logo_two_width`, `logo_two_height`, `fav_icon`, `fav_icon_width`, `fav_icon_height`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Dew Hunt', '|', 'Portfolio', 'Dew Hunt', 'http://www.dewhunt.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 4, '2020-07-09 00:50:32', 4, '2020-07-09 00:51:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_frontend_menu`
--

CREATE TABLE `tbl_frontend_menu` (
  `id` int(11) NOT NULL,
  `parent_menu` int(11) DEFAULT NULL,
  `menu_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `menu_status` tinyint(4) NOT NULL DEFAULT 1,
  `footer_menu_status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_frontend_menu`
--

INSERT INTO `tbl_frontend_menu` (`id`, `parent_menu`, `menu_name`, `menu_link`, `order_by`, `status`, `menu_status`, `footer_menu_status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, NULL, 'Version', 'home.index', 1, 1, 1, 1, 4, '2020-04-18 08:48:30', 4, '2020-04-18 09:53:16'),
(3, 1, 'Version - 1', 'Version1.add', 1, 1, 1, 1, 4, '2020-04-18 09:30:03', NULL, '2020-04-18 09:53:20'),
(4, NULL, 'Dew Hunt', 'dewhunt.com', 2, 1, 1, 1, 4, '2020-05-10 04:56:47', 4, '2020-09-11 03:48:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menus`
--

CREATE TABLE `tbl_menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_menu` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_icon` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_menus`
--

INSERT INTO `tbl_menus` (`id`, `parent_menu`, `menu_name`, `menu_link`, `menu_icon`, `order_by`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Dashboard', 'home', 'ti-layout-grid2', 1, '1', '2020-07-08 23:22:23', '2020-09-11 02:38:34'),
(2, '13', 'Menu', 'menu', 'ti-settings', 1, '1', NULL, NULL),
(3, '13', 'Users Role', 'user_role', 'ti-settings', 3, '1', '2020-03-03 13:48:57', '2020-03-15 06:02:37'),
(4, '13', 'Menu Action Type', 'menu_action_type', 'ti-settings', 2, '1', NULL, NULL),
(5, '13', 'User', 'user', 'ti-settings', 4, '1', '2020-03-14 02:06:15', '2020-03-15 06:02:33'),
(6, NULL, 'Front-End Management', '', 'ti-layout-grid2', 3, '1', '2020-04-16 09:54:08', '2020-07-08 23:25:14'),
(7, '6', 'Website Information', 'websiteInformation.index', 'ti-settings', 1, '1', '2020-04-16 10:43:15', '2020-04-16 10:43:15'),
(8, '6', 'Menus', 'frontEndMenu.index', 'ti-settings', 2, '1', '2020-04-18 08:17:03', '2020-04-18 08:17:03'),
(10, '6', 'Social Links', 'socialLink.index', 'ti-settings', 3, '1', '2020-04-18 10:14:20', '2020-04-18 10:14:20'),
(11, '6', 'Sliders', 'sliders.index', 'ti-settings', 4, '1', '2020-04-19 08:19:58', '2020-04-19 08:19:58'),
(12, '6', 'Pages', 'page.index', 'ti-settings', 5, '1', '2020-05-10 05:09:10', '2020-05-10 05:09:10'),
(13, NULL, 'User Management', '', 'ti-layout-grid2', 2, '1', NULL, '2020-07-08 23:25:07'),
(15, '13', 'Admin Information', 'admininformation', 'ti-layout-grid2', 5, '1', '2020-07-09 00:45:20', '2020-07-09 00:45:20'),
(16, NULL, 'No Sub Menu', 'NoSubMenu', 'ti-layout-grid2', 4, '1', NULL, NULL),
(17, NULL, 'Multi Level Menu', '', 'ti-layout-grid2', 5, '1', NULL, NULL),
(18, '17', 'Parent Menu 1', 'ParentMenuOne', 'ti-settings', 1, '1', NULL, NULL),
(19, '18', 'Child Menu 1', 'ChildMenuOne', 'ti-files', 1, '1', NULL, NULL),
(20, '18', 'Child Menu 2', 'ChildMenuTwo', 'ti-files', 2, '1', NULL, NULL),
(21, '17', 'Parent Menu 2', 'ParentMenuTwo', 'ti-settings', 2, '1', NULL, NULL),
(22, '21', 'Child Menu 3', 'ChildMenuThree', 'ti-files', 1, '1', NULL, NULL),
(23, '17', 'parent Menu 3', 'ParentMenuThree', 'ti-settings', 3, '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu_actions`
--

CREATE TABLE `tbl_menu_actions` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_menu_id` int(11) DEFAULT NULL,
  `menu_type` int(11) DEFAULT NULL,
  `action_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_link` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_menu_actions`
--

INSERT INTO `tbl_menu_actions` (`id`, `parent_menu_id`, `menu_type`, `action_name`, `action_link`, `order_by`, `status`, `created_at`, `updated_at`) VALUES
(2, 2, 1, 'Add New', 'menu/add/', 1, 1, NULL, NULL),
(3, 2, 2, 'Edit', 'menu/edit/', 2, 1, NULL, NULL),
(4, 2, 3, 'Status', 'menu/status/', 3, 1, NULL, NULL),
(5, 2, 8, 'View Menu Action', 'menu_action/index/', 4, 1, NULL, NULL),
(6, 2, 4, 'Delete', 'menu/delete/', 5, 1, NULL, NULL),
(7, 4, 1, 'Add New', 'menu_action_type/add/', 1, 1, NULL, NULL),
(8, 4, 2, 'Edit', 'menu_action_type/edit/', 2, 1, NULL, NULL),
(9, 4, 3, 'Status', 'menu_action_type/status/', 3, 1, NULL, NULL),
(10, 4, 4, 'Delete', 'menu_action_type/delete/', 4, 1, NULL, NULL),
(11, 3, 1, 'Add New', 'user_role/add/', 1, 1, '2020-03-06 23:37:18', '2020-03-06 23:37:18'),
(12, 3, 2, 'Edit', 'user_role/edit/', 2, 1, '2020-03-07 00:16:00', '2020-03-07 00:16:00'),
(13, 3, 5, 'Permission', 'user_role/permission/', 3, 1, '2020-03-07 00:17:25', '2020-03-07 00:17:25'),
(14, 3, 3, 'Status', 'user_role/status/', 4, 1, '2020-03-07 00:18:08', '2020-03-07 00:18:08'),
(15, 3, 4, 'Delete', 'user_role/delete/', 5, 1, '2020-03-07 00:18:22', '2020-03-07 00:18:22'),
(21, 5, 1, 'Add New', 'user/add/', 1, 1, '2020-03-14 02:06:39', '2020-03-14 02:06:39'),
(22, 5, 2, 'Edit', 'user/edit/', 2, 1, '2020-03-14 02:06:53', '2020-03-14 02:06:53'),
(23, 5, 8, 'View Profile', 'user/profile/', 4, 1, '2020-03-14 02:07:32', '2020-03-14 02:07:32'),
(24, 5, 6, 'Change Password', 'user/change_password/', 5, 1, '2020-03-14 02:07:57', '2020-03-14 02:07:57'),
(25, 5, 3, 'Status', 'user/status/', 7, 1, '2020-03-14 02:08:23', '2020-03-14 02:08:23'),
(26, 5, 4, 'Delete', 'user/delete/', 6, 1, '2020-03-14 02:08:35', '2020-03-14 02:08:35'),
(28, 7, 1, 'Add', 'websiteInformation.add', 1, 1, '2020-04-16 11:50:12', '2020-09-11 02:52:22'),
(29, 7, 2, 'Edit', 'websiteInformation.edit', 2, 1, '2020-04-16 11:50:28', '2020-04-16 11:50:28'),
(30, 8, 1, 'Add', 'frontEndMenu.add', 1, 1, '2020-04-18 08:18:00', '2020-04-18 08:18:00'),
(31, 8, 2, 'Edit', 'frontEndMenu.edit', 2, 1, '2020-04-18 08:18:14', '2020-04-18 08:18:14'),
(32, 8, 3, 'Status', 'frontEndMenu.status', 3, 1, '2020-04-18 08:20:33', '2020-04-18 08:20:33'),
(33, 8, 4, 'Delete', 'frontEndMenu.delete', 4, 1, '2020-04-18 08:20:48', '2020-04-18 08:20:48'),
(39, 10, 1, 'Add', 'socialLink.add', 1, 1, '2020-04-18 10:14:43', '2020-04-18 10:14:43'),
(40, 10, 2, 'Edit', 'socialLink.edit', 2, 1, '2020-04-18 10:14:54', '2020-04-18 10:14:54'),
(41, 10, 3, 'Status', 'socialLink.status', 3, 1, '2020-04-18 10:15:15', '2020-04-18 10:15:15'),
(42, 10, 4, 'Delete', 'socialLink.delete', 4, 1, '2020-04-18 10:15:32', '2020-04-18 10:15:32'),
(43, 11, 1, 'Add', 'sliders.add', 1, 1, '2020-04-19 08:20:24', '2020-04-19 08:20:24'),
(44, 11, 2, 'Edit', 'sliders.edit', 2, 1, '2020-04-19 08:20:39', '2020-04-19 08:20:39'),
(45, 11, 3, 'Status', 'sliders.status', 3, 1, '2020-04-19 08:20:59', '2020-04-19 08:20:59'),
(46, 11, 4, 'Delete', 'sliders.delete', 4, 1, '2020-04-19 08:21:14', '2020-04-19 08:21:14'),
(47, 12, 1, 'Add', 'page.add', 1, 1, '2020-05-10 05:09:46', '2020-05-10 05:09:46'),
(48, 12, 2, 'Edit', 'page.edit', 2, 1, '2020-05-10 05:09:58', '2020-05-10 05:09:58'),
(49, 12, 3, 'Status', 'page.status', 3, 1, '2020-05-10 05:10:22', '2020-05-10 05:10:22'),
(50, 12, 8, 'View Posts', 'post.index', 4, 1, '2020-05-10 05:11:48', '2020-05-10 05:11:48'),
(51, 12, 4, 'Delete', 'page.delete', 5, 1, '2020-05-10 05:12:01', '2020-05-10 05:12:01'),
(52, 15, 1, 'Add', 'admininformation/add/', 1, 1, '2020-07-09 00:45:42', '2020-07-09 00:45:42'),
(53, 15, 2, 'Edit', 'admininformation/edit/', 2, 1, '2020-07-09 00:45:50', '2020-07-09 00:45:50'),
(54, 16, 1, 'Add', 'nosubmenu/add/', 1, 1, NULL, NULL),
(55, 16, 2, 'Edit', 'nosubmenu/edit/', 2, 1, NULL, NULL),
(56, 19, 1, 'Add', 'childmenu/add', 1, 1, NULL, NULL),
(57, 19, 2, 'Edit', 'childmenu/edit/', 2, 1, NULL, NULL),
(58, 5, 5, 'Reject Permission', 'user/reject_permission/', 3, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu_action_type`
--

CREATE TABLE `tbl_menu_action_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_menu_action_type`
--

INSERT INTO `tbl_menu_action_type` (`id`, `name`, `action_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Add', 1, 1, '2020-03-05 13:42:26', '2020-09-11 02:52:39'),
(2, 'Edit', 2, 1, '2020-03-05 13:43:02', '2020-03-05 13:43:02'),
(3, 'Publication Status', 3, 1, '2020-03-05 13:49:41', '2020-03-05 13:49:41'),
(4, 'Delete', 4, 1, '2020-03-05 13:51:00', '2020-03-05 13:51:00'),
(6, 'Permission', 5, 1, '2020-03-06 02:11:00', '2020-03-06 02:11:00'),
(7, 'Change Password', 6, 1, '2020-03-06 02:11:38', '2020-03-06 02:12:58'),
(8, 'View PopUp', 7, 1, '2020-03-06 02:11:59', '2020-03-06 02:11:59'),
(9, 'View', 8, 1, '2020-03-06 02:12:09', '2020-03-06 02:12:09'),
(10, 'Shipping Status', 9, 1, '2020-03-06 02:12:20', '2020-03-06 02:12:20'),
(11, 'Product List', 10, 1, '2020-03-06 02:12:28', '2020-03-06 02:12:28'),
(12, 'View PDF', 11, 1, '2020-03-06 02:12:39', '2020-03-06 02:12:39');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pages`
--

CREATE TABLE `tbl_pages` (
  `id` int(11) NOT NULL,
  `frontend_menu_id` int(11) DEFAULT NULL,
  `page_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_pages`
--

INSERT INTO `tbl_pages` (`id`, `frontend_menu_id`, `page_name`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 4, 'Dew Hunt', 1, 4, '2020-05-10 04:56:47', 4, '2020-09-11 04:14:16'),
(2, 4, 'Page One', 1, 4, '2020-05-10 05:42:32', 4, '2020-05-10 06:03:53'),
(4, 1, 'Version Page One', 1, 4, '2020-05-10 06:08:42', NULL, '2020-05-10 06:08:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_password_resets`
--

CREATE TABLE `tbl_password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_posts`
--

CREATE TABLE `tbl_posts` (
  `id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT NULL,
  `post_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inner_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url_link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `inner_image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inner_width` int(11) DEFAULT NULL,
  `inner_height` int(11) DEFAULT NULL,
  `meta_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keyword` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_posts`
--

INSERT INTO `tbl_posts` (`id`, `page_id`, `post_name`, `title`, `inner_title`, `description`, `url_link`, `icon`, `image`, `width`, `height`, `inner_image`, `inner_width`, `inner_height`, `meta_title`, `meta_keyword`, `meta_description`, `order_by`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(3, 4, 'Post One', 'Post For Vision Page', 'Inner Post For Vision Page', '<h3><span style=\"font-family: &quot;Comic Sans MS&quot;;\"><b><font color=\"#ff0000\">Description for Vision Page.</font></b></span><b style=\"background-color: rgb(255, 255, 255);\"><span style=\"font-family: &quot;Comic Sans MS&quot;;\"></span></b></h3>', 'Link for Vision Page', 'Icon For Vision Page', 'public/uploads/post_images/15941214_1648336092137702_5654391025677692098_n_172610808459.jpg', NULL, NULL, 'public/uploads/post_images/91358904_2953446438056905_333599395599613952_o_19832201615.jpg', NULL, NULL, 'Meta Title for Vision Page', 'Meta,Keyaword', 'Meta Description', 1, 1, 4, '2020-05-26 18:43:20', NULL, '2020-05-26 18:43:20'),
(4, 1, 'Dew Post', 'Dew Hunt Post', 'Dew Hunt Inner Post', '<blockquote class=\"blockquote\"><b>Dew Hunt Description.</b></blockquote>', NULL, 'Dew Hunt Icon', 'public/uploads/post_images/91349259_246886026467370_5892588859736195072_o_83553817927.jpg', 500, 400, 'public/uploads/post_images/91358904_2953446438056905_333599395599613952_o_65946152893.jpg', 600, 300, 'Dew Hunt', 'Dew Hunt', 'Description', 1, 1, 4, '2020-05-26 18:48:56', NULL, '2020-09-11 04:10:23'),
(5, 2, 'Page One Post', 'Page One title', 'Page One Inner Title', '<p>Page One Description</p>', 'Link for Page One', 'Icon For Page One', NULL, NULL, NULL, NULL, NULL, NULL, 'Meta Title for Page One', 'Page,One', 'Meta Description for Page One', 1, 1, 4, '2020-06-06 03:27:13', NULL, '2020-06-06 03:27:13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sliders`
--

CREATE TABLE `tbl_sliders` (
  `id` int(11) NOT NULL,
  `first_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `second_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `third_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keyword` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_sliders`
--

INSERT INTO `tbl_sliders` (`id`, `first_title`, `second_title`, `third_title`, `description`, `image`, `width`, `height`, `link`, `meta_title`, `meta_keyword`, `meta_description`, `order_by`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Title - 1', 'Title - 2', 'Title - 3', '<p>Slider Short Description.</p>', 'public/uploads/slider_image/67081606_2571169809589456_136986895279194112_n_132422349083_6137491555.jpg', 250, 150, 'link', 'meta title', 'meta,keyword', 'meta description.', 1, 1, 4, '2020-04-23 10:49:57', NULL, '2020-09-11 03:59:54');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_social_links`
--

CREATE TABLE `tbl_social_links` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_social_links`
--

INSERT INTO `tbl_social_links` (`id`, `name`, `icon`, `link`, `status`, `order_by`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(3, 'Facebook', 'fa fa-facebook-f', 'https://www.facebook.com/', 1, 1, 4, '2019-12-01 05:54:34', NULL, '2020-09-11 03:57:00'),
(4, 'Twiteer', 'fa fa-twitter', 'https://twitter.com', 1, 2, NULL, '2019-12-01 05:56:55', NULL, '2020-04-18 10:38:01'),
(5, 'whatsapp', 'fa fa-whatsapp', 'https://www.whatsapp.com/', 1, 3, NULL, '2020-01-11 04:12:44', NULL, '2020-09-11 03:56:39'),
(6, 'Linkdin', 'fa fa-linkedin', 'https://bd.linkedin.com/', 0, 4, NULL, '2020-01-11 04:13:04', NULL, '2020-03-02 00:02:23'),
(7, 'Instagram', 'fa fa-instagram', 'https://www.instagram.com/', 0, 5, NULL, '2020-01-11 04:13:29', NULL, '2020-03-02 00:02:25'),
(8, 'Google Plus', 'fa fa-google-plus-g', 'http://facebook.com/', 0, 6, NULL, '2020-02-11 04:47:23', NULL, '2020-03-02 00:02:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `name`, `email`, `user_name`, `image`, `role`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'Admin', 'admin@gmail.com', 'Admin', '/public/uploads/user_images/avatar7_20165942041.png', 2, '8cb2237d0679ca88db6464eac60da96345513964', 1, 'HftBsS0WaFhNaeki9GEnbTOdo99h14G9dS1WtBq9AJJkzUuSyNKsUxMufhEx', '2019-04-17 01:04:35', '2020-09-11 03:23:42'),
(7, 'Jisan Ahmed', 'jisanahmed06@gmail.com', 'jisan', '/public/uploads/user_images/images_21444773304.jpg', 3, '8cb2237d0679ca88db6464eac60da96345513964', 1, NULL, '2019-08-30 21:43:55', '2019-11-26 22:25:40'),
(11, 'Shamim', 'shamim@gmail.com', 'shamim', '/public/uploads/user_images/img00.jpg', 3, '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_roles`
--

CREATE TABLE `tbl_user_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_role` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `permission` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_permission` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_user_roles`
--

INSERT INTO `tbl_user_roles` (`id`, `name`, `parent_role`, `level`, `order_by`, `status`, `permission`, `action_permission`, `created_at`, `updated_at`) VALUES
(2, 'Super Admin', NULL, 1, 0, 1, '1,6,7,8,10,11,12,2,3,4,5,15', '28,29,30,31,32,33,39,40,41,42,43,44,45,46,47,48,49,50,51,2,3,4,5,6,11,12,13,14,15,7,8,9,10,21,22,23,24,26,25,52,53', '2019-04-17 00:50:05', '2020-07-09 00:46:03'),
(3, 'Admin', 2, 1, NULL, 1, '1,16', '54,55,24', '2019-04-17 00:52:54', '2020-09-11 03:36:59'),
(4, 'User', NULL, 1, NULL, 1, '1', '', '2020-03-07 00:49:33', '2020-07-09 00:35:23'),
(5, 'Manager', NULL, NULL, 4, 1, '1,6,7', '28,29', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_website_information`
--

CREATE TABLE `tbl_website_information` (
  `id` int(11) NOT NULL,
  `website_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prefix_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `developed_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `developer_website_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_one` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_two` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_three` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_one` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_two` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fav_icon` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keyword` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_website_information`
--

INSERT INTO `tbl_website_information` (`id`, `website_name`, `prefix_title`, `website_title`, `website_link`, `developed_by`, `developer_website_link`, `phone_one`, `phone_two`, `phone_three`, `logo_one`, `logo_two`, `fav_icon`, `meta_title`, `meta_keyword`, `meta_description`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Dew Hunt', '|', 'Portfolio', 'http://www.dewhunt.com', 'Dew Hunt', 'http://www.dewhunt.com', '01317243494', NULL, NULL, 'public/uploads/site_logo/logo1/apollo-beast-making-of-2_193381422103.jpg', 'public/uploads/site_logo/logo2/Apollo-Tyres-Beast-Kampagne_188041158179.jpg', 'public/uploads/site_logo/fav_icon/67081606_2571169809589456_136986895279194112_n_38406452410.jpg', 'meta title', NULL, 'meta description', 1, 4, '2020-04-17 08:33:15', NULL, '2020-07-09 00:43:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin_panel_information`
--
ALTER TABLE `tbl_admin_panel_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_frontend_menu`
--
ALTER TABLE `tbl_frontend_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_menus`
--
ALTER TABLE `tbl_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_menu_actions`
--
ALTER TABLE `tbl_menu_actions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_menu_action_type`
--
ALTER TABLE `tbl_menu_action_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pages`
--
ALTER TABLE `tbl_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_password_resets`
--
ALTER TABLE `tbl_password_resets`
  ADD KEY `password_resets_email_index` (`email`(191));

--
-- Indexes for table `tbl_posts`
--
ALTER TABLE `tbl_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sliders`
--
ALTER TABLE `tbl_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_social_links`
--
ALTER TABLE `tbl_social_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `tbl_user_roles`
--
ALTER TABLE `tbl_user_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_website_information`
--
ALTER TABLE `tbl_website_information`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin_panel_information`
--
ALTER TABLE `tbl_admin_panel_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_frontend_menu`
--
ALTER TABLE `tbl_frontend_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_menus`
--
ALTER TABLE `tbl_menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_menu_actions`
--
ALTER TABLE `tbl_menu_actions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tbl_menu_action_type`
--
ALTER TABLE `tbl_menu_action_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_pages`
--
ALTER TABLE `tbl_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_posts`
--
ALTER TABLE `tbl_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_sliders`
--
ALTER TABLE `tbl_sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_social_links`
--
ALTER TABLE `tbl_social_links`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_user_roles`
--
ALTER TABLE `tbl_user_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_website_information`
--
ALTER TABLE `tbl_website_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
