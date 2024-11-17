-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 17, 2024 at 09:08 AM
-- Server version: 10.11.9-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u447740167_campushala_dem`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_quotes`
--

CREATE TABLE `app_quotes` (
  `AppQuotesId` int(100) NOT NULL,
  `AppQuoteName` longtext NOT NULL,
  `AppQuoteDate` varchar(25) NOT NULL,
  `AppQuoteStatus` varchar(10) NOT NULL,
  `AppQuotesCreatedBy` int(10) NOT NULL,
  `AppQuotesCreatedAt` varchar(25) NOT NULL,
  `AppQuotesUpdatedAt` varchar(25) NOT NULL,
  `AppQuotesUpdatedBy` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `AssetsId` int(100) NOT NULL,
  `AssetName` varchar(1000) NOT NULL,
  `AssetsImage` varchar(1000) NOT NULL,
  `AssetCategory` varchar(100) NOT NULL,
  `AssetModalNo` varchar(100) NOT NULL,
  `AssetSerialNo` varchar(100) NOT NULL,
  `AssetsCost` int(10) NOT NULL,
  `AssetPurchaseDate` varchar(40) NOT NULL,
  `AssetsDescription` varchar(1000) NOT NULL,
  `AssetsCreatedAt` varchar(40) NOT NULL,
  `AssetsUpdatedAt` varchar(40) NOT NULL,
  `AssetsCreatedBy` varchar(40) NOT NULL,
  `AssetsUpdatedBy` varchar(40) NOT NULL,
  `AssetsPurchaseReceipts` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assets_issued`
--

CREATE TABLE `assets_issued` (
  `AssetsMoveId` int(10) NOT NULL,
  `AssetsMainId` int(10) NOT NULL,
  `AssetsIssuedTo` int(10) NOT NULL,
  `AssetsIssueDate` varchar(20) NOT NULL,
  `AssetsIssueNotes` varchar(255) NOT NULL,
  `AssetsIssuedBy` int(10) NOT NULL,
  `AssetsIssueCreatedAt` varchar(20) NOT NULL,
  `AssetsIssueUpdatedAt` varchar(20) NOT NULL,
  `AssetsIssueStatus` varchar(100) NOT NULL,
  `AssetsIssueReturnedDate` varchar(100) NOT NULL,
  `AssetsIssueReturedTo` varchar(100) NOT NULL,
  `AssetsIssueReturnNotes` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bdes_primary_details`
--

CREATE TABLE `bdes_primary_details` (
  `bdes_id` int(11) NOT NULL,
  `bdes_first_name` varchar(255) NOT NULL,
  `bdes_last_name` varchar(255) NOT NULL,
  `bdes_phone_no` varchar(255) NOT NULL,
  `bdes_email_id` varchar(255) NOT NULL,
  `bdes_password` varchar(255) DEFAULT NULL,
  `bdes_address_line1` varchar(255) NOT NULL,
  `bdes_address_line2` varchar(255) NOT NULL,
  `bdes_city` varchar(255) NOT NULL,
  `bdes_state` varchar(255) NOT NULL,
  `bdes_country` varchar(255) NOT NULL,
  `bdes_zip` varchar(255) NOT NULL,
  `bdes_status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(255) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bdes_primary_details`
--

INSERT INTO `bdes_primary_details` (`bdes_id`, `bdes_first_name`, `bdes_last_name`, `bdes_phone_no`, `bdes_email_id`, `bdes_password`, `bdes_address_line1`, `bdes_address_line2`, `bdes_city`, `bdes_state`, `bdes_country`, `bdes_zip`, `bdes_status`, `created_at`, `created_by`, `update_at`, `updated_by`) VALUES
(1, 'shubham kumar', 'dubey', '9429008403', 'shubham@gmail.com', '$2y$10$f.didRVXi7h0hKHmbagg6uBd1QuG4aRFKIWSX2rIKBPU/4zVs/j9q', 'ram shubham', 'ghdsbfdh', 'noida', '1', 'India', '9842001', 0, '2023-07-15 10:33:52', '1', '2023-07-15 10:33:52', '1'),
(2, 'Selma', 'Campos', '+1 (454) 761-9756', 'kaju@mailinator.com', '$2y$10$t2BoQutX8IKoLU0Klv2KAu7241iOVy9GbtCAgkVpQ0vyzMa2pTLZW', '15 Milton Court', 'Est eum dolor quis e', 'Quis voluptate itaqu', 'Laborum anim sunt q', 'Bouvet Island', '68651', 1, '2023-07-15 10:35:48', '1', '2023-07-15 10:35:48', '1'),
(3, 'Remedios', 'Mosley', '+1 (266) 826-2686', 'rexav@mailinator.com', '$2y$10$5BilP/HXSFCnKxDfsJi75OZDXJzBSKk6HDMJ4OLlUudxIpoPsMRnW', '18 South Nobel Boulevard', 'Delectus cupidatat ', 'Dicta omnis laborum ', 'Dolorem consectetur ', 'Guyana', '19563', 1, '2023-07-19 15:43:05', '1', '2023-07-19 15:43:05', '1'),
(4, 'Manik', 'Bansal', '09874563210', 'irfan@gmail.com', '$2y$10$A5AT0/Z8b7vCkvgld5FO4uUBou9k/9hE4/9xG7BPDEMWl2zLqkSuK', 'hhh', 'hhhhu', 'uuui', 'iiuiu', 'India', '95595', 1, '2023-09-11 16:16:52', '1', '2023-09-11 16:16:52', '1'),
(5, 'Adrian', 'Moreno', '+1 (635) 933-9666', 'miticyv@mailinator.com', '$2y$10$G4IIfTEMsnP13Af4K54PGufnLutrNo2YB1KJa2laNYXNczePIHGN6', '18 West Milton Avenue', 'Delectus laborum P', 'Et aut id est odio ', 'Occaecat corporis qu', 'Peru', '41999', 1, '2023-09-13 12:24:30', '1', '2023-09-13 12:24:30', '1');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `bookingId` int(10) NOT NULL,
  `BookingAckCode` varchar(100) NOT NULL,
  `BookingCustomerName` varchar(100) NOT NULL,
  `BookingCustomerPhone` varchar(100) NOT NULL,
  `BookingForProject` varchar(100) NOT NULL,
  `BookingProjectPhase` varchar(100) NOT NULL,
  `BookingAmount` varchar(10) NOT NULL,
  `BookingPaymentMode` varchar(100) NOT NULL,
  `BookingPaymentSource` varchar(100) NOT NULL,
  `BookingPaymentRefNo` varchar(100) NOT NULL,
  `BookingPaymentDetails` varchar(100) NOT NULL,
  `BookingDate` varchar(100) NOT NULL,
  `BookingNotes` varchar(1000) NOT NULL,
  `BookingCreatedAt` varchar(40) NOT NULL,
  `BookingUpdatedAt` varchar(40) NOT NULL,
  `BookingCreatedBy` varchar(10) NOT NULL,
  `BookingTeamHeadId` varchar(10) NOT NULL,
  `BookingDirectSalePersonId` varchar(10) NOT NULL DEFAULT '1',
  `BookingBusinessHead` varchar(100) NOT NULL,
  `BookingStatus` varchar(100) NOT NULL,
  `BookingUpdatedBy` varchar(10) NOT NULL,
  `BookingMainCustomerId` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_refunds`
--

CREATE TABLE `booking_refunds` (
  `BookingRefundId` int(10) NOT NULL,
  `BookingMainId` int(10) NOT NULL,
  `BookingRefundMode` varchar(100) NOT NULL,
  `BookingRefundSource` varchar(100) NOT NULL,
  `BookingRefundRefNo` varchar(100) NOT NULL,
  `BookingRefundDetails` varchar(10000) NOT NULL,
  `BookingRefundedTo` varchar(100) NOT NULL,
  `BookingRefundDate` varchar(50) NOT NULL,
  `BookingRefundCreatedAt` varchar(50) NOT NULL,
  `BookingRefundUpdatedAt` varchar(50) NOT NULL,
  `BookingRefundBy` int(10) NOT NULL,
  `BookingRefundAmount` varchar(100) NOT NULL,
  `BookingRefundApproxClearingDate` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_refund_documents`
--

CREATE TABLE `booking_refund_documents` (
  `BookingRefundDocId` int(10) NOT NULL,
  `BookingRefundMainId` varchar(10) NOT NULL,
  `BookingRefundDocName` varchar(100) NOT NULL,
  `BookingRefundDocFile` varchar(1000) NOT NULL,
  `BookingRefundDocUploadedAt` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `ChatId` int(100) NOT NULL,
  `ChatRefId` varchar(100) NOT NULL,
  `ChatMainSenderId` varchar(10) NOT NULL,
  `ChatMainReceiverId` varchar(10) NOT NULL,
  `ChatOpenedAt` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_attachements`
--

CREATE TABLE `chat_attachements` (
  `ChatAttachId` int(10) NOT NULL,
  `ChatMsgMainId` int(10) NOT NULL,
  `ChatAttachedFile` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `ChatMessageId` int(10) NOT NULL,
  `ChatMainId` int(100) NOT NULL,
  `ChatMsgSenderId` varchar(10) NOT NULL,
  `ChatMsgReceiverId` varchar(10) NOT NULL,
  `ChatMessageDetails` longtext NOT NULL,
  `ChatMessageSentAt` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `circulars`
--

CREATE TABLE `circulars` (
  `CircularId` int(10) NOT NULL,
  `CircularName` varchar(100) NOT NULL,
  `CircularSubject` varchar(200) NOT NULL,
  `CircularDescriptions` longtext NOT NULL,
  `CircularCreatedBy` varchar(10) NOT NULL,
  `CircularUpdatedAt` varchar(40) NOT NULL,
  `CircularCreatedAt` varchar(40) NOT NULL,
  `CircularDate` varchar(40) NOT NULL,
  `CircularStatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `circulars`
--

INSERT INTO `circulars` (`CircularId`, `CircularName`, `CircularSubject`, `CircularDescriptions`, `CircularCreatedBy`, `CircularUpdatedAt`, `CircularCreatedAt`, `CircularDate`, `CircularStatus`) VALUES
(14, 'Olympia Russell', 'Laudantium ut aut e', 'WkRqWXRoMEtPTENCdHJ4UlhnRk9YUENoVHVFVWZSN2NndThJTDljVzlXcmRSUC9JejM2VXgwdDIrUTIwbFdKNg==', '1', '2023-02-28 10:26:29 AM', '2023-02-28 10:26:29 AM', '1983-02-28', 'Null'),
(15, 'Demetrius Haney', 'Voluptas maiores mai', 'dm1HVUs0eHg0NUJCRlNHTXdIR2ZTdjhGeit6amI4NWpXaDNsUDBLaSswZ0svNnJXbzlOQk81ZlJybWdiSU5PdQ==', '1', '2023-02-28 11:42:18 AM', '2023-02-28 10:26:54 AM', '1976-04-17', 'Null'),
(16, 'nmmnb', 'n,mn,m', 'dENJVVZIdjhuT052Mmx2eS9MSGtkQT09', '1', '2023-02-28 11:41:49 AM', '2023-02-28 11:41:49 AM', '2023-02-28', 'Send');

-- --------------------------------------------------------

--
-- Table structure for table `circular_files`
--

CREATE TABLE `circular_files` (
  `CircularFileId` int(10) NOT NULL,
  `CircularMainId` varchar(10) NOT NULL,
  `CircularDocumentName` varchar(1000) NOT NULL,
  `CircularDocumentFile` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `circular_files`
--

INSERT INTO `circular_files` (`CircularFileId`, `CircularMainId`, `CircularDocumentName`, `CircularDocumentFile`) VALUES
(7, '14', 'Olympia Russell', 'Circular_Olympia_Russell_28_Feb_2023_10_02_29_74998715842_.jpg'),
(8, '15', 'Demetrius Haney', 'Circular_Demetrius_Haney_28_Feb_2023_10_02_54_3629553787_.jpg'),
(9, '16', 'nmmnb', 'Circular_nmmnb_28_Feb_2023_11_02_49_57524891463_.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `circular_status`
--

CREATE TABLE `circular_status` (
  `CircularStatusId` int(10) NOT NULL,
  `CircularMainId` int(10) NOT NULL,
  `CircularMainUserId` int(10) NOT NULL,
  `CircularViewAt` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `circular_status`
--

INSERT INTO `circular_status` (`CircularStatusId`, `CircularMainId`, `CircularMainUserId`, `CircularViewAt`) VALUES
(1, 15, 1, '2023-02-28 12:28:43 PM'),
(2, 16, 1, '2023-03-04 03:35:36 PM'),
(3, 14, 1, '2023-03-04 03:35:43 PM');

-- --------------------------------------------------------

--
-- Table structure for table `comaigns`
--

CREATE TABLE `comaigns` (
  `ComaignId` int(100) NOT NULL,
  `CompaignName` varchar(100) NOT NULL,
  `CompaignDate` varchar(40) NOT NULL,
  `SourceOfCompaign` varchar(100) NOT NULL,
  `ProjectName` varchar(100) NOT NULL,
  `ProjectLocation` varchar(100) NOT NULL,
  `NumberOfLeads` varchar(100) NOT NULL,
  `CompaignCPL` varchar(100) NOT NULL,
  `CompaignForUserId` varchar(100) NOT NULL,
  `CompaignAmountSpent` varchar(100) NOT NULL,
  `CompaingDescription` varchar(1000) NOT NULL,
  `CompaignCreatedAt` varchar(40) NOT NULL,
  `CompaginUpdatedAt` varchar(40) NOT NULL,
  `CompaignStatus` varchar(10) NOT NULL,
  `CompaingAddedBy` varchar(100) NOT NULL,
  `CompaingUpdatedBy` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comaigns`
--

INSERT INTO `comaigns` (`ComaignId`, `CompaignName`, `CompaignDate`, `SourceOfCompaign`, `ProjectName`, `ProjectLocation`, `NumberOfLeads`, `CompaignCPL`, `CompaignForUserId`, `CompaignAmountSpent`, `CompaingDescription`, `CompaignCreatedAt`, `CompaginUpdatedAt`, `CompaignStatus`, `CompaingAddedBy`, `CompaingUpdatedBy`) VALUES
(3, 'Sloane Burns', '2015-01-31', 'Others', '20', 'Id recusandae Id ', '317', '41', '7', '65', 'NnhKUWlmSmNLVDdQVW9yTXZSYmFqdGhobEtSeVlrMWEwb3FJb1ZJdVRraz0=', '2022-12-28 10:12:46 AM', '2022-12-28 10:12:46 AM', 'Inactive', '72', '72'),
(4, 'Colby Ratliff', '2021-03-02', 'Self', '18', 'Cum rerum omnis sint', '253', '80', '70', '49', 'OFdJSmhxc3VJUjdPbnRDUmNnMDlZNDZmMzhzMnIxWVFkYURObDVlSDlEMD0=', '2022-12-28 12:12:39 PM', '2023-02-11 03:02:12 PM', 'Paused', '72', '72'),
(5, 'Acton Gonzalez', '1993-06-06', '99acre', '6', 'Perspiciatis sit si', '526', '95', '0', '27', 'OHZUdU1zODBvTHp6VmJYTDRiWFhNOHh0WnBocGtJV0hReDF3dXY1MTZtcz0=', '2023-03-04 02:58:06 PM', '2023-03-04 02:58:06 PM', 'Closed', '1', '1'),
(6, 'Michael Snow', '1972-01-14', 'India Mart', '20', 'Ea ratione praesenti', '397', '70', '0', '99', 'VE9HNmF2aXdQYWxzRklaUGVTR04yZ1ZVdzZCWmpsSUtTY2pkeGVZVXJJQT0=', '2023-03-04 02:58:56 PM', '2023-03-04 02:58:56 PM', 'Paused', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `company_policies`
--

CREATE TABLE `company_policies` (
  `PolicyId` int(10) NOT NULL,
  `PolicyName` varchar(100) NOT NULL,
  `PolicyDetails` longtext NOT NULL,
  `PolicyActiveFrom` varchar(40) NOT NULL,
  `PolicyCreatedAt` varchar(40) NOT NULL,
  `PolicyUpdatedAt` varchar(40) NOT NULL,
  `PolicyCreatedBy` varchar(40) NOT NULL,
  `PolicyUpdatedBy` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company_policies`
--

INSERT INTO `company_policies` (`PolicyId`, `PolicyName`, `PolicyDetails`, `PolicyActiveFrom`, `PolicyCreatedAt`, `PolicyUpdatedAt`, `PolicyCreatedBy`, `PolicyUpdatedBy`) VALUES
(2, 'Leave Policy', 'ekpuaW9xWXFZSSt2L1IrZFlCSllwYjJobWk4UlNhNnR1eWhOc0ZxbHkxND0=', '2022-12-28', '2022-12-28 03:12:02 PM', '2022-12-28 04:12:54 PM', '4', '4'),
(3, 'Medical Policy', 'bmp0ZXRiMExnb2xFQjdVd1F2bElreWh2dG9OSDRpKzN0WXBNd2tDeHcvVFdyUWRhZkF6SVZDR1R6YWFPcFZhdldTUTcrTzdkQ0tjYk9NQWlKOWxIS000QjZHVlVESlVXQkZZb3VQMUNOa0hmaE9GZGVXL1lTbkFKWGZJQVdacUlSc1lFMDJQd3Q4eWtqNjJtQjhBdnBIZUg2M1JVUFRtSHlQK2JXRjJRZ1ZWRm8zcmFPN2FOQlROY3F2Q2lFcTU2', '2022-12-28', '2022-12-28 04:12:42 PM', '2023-02-24 03:27:28 PM', '4', '1'),
(4, 'Health &amp; safty Policy', 'bmp0ZXRiMExnb2xFQjdVd1F2bElreWh2dG9OSDRpKzN0WXBNd2tDeHcvVFdyUWRhZkF6SVZDR1R6YWFPcFZhdldTUTcrTzdkQ0tjYk9NQWlKOWxIS0JYSm1PUW9ubUlQOUZrTEtyZVA4K2taazI3dm81NmtxY09vc0NWME5xWHBZK2xTMXlVRnhzODdsTTVPWW5ZMG5kNS8rcXFRWTFza0tTeG1BZHp5RWtLWXMxN2VnZHByUHBoT2I4cy9qY0tuclhQV3M3dXIyOXhwYzQ3T2EzQnpDWnhubHByNytpOCs1Vk1DV1lRamhUL1NLb09RTTAzTk9nR3dlWXc5SnZVbmltTVpsL2ZEQzFTSmhBbGUyKytxRk4xdm9rWExDYjA1elBRb1U1VXRxNmU0dmNaZmo5alBtS3J1djhNaVFyc2NSeXVTSGtubzYxRUdmbEtVY09YdDA0cDdhSkVzMW90cFgvY3Z6VzBtMG5HQ3EvYlFPdjdoejBaZ2o1dEFPaERl', '2022-12-28', '2022-12-28 04:12:56 PM', '2022-12-28 04:12:56 PM', '4', '4'),
(5, 'Break Policy', 'bmp0ZXRiMExnb2xFQjdVd1F2bElreWh2dG9OSDRpKzN0WXBNd2tDeHcvVFdyUWRhZkF6SVZDR1R6YWFPcFZhdldTUTcrTzdkQ0tjYk9NQWlKOWxIS0JYSm1PUW9ubUlQOUZrTEtyZVA4K2taazI3dm81NmtxY09vc0NWME5xWHBiVEpab2poL3BlRkMvczJVNFpBS1NxalRlQ1p3U083b3hhSHkrN1g2KzdoYjQrTk44b2tWTDBLdWFUckg3UjlLV3ZVYlY1VmVkWVd5aWpIK2hYOWpKaGpDcmRpVWMxcDJZSENnTWk3KzRLUUswd2pYdXIxTDY2a2kwN3NyOWtvUjZBUTR4ZVl5U1ROdjlMYThmZGg1QkFWUGRQU1FpQXFHQUlEeEduanY4WW5YQStGMTFGaHVxYjQ0VXZ2MzhvcVIrV1ZsZElwQ0U3cGkwZWJmVjVkMlhBPT0=', '2022-12-28', '2022-12-28 04:12:19 PM', '2022-12-28 04:12:19 PM', '4', '4'),
(6, 'Time Off work Policy', 'bmp0ZXRiMExnb2xFQjdVd1F2bElreWh2dG9OSDRpKzN0WXBNd2tDeHcvVFdyUWRhZkF6SVZDR1R6YWFPcFZhdldTUTcrTzdkQ0tjYk9NQWlKOWxIS0JYSm1PUW9ubUlQOUZrTEtyZVA4K2taazI3dm81NmtxY09vc0NWME5xWHB5eldjNUx6dStmanFEbWl6V2NkN0piNEtQZ216TlFUM283em5zbWNTeWY5dDM2RVdQTGNrQm1jbFFNMGlOTmNwRGtwVEhUN1BKL2VhNUllSElvdzFmaDRqb3R4WlhNazlSNWVBbXdqa0JJN3R5azRmV1RvVEdxSE44MXdubm5PWk9DWm5LSDN1bEY0VitnRU85QXNjT3BjR2ZScU5sWjJUMjFnVHNJUmRNdzY5bzFMazlsYjNWWk8rNStCMlVoUkNGZy92WVhqZ0UxdHdSSC8zdjdrMC9PeHVPc0xaSzFHSzUrdmdwK0NZRkdVPQ==', '2022-12-28', '2022-12-28 04:12:31 PM', '2022-12-28 04:12:31 PM', '4', '4'),
(7, 'On Duty Work Policy', 'bTRvTUo3WTU0OWd6dEl0RDRIdWs4VENoVnNJQ1kyb1d2RWhpYXk4MkxWZz0=', '2022-12-28', '2022-12-28 04:12:02 PM', '2022-12-28 04:12:02 PM', '4', '4'),
(8, 'Termination of employment policy', 'bmp0ZXRiMExnb2xFQjdVd1F2bElreWh2dG9OSDRpKzN0WXBNd2tDeHcvVFdyUWRhZkF6SVZDR1R6YWFPcFZhdldTUTcrTzdkQ0tjYk9NQWlKOWxIS0JYSm1PUW9ubUlQOUZrTEtyZVA4K2taazI3dm81NmtxY09vc0NWME5xWHBaSDIxWlgxZnBQd2VCY1R0YmdNRkxrM05UdGdmU2tnbHpSS1dUb0ZWdkFDQjNUR3gzcWs2aUNqNU5wamlJZ1JRWkg3NGtOMUQ4ZzcybUlBd0RMNlkyQm5CREtZMmM2Uml6ZFlUQWhOaTF4VWt2TktTOVhBQnArUVF4VERzZldBQjJ3enJlNllmb05WTG9mV2owVmdlQ3Q3WFhsaXFsNmdpdytwV2lNZHZLZDdHY1M2djdYeDl3VFd1UXpmUkhUcXZXSEZUeHA2ampDT3JQd3I5QStqaG92YjB2R290czNoeGVoTlo1MFBqQ05Db2RsNTgxWGdLU240dVh3SnR0emVwM3cxK2lnZFRTL3lDNnZiTTZnKzR0Zz09', '2022-12-28', '2022-12-28 04:12:16 PM', '2022-12-28 04:12:16 PM', '4', '4'),
(9, 'Dress Code Policy', 'bmp0ZXRiMExnb2xFQjdVd1F2bElreWh2dG9OSDRpKzN0WXBNd2tDeHcvVFdyUWRhZkF6SVZDR1R6YWFPcFZhdldTUTcrTzdkQ0tjYk9NQWlKOWxIS0JYSm1PUW9ubUlQOUZrTEtyZVA4K2taazI3dm81NmtxY09vc0NWME5xWHBMU1l6cStCZFUxeUV5bDI0Rnorb1NGQWZMRzJtc3htSmRZS1pzTit2NGxJMEJ6M0hQTC9SbEZCd2hPcG1wYUt5MmlUcUlkcUUrVm5sVGR2ZU0zbXVxbVJkdXYwaWxzUGdQQUlVaVVoRXFOSnlMRURnaFRETFRxMWVGK2xxTWpxaXpkdmxIZVJxcEwzN3cvWDRyb3h2S1N2dTlmOXA4ZS9xU2tFZHhud05Gb3JyanluM2d4bnQ5dVJaNVFuMUJidjd1OTJEeUpjTDUwR2IvdDhzV2JCUkFXU25ObGFxaExFck5ZSVFKeDJnK2JZPQ==', '2022-12-28', '2022-12-28 04:12:27 PM', '2022-12-28 04:12:27 PM', '4', '4'),
(10, 'probation and Confirmantion Policy', 'bmp0ZXRiMExnb2xFQjdVd1F2bElreWh2dG9OSDRpKzN0WXBNd2tDeHcvVFdyUWRhZkF6SVZDR1R6YWFPcFZhdldTUTcrTzdkQ0tjYk9NQWlKOWxIS0JYSm1PUW9ubUlQOUZrTEtyZVA4K2taazI3dm81NmtxY09vc0NWME5xWHBObFpoWkJaQjN6bkpTTFhJOW5HaGI5Y09XRWw0dDl0dExLeTI4d2gwbXZEbjkvdCs3dG1TRTl1b21vQ3ZrQW0zL1pvaFdZTHlrUzJ2RzRwL1VVV2tuemdvckttaDRQQkdVWFc2QkdOd2Z3WldYZHRSTHV2Y2lWaW4wclJNUWkrTUxxT0syVnMxL0dwWXg5U3NIdmlKNldaRzdVakxQVGEwMVYyUlJRbm9ieHBVQk5JOElnSTd0MTkzUEczN2RNdlpoc1ZFRyswUHJZNy9mYXNzOG1qSzF2MXFlMmxCeWdaNW13ZXFRQTV3NDlNTHRZajl0bWx3MmE4Q3VnSDg2UVF6SHpjam5iZnpwSW8rK1FpMmFnNlY4QT09', '2022-12-28', '2022-12-28 04:12:38 PM', '2022-12-28 04:12:38 PM', '4', '4'),
(11, 'Gravience Policy', 'bmp0ZXRiMExnb2xFQjdVd1F2bElreWh2dG9OSDRpKzN0WXBNd2tDeHcvVFdyUWRhZkF6SVZDR1R6YWFPcFZhdldTUTcrTzdkQ0tjYk9NQWlKOWxIS0JYSm1PUW9ubUlQOUZrTEtyZVA4K2taazI3dm81NmtxY09vc0NWME5xWHBVcU9jRVI2SXYzQlo0cjArUHpPOFlYMTl5NDg0UFVCY1NDTTE2dnpSWVpKV2o1WG1Od1lhVTErbjlkR2JMLzV2OVNoemhWRnZpM2poV1JaUmY3RkxhSnRFazFYNXp5SlZRWmVyTWZncHJLY2w2cEZ0MDhBQXA0djZJY1J1NGd6MS8wWWo4UzlaZ2ZGSDFXbVhuY3BBQ0ZhSkxUdktuVVROQjdoZ3hjdVdvZVVsZjBzQ1lkTkxPN2ZFQTZ3MHVDTTRHNWtnNUg5OUR1M2RkRHlKenlsbVlqSkhFeVpPZ255V2VXL1ZIWWI4NjFrPQ==', '2022-12-28', '2022-12-28 04:12:33 PM', '2022-12-28 04:12:33 PM', '4', '4'),
(12, 'Award and recognization Policy', 'bmp0ZXRiMExnb2xFQjdVd1F2bElreWh2dG9OSDRpKzN0WXBNd2tDeHcvVFdyUWRhZkF6SVZDR1R6YWFPcFZhdldTUTcrTzdkQ0tjYk9NQWlKOWxIS0JYSm1PUW9ubUlQOUZrTEtyZVA4K2taazI3dm81NmtxY09vc0NWME5xWHBJK0k2eE53Q3BkVnhPL0RZQnRCWU54UitBQXpQdEw1ZzZkOGRtTGEwVmtHM0cwOXpsa3VGYi9UdmprRUpjamRFSXVaUDc4ZFhKZGJxLy9sL0p0bzcwTmMwYXVjcjZvOVExU2xadnVEWjUxZEd2a0RMTnpPMUNZNjFQRDNrMGJvdXBwYjlxMXJOaW5GRjl5SmFRT3E3eDU2V1kyUDBZOGFhdXJxdS92VjdLdzFqcGtQYnR3Vko1UVNJdlBvejZoTElrdU9hNGpqRHV5eHh5K1Z3QmorYUp1bTVaNWpPUnB5S1NCcEwwSGFJNFU4MnBxSlU1UlRjUEhiSHE0M0dzZ05o', '2022-12-28', '2022-12-28 04:12:55 PM', '2022-12-28 04:12:55 PM', '4', '4'),
(13, 'Travel Policy', 'bmp0ZXRiMExnb2xFQjdVd1F2bElreWh2dG9OSDRpKzN0WXBNd2tDeHcvVFdyUWRhZkF6SVZDR1R6YWFPcFZhdldTUTcrTzdkQ0tjYk9NQWlKOWxIS0JYSm1PUW9ubUlQOUZrTEtyZVA4K2taazI3dm81NmtxY09vc0NWME5xWHBuV3prWkVpZXVCWDZpKzdlK2tsREsyTWlpNjhzTEhlNXd6NVpyZkdENjBOSHoyS1hQMWJkdWxPeGR1bkVmNUZINTN6VStEeDJxTFRrUlY2Ujd2aUc4eFJpWWQ0WE1PVUlEeXhrMlRSb2p6eTV2aHAwbWxJZ0FWSVlXQTc4QmFOaWhZdFE3M1Npb045ZGF1NDhJVUx0TlFRUUdqOU0vOVFncVEvRkFWUVh1RXNRaHFtRFFpR1lyVGk5V09PeGE0czMyWnR0WTRTWHVNR2VibUJ6L2UrNThnPT0=', '2022-12-28', '2022-12-28 04:12:04 PM', '2022-12-28 04:12:04 PM', '4', '4'),
(14, 'Sexual harrasment in the work Policy', 'bmp0ZXRiMExnb2xFQjdVd1F2bElreWh2dG9OSDRpKzN0WXBNd2tDeHcvVFdyUWRhZkF6SVZDR1R6YWFPcFZhdldTUTcrTzdkQ0tjYk9NQWlKOWxIS0JYSm1PUW9ubUlQOUZrTEtyZVA4K2taazI3dm81NmtxY09vc0NWME5xWHAxVG9QUkVpcEhSYm1icEkvMTlycjRnUmN6MWZLZGQzUjY3N0tIZmRUc2RhUkZnMDd3UUhBT3piMi83VVlaSXNzaFdMM2tPeUZXOGhETDA3MWkyanpPRHA0S1JxNWZ4a0RNUHIybnM0RW1PbmpXUkg4SlE3VFpjbnNXNzRDS1lDSjZlb3F0ZjF3MVJwcXpDcVB4dzdPam1CNFVSQzZwaTUwQ01LVmlZUXZuS20raWNiSGk1bXoxb0dwbzVQbUJzdFBOMC9YWkcvSzNGc3phZXEvREkwZHN3QU1IUWVBNzVyR3BLWDBZM2l4bERkWDdDN1luQjJvdy9yYjJhVmp4N3p5c0pIZ0UxNWlZd0h5SUlPWUVLVis1dz09', '2022-12-28', '2022-12-28 04:12:19 PM', '2022-12-28 04:12:19 PM', '4', '4'),
(15, 'Code Of Conduct Policy ', 'MUxURkNBKzFHSXJHMDZMMkZDaFByQT09', '2022-12-28', '2022-12-28 04:12:31 PM', '2022-12-28 04:12:31 PM', '4', '4');

-- --------------------------------------------------------

--
-- Table structure for table `company_policy_applicable_on`
--

CREATE TABLE `company_policy_applicable_on` (
  `ApplicableId` int(100) NOT NULL,
  `PolicyMainId` varchar(100) NOT NULL,
  `ApplicableGroupName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company_policy_applicable_on`
--

INSERT INTO `company_policy_applicable_on` (`ApplicableId`, `PolicyMainId`, `ApplicableGroupName`) VALUES
(12, '2', 'Admin'),
(13, '2', 'TeamMember'),
(14, '2', 'HR'),
(15, '2', 'Digital'),
(21, '3', 'Admin'),
(22, '3', 'TeamMember'),
(23, '3', 'HR'),
(24, '3', 'Digital'),
(25, '3', 'CRM');

-- --------------------------------------------------------

--
-- Table structure for table `configs`
--

CREATE TABLE `configs` (
  `ConfigsId` int(100) NOT NULL,
  `ConfigGroupName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `configs`
--

INSERT INTO `configs` (`ConfigsId`, `ConfigGroupName`) VALUES
(1, 'REGISTRATION_STATUS'),
(2, 'PAYMENT_MODE'),
(3, 'PAYMENT_TYPE'),
(4, 'LEAD_SOURCE'),
(5, 'GENDER'),
(6, 'COUNTRY'),
(7, 'COURSE_TYPE'),
(8, 'ABC');

-- --------------------------------------------------------

--
-- Table structure for table `configurations`
--

CREATE TABLE `configurations` (
  `configurationsid` int(100) NOT NULL,
  `configurationname` varchar(50) NOT NULL,
  `configurationvalue` varchar(9999) NOT NULL,
  `configurationtype` varchar(30) NOT NULL DEFAULT 'text',
  `configurationsupportivetext` varchar(1000) NOT NULL DEFAULT 'null'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `configurations`
--

INSERT INTO `configurations` (`configurationsid`, `configurationname`, `configurationvalue`, `configurationtype`, `configurationsupportivetext`) VALUES
(1, 'APP_NAME', 'ADMISSION CONSULTANT (APNA-LEAD)', 'TEXT', 'null'),
(2, 'TAGLINE', 'LEADS 365', 'text', 'null'),
(3, 'OWNER_NAME', 'Navix Consultancy Services', 'text', 'null'),
(4, 'PRIMARY_PHONE', '+91 9311382012', 'phone', 'null'),
(5, 'PRIMARY_EMAIL', 'info@acresnbrokers.com', 'email', 'null'),
(6, 'SHORT_DESCRIPTION', 'bVVObWhBaDNwYnZoTzdBamdKM1Q0Z2ZjNldvTmpWTWtqRFQyazNZUTE2cz0=', 'text', 'null'),
(7, 'PRIMARY_ADDRESS', 'N2xGcEkxZURhdU5tS25ZRWkxVFZieVdGU1RSRFpyRllnemREbW9sY3JGZ0VVREhnVWU1Tm9VZS93ZHZMdE9qT1ozWWlNdjdQcHp3NmFsdkk5ZG1QN0JOellSZ0pmZFdQSE9Oa0RiVTJxdUU9', 'address', 'null'),
(8, 'PRIMARY_MAP_LOCATION_LINK', 'M3N6cEE1V0syMjBKWE9JamJ0d2dERVk0aGNLSGw4cW5SUjYyKzY1NWNvQzVtcmZuc1JkVS81dTRsbFZCaGFuU0ZTVDZ2N1hMNDVuVzNoV3ROaEErZGJRa2hzV2FJbDVjREpGZFo2OUZ0R0pKbnlkNUtuZzFVLzRqdmwycWhnYlZWd0ZGUThnMHA5VE9TdnYwYnpSblZSenlDbUJjNVdFc0xaZEd2Mng5NVBqVnlTYThjZitzaE5ZL04vdU4wdTZnQk1rS3FORnJhYVo5QVBTbzJHczhIaEJTcVgzMStoOHpDM1prRURkV0Z0UFJPMkcyalQ4Mit1Uk5tRWJYUzYrK091R1BkSVR1N3R4ZVpGUTJTSStoM0xCN2xJeko0NXVNMit4Ni9sdyt0M0t2TU45RG5GSXh4U0tmbjRqdzkxcUczNHFlNkhZZHV1SFZTZG9Yc2cwNEpSb0pnbFA5bmlkRk91aHJ2L2NxT0dWUGpTU1A4dEI1MWVOTDVnc05pZlhSYVlQbFdGbVZiQnlQOWk3UE54SFptYjlmUkQ2eEt4SFJhY1gwY1FKd0lXWT0=', 'map', 'null'),
(9, 'SENDER_MAIL_ID', 'info@roofandassets.com', 'email', 'null'),
(10, 'RECEIVER_MAIL', 'info@roofandassets.com', 'email', 'null'),
(11, 'REPLY_TO', 'not available', 'email', 'null'),
(12, 'SUPPORT_MAIL', 'support@roofandassets.com', 'email', 'null'),
(13, 'ENQUIRY_MAIL', 'info@roofandassets.com', 'email', 'null'),
(14, 'ADMIN_MAIL', 'info@roofandassets.com', 'text', 'null'),
(15, 'SMS_API_KEY', 'null', 'text', 'null'),
(16, 'DOWNLOAD_ANDROID_APP_LINK', 'not available', 'link', 'null'),
(17, 'DOWNLOAD_IOS_APP_LINK', 'DOMAIN', 'link', 'null'),
(18, 'DOWNLOAD_BROCHER_LINK', 'DOMAIN\r\n', 'link', 'null'),
(20, 'CONTROL_WORK_ENV', 'DEV', 'boolean', 'dev, prod'),
(21, 'CONTROL_SMS', 'false', 'boolean', 'true, false'),
(23, 'CONTROL_MAILS', 'true', 'boolean', 'true, false'),
(24, 'CONTROL_NOTIFICATION', 'true', 'boolean', 'true, false'),
(25, 'CONTROL_MSG_DISPLAY_TIME', '4500', 'number', '1000, 10000'),
(26, 'CONTROL_APP_LOGS', 'true', 'boolean', 'true, false'),
(27, 'APP_LOGO', 'ADMISSION_CONSULTANT_(APNA-LEAD)_Logo_13_Jun_2024_01_06_51_49185727664_.png', 'img', 'null'),
(28, 'SMS_OTP_TEMP_ID', 'null', 'text', 'null'),
(29, 'PASS_RESET_OTP_TEMP', 'null', 'text', 'null'),
(30, 'SMS_SENDER_ID', 'null', 'text', 'null'),
(31, 'PG_PROVIDER', 'RAZORAPAY', 'text', 'null'),
(32, 'PG_MODE', 'jhvjhdsbvj', 'text', 'null'),
(33, 'MERCHENT_ID', 'jbcjhbdbfm b', 'text', 'null'),
(34, 'MERCHANT_KEY', 'qkjbdjkfbvjdbvkdbkjvbdkjbjkbdjkfd vjdbvgjhdfhbvdf', 'text', 'null'),
(35, 'ONLINE_PAYMENT_OPTION', 'true', 'boolean', 'true, false'),
(36, 'CONTROL_NOTIFICATION_SOUND', 'true', 'boolean', 'true, false'),
(37, 'FINANCIAL_YEAR', 'September - August', 'text', 'null'),
(38, 'GST_NO', '09AALCR4165K1ZT', 'text', 'null'),
(39, 'COMPANY_TYPE', 'PUBLISHING', 'text', 'null'),
(40, 'LOGIN_BG_IMAGE', 'ROOF_&_ASSETS_INFRA_Logo_26_Sep_2022_10_09_48_61750536552_.gif', 'text', 'null'),
(41, 'PRIMARY_AREA', 'M3RKYjIyemJJcnFXZ2xLdzZINzdMNVNqRVJFbkY2ZnpTQ1BmNFdQcUgrMD0=', 'text', 'null'),
(42, 'PRIMARY_CITY', 'Q1o2a0w2NEpQOEFLTHA3ZHdNYjh4UT09', 'text', 'null'),
(43, 'PRIMARY_STATE', 'Rm9nUDlDRTVkV20zWm8wMmEvMEpPZz09', 'text', 'null'),
(44, 'PRIMARY_COUNTRY', 'MmtSc3hhcXA1OU1mNjFaYUJ6VVhIZz09', 'text', 'null'),
(45, 'PRIMARY_PINCODE', 'RjV6emhnOUxVeC9ic29tQ25BV211QT09', 'text', 'null'),
(46, 'TAX_NO', 'DELA61323D1', 'text', 'null'),
(47, 'APP_THEME', 'facebook', 'text', 'null'),
(48, 'DEFAULT_RECORD_LISTING', '15', 'text', 'null'),
(49, 'DEFAULT_RECORD_LISTING', '15', 'text', 'null');

-- --------------------------------------------------------

--
-- Table structure for table `config_facebook_accounts`
--

CREATE TABLE `config_facebook_accounts` (
  `id` bigint(20) NOT NULL,
  `fb_page_name` varchar(255) NOT NULL,
  `fb_adaccounts_id` varchar(255) NOT NULL,
  `fd_adaccounts_status` varchar(255) NOT NULL DEFAULT 'Active',
  `fb_campaigns_id` varchar(255) NOT NULL,
  `fb_campaigns_name` varchar(255) NOT NULL,
  `fb_campaigns_status` varchar(255) NOT NULL DEFAULT 'Active',
  `fb_adsets_id` varchar(255) NOT NULL,
  `fb_adsets_name` varchar(255) NOT NULL,
  `fd_adsets_status` varchar(255) NOT NULL DEFAULT 'Active',
  `fb_ads_id` varchar(255) NOT NULL,
  `fb_ads_name` varchar(255) NOT NULL,
  `fd_ads_status` varchar(255) NOT NULL DEFAULT 'Active',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `config_facebook_accounts`
--

INSERT INTO `config_facebook_accounts` (`id`, `fb_page_name`, `fb_adaccounts_id`, `fd_adaccounts_status`, `fb_campaigns_id`, `fb_campaigns_name`, `fb_campaigns_status`, `fb_adsets_id`, `fb_adsets_name`, `fd_adsets_status`, `fb_ads_id`, `fb_ads_name`, `fd_ads_status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(2, 'University Mantra', '597359049004353', 'Active', '23853756674500045', 'Phd New Automated', 'Active', '23853756674550045', 'Phd-Automated 23rd May', 'Active', '23853756674590045', 'New Leads ad', 'Active', '2023-05-29 16:07:06', '1', '2023-05-29 16:07:06', '1');

-- --------------------------------------------------------

--
-- Table structure for table `config_holidays`
--

CREATE TABLE `config_holidays` (
  `ConfigHolidayid` int(10) NOT NULL,
  `ConfigHolidayName` varchar(100) NOT NULL,
  `ConfigHolidayFromDate` varchar(25) NOT NULL,
  `ConfigHolidayToDate` varchar(25) NOT NULL,
  `ConfigHolidayNotes` varchar(1000) NOT NULL,
  `ConfigHolidayMediaImage` varchar(1000) NOT NULL,
  `ConfigHolidayCreatedBy` varchar(25) NOT NULL,
  `ConfigHolidayMailStatus` varchar(10) NOT NULL,
  `ConfigHolidayCreatedAt` varchar(25) NOT NULL,
  `ConfigHolidayUpdatedAt` varchar(25) NOT NULL,
  `ConfigHolidayUpdatedBy` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `config_holidays`
--

INSERT INTO `config_holidays` (`ConfigHolidayid`, `ConfigHolidayName`, `ConfigHolidayFromDate`, `ConfigHolidayToDate`, `ConfigHolidayNotes`, `ConfigHolidayMediaImage`, `ConfigHolidayCreatedBy`, `ConfigHolidayMailStatus`, `ConfigHolidayCreatedAt`, `ConfigHolidayUpdatedAt`, `ConfigHolidayUpdatedBy`) VALUES
(5, 'n,m,mbnnm', '2023-02-23', '', 'eWl1eFlJakxlUWxGU3NPdG04MlNoMDlIb0hSMmduaGZWdFovdVcyNnJCcz0=', '', '1', 'Active', '2023-02-28 05:10:07 PM', '2023-03-04 03:52:28 PM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `config_modules`
--

CREATE TABLE `config_modules` (
  `ConfigModuleId` int(100) NOT NULL,
  `ConfigModuleName` varchar(100) NOT NULL,
  `ConfigModuleCreatedAt` varchar(100) NOT NULL,
  `ConfigModuleUpdatedAt` varchar(100) NOT NULL,
  `ConfigModuleUpdatedBy` varchar(100) NOT NULL,
  `ConfigModuleCreatedBy` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `config_pgs`
--

CREATE TABLE `config_pgs` (
  `ConfigPgId` int(100) NOT NULL,
  `ConfigPgProvider` varchar(100) NOT NULL,
  `ConfigPgMode` varchar(100) NOT NULL,
  `ConfigPgMerchantId` varchar(500) NOT NULL,
  `ConfigPgMerchantKey` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `config_pgs`
--

INSERT INTO `config_pgs` (`ConfigPgId`, `ConfigPgProvider`, `ConfigPgMode`, `ConfigPgMerchantId`, `ConfigPgMerchantKey`) VALUES
(1, 'RAZORAPAY', 'jhvjhdsbvj', 'jbcjhbdbfm b', 'qkjbdjkfbvjdbvkdbkjvbdkjbjkbdjkfd vjdbvgjhdfhbvdf'),
(2, 'PAYTM', 'DEV', 'HJvgh1gh3234jh4vgc3j4c3gh123', '#bkjbhv23h2v3gh232vghvc2gv3gh');

-- --------------------------------------------------------

--
-- Table structure for table `config_values`
--

CREATE TABLE `config_values` (
  `ConfigValueId` int(100) NOT NULL,
  `ConfigValueGroupId` varchar(100) NOT NULL,
  `ConfigValueDetails` varchar(100) NOT NULL,
  `ConfigReferenceId` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `config_values`
--

INSERT INTO `config_values` (`ConfigValueId`, `ConfigValueGroupId`, `ConfigValueDetails`, `ConfigReferenceId`) VALUES
(1, '1', 'Registration Open', '0'),
(2, '1', 'Registration Closed', '0'),
(3, '1', 'Registration Pending', '0'),
(4, '2', 'Cash', '0'),
(5, '2', 'Check', '0'),
(6, '2', 'UPI', '0'),
(7, '2', 'Debit Card', '0'),
(8, '2', 'Credit Card', '0'),
(9, '2', 'Internet Banking', '0'),
(10, '3', 'Registration Amount', '0'),
(11, '4', 'Instagram', '0'),
(12, '4', 'Facebook', '0'),
(13, '4', 'Whatsapp', '0'),
(14, '4', 'Referred By', '0'),
(15, '5', 'Male', '0'),
(16, '5', 'Female', '0'),
(17, '5', 'Other', '0'),
(18, '6', 'India', '0'),
(19, '7', 'Graduation', '0'),
(20, '7', 'Post Graduation', '0'),
(21, '7', 'Under Graduation', '0'),
(22, '2', 'ABC', '0'),
(23, '1', 'Addimmision done', '0');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_specialization` text NOT NULL,
  `course_type` varchar(255) NOT NULL,
  `course_session_year` varchar(255) NOT NULL,
  `course_total_years` varchar(255) NOT NULL,
  `course_total_semester` varchar(255) NOT NULL,
  `fees_mode` varchar(255) NOT NULL,
  `fee_mode_semester_wise` text DEFAULT NULL,
  `semester_wise_fee` text DEFAULT NULL,
  `fee_mode_year_wise` text DEFAULT NULL,
  `year_wise_fee` text DEFAULT NULL,
  `fee_mode_one_time` varchar(255) DEFAULT NULL,
  `one_time_fee` varchar(255) DEFAULT NULL,
  `course_total_fees` varchar(255) NOT NULL,
  `course_status` varchar(255) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `course_specialization`, `course_type`, `course_session_year`, `course_total_years`, `course_total_semester`, `fees_mode`, `fee_mode_semester_wise`, `semester_wise_fee`, `fee_mode_year_wise`, `year_wise_fee`, `fee_mode_one_time`, `one_time_fee`, `course_total_fees`, `course_status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'B.Tech', 'computer science,civil', 'Graduation', 'Session Year(July,2023)', '4', '8', 'Semesters Wise', '1,2,3,4,5,6,7,8', '100,200,300,400,500,600,700,800', '', '', '', '', '3600.00', '1', '2023-06-11 23:50:45', '1', '2023-06-11 23:50:45', '1'),
(2, 'M.tec', 'computer scienc,civi,mech', 'Post Graduation', 'Session Year(July,2023)', '2', '4', 'Semesters Wise', '1,2,3,4', '100,200,300,400', '', '', '', '', '1000.00', '1', '2023-06-13 14:48:47', '1', '2023-06-13 14:48:47', '1'),
(3, 'MBA', 'Marketing,Finance,operations', 'Post Graduation', 'January 2023', '2', '4', 'One Time', '', '', '', '', '', '100000', '100000.00', '1', '2023-06-13 15:03:39', '1', '2023-06-13 15:03:39', '1');

-- --------------------------------------------------------

--
-- Table structure for table `creatives`
--

CREATE TABLE `creatives` (
  `CreativeId` int(10) NOT NULL,
  `CreativeName` varchar(100) NOT NULL,
  `CreativeOccasion` varchar(100) NOT NULL,
  `PostedOn` varchar(100) NOT NULL,
  `UploadCreative` varchar(1000) NOT NULL,
  `CreatedOn` varchar(100) NOT NULL,
  `ExecutionDate` varchar(100) NOT NULL,
  `CreatedAt` varchar(40) NOT NULL,
  `UpdatedAt` varchar(40) NOT NULL,
  `CreatedBy` int(10) NOT NULL,
  `UpdatedBy` int(10) NOT NULL,
  `CreativeNotes` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `CustomerId` int(10) NOT NULL,
  `CustomerName` varchar(100) NOT NULL,
  `CustomerRelationName` varchar(100) NOT NULL,
  `CustomerPhoneNumber` varchar(100) NOT NULL,
  `CustomerEmailId` varchar(100) NOT NULL,
  `CustomerBirthdate` varchar(100) NOT NULL,
  `CustomerCreatedBy` varchar(10) NOT NULL,
  `CustomerUpdatedBy` varchar(10) NOT NULL,
  `CustomerCreatedAt` varchar(40) NOT NULL,
  `CustomerUpdatedAt` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CustomerId`, `CustomerName`, `CustomerRelationName`, `CustomerPhoneNumber`, `CustomerEmailId`, `CustomerBirthdate`, `CustomerCreatedBy`, `CustomerUpdatedBy`, `CustomerCreatedAt`, `CustomerUpdatedAt`) VALUES
(1, 'sdfghj', 'dfghjk', '9429008403', 'sh@gmail.com', '2023-03-08', '1', '1', '2023-03-29 10:30:08 PM', '2023-03-29 10:30:08 PM'),
(2, 'sdfghj', 'dfghjk', '9429008403', 'sh@gmail.com', '2023-03-08', '1', '1', '2023-03-29 10:30:17 PM', '2023-03-29 10:30:17 PM');

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `CustAddressId` int(10) NOT NULL,
  `CustomerMainId` int(100) NOT NULL,
  `CustomerStreetAddress` varchar(500) NOT NULL,
  `CustomerAreaLocality` varchar(100) NOT NULL,
  `CustomerCity` varchar(100) NOT NULL,
  `CustomerState` varchar(100) NOT NULL,
  `CustomerCountry` varchar(100) NOT NULL,
  `CustomerPincode` varchar(10) NOT NULL,
  `CustAddressIfDefault` varchar(10) NOT NULL,
  `CustomerAddressType` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_co_address_details`
--

CREATE TABLE `customer_co_address_details` (
  `CustomerCoAddressId` int(10) NOT NULL,
  `MainCoCustomerId` int(10) NOT NULL,
  `CoCustomerStreetAddress` varchar(1000) NOT NULL,
  `CoCustomerAreaLocality` varchar(500) NOT NULL,
  `CoCustomerCity` varchar(100) NOT NULL,
  `CoCustomerState` varchar(150) NOT NULL,
  `CoCustomerCountry` varchar(100) NOT NULL,
  `CoCustomerPincode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_co_details`
--

CREATE TABLE `customer_co_details` (
  `CustCoId` int(10) NOT NULL,
  `MainCustomerId` varchar(100) NOT NULL,
  `CoCustomerName` varchar(100) NOT NULL,
  `CoCustomerRelationName` varchar(100) NOT NULL,
  `CoCustomerPhoneNumber` varchar(100) NOT NULL,
  `CoCustomerEmailId` varchar(100) NOT NULL,
  `CoCustomerCreatedAt` varchar(40) NOT NULL,
  `CoCustomerUpdatedAt` varchar(40) NOT NULL,
  `CuCustomerCreatedBy` varchar(40) NOT NULL,
  `CoCustomerUpdatedBy` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_co_documents`
--

CREATE TABLE `customer_co_documents` (
  `CustomerCoDocId` int(10) NOT NULL,
  `CustomerCoMainId` int(10) NOT NULL,
  `CustomerCoDocName` varchar(100) NOT NULL,
  `CustomerCoDocNo` varchar(100) NOT NULL,
  `CustomerCoFile` varchar(1000) NOT NULL,
  `CustomerCoUploadedAt` varchar(100) NOT NULL,
  `CustomerUploadedBy` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_documents`
--

CREATE TABLE `customer_documents` (
  `CustomerDocumentId` int(10) NOT NULL,
  `CustomerMainId` varchar(10) NOT NULL,
  `CustomerDocmentType` varchar(100) NOT NULL,
  `CustomerDocumentName` varchar(100) NOT NULL,
  `CustomerDocumentNo` varchar(1000) NOT NULL,
  `CustomerDocumentAttachement` varchar(1000) NOT NULL,
  `CustomerDocUploadedAt` varchar(40) NOT NULL,
  `CustomerDocumentUpdatedBy` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_nominees`
--

CREATE TABLE `customer_nominees` (
  `CustNomineeId` int(10) NOT NULL,
  `CustomerMainId` int(10) NOT NULL,
  `CustNomRelation` varchar(100) NOT NULL,
  `CustNomFullName` varchar(100) NOT NULL,
  `CustNomPhoneNumber` varchar(100) NOT NULL,
  `CustNomEmailId` varchar(100) NOT NULL,
  `CustNomStreetAdress` varchar(500) NOT NULL,
  `CustNomAreaLocality` varchar(100) NOT NULL,
  `CustNomCity` varchar(100) NOT NULL,
  `CustNomState` varchar(100) NOT NULL,
  `CustNomCountry` varchar(100) NOT NULL,
  `CustNomPincode` varchar(100) NOT NULL,
  `CustNomDateofbirth` varchar(100) NOT NULL,
  `CustNomCreatedAt` varchar(100) NOT NULL,
  `CustNomUpdatedAt` varchar(100) NOT NULL,
  `CustNomCreatedBy` varchar(100) NOT NULL,
  `CustNomUpdatedBy` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_notifications`
--

CREATE TABLE `customer_notifications` (
  `CustomerNotificationId` int(100) NOT NULL,
  `CustomerMainId` int(10) NOT NULL,
  `CustNotificationSubject` varchar(200) NOT NULL,
  `CustNotificationDetails` longtext NOT NULL,
  `CustNotificationDate` varchar(40) NOT NULL,
  `CustNotificationStatus` varchar(40) NOT NULL,
  `CustNotificationCreatedBy` varchar(10) NOT NULL,
  `CustNotificationCreatedAt` varchar(40) NOT NULL,
  `CustNotificationUpdatedAt` varchar(40) NOT NULL,
  `CustNotificationReadAt` varchar(10) NOT NULL,
  `CustNotificationSendStatus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expanses`
--

CREATE TABLE `expanses` (
  `ExpansesId` bigint(100) NOT NULL,
  `ExpanseName` varchar(200) NOT NULL,
  `ExpanseCategory` varchar(200) NOT NULL,
  `ExpanseTags` varchar(200) NOT NULL,
  `ExpanseAmount` int(10) NOT NULL,
  `ExpanseDescription` varchar(10000) NOT NULL,
  `ExpanseCreatedBy` varchar(100) NOT NULL,
  `ExpanseCreatedFor` varchar(100) NOT NULL,
  `ExpanseDate` varchar(100) NOT NULL,
  `ExpanseCreatedAt` varchar(100) NOT NULL,
  `ExpanseUpdatedAt` varchar(100) NOT NULL,
  `ExpanseUpdatedBy` varchar(100) NOT NULL,
  `ExpanseReceiptAttachment` varchar(1000) NOT NULL,
  `ExpansePaidStatus` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `LeadsId` int(10) NOT NULL,
  `LeadPersonFullname` varchar(100) NOT NULL,
  `LeadSalutations` varchar(1000) NOT NULL,
  `LeadPersonPhoneNumber` varchar(100) NOT NULL,
  `LeadPersonEmailId` varchar(200) NOT NULL,
  `LeadPersonAddress` varchar(1000) NOT NULL,
  `LeadPersonCreatedAt` varchar(100) NOT NULL,
  `LeadPersonLastUpdatedAt` varchar(100) NOT NULL,
  `LeadPersonCreatedBy` varchar(100) NOT NULL,
  `LeadPersonManagedBy` varchar(100) NOT NULL,
  `LeadPersonStatus` varchar(100) NOT NULL,
  `LeadPriorityLevel` varchar(100) NOT NULL,
  `LeadPersonNotes` varchar(10000) NOT NULL,
  `LeadPersonSource` varchar(1000) NOT NULL,
  `LeadPersonSubStatus` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lead_followups`
--

CREATE TABLE `lead_followups` (
  `LeadFollowUpId` int(100) NOT NULL,
  `LeadFollowMainId` varchar(100) NOT NULL,
  `LeadFollowStatus` varchar(100) NOT NULL,
  `LeadFollowCurrentStatus` varchar(100) NOT NULL,
  `LeadFollowUpDate` varchar(100) NOT NULL,
  `LeadFollowUpTime` varchar(100) NOT NULL,
  `LeadFollowUpDescriptions` varchar(1000) NOT NULL,
  `LeadFollowUpHandleBy` varchar(100) NOT NULL,
  `LeadFollowUpCreatedAt` varchar(100) NOT NULL,
  `LeadFollowUpCallType` varchar(100) NOT NULL,
  `LeadFollowUpRemindStatus` varchar(1000) NOT NULL,
  `LeadFollowUpRemindNotes` varchar(1000) NOT NULL,
  `LeadFollowUpUpdatedAt` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lead_requirements`
--

CREATE TABLE `lead_requirements` (
  `LeadRequirementID` int(10) NOT NULL,
  `LeadMainId` int(10) NOT NULL,
  `LeadRequirementDetails` varchar(200) NOT NULL,
  `LeadRequirementCreatedAt` varchar(100) NOT NULL,
  `LeadRequirementStatus` varchar(100) NOT NULL,
  `LeadRequirementNotes` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lead_uploads`
--

CREATE TABLE `lead_uploads` (
  `leadsUploadId` int(100) NOT NULL,
  `LeadsUploadBy` varchar(100) NOT NULL,
  `LeadsUploadedfor` varchar(100) NOT NULL,
  `LeadsName` varchar(100) NOT NULL,
  `LeadsEmail` varchar(100) DEFAULT NULL,
  `LeadsPhone` varchar(100) NOT NULL,
  `LeadsWhatsappPhoneNumber` varchar(255) NOT NULL,
  `LeadsAddress` varchar(100) NOT NULL,
  `LeadsCity` varchar(100) NOT NULL,
  `LeadsProfession` varchar(100) NOT NULL,
  `LeadsSource` varchar(100) NOT NULL,
  `UploadedOn` varchar(1000) NOT NULL,
  `LeadStatus` varchar(100) NOT NULL,
  `LeadProjectsRef` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marketing_collaterals`
--

CREATE TABLE `marketing_collaterals` (
  `MarketingCoId` int(100) NOT NULL,
  `MarketingCoProjectName` varchar(100) NOT NULL,
  `MaterialName` varchar(100) NOT NULL,
  `AllotmentDate` varchar(40) NOT NULL,
  `NumberOfMarketingMaterial` varchar(50) NOT NULL,
  `IssuedTo` varchar(100) NOT NULL,
  `Amount` varchar(100) NOT NULL,
  `NoteAndRemarks` varchar(1000) NOT NULL,
  `CreatedAt` varchar(50) NOT NULL,
  `UpdatedAt` varchar(50) NOT NULL,
  `CreatedBy` varchar(50) NOT NULL,
  `UpdatedBy` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `newspapercompaigns`
--

CREATE TABLE `newspapercompaigns` (
  `NewCompaignId` int(10) NOT NULL,
  `NewsPaperName` varchar(100) NOT NULL,
  `ProjectName` varchar(100) NOT NULL,
  `CompaignDate` varchar(100) NOT NULL,
  `NewPaperEditions` varchar(100) NOT NULL,
  `NewPaperAdSize` varchar(100) NOT NULL,
  `PublicationDate` varchar(100) NOT NULL,
  `PublicationCost` varchar(100) NOT NULL,
  `UploadCreative` varchar(100) NOT NULL,
  `ContactPersonName` varchar(100) NOT NULL,
  `ContactPersonPhoneNumber` varchar(20) NOT NULL,
  `NewsPaperLink` varchar(1000) NOT NULL,
  `CreatedAt` varchar(100) NOT NULL,
  `UpdatedAt` varchar(100) NOT NULL,
  `CreatedBy` varchar(10) NOT NULL,
  `UpdatedBy` varchar(10) NOT NULL,
  `PublicationNotes` varchar(10000) NOT NULL,
  `CompaignStatus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `NotificationsId` bigint(100) NOT NULL,
  `NotificationRefNo` varchar(100) NOT NULL,
  `NotificationSenderId` int(10) NOT NULL,
  `NotificationReceiverId` int(10) NOT NULL,
  `NotificationDetails` varchar(10000) NOT NULL,
  `NotificationSendDateTime` varchar(30) NOT NULL,
  `NotificationStatus` varchar(10) NOT NULL,
  `NotificationReadAt` varchar(25) NOT NULL,
  `NotificationResponseModule` varchar(1000) NOT NULL,
  `NotificationName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `od_forms`
--

CREATE TABLE `od_forms` (
  `OdFormId` int(10) NOT NULL,
  `OdReferenceId` varchar(100) NOT NULL,
  `OdMainUserId` int(10) NOT NULL,
  `OdTeamLeaderId` int(10) NOT NULL,
  `OdPermissionTimeFrom` varchar(30) NOT NULL,
  `OdPermissionTimeTo` varchar(30) NOT NULL,
  `OdRequestDate` varchar(40) NOT NULL,
  `OdBriefReason` varchar(1000) NOT NULL,
  `OdLeadMainId` int(100) NOT NULL,
  `OdLocationDetails` varchar(1000) NOT NULL,
  `OdCreatedBy` int(10) NOT NULL,
  `OdCreatedAt` varchar(40) NOT NULL,
  `OdUpdatedAt` varchar(40) NOT NULL,
  `OdUpdatedBy` varchar(40) NOT NULL,
  `ODFormStatus` varchar(100) NOT NULL DEFAULT 'NEW'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `od_form_attachements`
--

CREATE TABLE `od_form_attachements` (
  `OdFormAttachmentId` int(100) NOT NULL,
  `OdFormMainId` varchar(100) NOT NULL,
  `OdFormAttachedFile` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `od_form_status`
--

CREATE TABLE `od_form_status` (
  `OdFormStatuslId` int(10) NOT NULL,
  `OdFormMainId` int(10) NOT NULL,
  `OdFormStatusAddedBy` int(10) NOT NULL,
  `OdFormStatusRemarks` varchar(1000) NOT NULL,
  `OdFormStatusAddedAt` varchar(40) NOT NULL,
  `OdFormStatus` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `popups`
--

CREATE TABLE `popups` (
  `PopUpId` int(100) NOT NULL,
  `MainUserId` varchar(10) NOT NULL,
  `PopUpType` varchar(100) NOT NULL,
  `PopUpDate` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `ProjectsId` int(100) NOT NULL,
  `ProjectName` varchar(100) NOT NULL,
  `ProjectTypeId` int(10) NOT NULL,
  `ProjectDescriptions` varchar(10000) NOT NULL,
  `ProjectCreatedAt` varchar(100) NOT NULL,
  `ProjectCreatedBy` varchar(100) NOT NULL,
  `ProjectUpdatedAt` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_media_files`
--

CREATE TABLE `project_media_files` (
  `ProjectMediaFileId` int(10) NOT NULL,
  `ProjectMainId` int(10) NOT NULL,
  `ProjectMediaFileName` varchar(1000) NOT NULL,
  `ProjectMediaFileType` varchar(100) NOT NULL,
  `ProjectMediaFileDocument` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `RegistrationId` int(10) NOT NULL,
  `RegMainCustomerId` varchar(100) NOT NULL,
  `RegCustomRefId` varchar(100) NOT NULL,
  `RegAcknowledgeCode` varchar(100) NOT NULL,
  `RegProjectId` varchar(100) NOT NULL,
  `RegUnitCost` int(100) NOT NULL,
  `RegAllotmentPhase` varchar(100) NOT NULL,
  `RegUnitSizeApplied` varchar(100) NOT NULL,
  `RegProjectCost` int(100) NOT NULL,
  `RegistrationDate` varchar(100) NOT NULL,
  `RegPossessionStatus` varchar(100) NOT NULL,
  `RegTeamHead` varchar(100) NOT NULL,
  `RegDirectSale` varchar(100) NOT NULL,
  `RegBusHead` varchar(100) NOT NULL,
  `RegMailSentStatus` varchar(10) NOT NULL DEFAULT 'false',
  `RegAutoMailSentStatus` varchar(10) NOT NULL DEFAULT 'false',
  `RegStatus` varchar(10) NOT NULL DEFAULT 'Active',
  `RegUnitAlloted` varchar(10) NOT NULL,
  `RegNotes` varchar(10000) NOT NULL,
  `RegCreatedAt` varchar(30) NOT NULL,
  `RegUpdatedAt` varchar(30) NOT NULL,
  `RegCreatedby` int(10) NOT NULL,
  `RegUpdatedBy` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registration_activities`
--

CREATE TABLE `registration_activities` (
  `RegActivityId` int(100) NOT NULL,
  `RegMainId` int(10) NOT NULL,
  `RegActivityType` varchar(100) NOT NULL,
  `RegActivityDetails` mediumtext NOT NULL,
  `RegActivityRemindDate` varchar(100) NOT NULL,
  `RegActivityRemindTime` varchar(100) NOT NULL,
  `RegActivityStatus` varchar(100) NOT NULL,
  `RegActivityManagedBy` varchar(10) NOT NULL,
  `RegActivityCreatedBy` varchar(100) NOT NULL,
  `RegActivityCreatedAt` varchar(100) NOT NULL,
  `RegActivityUpdatedAt` varchar(100) NOT NULL,
  `RegActivityUpdatedBy` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registration_charges`
--

CREATE TABLE `registration_charges` (
  `RegChargeId` int(100) NOT NULL,
  `RegistrationMainId` varchar(100) NOT NULL,
  `RegChargeName` varchar(50) NOT NULL,
  `RegChargeType` varchar(15) NOT NULL,
  `RegChargePercentage` varchar(10) NOT NULL,
  `RegChargeAmount` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registration_members`
--

CREATE TABLE `registration_members` (
  `RegMemberId` int(100) NOT NULL,
  `RegMainId` varchar(100) NOT NULL,
  `RegMemberRole` varchar(100) NOT NULL,
  `RegMemberMainId` varchar(100) NOT NULL,
  `RegMemberNotes` varchar(1000) NOT NULL,
  `RegMemberCreatedAt` varchar(100) NOT NULL,
  `RegMemberUpatedAt` varchar(100) NOT NULL,
  `RegMemUpdatedBy` varchar(100) NOT NULL,
  `RegMemCreatedBy` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registration_nominee_docs`
--

CREATE TABLE `registration_nominee_docs` (
  `RegNomDocId` int(10) NOT NULL,
  `RegMainNomId` int(10) NOT NULL,
  `RegNomDocName` varchar(100) NOT NULL,
  `RegNomDocNo` varchar(100) NOT NULL,
  `RegNomDocFile` varchar(1000) NOT NULL,
  `RegNomDocUploadedAt` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registration_nom_transfer`
--

CREATE TABLE `registration_nom_transfer` (
  `RegNomTransferId` int(100) NOT NULL,
  `RegMainId` int(100) NOT NULL,
  `RegNomTransferReason` varchar(1000) NOT NULL,
  `RegNomTransferDate` varchar(10000) NOT NULL,
  `RegNomCreatedBy` varchar(100) NOT NULL,
  `RegNomUpdatedBy` varchar(100) NOT NULL,
  `RegNomCreatedAt` varchar(100) NOT NULL,
  `RegNomUpdatedAt` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registration_nom_transfer_docs`
--

CREATE TABLE `registration_nom_transfer_docs` (
  `RegNomTranDocId` int(10) NOT NULL,
  `RegMainTransferId` varchar(10) NOT NULL,
  `RegNomTranDocName` varchar(100) NOT NULL,
  `RegNomDocNo` varchar(100) NOT NULL,
  `RegNomDocFile` varchar(1000) NOT NULL,
  `RegDocUploadedAt` varchar(100) NOT NULL,
  `RegDocUploadedBy` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registration_payments`
--

CREATE TABLE `registration_payments` (
  `RegPaymentId` int(100) NOT NULL,
  `RegPayCustRefId` varchar(100) NOT NULL,
  `RegMainId` varchar(100) NOT NULL,
  `RegPayMode` varchar(100) NOT NULL,
  `RegPayTotalAmount` int(50) NOT NULL,
  `RegPayTaxPercentage` int(50) NOT NULL,
  `RegPaySourceName` varchar(100) NOT NULL,
  `RegPaySourceNo` varchar(100) NOT NULL,
  `RegPayReferenceNo` varchar(100) NOT NULL,
  `RegPayChequeDDNo` varchar(100) NOT NULL,
  `RegPayOtherDetails` varchar(10000) NOT NULL,
  `RegPaymentStatus` varchar(20) NOT NULL,
  `RegPaymentCreatedAt` varchar(30) NOT NULL,
  `RegPayCashReceivedBy` varchar(10) NOT NULL,
  `RegPaymentReceivedBy` varchar(100) NOT NULL,
  `RegPaymentUpdatedAt` varchar(30) NOT NULL,
  `RegPaymentUploadReceipt` varchar(10) NOT NULL,
  `RegPaymentCreatedBy` varchar(10) NOT NULL,
  `RegPayClearedAt` varchar(30) NOT NULL,
  `RegPaymentDate` varchar(30) NOT NULL,
  `RegPaymentFailedAt` varchar(30) NOT NULL,
  `RegPatmentBounceAt` varchar(30) NOT NULL,
  `RegChequePayIssueBy` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registration_payment_activities`
--

CREATE TABLE `registration_payment_activities` (
  `RegPayActivityId` int(100) NOT NULL,
  `RegPayId` varchar(100) NOT NULL,
  `RegPayActivityDate` varchar(50) NOT NULL,
  `RegPayPreviousDetails` varchar(1000) NOT NULL,
  `RegPayRecordUpdatedBy` varchar(50) NOT NULL,
  `RegLastPayStatus` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registration_refunds`
--

CREATE TABLE `registration_refunds` (
  `RegRefundId` int(10) NOT NULL,
  `RegMainId` int(10) NOT NULL,
  `RegRefundCustomRefId` varchar(100) NOT NULL,
  `RegRefundReason` varchar(500) NOT NULL,
  `RegRefundMode` varchar(200) NOT NULL,
  `RegRefundNotes` mediumtext NOT NULL,
  `RegRefundCreateDate` varchar(100) NOT NULL,
  `RegRefundStatus` varchar(20) NOT NULL,
  `RegRefundDate` varchar(100) NOT NULL,
  `RegRefundCreatedAt` varchar(100) NOT NULL,
  `RegRefundUpdatedAt` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registration_refund_documents`
--

CREATE TABLE `registration_refund_documents` (
  `RegRefundDocId` int(10) NOT NULL,
  `RegMainRefundId` int(10) NOT NULL,
  `RegRefundDocName` varchar(100) NOT NULL,
  `RegRefundDoNo` varchar(100) NOT NULL,
  `RegRefundDocFile` varchar(200) NOT NULL,
  `RegRefundCreatedOn` varchar(100) NOT NULL,
  `RegRefundUpdatedOn` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students_leadSource_and_bdeDetails`
--

CREATE TABLE `students_leadSource_and_bdeDetails` (
  `stud_bde_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `bde_id` int(11) NOT NULL,
  `BDEPoints` varchar(255) DEFAULT NULL,
  `leadSource` varchar(255) NOT NULL,
  `refereeName` varchar(255) DEFAULT NULL,
  `refereeContact` varchar(255) DEFAULT NULL,
  `stud_team_member` varchar(255) NOT NULL,
  `stud_bde_status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students_leadSource_and_bdeDetails`
--

INSERT INTO `students_leadSource_and_bdeDetails` (`stud_bde_id`, `student_id`, `bde_id`, `BDEPoints`, `leadSource`, `refereeName`, `refereeContact`, `stud_team_member`, `stud_bde_status`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`) VALUES
(1, 1, 4, '1', 'Instagram', '', '', '', 1, '2023-10-06 12:23:13', '1', '2023-10-06 12:23:13', '1', NULL),
(2, 2, 2, 'Voluptates quod sit', 'Instagram', '', '', '', 1, '2023-10-16 05:53:17', '1', '2023-10-16 05:53:17', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students_primary_details`
--

CREATE TABLE `students_primary_details` (
  `student_id` int(11) NOT NULL,
  `student_full_name` varchar(255) NOT NULL,
  `student_phone_no` varchar(255) NOT NULL,
  `student_alt_phone_no` varchar(255) DEFAULT NULL,
  `student_email_id` varchar(255) NOT NULL,
  `student_alt_email_id` varchar(255) DEFAULT NULL,
  `student_date_birth` varchar(255) NOT NULL,
  `student_gender` varchar(255) NOT NULL,
  `student_status` varchar(255) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students_primary_details`
--

INSERT INTO `students_primary_details` (`student_id`, `student_full_name`, `student_phone_no`, `student_alt_phone_no`, `student_email_id`, `student_alt_email_id`, `student_date_birth`, `student_gender`, `student_status`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`) VALUES
(1, 'Student Test', '7', '', '', '', '', 'Male', '1', '2023-10-06 12:23:13', '1', '2023-10-06 12:23:13', '1', NULL),
(2, 'Bert Workman', '+1 (628) 315-6532', '+1 (759) 128-2001', 'qazumuwif@mailinator.com', 'xerutul@mailinator.com', '2013-11-16', 'Male', '1', '2023-10-16 05:53:17', '1', '2023-10-16 05:53:17', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students_registration_details`
--

CREATE TABLE `students_registration_details` (
  `stud_reg_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `university_id` varchar(255) NOT NULL,
  `univ_session_id` varchar(255) NOT NULL,
  `univ_courses_id` varchar(255) NOT NULL,
  `univ_course_specialization_id` varchar(255) NOT NULL,
  `univ_course_specialization_fee_id` varchar(255) NOT NULL,
  `stud_dof_admission` varchar(255) NOT NULL,
  `stud_reg_no` varchar(255) NOT NULL,
  `stud_reg_status` varchar(255) NOT NULL,
  `stud_fee_payment_mode` varchar(255) NOT NULL,
  `stud_fee_payment_type` varchar(255) NOT NULL,
  `stud_reg_amount` varchar(255) NOT NULL,
  `stud_payment_date` varchar(255) NOT NULL,
  `stud_reg_note` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students_registration_details`
--

INSERT INTO `students_registration_details` (`stud_reg_id`, `student_id`, `university_id`, `univ_session_id`, `univ_courses_id`, `univ_course_specialization_id`, `univ_course_specialization_fee_id`, `stud_dof_admission`, `stud_reg_no`, `stud_reg_status`, `stud_fee_payment_mode`, `stud_fee_payment_type`, `stud_reg_amount`, `stud_payment_date`, `stud_reg_note`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`) VALUES
(1, 1, '2', '2', '3', '4', '4', '2023-10-06', '', 'Registration Open', 'UPI', 'Registration Amount', '1', '2023-10-06', 'Registration done', 1, '2023-10-06 12:23:13', '1', '2023-10-06 12:23:13', '1', NULL),
(2, 2, '1', '1', '1', '1', '1', '2016-08-22', 'Omnis aperiam sapien', 'Registration Open', 'Cash', 'Registration Amount', '7800', '2014-06-22', 'Cumque ea provident', 1, '2023-10-16 05:53:17', '1', '2023-10-16 05:53:17', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students_university_courses`
--

CREATE TABLE `students_university_courses` (
  `stud_university_courses_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `university_id` int(11) NOT NULL,
  `univ_session_id` varchar(255) NOT NULL,
  `univ_courses_id` varchar(255) NOT NULL,
  `univ_course_specialization_id` varchar(255) NOT NULL,
  `univ_course_specialization_fee_id` varchar(255) NOT NULL,
  `stud_university_courses_status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students_university_courses`
--

INSERT INTO `students_university_courses` (`stud_university_courses_id`, `student_id`, `university_id`, `univ_session_id`, `univ_courses_id`, `univ_course_specialization_id`, `univ_course_specialization_fee_id`, `stud_university_courses_status`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`) VALUES
(1, 1, 2, '2', '3', '4', '4', 1, '2023-10-06 12:23:13', '1', '2023-10-06 12:23:13', '1', NULL),
(2, 2, 1, '1', '1', '1', '1', 1, '2023-10-16 05:53:17', '1', '2023-10-16 05:53:17', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students_university_course_discount_details`
--

CREATE TABLE `students_university_course_discount_details` (
  `discount_id` int(11) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `university_id` varchar(255) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `course_id` varchar(255) NOT NULL,
  `specilization_id` varchar(255) NOT NULL,
  `specilization_fee_id` varchar(255) NOT NULL,
  `discount_type` varchar(255) NOT NULL,
  `discount_mode` varchar(255) NOT NULL,
  `discount_type_names` varchar(255) NOT NULL,
  `discount_type_fees` varchar(255) NOT NULL,
  `discount_is_completed` varchar(255) DEFAULT NULL,
  `discount_status` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students_university_course_discount_details`
--

INSERT INTO `students_university_course_discount_details` (`discount_id`, `student_id`, `university_id`, `session_id`, `course_id`, `specilization_id`, `specilization_fee_id`, `discount_type`, `discount_mode`, `discount_type_names`, `discount_type_fees`, `discount_is_completed`, `discount_status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, '1', '2', '2', '3', '4', '4', 'Semester Wise Discount', '', '', '1', NULL, 'Done', '2023-10-06 12:23:13', '1', '2023-10-06 12:23:13', '1'),
(2, '2', '1', '1', '1', '1', '1', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 'Pending', '2023-10-16 05:53:17', '1', '2023-10-16 05:53:17', '1');

-- --------------------------------------------------------

--
-- Table structure for table `student_fee_txns`
--

CREATE TABLE `student_fee_txns` (
  `stud_fee_txns_id` bigint(20) NOT NULL,
  `student_id` int(11) NOT NULL,
  `university_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `specilization_id` int(11) NOT NULL,
  `specilization_fee_id` int(11) DEFAULT NULL,
  `discount_id` int(11) DEFAULT NULL,
  `discount_mode` varchar(255) DEFAULT NULL,
  `discount_amount` varchar(225) DEFAULT NULL,
  `fee_mode` varchar(255) NOT NULL,
  `fee_mode_name` varchar(255) NOT NULL,
  `fee_mode_sem_name` varchar(255) DEFAULT NULL,
  `fee_mode_amount` varchar(255) NOT NULL,
  `dueAmount` varchar(255) DEFAULT NULL,
  `feePayment` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `is_completed` varchar(255) NOT NULL,
  `transaction_date_time` varchar(255) NOT NULL,
  `transaction_type` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_fee_txns`
--

INSERT INTO `student_fee_txns` (`stud_fee_txns_id`, `student_id`, `university_id`, `session_id`, `course_id`, `specilization_id`, `specilization_fee_id`, `discount_id`, `discount_mode`, `discount_amount`, `fee_mode`, `fee_mode_name`, `fee_mode_sem_name`, `fee_mode_amount`, `dueAmount`, `feePayment`, `payment_method`, `payment_status`, `description`, `is_completed`, `transaction_date_time`, `transaction_type`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 2, 2, 3, 4, 4, NULL, NULL, '0', 'Registration Fee', 'Registration Amount', NULL, '1', NULL, '1', 'UPI', 'Done', 'Registration done', 'Completed', '2023-10-06 05:53:13 PM', 'Payment', '2023-10-06 12:23:13', '1', '2023-10-06 12:23:13', '1'),
(2, 2, 1, 1, 1, 1, 1, NULL, NULL, '0', 'Registration Fee', 'Registration Amount', NULL, '7800', NULL, '7800', 'Cash', 'Done', 'Cumque ea provident', 'Completed', '2023-10-16 11:23:17 AM', 'Payment', '2023-10-16 05:53:17', '1', '2023-10-16 05:53:17', '1'),
(3, 1, 2, 2, 3, 4, 4, 1, '', '', 'Semesters Wise', '1', NULL, '40000', '0', '40000', 'Cash', 'Done', 'hghg', 'Completed', '2023-10-16 11:30:00 AM', 'Payment', '2023-10-16 06:01:04', '1', '2023-10-16 06:01:04', '1'),
(4, 1, 2, 2, 3, 4, 4, 1, '', '', 'Semesters Wise', '2', NULL, '40000', '38000', '2000', 'Cash', 'Done', 'hjhj', 'Completed', '2023-10-16 11:31:00 AM', 'Payment', '2023-10-16 06:01:17', '1', '2023-10-16 06:01:17', '1');

-- --------------------------------------------------------

--
-- Table structure for table `stud_fees_modes`
--

CREATE TABLE `stud_fees_modes` (
  `stud_fee_mode_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `university_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `specilization_id` int(11) NOT NULL,
  `specilization_fee_id` int(11) NOT NULL,
  `fee_mode` varchar(255) NOT NULL,
  `fee_mode_status` varchar(255) NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stud_fees_modes`
--

INSERT INTO `stud_fees_modes` (`stud_fee_mode_id`, `student_id`, `university_id`, `session_id`, `course_id`, `specilization_id`, `specilization_fee_id`, `fee_mode`, `fee_mode_status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 2, 2, 3, 4, 4, 'Semesters Wise', 'Done', '2023-10-06 12:23:13', 1, '2023-10-06 12:23:13', '1'),
(2, 2, 1, 1, 1, 1, 1, 'Semesters Wise', 'Done', '2023-10-16 05:53:17', 1, '2023-10-16 05:53:17', '1');

-- --------------------------------------------------------

--
-- Table structure for table `stud_fee_collects`
--

CREATE TABLE `stud_fee_collects` (
  `stud_fee_collect_id` bigint(20) NOT NULL,
  `student_id` int(11) NOT NULL,
  `university_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `specilization_id` int(11) NOT NULL,
  `specilization_fee_id` int(11) DEFAULT NULL,
  `discount_id` int(11) DEFAULT NULL,
  `discount_mode` varchar(255) DEFAULT NULL,
  `discount_amount` varchar(255) DEFAULT NULL,
  `fee_mode` varchar(255) NOT NULL,
  `fee_mode_name` varchar(255) NOT NULL,
  `fee_mode_sem_name` varchar(255) DEFAULT NULL,
  `fee_mode_sem_name_value` varchar(255) DEFAULT NULL,
  `fee_mode_amount` varchar(255) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `paid_amount` varchar(255) NOT NULL,
  `outstanding_amount` varchar(255) NOT NULL,
  `due_date` varchar(255) NOT NULL,
  `last_payment_date` varchar(255) NOT NULL,
  `is_overdue` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `transaction_type` varchar(255) NOT NULL,
  `is_completed` varchar(255) NOT NULL,
  `stud_fee_txns_id` varchar(255) NOT NULL,
  `stud_fee_mode_id` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stud_fee_collects`
--

INSERT INTO `stud_fee_collects` (`stud_fee_collect_id`, `student_id`, `university_id`, `session_id`, `course_id`, `specilization_id`, `specilization_fee_id`, `discount_id`, `discount_mode`, `discount_amount`, `fee_mode`, `fee_mode_name`, `fee_mode_sem_name`, `fee_mode_sem_name_value`, `fee_mode_amount`, `total_amount`, `paid_amount`, `outstanding_amount`, `due_date`, `last_payment_date`, `is_overdue`, `payment_method`, `payment_status`, `transaction_type`, `is_completed`, `stud_fee_txns_id`, `stud_fee_mode_id`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 2, 2, 3, 4, 4, NULL, NULL, NULL, 'Registration Fee', 'Registration Amount', NULL, NULL, '1', '1', '1', '0', 'N/A', 'N/A', 'N/A', 'UPI', 'Done', 'Payment', 'Completed', '1', NULL, '2023-10-06 12:23:13', '1', '2023-10-06 12:23:13', '1'),
(2, 1, 2, 2, 3, 4, 4, 1, '', '', 'Semesters Wise', '1', NULL, NULL, '40000', '40000', '40000', '0', 'N/A', 'N/A', 'N/A', 'Cash', 'Pending', 'Payment', 'Completed', '3', '1', '2023-10-06 12:23:13', '1', '2023-10-06 12:23:13', '1'),
(3, 2, 1, 1, 1, 1, 1, NULL, NULL, NULL, 'Registration Fee', 'Registration Amount', NULL, NULL, '7800', '7800', '7800', '0', 'N/A', 'N/A', 'N/A', 'Cash', 'Done', 'Payment', 'Completed', '2', NULL, '2023-10-16 05:53:17', '1', '2023-10-16 05:53:17', '1'),
(4, 2, 1, 1, 1, 1, 1, 2, NULL, NULL, 'Semesters Wise', 'N/A', NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Pending', 'N/A', 'N/A', 'N/A', '2', '2023-10-16 05:53:17', '1', '2023-10-16 05:53:17', '1'),
(5, 1, 2, 2, 3, 4, 4, 1, '', '', 'Semesters Wise', '2', NULL, NULL, '40000', '40000', '2000', '38000', 'N/A', 'N/A', 'N/A', 'Cash', 'Pending', 'Payment', 'Completed', '4', '1', '2023-10-16 06:01:17', '1', '2023-10-16 06:01:17', '1');

-- --------------------------------------------------------

--
-- Table structure for table `systemlogs`
--

CREATE TABLE `systemlogs` (
  `LogsId` int(100) NOT NULL,
  `logTitle` varchar(200) NOT NULL,
  `logdesc` varchar(1000) NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `systeminfo` varchar(1000) NOT NULL,
  `logtype` varchar(100) NOT NULL,
  `logenv` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `systemlogs`
--

INSERT INTO `systemlogs` (`LogsId`, `logTitle`, `logdesc`, `created_at`, `systeminfo`, `logtype`, `logenv`) VALUES
(5, 'YUVKYnZmdHd4Vjg3Z1o3dzVhYUo2QT09', 'czVHYWJOeGVBSjkyN0Qwazg2TEhPekt0MjE0UCtIalRhSzlUZDE0aWtsdDZFaVFrUmVMUGltMnVvbUluYmg1Y2VRWWtLOUVrbnp3SUlXcDVhNVVzUVE9PQ==', '2023-09-23 09:56:07', 'YWpRVE95SXN0VXZUMHkvb1pISXNqckRpajFwbnY5b2RRSE41OUl3NzdGUG1vcXBXVEpNWkJQaXpiMzB4VDA4eXpJYW5wYnZQQisyWitMb3pZMEwxcVBQaFIreVpscEttRmZtdVhtdytTb01xa0VpSXBaSWt5bkJPd2c3cTc2V2gxY0w2YmZ0bm1JZW9MNVlWZ0ZNUFh0KzRnTjdyWHJRMllCY2RFc202TjZiOGFqTDlmMUhRYmI0LzB5TEtOd1JIV1lSYnIwRDg3UmlwbW9XMU51a3U2T3FCaFRkd0YxZWhydVBpWUg3b1phWlgyd1dMNWM0Vk84U2FyWHMzMEEyL0wzeFowY3N5b0FFdWx1Vm83SEhhR3NRSnBqZDF3YXRITVBVUmxueFNlbmF1VmhmMVpmbHBvVTBBaGlOc1l5WndLRGlSU1N4dWhqaTlpU0lONG9hTU0vWnpXMlU2NmpNQ0l0dk9jbSs0WkVtRDYvalc0azRjYnp3UnNDZzN5VGlUak0xbXBQc2d2Z1B0UGZTc1pjNFl4YTdPeC9abFN5T1E3ZkFIckdHVGZjMnFxcFdaU1hJdldhTGhzclc4bW82NGhsM3lleFoxd0x5anF6amlGQ0Y5dEZXUWJOUUVxY2RKWTZ4NU93MVNhamc2Y1BxS1psMEU5RUFMRFRNUzZ4amEzdFhPYnh0WXNtSjMrVjFiUitMbkMwNGppZ0hxcVRrZmpZTU5QRWc2WmxienVOd2w5akYxQ1lBV2FwRU95OTRQQVFDajBNVkFHZTRCVUV0QXllNFhxdHBGUTAyVWxoaWVnM0IwUFNPbDM4UGZOdkRPYWFjVkV3K0lUM0Rybnh5cHlpczI5ampKS1FxQi9mNGxBMU9GQnh2d25Qdkg2VXNiSldLVTRSYTUrU2x1QzQySTMzMHZiU3Y0elRCL2o3bldyOU9sSHBnQkM2VXBoS2lxa0NSRTI1c1JSVFB3K1dmVXB6SUdoZ29aRzBNMVZv', 'LOGIN', 'DEV'),
(6, 'YUVKYnZmdHd4Vjg3Z1o3dzVhYUo2QT09', 'czVHYWJOeGVBSjkyN0Qwazg2TEhPekt0MjE0UCtIalRhSzlUZDE0aWtsdDZFaVFrUmVMUGltMnVvbUluYmg1Y2VRWWtLOUVrbnp3SUlXcDVhNVVzUVE9PQ==', '2023-09-28 04:36:26', 'YWpRVE95SXN0VXZUMHkvb1pISXNqb2ZQR3NheW9wdjRWaDdLNkd6Nm56L3F0R3ZUcmZLdS9KdXo5Z3FSV0FsWlVEaXhUZWxFTjFpdllvd3BNc2VmWTQ1R0RUd3lneGNXTWlKQVBaTG1mS09JYlVMUFJ5Wk9HemgvSVJqdmNiY05qNExjaTkvTUl3elFsRDNVQzN2TVVJRzlrSk9haDhNNUJDVUU4b01IMEh1cnNCMHkyLzIxbzYvdDg5OFo4c3FWcWQ3UGdvY1VHQ0J5aEtybjhONDhXVWFVRGs0RjVGbEo1aTN3RFo1VHpuZ0puck8zSjE1dkovS3lQS1BrbkRuSGp2a1Z2Z2FjVzBZS0tJL09QaVhQNHNQaXBrNjFwRnVMSFBMaVdwSGFkTmo1S2JDR0o0bVdSeXRERi9tVUtDU2xpUk00Y3FDU0RUcjVrbHNVYlExSGgvQWw3WWFvMHFGSnB0L1NFODEvUjFIYUxCM1dtY0dTbGRiZXZFTUxXV0FudXkvZVkzYUZ1Q3dOa052OHFOSDh4SDdlM29lWDhTSDllMlNjaTVTOTlYVVNoSDJjVHY5eCt4dTJjM29rVVhyNEJmMDVDT0Q1VW5JZlozbGdnUWRmazZlZ3NpU3pVNzZRNHMzM2d3WFkwY3ArZnVlVDRMck1meFdoOEY5TFh4RjJsVmJKRjhmZllweHFuL3NyRDBNRTlvZHVWTmdIa2szTWRxVlZKd2RvM2ZwUS92dnMwbzJlWWRuR2U2NmdYOXEvYVRONzJ0Y2FFY0RpZS9udkVIdkZBYW1wUmtxU3BsVS9CWG14djZTMXMySUZFcWIzanVZamFrdnBoM1BMc0FuOUVleXdBdU1MRnhtdC9sRmRLem1JbTdTejl6QTg4cHMzdTd0dlFHV2Z0RUpjSTZoMUVXVGI0YTJEQVVEY3QvWUZhS3BtWUVaTzhsZkVGaW9NNlZzTmVFWDh1c3FoNU55Z2Z4dUl1cWYzMHg0MHJU', 'LOGIN', 'DEV'),
(7, 'YUVKYnZmdHd4Vjg3Z1o3dzVhYUo2QT09', 'czVHYWJOeGVBSjkyN0Qwazg2TEhPekt0MjE0UCtIalRhSzlUZDE0aWtsdDZFaVFrUmVMUGltMnVvbUluYmg1Y2VRWWtLOUVrbnp3SUlXcDVhNVVzUVE9PQ==', '2023-09-28 09:45:44', 'YWpRVE95SXN0VXZUMHkvb1pISXNqb2ZQR3NheW9wdjRWaDdLNkd6Nm56K1htaEhvWWQ0WDU0VEp2bVhyNDcyZ2I1a1U1em9tYVZLRm1ZRlNVWmp1RGxjTGw5dEJGT1J5elpHR1dlNnpuUHEzTFV3LzdyRm1Fa1BWYklZVnltR0tDWTZtQWt3eVp1MVZWcEVHaVlXQUxTVDlEZGpRWTM3aFdrZnl4d0RkR0FYUUhVTnBJek9WVE05QlhnK3F0OEtyVVlwcjdvT3BqdHVmTm5FdkRwTUNmeWpZYTVhekVWT3lCdDArTWlrSkdMMWozR1hPS2EwZkt1YjVkcnllS3VXQ3pPV2RRbXpGMkJrM0h3K05ucHRtZEdLZDJIeGtOVU1xSENnRGV5VStPbllaMnNlWGgvbDZzV051SldGVVdoMU1VRGFtaThPMlRZRFRvUEFhMzJ4TjlmemVLcS9SNC80Y2JnbGR0YTJYaDFZSVlmcWNoNFcvbHZ6enluTEVIanB5QVFhdGlXWGVaY2VSUTAyVXkvSUpONzFzZ21TOE01NjVhTFhkQjFlc0o1NEl1eHI1SmQvK0d0TWw1c0gzNmJTdlhmV3Q4d21UTWphQ3kzYngyVmx4WWhobE1HODN6Qnl5a1FBTG4yalowNmxSRnBkTWlJN1FxZ3ovV3kybVBSTWl6UWhGcWdGZnVkZUM0TVBQc2JsdzJ1YUFPd0FPZHVCL0pRZllEME9BUUtpMWRLdHluL0ZCUWVxTkovb3ZEdlNCakhtRDNTZVl0dG05dXUwN3B2UVVPblFkVnA2TFdhK0FRcnAzemRnYzVUWjNncUlyZGJCeG5KQ0RQRmMxNk1BaDVpL2RKUnlVUERXQWo1Tjg0WGVNWHgwd002NG5sYTNuNFFaTDNKNkw4NVgrOWIxMzkxN2N0aHY0dE5nMVBJUmh4eDhrZjNWTnF1cGxiRUpoQTk2K2lWL1JFYWlpR1Q3REY3cjlYK1hXNjJpaE1J', 'LOGIN', 'DEV'),
(8, 'YUVKYnZmdHd4Vjg3Z1o3dzVhYUo2QT09', 'czVHYWJOeGVBSjkyN0Qwazg2TEhPekt0MjE0UCtIalRhSzlUZDE0aWtsdDZFaVFrUmVMUGltMnVvbUluYmg1Y2VRWWtLOUVrbnp3SUlXcDVhNVVzUVE9PQ==', '2023-09-29 06:55:16', 'YWpRVE95SXN0VXZUMHkvb1pISXNqZ1dabzRxcGVUdVgvZ2hxQWF0MFBVREVxeGhGZVp2bU0xb3JPT2NLUE0xRlFmNC9Fd3lUMzJ0dHRpa0pJZVlTeGVDL2dTeVhmcnFqdFpLS2VGT3pKVnFDbTIwVDdUblVJckxYYlpSNDMwbUhhTHlRbzBmNmc5UFFQSzkvRmYyWk9BdEFpTFJIYjZ0ZVVLNm9lK2VLdzZwak5mSlA1aTFhaGpRdzNOdUNxYnZOdmJUNW94UU40Y2lqYWdoajl4cjhOcUVxb3lWUEE2Qng0ajBkcUJ6TGpkOXJSbjAvUitTdEcweTl3VzdBZVZIN3U5dFFrRUxKUWd0bjVNVSs3aE9SSW5ERTZPR3FuQ3RYWERQdHE3eTYwM2haTVFxTW1xMWxURUVWMEcvMU1aZ25RK0JaTThRU3graWlwQ0FGYkVKVkFpSzRsSWYzNDI1SjhsSFRHaWh5eGI1Mk1EbGFzRzFlVjBuR0tDWlg2QjFwSGV3TlVYUEJPZGIyM0dNNVQvYmo2dUd0S0ZvQnVEVGZuMGtWOXlCbUVqYlpsaitYYmFlazJ6djFZZ1lBQUhpWk42WThObXFmMWNQQ29CQ0xtYklxSzRBY0x5WXRNaTFnYXNaRmFJWDFPdWVxaGZBbTkzT3A4NVV1bTIwRzQrZWtncWhxbXJoMUpoWnhFKzZnS2oyUFMxYjVPSFlUcVB6TmZERUt2RUNOMXNBL0t0SCtmSVpFWXNjSXRMd0ppRVBWZi9RTmhOZ2xQZHVZNGVFVW9hZlUzQ0NMcFhhcGpCcG5ubWxqa3pJSjErcHR3VXQ2YnRsZnEybGdDQlRWSFpaLzRBdlNEZlg4T2NndnpoMXhGQ3NEUy9yaG9pQUgwRUpmQTRoajhCMElxTFlmZzBPVHlxTFdDa2NYU000TUxHMG1BenJXeENGUGl1K2JadmJlK2t0ak9qNkZpck9JUnVZSVByMFJudk1KMk9BRlMz', 'LOGIN', 'DEV'),
(9, 'YUVKYnZmdHd4Vjg3Z1o3dzVhYUo2QT09', 'czVHYWJOeGVBSjkyN0Qwazg2TEhPekt0MjE0UCtIalRhSzlUZDE0aWtsdDZFaVFrUmVMUGltMnVvbUluYmg1Y2VRWWtLOUVrbnp3SUlXcDVhNVVzUVE9PQ==', '2023-09-29 07:40:25', 'YWpRVE95SXN0VXZUMHkvb1pISXNqZ1dabzRxcGVUdVgvZ2hxQWF0MFBVQ29BUGcwUkgydHJOUFk3WGl0dzlDUWlKTnB4Q2dNci9TT2pRdlNPOWQ2U24wQkdvanNRMkhCdlNaS21nTDg1dVYzeTUrUTRPL09IQmp4S3huN3U3L1NibjhRK0VpaURzTWFZKzgvRVdGdkp0cGl2UExDOTFBdk1zamVLZWZCWXU2OG9zY2NBaEhWTjlKNkc2eTh1Rkx0dHFzNnU2Mk1YSUR1UmZYQWNLSGhnblp4VFNXdlZTQjN4cGlxQ05hUDVteHUyeFRpWlBtWDBLTW1nSkNYZ0JPeVN0dDVOREd3cE9qQ2YyVzZqVE14d01zNy9oenJXVGhvUWNraUpKclpkUWFYMFpiWVZBRjNqOHF0bTNuR3hMaWlDYkNoSndZUG5yeTlhdjdyR01kZytvUjNHd2hacVF5d1Z1S2RnTkp2MXgvYnoxL3NYM043NXkvWnVXcVdzQy82MnRZL3huY00zdXhwRTc2ZzhIUWtxZTM3WEJ5RHpEVjdITStGVW1DZWROZHlacVYwUXFBVUJScXplZFBKMThrVVRPZncxblZMNk5UTGlYTWVIU2dGU1c0dUkreGFrWmVabjFONnZacHBjci9CVXdWZHhNR0RjR05hME5RSURMU3B3UHJMQ3NPemtlQjRxYk4rcGREazkxb0lydTcxbUJuZWxGL3BEM3Q4Mm1QaUR2ZGNEVnI5SkEvb05UY3RpQ05FYXNCdkZqdm1MQWZJWGRobHpMUGtUcm9kOVhoTi9OV1krcVlLKzlWV3U4SGV1NnlUczJlRkltRmREd0pPZDB1cTFMblFvbVhUNy8wYWZSMXBBRVF2NitsSzl2cHMyMXdYZEdXdWYxSjh6Yng3MmRQbTh4VW1rWHBLeFgwdTczaThBNklSaU1RZ1BmWmc4Q2lkZktKZTV0T2lGdzk5V2oyMVYvVnAzZW8yWmRpSWUz', 'LOGIN', 'DEV'),
(10, 'YUVKYnZmdHd4Vjg3Z1o3dzVhYUo2QT09', 'czVHYWJOeGVBSjkyN0Qwazg2TEhPekt0MjE0UCtIalRhSzlUZDE0aWtsdDZFaVFrUmVMUGltMnVvbUluYmg1Y2VRWWtLOUVrbnp3SUlXcDVhNVVzUVE9PQ==', '2023-09-29 09:31:49', 'YWpRVE95SXN0VXZUMHkvb1pISXNqZ1dabzRxcGVUdVgvZ2hxQWF0MFBVQ0NyRFd5MGlZaDFMU3A5ZWpFblNSU2R3KzFFMG01WHoreTNBRzdMa252UzNMTHJIREErMHp1cXNSVytsU3ZKM3VnSDBzRkhlSGhDWFUvbEJEOXdjM0xVY2dLUkR2b3JucWpGUkdXeWw3OXhtVWtuZ1RTcTRVM1IvMmlQS1Z2M0NuTVo4MXZGOUJGalZVL2xSVGxmOU9jcUdxcDR6YUNLd2w1Sk83d1RUUkdoUjRCY3pvbXVwWU5JdkIrT280K2NUUS9MRGZYd2VmYVBJMVVERDFsSko4dUpTdEZBd2Y4UEx5UW5zcXBJZFFyYTVWR1MxVzlsVFpuKy83N2JQVjV5ek9oc250TW93R1ZoSDRiN3JZTW5Gb0VDMjJFeCs3U0xDWWVFeXNvVFE2aEkraUtzNVBSNmlFWmRraXNxNlQvTGUrenkrWXUwd0V6OW5jNmNmdGlnVnJ1WFJ3MzcydWk0NGJXeWpvOW83WnQrbDhtN0RvVldacGJ2czB5elZ5WW9aSmt5TCt2bkNDUHpqUXRsMVVGWm5PcE9XZWI4T1FYOFV2aWo1TGRQdXBkWktTOUhUakk3WURyTTBlV0RscHlHYjNjRHI1bWU3MFFrb2tVcHRUMkhPSWhQdlBnUm5DVzRHbVVXZWpmV3QrSmpZQWM3LzYwY0toUFJsMVhRMkxsaTNsWjdyeVR2ZDBHcVpDVGVUc003eXNrdHhQbG05RDNmdGIxSHdzUVBsanhUcnVsOXYxS1Q0MUdLVGd3eU85eWs2Ri8xaDI5ay9KVk80OU5XYmlGaXVPSXBQM0VKVW5zOVRJOUdBUVc4c2hHWXRBUlZEcjVqMkNydFlaY05xSzZXNjBzUU9nb3NvMytoOUREMXorU1ZaRjlxaVF4UGVFNDVITllPeVRjb2R3TDFycS9FakJ2ZVRiOWs2UmpidUZ0dGJjZ095', 'LOGIN', 'DEV'),
(11, 'YUVKYnZmdHd4Vjg3Z1o3dzVhYUo2QT09', 'czVHYWJOeGVBSjkyN0Qwazg2TEhPekt0MjE0UCtIalRhSzlUZDE0aWtsdDZFaVFrUmVMUGltMnVvbUluYmg1Y2VRWWtLOUVrbnp3SUlXcDVhNVVzUVE9PQ==', '2023-09-30 05:04:40', 'YWpRVE95SXN0VXZUMHkvb1pISXNqb0s1ck9HZFdjVUJMT1RIOEMxdlZtRy9oMzgrcmFxZDM0TW9QNXNlUVNvUXJMdGJ1OGlzaHE2R2l4ak5uTTR1WmRXRWVxQkxVV0xnQjlvYXdDcG1FSWZMUW14eWh4cmVGRUYwUk8vU3VFTkN0Yk91S1owTGVCQkwyQ2hGQk1FRjJ5NFpoZThOZzZSYWxsejJ4SGRXcmp4RE9sdkxEVWZ5WW1zeXdjcVZxeGNVOGhaREw5OWFlTXFjVUg2ZXlVbUVSSStZbDh1Rjh4RFkxczVXTUZWdVJLQ2NTUWpzWm1OTDN5NkRnZjE5aWZISG0wZWt2RkJoVEt0RkdJajdmKzNpTTZra2ZhS3kxMngzZEhQdk1iblBxYmxWRFBmeHE0bzlpemR5cm96Z042cWdvV1Q1UHBQNUlSc2wzTWhSQWRqNXRmZUtaejZyYU1pMzZTSHFreUdLaGpXOGlpdGhaTHhISTh3WkE2dUgvMkIxTWhxbXI4VjJ1b2JuVVpHWEovL3ZWQ3FkMXlZU0x5Nk8zc282ZFRHcjNPaEM0T0wrTElnWnhLcDd0KzFKRzBya2ZrT250OU9Mb1lLZ0JLbDduV2wvWmFWYmhGbjlWMFVQcERqcmFWUEQvMllROTAwQXlsQkpQMzlPeEFVdFo5YjZJZGVqRUZ2SnpkWFZsQTRjUzVZMGVyWG1hc1BLdTNENDJ5NlBzWjBzR3pWblZ1b2hlUmk4SHRQWldRSVoydWpqNEpBVXFncVRsWFpFekdyZjJBTHpUSnc1aW9JeDhNODZLZ2d0Z2FZaXNvbXRCdnZINFBhdVZYdmhzVmJDdjAzUEUvalkwQW05cTdNN3FPQUF3cEkyZ2NLbW8vN3I5THB5VUtNaFFqRWVlU1pLbXdkbzRjK0hkaUp1UkxBOGlaamdDZjZKQi9BQTJPZHdxZjhxR01OTCtYNk9haDU0RUJRalFMWlpDN2o2enhpaUNj', 'LOGIN', 'DEV'),
(12, 'YUVKYnZmdHd4Vjg3Z1o3dzVhYUo2QT09', 'czVHYWJOeGVBSjkyN0Qwazg2TEhPekt0MjE0UCtIalRhSzlUZDE0aWtsdDZFaVFrUmVMUGltMnVvbUluYmg1Y2VRWWtLOUVrbnp3SUlXcDVhNVVzUVE9PQ==', '2023-09-30 12:04:50', 'YWpRVE95SXN0VXZUMHkvb1pISXNqb0s1ck9HZFdjVUJMT1RIOEMxdlZtRmRrSGZCVE9JMFNuRWZjUGd5dGRYd0FLN3IwY2JJUnpqRzVMVXJTUFFubE1MdDJYbkJMS0doRUx0M1dROC9MM29qSXJrOHhmZmM0S1NFQ3JKbS9aZlpFY1gvL1ZzV2VlVlk0ZXV6eVFWTVV6SXk3djFBcEpxYkgrYjJhN3YvaXIvWVBqa2lsSExrdWVaUFJUWUFaMklURUlkK2VQU3Y5WXprWjdudm1ZbnhyR3JaVkVUV3RSWTJzQTF2alpFQmtvRmM2YXFNbUY2Wll4SmxRKzNKU1pMeTczL1JtY2JyZk84R29KOWhPMllvZEFMN0t4azVheXp3SFlvNER4T3VqeXFkQ0JDQ2h0bTljWVpOVVdNZ1UxV2V6bVJ6TW5peG1KQVM3NHJVOUcyV1pNc3JlVEx0UUVSS3JLMVV6dnREaGkrTGJGeStZNGtxYklpc0RwRDlSK3RVK1Fya1I5bE9ZblN5MWFHS1h1TWR5QkwyQmtPVWJBNXRVL1pFMjV1OXNBREJha0QzdVNFaGNsd2R5dVU5UlpickQyVU9PcmhDR0xxQ25ZWFFGUlZaNnAvZTZnTnIzWk9VdkkyT3BCSHZBMGFTY2hJU3hkOEJYblFYNUp6TEFhMy9zUVJQQkJCSHBpL1pwWDMzTi8vSXNyeVd5WTl5UjcrRlpUbU9mTURnN0hqUkQ3Ni92QUFxb3ZEd0R1cVZDai93OVlZWEtBZ1FOMWducXJYRjhMZ3lEZFdnK3FVNEJZQnh2Q0dLUGp6RU43aHlYSTNDZEkwWEdhSlNyTy8yNXpiTGdxbUJnWUliem5HWCtsS2FVSExxaEl4amxMYmc3MU9Mb0F6L2lYUUtONFFJY3dCaDNTNjk0clJtaERyQ0FlcmhFdTVmV21jVFQvOXVCaGVJZjRETWZ3TkNUNkJNVVV5WGpyZ3VWK0tKcjdzdXdi', 'LOGIN', 'DEV'),
(13, 'YUVKYnZmdHd4Vjg3Z1o3dzVhYUo2QT09', 'czVHYWJOeGVBSjkyN0Qwazg2TEhPekt0MjE0UCtIalRhSzlUZDE0aWtsdDZFaVFrUmVMUGltMnVvbUluYmg1Y2VRWWtLOUVrbnp3SUlXcDVhNVVzUVE9PQ==', '2023-10-04 08:06:39', 'YWpRVE95SXN0VXZUMHkvb1pISXNqcEFmTFlVdUFJTDQ1WWdiaG4wbVZhbHNuVGxMMTFtOVhTTTNBc3UyWHo0VVVwekVvQXdhZ1VueTJvUVhCdWU5OExTaWhaS0hOVHdYbmdOOG10TE03cW9TODJ0RHErcThVZUtMNjQ4a3ozMEkyYzBNcXMzQ1J2UTluMTR1akVuNWV4V2tmei9PZGdMTTdCb3E2RDNvTkFOYzBmOElseVdGSk1OYkhDRkltSFlYTVNoZmc4NDhiTlJqMnZTb2s5S281QjFUZ1Z1T2JCNDdPTjJyUmFGc2t4NDJaS1N2bUFQMW00RjlKNFRkRXMwUGo4YlhnUm9jNUJOeSthVXNDeXhaMzFEMEFDenZsellJS1U3enlVdG41VEEzTk12VENLRjdxekJnN1RVR3BEbUFlSkFGTXZQcFl6WTQyWlBQSFVUcTgrdUh1MXVGTDZaQTQyR1hIZU93MEpESnMyQkNGM1BYSHJEa2NCaUFrQ3lzUE1WQjhld24zRVRDcmRaK3orb1JDZHk3MTlld2swNjFqREdtTW1xL2pSVVIrOU5Eeld0cDUxbmRnWGdLWmJwbkVpbWZZRHYzUXB5WDBwQmtIUU1GaTlSdHhBUWJUSGxtL2liWlo0Vy8rS1hwcTFUd0ExcSsraGZSY3IxckVhNnZKZFF2cDBROU9NSzhxSGtTYitjeExFUjFiOFowUjJuZGRvUmRhZVNoaHRXY0NWR0IyMlRrREgwWUljUXNLY3JqVU1pRmpROHE3bXZEUVdsbHVYbjhkb0JLenhQVTNXbEZMVXEwMVJMZjZRV2xxSWlzQkF6NkZGQ1pxcUpkNTFtTUtlSTRpYjJaRmVGK0JBRjNwQ3V2SytXTmZHQzBNUDFWY2tCMS9zNEJaZFM3ZEczZmxaZTZsanp2OUhsVHBwZkJQYStFcllMamZML2J0Nkg1TU12MjYxOUMzZ2d4dC9VQlpybFdqZlRqNGZzUTF2', 'LOGIN', 'DEV'),
(14, 'YUVKYnZmdHd4Vjg3Z1o3dzVhYUo2QT09', 'czVHYWJOeGVBSjkyN0Qwazg2TEhPekt0MjE0UCtIalRhSzlUZDE0aWtsdDZFaVFrUmVMUGltMnVvbUluYmg1Y2VRWWtLOUVrbnp3SUlXcDVhNVVzUVE9PQ==', '2023-10-06 12:13:25', 'YWpRVE95SXN0VXZUMHkvb1pISXNqdjMzUkJrVldOTkVXaEpTd2FOTnpveEhlZzlzV2IwUkc4bUZHeFBNNWhkc1hIZ0ZORWhkOHJqRVNjZUdaNi9HZ25zcy9LVDNMK3ptZjdrVFZ1cTJIRzBTN0xIdHU3ZzhsODhSZnNzbEV0MDdNTUljRG1XUU1Gbkt6VDhVVG9hWFV5dEdpQlNveVhjRlRHc2s0NTYzS3NhbVVNWkE0ekd3QW1KZWQ4WURSQ2dpQk93UWkwSnpxL0lBMjdka0dZMnkyWVNXMUdmeWRtL3lXaWRGWjhyVStiSEtaQUhvbWRVTFMxYUhwZ204dlpJMDBrK1hKcjdGMGsyeXBHM05oOVUvUjd4a2ZQcGVJVklDZTZKU0RlREZxUlRDc2lPS3gzQm0ySXRMZkNWekxLenZzVElSczlWdEs4WXovc3RIZ29sTUJUdnBOYWlOaDlwR2NNTHdRSXV6VHpmRDIwNnl3bVErSnBMeWIvcHJUeG12UnNaNkFqZUpsbktVNXNQSFVVa3RvRkdyMGtNWjVsVEF4alQ5MjhaS3BBK2diaHMrQmdaQWpCSjY4czlhYlYxdk8rQ2dxajJrbk04cFlMSlVSRDFZT1hwckprc1E5NUFTR2ZGU283UlZkTGo3TUYvNjkzS2l2SWRuWmZNbUlyL3BXQWN2eXNLODR4a2lBWVloUDJjQ3NuWGlYVVJsOVV2YkdMTnpleWdhYldoVkdtaHl0SG9nNXVQNDdsR3hBditTdGR2d3ROTGc2TnpMaXFERDJ0UkI0V21VTEwxZkFWMlM2NmlIMTVVK0dnbEtFQzU3UzBJak1GeUkvQkcvT21nait0NVlWdnljRDJVaUJPdTBydFZBRm5OL2lXbVFvSDNrdDFRTUVPcjJvdFgvNVVialhRb1h5djY2NWoxSHE2TmdTaE1OZjF1enZpWEV0TWF5S3ZvbWpDWklxYVBBdHZjVHMwcW5BeEl5eTIycXdl', 'LOGIN', 'DEV'),
(15, 'YUVKYnZmdHd4Vjg3Z1o3dzVhYUo2QT09', 'czVHYWJOeGVBSjkyN0Qwazg2TEhPekt0MjE0UCtIalRhSzlUZDE0aWtsdDZFaVFrUmVMUGltMnVvbUluYmg1Y2VRWWtLOUVrbnp3SUlXcDVhNVVzUVE9PQ==', '2023-10-13 06:52:33', 'YWpRVE95SXN0VXZUMHkvb1pISXNqdWZxYjZsTE1YM3BTNFY2bnh6MytpMGY4RzQ3M1Y0RWRCZUh2Qjl5NU9sVndGMDZjL3Q4ekJRaUZ2aUZGOWxvazkyNlBZZEQ3M0ZjL3lFVloxQjR4ZHhHVGNtZ2dmaEpqQysvN29xc1d3Z0kyeDl3RnY4aWJMQnIvWUlrNlRPQVVmTTF4U0JJNUZYQ3FORXVnWVdOQ2hhbVVSZFFVS2x3R2lDMUNPajlqVlhzVlB1VnRTSXZJY01CNVF4YzlERUxEc3B2RFBtamI4Q0dqRVlqcXRGSU5TL0w1ZVBxNXpPc3hNM01YcjFBcXRKR3BZWDZOQVl4bU00ZkcrWFZLbDR6ZHdQKzFiSUovcnkyL2d3Rk1zZ1daSlBWL3ZXbW1kcDQ3clM1TGRONHRTSm00cnJmRVFJZWdOMlNwYmZQbmgwajZHWEVtRXRzejhLVE5hOWdBcHhtcHhSUUI2c2d0TU9HS3JCQTU1dmxzeDNmdWw5TXliaVVyQ25HK0FGZExvbDhXQU1qakZHNlpJT1dKL25EcGZEclVUVVlLQ3RZdUUrcCtWYm1OeFNHbHhMOVFiQnh2OE4xcVVxMDhBQU0zSERPMFJHZG1vNjFkWUZWRHdObXVaNXVrdU8wUThZZzJ0WUp0Y1lCNnlpREV5elN5UHc3R1BGY1p6T1VwaFpQNjh2VlhPSzl6NnBCa1dQQklSTGo2RmlvWEJtM3hHNm9tNFhLcGlTY0hqYmV0M2ZDUjVWUkFiRE9VQWJRZmd0VngyTThlZkdrQ2RVaG8wL0JYdkVsdUpJaFlyQWN1ZnF6SURLOXhTTVEvWlRBWGY0aVlnYlNaeVEvUlJiVG1PUXJDcWJzZi9hMmlhQit4S3FJb2dTOFFZSWpIUGEvSHBsbzgrcjhKUWQvMEtVVnUzRzIzejh5L2NEUTVOTzFXVmMzUk1qaVFwZEtzNFBYUm82SkE5Z3NaclNZc0FOSmRE', 'LOGIN', 'DEV'),
(16, 'YUVKYnZmdHd4Vjg3Z1o3dzVhYUo2QT09', 'czVHYWJOeGVBSjkyN0Qwazg2TEhPekt0MjE0UCtIalRhSzlUZDE0aWtsdDZFaVFrUmVMUGltMnVvbUluYmg1Y2VRWWtLOUVrbnp3SUlXcDVhNVVzUVE9PQ==', '2023-10-16 05:52:36', 'YWpRVE95SXN0VXZUMHkvb1pISXNqbzUvSE9PdjlmcTd1MUgvMDZTZ3VZRG9JWm9JeG93TUhIVFUrSGhtaXFySVFocHRYeGxJWDVKZURnS3ZHdysyMWFiMjJaVFFBQllwZ2FxelJzU1ovR0FRM1JTdlNQU1JUN0x3K3NaSEgybUQxWVJzWE9RM1ZkUEE1eDBPeHphSnNHV3RSVU5sZWJKRjR1MUJyeDVwRlVKL0Q0WGpRMEYyQ3IwdklsYlI1bWNWSkltQVc5Q0hGS2JBazhZc3dabVgxeXFhSzliMkhORGJiZjZIdmMyWXpML1dyakpjRjE1QnBKSkpLcjFuVHl2OGNERnFSR3kyaXgxSm4yRVpQMzdjOEkyVnA5WXh5V3FzbmZpSXc2WDE3SjQwb1ZPa25yM3UrUzlPcWVuN1J1OW5iSFE4TnF1MzJsVGpjSTFNQmpZSjdPYVRHK0xNWFN0eGVuNmJ3WG1relQzTVhKcDZjZ2RuMk1NZGdIYUxTMFlVNWRnclhGSWJ3NmV6dm0yYU9FM1RMenNURmVNMkd1MXRxNHM3TTJOWmdEcmxZYkpVa0RqdUJoSnlnQ25TakRld0dDci83bHBueGFXSVhOK3BsdGNNWHFHbW5SKzc4ZTJTSWJqWjY5dDd0cGM3MW82RjNSWEFObXR3bW9icWEzVS94U0ZrcUZ3YlVOY3I2WFVWSS9DcW52RCt2eDRsYnBlK3pFNnlSU2xDUG8wY1dRNi9qZTFxZHVrQ2Y3SStLOVJpSVVJNlF4Z2dyYzk4UlgreVVKYm1SMnhOclpPR0QrUmJQeFp0eCtpVUJKTTlyMWM2RkRxRDdEbWpDV21rL01sWkNHdkM4QVRwdk1xR0N4dWRqYlZ5dFh1WDVvZ0lVZW5uOGtZYkhudjF3ek1vWElLK3JnSWltUmVZL3I5ZDJBQzZMbHVPNnZRakFHMmxMeFk5dS9pU2F1c3BzdnhSWVFyNXFUVVZMOWhLQXFzNDc3', 'LOGIN', 'DEV'),
(17, 'YUVKYnZmdHd4Vjg3Z1o3dzVhYUo2QT09', 'czVHYWJOeGVBSjkyN0Qwazg2TEhPekt0MjE0UCtIalRhSzlUZDE0aWtsdDZFaVFrUmVMUGltMnVvbUluYmg1Y2VRWWtLOUVrbnp3SUlXcDVhNVVzUVE9PQ==', '2023-10-16 07:23:56', 'YWpRVE95SXN0VXZUMHkvb1pISXNqbzUvSE9PdjlmcTd1MUgvMDZTZ3VZQVNLT0dQU3gwRmZWSFdRZ0dqRGNIY3g4cEpMMTdtbmZXNk9VeUJLK2E0UU8rditQdFJ3VWFNTG1xVmNZOTFvV3JHb3RqVURMeUNISmxNbGFIQk1DZ3BDT2FOU3dZcmpWUk1ZRGp1bTlLb3BQcDRqSWtxNzF1UmN5L2VNL0Nmd29USFZscXpUaHRGOW9vRUM3WVBXN0h3U0l2OW5HZzdwbFkzVTRTUTJGMjhURW5pQXludnF6cXliZnNKOEhwUHRkS2oyOTVkUW51TUxxT01LWFpXRVNNcGUwdTJ2MTlUemlGM3kxajM2NUVOOHVPSHVMbTN5M1piUVd2Y0RkQ3ZqUjJkYklaMFpDbjNkM2kxcTZyeHNRM3ljellPd0hrY0srMTg5OWNoQWpLR3g4aGkrMis1NENSSjdmUFhXcWZ2a3RydjMrZXNXYUYyRnN6TVJoWmxzTVJ5MUJHZlNmZnlEbndldXpjR1RIVnI3UXZEaUFZSkE1Vm93aEVabDFzWklnbHVFejY1Z1NKU0tzdHBYTE9vOGZIaThyMmpwSXZJa1c2ZXdsam1YNWtlYmQ4UU41d2ZJbElJSzViK2x1aFdvVWZqVjJXWDErNTlTVks5N0ZvWVJLaUxPYkhTMjU0cFNaTy9RVXl3SjZ6UTBycWtwOEt3OThQbHhVdG1UcWE3NlpJUkhlN3VqV3BRc1AxeVlRV0cvVW83Mk1FdGFpc3ZudVp2cnZOODdQTkpZU3lSNFZvdW00VFI4cnpJSnpKa3daRlgzRTlRaTZKRnl1aFFqdGFVU3lUMFNFbm1EYkZCUUxRWnlXUGdwU0kzbXc5K2tTNUU0ekNOZ1M1VjVub0VwU0pFaVhDaHRlcElCSzY3SHdlb0RkejAzVTFEME96VHZlUW8ySTZIWFV5ZmFmeHcvYkV2OUx0UWR1WlRJQlcrbVZIa2xX', 'LOGIN', 'DEV'),
(18, 'YUVKYnZmdHd4Vjg3Z1o3dzVhYUo2QT09', 'czVHYWJOeGVBSjkyN0Qwazg2TEhPekt0MjE0UCtIalRhSzlUZDE0aWtsdDZFaVFrUmVMUGltMnVvbUluYmg1Y2VRWWtLOUVrbnp3SUlXcDVhNVVzUVE9PQ==', '2023-10-21 10:17:22', 'YWpRVE95SXN0VXZUMHkvb1pISXNqbUdsM0plcmRtTHBHZ1FQc3JIMHRIQ083ZTI5NEIvUm51TUR2a2JLckVaZjF4V011ZXExZzhoWTFKVDVSOW1mSlJjcEpKTjZZOWtNT2tEQ0dDZGlHUERLdXRxczdqYTFxWVh2Zk1ZdEl3UmZzQ1FVbVJRY2FYb2VuVWcxd3d5L243K09RZnJMMEFVUDhleVR6L1RaKytPOHlYZTJnVnZTeS9PZjV0NW9GekZwM3FJL3d1NXkwRG52U0N3cHBQME9iVlcwTldWOTZrUWdIRWJvOE5MNnc5MFBhRmJMSUtFa1k5c0JKeEJ2ZmZ0dUhlc2RrMzBQa3lwR25laWtwK2FrS3lyNUJHTlIvMHp2VXBCOXN5dXlOZDFCUGc3a0lTWnpaVkw4aGNlcThrTWhRcEozVmc2T1BWdmhaMmFNcFd0TVc4YTBhay9qWE5zMXViT1hxVFpLUWhmQkF1RnpJMXVNazNlWEdLS1JLeXU2NHE3ME1tZFp6TTFJRUo3R2tSRjFmcysrdjB4a1dHaFYwamdaSkpBc0t4SXlhSXVVbTUrSVZaMFFqbmNXd3djd2h1L3ltQ2RNeklyL211K21XTGlhUlRsTXBxY0lTYStGUEFJYVNCcXc1V1VGbzQyckhsTm9STVo2aGQzOUwvbXI3WUNqbmVwWU0vc25jL2h1SDg5MWlUMDJPcGw3QkVsTURubmxQU2RXbnpLdU5uSlpFQ3RYdTg3dTZaY3crWE9VdDJQbkN1em11ZENaZTROQldBSDJ3NlJYcjJTNFQwRHdVNi85SHZjemx4eG9HM2I2K0FZUzJwV1QxYVA2NlVnSWgxbko3bWdFUWM4Q245SkdUVFVvaHl0dU9WUGxKdHBGcjEvYnUxUzhyRjBFZkcwSUErTnI3aXJRb3h2NlhqS3ovMXJ2WGhDWmV1L3NQS2wrWHYrSjBnRWZleDl1STJjVEpJSGhpWnloelorUmt5', 'LOGIN', 'DEV'),
(19, 'YUVKYnZmdHd4Vjg3Z1o3dzVhYUo2QT09', 'czVHYWJOeGVBSjkyN0Qwazg2TEhPekt0MjE0UCtIalRhSzlUZDE0aWtsdDZFaVFrUmVMUGltMnVvbUluYmg1Y2VRWWtLOUVrbnp3SUlXcDVhNVVzUVE9PQ==', '2023-10-23 10:58:25', 'YWpRVE95SXN0VXZUMHkvb1pISXNqc1FvOEJVZlJCQzZ1VmJWWWc5M1NuWmNqY1VXOVVmVEtyOFVBSkN6aXBzS0U0elBaTk9vK211VVhCODU5UmxLMkJEQS9wU0IxVEJKZFVHY2RGVVhDZlhkdkUzdUQyVHRkNTFFRVhrdzA5VGRWSllybFBuY1AyZkpjaGszN21kb3R4WFVRYUg5VnFzbzc1a2dtSlFjOWJIYjRpdDl6Nlh4dkZUamM5WmU2d2tmWDNFcEs4VjJkN1lobCtmbTFnNXBkWGVMNC82YkVaczVJZGY5cjdqOXduMUpXYkU3MzJ3U1o4VzJLRFVqRlkyekJpZTl0TjB6VG1vOWFXWmd5TlM4cmE4aHU0ajBIVmVnajBEazFlWk8xNXRYV2ZaQUk3VFJnU1RpeXZ2dXYrWjMzSm5TUG5zUTNQQUlGQVR0UTFjcUU3YTZkc3d0TkI2Q0RGaldVdHluSFc4S25kMURMaHdBVTNtc3hFSWNqZDdCQW1nemRIZ0Z5WXgzdlZGWCtJbCttc2dZbEJJUTZvQjNhaW5xUldjQjZuTFlBcjF2ak9xNW04UVVIZGFEUWFOR1lpNWFnWVdGN21yNnpHU2VTbHByc2o1SEltMnpFbklabm4rUVNMeEk2Szd2N25tM0FjM29adEJ3V2dGeFZ2ZjNPaENQcmZoWUw2ZlJNR3YyZ3l0a3lEcnJOOVNuSWhKdXV5SnMrSWFXR3A5a2NkS1JyaEtmdmNhOFU2UDgvOGUxbDg2Y2M5ajI4c2s2dkdVUXV5Z0lMZlIra3dwRHJjNjFVRy9VZUp4czJ2enhjWm02K205cldpRndybGh2a3JhMHQyMkhicExETEJqNE5CZHQyekdHMTVPdVZKdmNFbm81YTF1WWRWdFlSSEdGMlBFaDZub05FdzIvbWw0MmNtZTNyV3VnZklUcFlzQVpKWTR3cmtaWHFoZFlTd05jaFQ3aHdtYVZOVXJsOFdRM0t2', 'LOGIN', 'DEV'),
(20, 'YUVKYnZmdHd4Vjg3Z1o3dzVhYUo2QT09', 'czVHYWJOeGVBSjkyN0Qwazg2TEhPekt0MjE0UCtIalRhSzlUZDE0aWtsdDZFaVFrUmVMUGltMnVvbUluYmg1Y2VRWWtLOUVrbnp3SUlXcDVhNVVzUVE9PQ==', '2023-10-23 11:17:08', 'YWpRVE95SXN0VXZUMHkvb1pISXNqc1FvOEJVZlJCQzZ1VmJWWWc5M1NuWks1QnlSdG44Y1d6bTRDWnNqRnk3cGFiWDl1eTFhQm9sR2lnUzB2STA2T2ovbWQrSjJRRHF2S1JXbThmNS9IZGtzZWc4VnJpN0hsbTg5OXVIWG8za2g0U0ZzK0dGV1FESjZOVDZOT29iTG1uZWxwUWhPUDJORi8vbVBiUkNRTFRwdXF1UXNDMkJqVFgzRXl6MnhRSHBWVFJuZWtJa3ZsUGk0OE1MSWtVSy9RbkIvbnc3TnBSWFZkQ3RhQUxUN2Z1VlNtR1QyVkxNd0NrTmlITm56QWlETWZ5aXB5TTlZRkxBN3piL1pUN2dJdnQyN0xEWmFJeDBaU3JObExSbXg4cWxFaEloQlJ6UWVYTXp3cnUxR0ptOXZ1VVJPUllkK3E3ZGpuMm5lZXhLeDNDc1NoT0RlQWIzV0Mydi9SM05XeHV3THZGR0tkWnFEbFFta0wrQUpyMGI1d0RITlVTWG9rUDVrOUVpTXNEQjQxSDNXVkZDNm1mUXBmMFY1TXZybHEyTmxla2pWVk94SjUzNFczMTNhTVVWN3k5cWNTMmYxTkcwYmhKMVJLTFNScjVjU0ZQV0JiNDlxL2xEZDVWbE1MZEpDQlFxajhWSTYvOVdOeUJYUGYzTDQ2cENKcjF3VUFseDdUd2hEbFM3ZGpaSCtsM3lMVlkxZDlMaXJKZENwMk8wdlZ3UndzSDVVL0NuTDlqbGxrUGplekQ1emZXV29INkNnRldYWkZEelVUa2J1K1NGNFRjaituK294SFBhc09EMWZJeWJ2Sk5qNXpzL2JhSTNsRTZkcDVVY1VPNGV0dkkrUll5U3N4YXA0VnFrYVpGeEZKSmJNM2cyV1lIRVRZVDZhOFRHSmJJT3l5c3hHLzcxdWVhaFA3a3NZeGtGTm5KSUV4MTlONGtjeHZNU3ppMXh3SjdGK2xpVC9KMUk4WEVUbWR1', 'LOGIN', 'DEV'),
(21, 'YUVKYnZmdHd4Vjg3Z1o3dzVhYUo2QT09', 'czVHYWJOeGVBSjkyN0Qwazg2TEhPekt0MjE0UCtIalRhSzlUZDE0aWtsdDZFaVFrUmVMUGltMnVvbUluYmg1Y2VRWWtLOUVrbnp3SUlXcDVhNVVzUVE9PQ==', '2023-10-23 11:44:48', 'YWpRVE95SXN0VXZUMHkvb1pISXNqc1FvOEJVZlJCQzZ1VmJWWWc5M1NuYjRSb0svLzdTVmxnRVlUdWtTWE4zK3ZLeFVRY2t3Uk9nbDNwc0RuVVFVM01YWFJJUTJwZWFRWEpjZUFqaStSZHVyMzNsSXFTZTNkeWZHazFldlBNbDJ1WS9iRUhuZHMxMjNndlVQZTNYdzhiNmNOSVQ4Tkk2V292L21QelBZTHczSWJXK1JjWVd4Sng1dUptK3VMeE95T0ZOOGo4TlFPSzlMcnFkemdhSXl6VzYxNGVRR0dWWVYwdC9oZ3owMWhFNkNJQXpNcDBWQksrd2ptekg1V2JqTE9oVUtMWmdnWVVaM1BEUExSc2cxSlU4eERoakNxalRDZGdwR0p3ZHVFZjFzRUxrM0hSQ0RqT3VSRWY4S3krajdiZVE5SEl2OVpRUS9ZcVdEcWF2ZUI1VWlNQlY1ZjF1NEJHMzNWMkhiNDN2cHEwb0NFaC93eG5pU3VmOG9oS0dTSUxXOCtsYWhzK0Nhd2RUSUkrSUNlT2FSa1lFSWpTK0RNbnlCbGRlaGlIdUwvM0RHekYzNXpSTTRRUk9ZS0JyQ0NiOC9mNnRyZXlSa0ZDd0xOb1p3MzUzaEQvQWVQWjdyWUhhUUVUSUYvTGtmeERSZVM1NkNxNHZqbnhwaU5DdWNqNkd3YlFmajhDYU9aTHBLdHJhSklyaXVMeDg0bVdUeXZzT3krMDR6ZktBSkFRWWpLM0h2Ylc2Kzg2ekpiSWc2T0EyWFFWZUhSMEVERk1wSWt1dHppK1NkUTlld2N4RUt3aVJKcUJKcmx6K3N2K0NCZXcwT3Zmdkd6bzRLK0FNZ1Y4N2FJWG9yWlVqZW4wdkl0WU5rRUE3eXViTENCN3VsTUFYMC9VSi9vZGVNVnZWMHJLdEJrMkhYQWI5blFOY21KMzlqQ3E4eEFzdHZqUGhzOHF0VnNZUm10SjV0NGIzdHNQelNlbHVHemdic1BB', 'LOGIN', 'DEV'),
(22, 'U3JLUHhEVVV1dGU4OGhqMlFHOWk5dz09', 'czVHYWJOeGVBSjkyN0Qwazg2TEhPM0Qzb29tRHhqSFZ5NUhZSUhHTktHSXBDaHduWGx4dVdySjR4NkpYNk9Feg==', '2024-01-11 19:03:05', 'YWpRVE95SXN0VXZUMHkvb1pISXNqa2Rxc2xFTDdwazU0RHZ6bHRIbkM0NmZ5N3liQzdnS0NGMGZzTEdpS1BFNnVDWU9Wc1FDTU1wT1lYTHpIMi81QVBSQ29FMC9LMXRGWGJNY2VCMGNldjg3d0N1dDduTUVVZEV4SXQ3RFd6QWxJL2RkbldHSzVDMXBzNWlhZ3E5U2pGL3EzM2FiTVlwNUFRMHhZek41ekI5V29UQnJWanMwRWJJQ2hGY1lqZG9nOWpzZzVsa1A4anlBdGZVNUwyWkZSbmtIenJkNW1kWDFHTFRNbjVIRTFNcjVWWWM0QlFYNXJTM09Rek9WR01lQlBXYy93Nk5pdjVGQUpDMHVMVG5vdVEydXl5UTRqWENFTEVsWWpNQXNrTWJsQmxvL2l0VUdHOUtEMjlpM0k4eFgvMUNkdkRJd2ZZZWJQeWFzd3E2ekxhNFc2ZU1kTkt4OTkwaENrZEVtVHQrVHlINGNiOXdHL0xXWS9HY09wUjVWZ3lkTSt0ekR2U3RBK21xZWswd2Qxb0NGcVVVbmUwWEU5aEUyWmhTVE0rcGdQNGY1QksvZ0RRQnZTTE1aRWY3cXNtQktkTSt4VFV5YUdZU0lrL2ZVRnFvTm9hK1BhY1FJb21rOXp0MmJpNGx2VTBLNWJwZDFIZU42OHhkUExxSXR0RytUREZHSEZZR0NNa3J0blBVWjNqbFpPSUVMYkZXdGIvWXFpZUNUZkFUNStzY3E3T1IyMW4rdExLekxVa2k0SGc4Yko3NVdnZjJiaHpaaGdrT1dsY0cvMU9LYy9iZ3kvdEpsbTVSbkJvTGhPLytkRUFMNHFBNHAzZjh1SGdHVnVibEREVGtLMjBzdUh2eWo4WDl4U3N3OUtpWmJaK3c4QlVGT1lwTXlueDljUlZoc2p4dVpRYWlrMnl5SUxtRFp0WGRod2lkUFI3TzVyMFlQUzY1MU12dWpES0dPbXh4UElxcjZYTjNNY09wdVVl', 'LOGIN', 'DEV'),
(23, 'U3JLUHhEVVV1dGU4OGhqMlFHOWk5dz09', 'czVHYWJOeGVBSjkyN0Qwazg2TEhPM0Qzb29tRHhqSFZ5NUhZSUhHTktHSXBDaHduWGx4dVdySjR4NkpYNk9Feg==', '2024-01-11 19:03:13', 'YWpRVE95SXN0VXZUMHkvb1pISXNqa2Rxc2xFTDdwazU0RHZ6bHRIbkM0NzhiVkY5TUpseHYxemFsZGJpTmxIRGZINUFsc0xOb2sreTN4QUhVRnV1eDNOclZoSGpyWWZnTW53eG1oTjdmYzdoS3Q0Q1VmT3JSTnRoV1E0OC9iTXE4OWI0ZHJBOG9hZTUzdGpxa3ZsVXJFbEZaYlhld0FQQnBnenh1U0VXcjQ0d0RSaVJSNmdQbUl3NW4xWitoMUVJNklTVGhjbWJIdVFTbTdXZVBWOHl5Q2l3RDNsNnFNcUxyNEZXWVc1emRGYlVpZG1EZkJVbmtuZjZmUXROQzRWbmpCamJWV0YyZUZuU21QbGo5elJMMS9MMnpoeUlSd1YzeTd1V2VXc0tmTG1jVDJvQTVEb1E4T0ticExnT3NJUVZ1V3VOU3YrZmkvYW03MExVSHRxbGxaNnVNL2VsUFZHdnZ3VDZXYkU1bEdEdnUzZHlzQ1Vra01YNytOdUNJU0tDdWo0QmRjbmFubmNFcHR5WExmamhKbHFNcTVkTlNOQTV6RFJEZGJjMndGYmQ4Y21ZdlB0OVRjTGkyOS9acVpuVVZ2MEpsMFVab1ZGR2tLYmQxRWJJdFBBdFkxZTJDaEUzdWNacDRucUh0R1dXQTN1ZW95TTFFTlpMdUdpVzZKU2RIOGlEVDlENzMvbnp1SWlMUnNDQk0veTE5b0t4cUwrNEs0bUpuc01NMzFxdnpLZUhrSzdkZ3RJbmc2blA2RlByRVFsRWl3S1ZEczZMWDdwNHNLU1NLNHdLQnNmSG1NRnRYblJHVEE1a0FITThrcDA3ZWNpNFdLZVJWNWpyeGZCZllUY2RpVE9lL1kvNnY5T1E1OVVKTlhLeW1IYUEyOXJ6MkxaSittQzJ1MUcyeDV0c0lTUnJmOXNtbGNoQkhhMFhpNG1qQ044Rm03RXBwdnRXOWVGMkxHOUZnTFpwR3ltN0UzV0ZpTGhmQWh3T29M', 'LOGIN', 'DEV'),
(24, 'YUVKYnZmdHd4Vjg3Z1o3dzVhYUo2QT09', 'czVHYWJOeGVBSjkyN0Qwazg2TEhPekt0MjE0UCtIalRhSzlUZDE0aWtsdDZFaVFrUmVMUGltMnVvbUluYmg1Y2VRWWtLOUVrbnp3SUlXcDVhNVVzUVE9PQ==', '2024-06-13 07:56:42', 'YWpRVE95SXN0VXZUMHkvb1pISXNqdHc5Z3c4bllnSndNQXp3ZmNIWUxzWHZ3L0dHdjhBOUdBRWx5dU1NTEFzeFc1eEcvRTBZUEljRXpoZFZVTTVKa2wzZFc0TklsT2NQOHBRQkpoeGw4WCsvRUs1MVVrdGVSalBWdkh4cnFiK2Zxck4zR2hEY01udTNVNVJpOEFzTXFsQzArbXBLNEl1c0hMcHVIaWN2cVdtRytzdnhOMG80bk1xWmtmNmtWZWpFeThoZ3oyOUM2UGtPUnh4WXR3RlpGNFA0VWV6cDhIK3NIRUowRWhaOVZrcE1Sd2JPdENzK0lKQ2dNNjYwbGkzdTBLQzY0R3B1clM4QmJyWkVjZi9pOC9NbmhQOTFkTU1MTlV2M3oxWEhwWFZMZnZ6OHVWNWs1RjV6alo5ZUlheVVDTG93bCt1L1BOTjJhWjhZaC9iTWJjVEgzYnMrQXVaUVdwdHVpUDc5YXZla2VvaVNreU12K3dtUUc2aUo2eEdWMmRsRXd4WXhZRjRMR3ZLd2pRUC8rSkxST25IdzNNSVV3K1d6RGF5bE45WXpHN1V1RlBvbG11Vy9SVlZab0ZEdTZOaXlyQWkxMFVnV01YbGhkUGxaOHdRRXpaYnljN2s0dzJ3RURhVjh1NWVYNVVlL0JsRkNTeXNqbnd3R3hyc0MzNEJYTUwvZFltQ2h1ZTgvSk54R2V0OGNMaDVHeHA4bWpxYTVMRUl0MDFweU9MdmM0azFHLy9NcGVYais0MW1LTUNQY1FJdTYyVTBYNHkyUitvNkt2cnVRRmdYbkVjNERqalE4MCtUbXpuZWU4RTZlUjFjNkRPMTJmbXUzSVhsMWJUTW80bW1MU09obzJUQ1AwTlZWdHRzOSsxU0pjYXRrTTZaWmFNQUFydHRVcExqUldjd1dCTTNTZlFHUUVva0xvVmR3bXdiUkthL01ZWllkZDhjUlJDNnk3V1ViMGJZbzVwaGlTSnNUcW40ZHBM', 'LOGIN', 'DEV'),
(25, 'YUVKYnZmdHd4Vjg3Z1o3dzVhYUo2QT09', 'czVHYWJOeGVBSjkyN0Qwazg2TEhPekt0MjE0UCtIalRhSzlUZDE0aWtsdDZFaVFrUmVMUGltMnVvbUluYmg1Y2VRWWtLOUVrbnp3SUlXcDVhNVVzUVE9PQ==', '2024-06-13 07:59:50', 'YWpRVE95SXN0VXZUMHkvb1pISXNqdHc5Z3c4bllnSndNQXp3ZmNIWUxzWDFoNHJuR281OWQzTlVuRkp4dWUrNThPL24vUXAwekRkaE5TUmJVVnp2MFlPRWNmK3QyQ0RTNDRGUlRiYzd4Uit5U2pTVlJGOXVobWNJaTFFenhEZlArbmlLbm9lVEYzMGxlbWZ2TVdWWnhxN0hhNytTdFQ2QlZHb2k4WU9qZjVRQkFaNXpwVTM4MU8wWU8xTXYxTUlUdGJ3N3o1NjFabzhIbjU4bk80Y0hnZEViTG5OQmJTOFU3dGVyRTd4TDdhTEZMM3lTeFRCQ1BhUXF4L1FpN29WSjhTZUZIbXlSaW1xeHZ4ZTcxcFRwa1NzTnBFQmZrcW94YTR6cjhOZ3dFbGNZZy85ZlNuZFhDdWh1cnM5eWwvNXdlOThlbTNUQjJpbmU0SmowelhCUVEydXE5UzdkVGFKVTFmTFpUTlVyQ2FMbS91c3BGTVVic0w5bnkwTXlpb0MxRmIrZmk5d0tBOTdFblp0UmxtTnNzZUJJQ3JkbzF6Q2FqRVQwcmNmTGFWT3JFM2hVN1RiMDB3TkRwQStqb3MxREJOb2phcUVMQ29WUFNwd3FTR2QrWWVMeXhEOXkwNldLdE5JMUZWZmE3dGJyYkJLYndHMFlXRVZCR0haZVBHKzYzK0kzV3RGeWxzalhiYmVESitwZjBlR1AwL0RRME0zd2FYNjJsdEQ5dUxNRDJFbjhxVWdFVTNHZnhCOVJkd2treitkZE5QZFZLb1RmbzBnR25YQS9pUmVpUnNGNG8vNDYvSmxWd1VaMzA5UTFUVFpacW5tQ0ZXUnNOTmYxTmI4d1Zndi8rMmRGRzZmMXBtZWVrRWFLOXc0RlFqK2tJTkp5cWxaQUVDaGthZlR5WGNsR2FTa1htck9LQ1djMUxaVEs3S1ppTjZyWFJJdFNMSUZUcDJzN3JHK0hQYm5yTUdwZmJQUGFqUS9KVkFPSndZ', 'LOGIN', 'DEV'),
(26, 'U3JLUHhEVVV1dGU4OGhqMlFHOWk5dz09', 'czVHYWJOeGVBSjkyN0Qwazg2TEhPekt0MjE0UCtIalRhSzlUZDE0aWtsdDZFaVFrUmVMUGltMnVvbUluYmg1Y2VRWWtLOUVrbnp3SUlXcDVhNVVzUVE9PQ==', '2024-06-13 08:00:58', 'YWpRVE95SXN0VXZUMHkvb1pISXNqdHc5Z3c4bllnSndNQXp3ZmNIWUxzWFYrdmVlc293eXMzeGRyb2U3RHpneFFjeUlTc0lUNVY5NFYwRksyYUg4L2hJaXZIOS85Tkx2Y29YOFRxZXpoZmNNV1JRYWFQSjk4YVF1Q21lMFVyUzhQb3g3c00ya2kxZGRjLzVoeExVcVZPbXdrZ3ZZR21qckk4aGdBekl3QnRrUmFoNmpWSmpFOGxtaUtpWGhiTi9QUExsM0RDSUVjNUVJQXBIM3Y2ZVpxUmpCNC82RmFjeUJjaEcreUdvdE1CQjBtQ1RYWFo4V21CZHFLcDF1aStlQ2tWcG9zSE84ellJeG12V01hdjdTamtWYnRqdkNDbDJGTURGT05zamc4R0YwenEvQm5aUFRSb3JSbzBKV2NwMEQ3NEZENGVZOHJGNU16L2dIaTdrU3ZxcTMxSHJad0JIZEw4bFJsWGJsdnlvWUQ5ZXRMTFlwN1FueDZqOHE4Sk42TE1xOWd3ZzgwTW5RYnE1SWhFcFRzdTlNVHNlMVZCbi9ERUVYUDBrOU84VjZrV1E0VnRoaStoZytUUHl0V2Z6bUh4STcyVXVJOUk3UFBvSFEzdE8wcXRKVHVhM2lwdVFCNDRBSWw4b0VidnBSaVd3Mk9EaVpkM1l6T081VVc4QkljME5HYU1xckxWTHRMb05yR3pVdDh3cTVDV2lLVk1XVnRQZ2JmMGdxcHZuK1lQaG5IamtCZUo1M2lVaTZHVXQxeHRVNW9HRlRzQXRmeW9uNnBaSmJVMWJPdzlHNFQ4NzIwTGs3WmdjbnZiWDY0ZG1XQTRUMEpyR3RCNFU3SFMveC9tcEdPS1NaSUxpMno5OTE5ZXBuTm9NRWo3ckFHY3dkQkR1RnF0VlNTOGM0OEhoN3diMytsWTRUc1FZVlV3RklIZmxKaFdMVitxZVJkWkpTaUt6dkhXOTlSMlVOYWc3eTVLSXZHMDN3MnFGY1FK', 'LOGIN', 'DEV'),
(27, 'YUVKYnZmdHd4Vjg3Z1o3dzVhYUo2QT09', 'czVHYWJOeGVBSjkyN0Qwazg2TEhPekt0MjE0UCtIalRhSzlUZDE0aWtsdDZFaVFrUmVMUGltMnVvbUluYmg1Y2VRWWtLOUVrbnp3SUlXcDVhNVVzUVE9PQ==', '2024-06-13 08:01:16', 'YWpRVE95SXN0VXZUMHkvb1pISXNqdHc5Z3c4bllnSndNQXp3ZmNIWUxzWFFrb05PdzMzVCtqTTRCZlozSEt0VnhTVlJLM3o1WVhFTFV6bUJlNjhudGtqdzZEaWhvTStXekJQNndnS09YMkFJcWplbUJDVXpSTG9jRmg3cjZGRGRmQ2QyUGpUak52eXpObDAzQmc3N0xqbzBmK1JocHJ4bUQxYTdORFA0OWlPMGs4a1c0VU5QNHZzckZJc3NCNitJOW5NbXRDRUZLV21ld013VDhYTXBQYVVodHhnUUsvSUZ6c2tCTWxneGU0Z3NxOGM5QytwN3ppOWRTMC9LYk9JQ3ZFWEtvM1RLdUw0aWN3NFpIMkluUk41cTZzN0xDRDBaVlltR2hKb1BBNXpmRUt1OFVEeW1WM0VFNnVxTFFmUFQvWE0yOTZXWXFpb3BaK0h1cFhjdFBrUEdYeUhjOE9PVmk0azNQRHFaWWswdW5qOU9TNDNyQWFFTFFhOUx5a3RuNXkvUTRzQTI4cTBaVVFlUkIyUWdRQlh0T2o2S3hVRE1WMmowbWtYWWNlTnM0VG9NYVhpVEo5QmNMY2loZkQ4dmV1MkYyZ3R2dmhJdjRoYWg3MlU4R3g2dTlPdWRBS0U2cUlXWXRiTWFBbC9ZQkNWMTZSMlZ4OHBIeCtiMzVSOUxqTkJhV0JxdWJxTm1Wa0J0aUszTFplT0MrUmhUSHNRR2RpMTRXekNBU3RqQ1pZQUtLSm1kQ2FvSGtOWU13TExBTUdvQmxQemxhejNnQjZmdzZzdWIwTkRySG8yUms1TlJvYms1L0t2bXB6QUdZRXZWUllOMDBqOUl3YzN4YmdDWXNJbmRyZTdGN3BNVC9YcGQ0UWRsRlJIRW9Gdk9WTk5FbW5ka3llWnB6VEllSXVLaUJZaGlRaVpBOU55bjIvdjdQSUFXWXM3TU5yNGJpWjFPeWNhRm1uMlNhK2JTTDBnTkZ5VU9YY3YxSUQ3UTNl', 'LOGIN', 'DEV'),
(28, 'V1VSMklNT3VuWThWTDRuSFAvVDgweFo0ZVo4WDZQMUJGaWx5TTdVM250ST0=', 'emJ5emVlc2JieUpCZm9Uc0ZDR0tXQktGTGdEZnNtOENMT3piTURCRStFQT0=', '2024-06-13 08:05:11', 'YWpRVE95SXN0VXZUMHkvb1pISXNqdHc5Z3c4bllnSndNQXp3ZmNIWUxzVmhQNXNWc0F5U3o4cVZIZ0dxeGVOOEtyckpVekYySGFWOGpsL3cwbDhhMjNFVzRZL1Z6T3FNU1NGVjN2L1krOWluMEROVThmbS9qekVLVnJ0eUgxR1FSMUI3NXlPeTJpSnVtUmRUYlNIV05razBiejlCUzg3bUZZcFM0N21MWTY0Q2ZiY0w5SE9WY0gralMyekRhR2hhVExXb3gyd2FpaDgydFZwbXlrYnZ0S2MzenhvZVhKb2VRaHVmTFg2U0xDK0FXckcxUEhCZisrWDVSRHNKY3lTT3QyQndFb2lpTXNlemdSSjFuNVJITitBeXIwa3VTaE1NbkZMRE11eERraW9VMFZVWDArRmVhRHRNMTYwOTRieGRiTzVyWEFoZk91TEp5OXFnTE5kZFZqVTAvc2w4TnpzRmdkTGVKbGhhNkJuekNSQkxWVnBkU1FRT1dreU9TM29keEk3YWZ4WWJtWHE3bWhLL1F6eGJkckVIQnlYK2ZPUXdVaThWbFJucmNyOTNNTm5CekdGTGlDZVRxUmhXdmM1anV2Z2FhZlM4OXBHcVorUGpXL3Q1V0NlMytUcVRqS3RyVzl4dTVTT3E2NzluMGcyekZCb1IvRG8zOUFhZkdDMnJaa042enFZNWk2YU9WVHZtYUVyWWxsSjZBZXgyaE9xTEJ2aEZxQUFtOXcvai8xTzZqM3V2d3hsekZEdmtUdWc1Q0U5NlBPUE5QVi9WeFBROUZWSUhkK0FqSm1neFFyK2dtdnhkakJRYkozcXk1T1dST2pOa3Eya0dlSlBpeDduWUs5OHlYdDBGcnJod0c0czRaTGh3Wkxib1F5bG53T0h5TDVhM3V5RTNmNGdwOVlGazV2bnIzQXVYQWwyYTYwUzRWcEs0ZTQ5U1dDc0pMU2RTS3pHNGZwVGZ2ODk3NlRuVXdCT1dZWUtJQW9RQ0g3', 'UPDATE', 'DEV'),
(29, 'V1VSMklNT3VuWThWTDRuSFAvVDgweFo0ZVo4WDZQMUJGaWx5TTdVM250ST0=', 'emJ5emVlc2JieUpCZm9Uc0ZDR0tXQktGTGdEZnNtOENMT3piTURCRStFQT0=', '2024-06-13 08:06:01', 'YWpRVE95SXN0VXZUMHkvb1pISXNqdHc5Z3c4bllnSndNQXp3ZmNIWUxzVlJpd25CSisvVU9ZYXJJZEVnZ2k1VERmYVdtWGZtREVPdnlKZjlFTmZGRkwvbGh4TVVKWEtYeGZXRnhjaEFoc0V3RE05RC83bzZZT3RkbDVxUnlsT1labjhaY1lHRVRaRzdUenpyamQ2N1F1R1NLamxsb1ZiQk0yY3JTTjlmMjBQa0E5MUdVVEZIamNlQ2RjZUNLQUZRaEVNT2ZacFBXSEJHOER4N3lIMnhTWVJFeCs2K2EyMDNZWUk0b1VUQVI2NENQOG9lTjR0cHZIbmlucHVTeFpvbXcrSlVBS2pLVEgrNE5IUFdpQitVMkozNkVGenZuWEN0UWJ1ZVNtZThFTlRkcEdjZUpEWGhhWGhjNG1JMjErMDNTbzdqVVl3cVZjejJrQis4ODdUNmVGUkhVMlh0TVpFOXplaHIzd1BDaDN5V0tiM2xVMmFQVjdlZXhGUEpXbFkrQ1hwSGtxY1JlbzlLZUFWc04vbGU2Q3VhLzgzK0UrVWZJRjZ5TCtiaFd3WlNmQktUaTJYM2NQWXdjaWJXUmZBOUx6ODZrcmNnNXVkM3kyOEpWUDhiakRZZHUwbFZOVWRqajRzQkpGVGg0cDhzZmhzUXlPdnhWT085NmxpR05TTStHaDdESzRZMXNEWHZDUEUzVnp5eDNQaWt1cXJWb0U5WHdQUU8zVmtaOGYrVkpNb2RMYXNDRmptdHlsck1DU0pTUHI3ZVN4M1dxdEhvZkVvRVJibk9VVlhMY3JVR3lXbjNpWEtrbVhvY0FXZ2dqTTZIeG1QQTJRbW80S1dDOFdsSmREeWNiSUlZRFc0cWhyeFVCUkZNUk02VjJyMG91TFpLVGZ1TXNWdjhEZm43bmFRUlhjU1J1NzlGWlMvU2NkNSs4NCtwZEV1QXdwbVIwcmZQWUZvRnNrVVU3cjdYY1RFOHA3VFhOMzl3VXNSVUFo', 'UPDATE', 'DEV'),
(30, 'QzBKSmxBektsTjB2YTA4eE4yRWUwUT09', 'MUxURkNBKzFHSXJHMDZMMkZDaFByQT09', '2024-06-13 08:06:21', 'YWpRVE95SXN0VXZUMHkvb1pISXNqdHc5Z3c4bllnSndNQXp3ZmNIWUxzVm5WV01zRjRLY1kveXgzc0hZN2MzdGFrQmtBMG5IcVJtTTAxV21BR1NJMWJqRUVENEpocytoNXlzQWMyU1RJRjZCdEtnRFQxN1lkcnhuM1BVYWYrTk9pZDlibjRLbk5vL0ZVSzFmUnllSXVHQTQ3Rm44aVR3Wlg3NWtVdGtiVGVtWUt1M3FrSXBVQlVuR2VLaXNQaFBnQUFBTXZ4a3VOd1FlUVZrVVlaeGN6Q2xTZjFMU1ZZSmowQlZaZWwzbEF3UGk2Y2JEaC9pWkVqVG1uZXlSUC9wbndCNi9uMlk0elZqWG9lT3d2Mmkwd1hWZFNxZzQyK2R3OVo2aWtWU1FvNXo4ZzlQTGY0T0Y4c3ZBUlhaTFZzSzkzdXNEeUNWYjkxc1FVbGVMV1pUdVBBZ1JNK3h4UGRObXVrb2JWYkl5cjc2SnRJK2h1QVhITnJXdS9qRGkwYkRYWWc1UzVHWkVML0ViL1lEQWMwZiszbHZRS2VGMTRnOWN5SVVrZmZSZ0VYR2luelhMUFpOSXRMb3huSnJTMzNDVWZ1bks5by9pSGFkQ0VNRUc0SlZjYk5mOGFwaGtqSXNyTXFBSnFlbGVtNjRWdlA1dkptd21UVm4wUXBYZmlRbGwxTDQwd3dsbXBFRnNpY0lJaEFoQnNlanFjQWYxWlRwWVFGUU9hNDBkdjg4RVlFODBvbVQrUEhvajErMExrUFZpcGxsK0xJQVlNRDcwOCt5L1BHS2lYUGVsS1RCVVNtOFg5Qk01RVdRUGY2VmZDK1hwVVNNNXNCT2IrZE9VQWEyc2RYeU9yaTQ5WFpyakRERmJFREVmd2ZFaE10OG04ZlZMR0ZDOU14WkJpNGhhQmVnUFRPR0F6dmdsV04wU1hRaVd0c1ludlgyMWcwcTJFeUtjMnRzdGxxa0YrdllYWEVKZGh4d0M1TVhrY0drcUUz', 'LOGO_UPDATED', 'DEV'),
(31, 'QzBKSmxBektsTjB2YTA4eE4yRWUwUT09', 'N2gzcG9VanlGMXBJZmM1OStVbGdJM1NSRXlSdFlOdWZuSmtGOGQxUjd2bWJxY3oyeFF5WW5hNDNTcEcyTjhWQ0ltYVNsOGxEc1ZLenJSTkVrWXdNNGtrQjh5RkQ3NmxvUk94eDNyRWx0VTg9', '2024-06-13 08:06:51', 'YWpRVE95SXN0VXZUMHkvb1pISXNqdHc5Z3c4bllnSndNQXp3ZmNIWUxzWDFoNHJuR281OWQzTlVuRkp4dWUrNThPL24vUXAwekRkaE5TUmJVVnp2MFlPRWNmK3QyQ0RTNDRGUlRiYzd4Uit5U2pTVlJGOXVobWNJaTFFenhEZlBMMG9SUXdXek12QWVmc0o4d1RveHNVOFhIWklwOTNCTGk1eWNyS21MTG1rZlovUFhTdWdWa3I1TnBUSFh5N29mTGZ0MVNrM0pPMVJsQThTUlhudERVbUZaR2JKeEtYbTRBOUV4Vk5mOGM2UW8vcnRKS3M0MUpjSktxM3FKWnhJN0FpL2twN1grVXVTLzAvbFp6SmRKaUU2NkxrR1c1bGNtOTU5bGFEOXNpUi96RjQ0T1pzY3lSK01uS09ZUGJvdGxkOHg4Z1lmVWtrTStFdERkVVJNejZvWGwvd1VVdXliaXl1Q3ZUL2c4cFN3ci94ckFSc1c1NnF6TDVNY3dJUUxkTVJPejdHRTd0U21CSjJzM1lXT3NhMk5NMFhqb2NWTGJVUFlIb3JwaXRXZkloandDMEkzY1FLanRjRmMrdHRSSllFeGRRU0dCQW5walpQbUd3Umh3aW5zQXVBR20yOERLOGsrM2t0blg2Z0xkdE9OcEdNcjBXS0xtV3c2djF0K0diQ3JFZVdoVkdkZHk0RzUrMzM4RUE3YjRzNDNDOHZqN0RPZXJnUjFqcUMxcXBYSDI1UGVEMXVmeHJWWEpjQUVlRlpNVFZ3UGloSE12OWFrM0labXVuUWF2aVBVZnU5WXBsaU5ta1JSaHJLdmUvRHV3ZGJnZUNoeHJYN0JOa3ZDbDhxVW50OVYvRnFhME16dDNpbzEvSWJNMmdRb3Y1VEZlM3Y2VlpBdG9TM3dpaTE2eFNVU3cvVWxJNENSNm9TaC91TG1ETTlYTk8vTlBpdzRuNXJzQ2swVldyTVFjaVkvcStteStNRUhoNmVKWTh0', 'LOGO_UPDATED', 'DEV'),
(32, 'YUVKYnZmdHd4Vjg3Z1o3dzVhYUo2QT09', 'czVHYWJOeGVBSjkyN0Qwazg2TEhPekt0MjE0UCtIalRhSzlUZDE0aWtsdDZFaVFrUmVMUGltMnVvbUluYmg1Y2VRWWtLOUVrbnp3SUlXcDVhNVVzUVE9PQ==', '2024-06-21 05:08:46', 'YWpRVE95SXN0VXZUMHkvb1pISXNqcFIwWDRxOHNOamZJbi9LeDhaTWprNWtwMzFHVUxJMkxGcXBndWhXam1zOXRFNWtZcXhoN3JKWVVFbGdkRWxxaXFkamhOU0Q0ek9kcVhLQ25LT3VERC9VdlV3UzNJUmdjRFc3UzF2ZUdkY2dQemF5a3VteDZPL1RubWk4VWE5QjU1TmdXdmdZMmlweW9ZZEk4WlNkSGh0bEdjOGUycW4rbk5IWDljS09rdmtic0VpS3pDMTFORHh5TVVLWmFTMjM3U01Wdm9YSmZJL1BoK0Y5K0pvekxwcXJycy9VYUhScVJ3dnEwMW1SeVh2aEhYUFlqNG1PSHVvc0VvSkRPTnVBSmI0QWovSkE1SkhMNmVXTUQxK1k0TzJlMk5PeVh0QWxuTE9NK1M1bHMxWnVDbHNDNWNqMkNPdHBwQ1pkd1dTQXN4TjBKNXBBdStpZmIwd1Z2dWtldWdHRGc5RDdoSnZCOERLbkprNElIVWlKRzhBNXI1aUpSZ3BVUEQ2UE5jY1Rmc21pdTEwRGxTd1pRajZ6OEFuRFFMMlpqZ2ROcUw2SkhCZkM3bklhTHJORHZUR2xBdTN0Y25keVVlZ2RiaDB0QzljZTUwYzlOUW9CSmFsbi96T01hN0ZLYkpOZTV2NGVPU2MzV3BwUS8ybjNldWhWR3VJc3JXeVYvNEVvWHdiaGduWi9Dd2lhY0o3U1pualJBb3NhV3Nlc2ZmK0RRbW5uSStRdG9oZWNZMWtDTmw0SkE1MFpsdTJRdXk4VUlJUGNkRVY5S1k4ZVR4NGR0a3B6ODM3ZkVHUGRaVmpnWGluNGRSTEJ4UzBtYWk3TmpNQlNGSGJBb2hQaGtGbDV3RnpPL1VhNTJwRXA0LzBXSGw4SGIyM21hb0JIVXRKV1NkL2d1WXF6YVJHUUQyZUl5T3lyWkx3SEtkUElHRXZGY2x2TXRuUmRna2Q1akpqUWlhOFVhSkJFQzhBZFF0', 'LOGIN', 'DEV'),
(33, 'YUVKYnZmdHd4Vjg3Z1o3dzVhYUo2QT09', 'czVHYWJOeGVBSjkyN0Qwazg2TEhPekt0MjE0UCtIalRhSzlUZDE0aWtsdDZFaVFrUmVMUGltMnVvbUluYmg1Y2VRWWtLOUVrbnp3SUlXcDVhNVVzUVE9PQ==', '2024-06-29 11:28:34', 'YWpRVE95SXN0VXZUMHkvb1pISXNqbWl0VmpsUWJRdmU2OHNLd0RRVElxb0ZoRm1pTmVXYVVZYjhqZ2VFUHBCc0JQOE41OEsvNS9Bb0NSVUpqYmQ2bzFKcWJGdS9KNkQ5WWxFTldaQVlRTFFzcS9HQm05V3ZzRDlPNWkyQVRHeDZkcGlqcXZHM29yZCt4dmJQNy9DNEQ3Vk96eTI0RXBON08vMnJaOVFlVVNDOXlkazV1dFRPbDhXazFRUG9mNU1TcmlUa3pHRzFuK2ViajdFR2FLRGVRSGhHT3FtcCtwRGRqT1FZb0swVXo1eWNVODdOejBjeWltVm1aSE9ibHVqcEhDQUVQQ094SEd6NVdic2krZHhuRHNZREJDTnBzdHhiMjdORElLN2V0YUk3UlB2UzRJNE1MTlNNNmRBdG9QbHJydjliNzFZWEYyVGhoZFZDdkU2cHh5QnZxMHRsUzBneWFCMkxRMFM4K29zR2RqemE0aUFBbVQyNEp4NVU2RUpiUWIyWDc1V0x3bzdFa01Qanp6VFl6YkcycDl2THdUSjJsNVhYMWhTUjJlSFZHSXZrSjh5Q2lIZksydDA1NTlRY2g0clYweHVvcktkSk5TTDBnZUswSFc5MmlyV09zTFgzNXRqbHlFcWpxakVoQWRlKzd2RHhjb0g2MkE0UXU5bXhTYzJDVFdKdU9FUVRpL211QnQ5cEs4YWVjbTZXOVVnWWVaQ2tVeW14UXluYzFVQ1Y5c2JYZDVkaExlYjZ4WGptQStuc2I0RHlRbWVVYnRCa09YemJCU3FVb2xQVVpyOGhjUlpXdVc4TkxWM1lrLzVHOUVXRGRKbzkyb2JjaCtMRUtoekJFc0NQM20yMkIzM3hmV2pVNW5TWjh2b1VnQ292eXVhK3VhS3pBeFpwcjRJTURvN1Q4Qkh0Q0R0MEZWck1KUDVROHRqaSt0ZXBaTCs1UUp4UHJvcUxhV1FUeGxTaTdwQ05XYjZITGJsRDNX', 'LOGIN', 'DEV'),
(34, 'U3JLUHhEVVV1dGU4OGhqMlFHOWk5dz09', 'czVHYWJOeGVBSjkyN0Qwazg2TEhPM0Qzb29tRHhqSFZ5NUhZSUhHTktHSXBDaHduWGx4dVdySjR4NkpYNk9Feg==', '2024-07-09 00:25:52', 'YWpRVE95SXN0VXZUMHkvb1pISXNqamtqSVVZTmQ3Rm16eTRSc1E1dUtrTjR3KzlsRTZxMVdROWZweGRUR3k0UUxLcFUvaTUxSFFWNC9DTHI4TTlhUzJucDhoZktzcm5MRjVRc1lPdk0rZ0hqNHBWQTd3L01JeS9uNVlER2pmYjVCV2tsRFE4Wlg2ZnVNWks4OGVIT3o2YWZWamdWVmpMbFJ5R0RmV3hjZTBwNSt4dkZzemkyTm5LZDlSR0sveXd6MkE1NGpYYnIzcUZoVE9EZFJqT1RzVGJaMGsrSzBFa2R3STN2NVBQVjFjd0tMOUZzU3BhOTJETVU3QXp1SkgzSmdBMUZ1SnZOTVFlcXpoMFJraHZydWFhNitnOFdRbWpSMUdlT3FQQ1MrMTE1cGJrTEJGQWY2aUZZZGpyNndrT0kxWlpyeVdld1hqVTl6SjhvaHhlMzF5Sk9EOEhIYk9yR2FuU3BSWEE4bHNyci91WmpwS1pYb0NkcG1seGtFdTVtNE1mWnlFSXV2cUNhbGZ1Q1hJZDVUWDMwemdWSGNNMEZyZTdBcFFhMWRrR0FtdTg3NGc2U0JoNHNqVVp6T0ZYMCtHN01jT3JFUHp3TzArVWtZVWdvWEV5dHRrL2FadjByK3p0a0pyeFVBSDdtcHM1MTdnWGJ3UlRWVkswSEJ4NnZnUXJlbTlkWkRWS2xUcUpmZlowMkx3c0pJcjNOaW1xTDB2dTRaL1A5VnlCeE9OQVNZaWQzbW1obzJ2dFR0OXhCbUJ4Z1p0WFUybTMxMzNVZWRvaGgwdktGcWZPQUkrNlo3RFFBbVlNdGNhbmErSXRXV1hpUnFYNGpWWEJHUTk3SFFqeVhRaWU5ZHNubkttNXpiNitObHhiSS9COURYVjFHRmNEMHN4dkNxTmxtSlVPRlp2R2hRWWtjWDc4Umc0ODBYc3RrYUZQczFSQ2NGMG8zN1BFRk9LSzVCQWpTeUMrRWVCb0VtcHZKMVBrWk1v', 'LOGIN', 'DEV');

-- --------------------------------------------------------

--
-- Table structure for table `trainings`
--

CREATE TABLE `trainings` (
  `TrainingId` int(10) NOT NULL,
  `TrainingName` varchar(100) NOT NULL,
  `TrainingDate` varchar(100) NOT NULL,
  `TrainingDetails` longtext NOT NULL,
  `TrainingDescriptions` varchar(100) NOT NULL,
  `TrainingCreatedAt` varchar(40) NOT NULL,
  `TrainingUpdatedAt` varchar(40) NOT NULL,
  `TrainingCreatedBy` varchar(50) NOT NULL,
  `TrainingUpdatedBy` varchar(50) NOT NULL,
  `TrainingMode` varchar(100) NOT NULL,
  `TrainingStatus` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `training_members`
--

CREATE TABLE `training_members` (
  `TrainingMemberId` int(10) NOT NULL,
  `TrainingMainId` int(10) NOT NULL,
  `TrainingUserId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `universities_billing_address`
--

CREATE TABLE `universities_billing_address` (
  `univ_billing_add_id` int(11) NOT NULL,
  `university_id` int(11) NOT NULL,
  `university_emails_id` varchar(255) DEFAULT NULL,
  `university_gst` varchar(255) DEFAULT NULL,
  `univ_reg_address` varchar(255) NOT NULL,
  `univ_reg_sector` varchar(255) NOT NULL,
  `univ_reg_landmark` varchar(255) NOT NULL,
  `univ_reg_city` varchar(255) NOT NULL,
  `univ_reg_state` varchar(255) NOT NULL,
  `univ_reg_country` varchar(255) NOT NULL,
  `univ_reg_pincode` varchar(255) NOT NULL,
  `univ_reg_status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `universities_billing_address`
--

INSERT INTO `universities_billing_address` (`univ_billing_add_id`, `university_id`, `university_emails_id`, `university_gst`, `univ_reg_address`, `univ_reg_sector`, `univ_reg_landmark`, `univ_reg_city`, `univ_reg_state`, `univ_reg_country`, `univ_reg_pincode`, `univ_reg_status`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`) VALUES
(1, 1, 'qekesyzi@mailinator.com', 'Voluptas pariatur V', 'Incidunt dolor quis', 'Voluptatem minima no', 'Incididunt labore ve', 'Incididunt neque ame', 'Nemo sequi quis irur', 'India', 'Aliquam sint ipsa ', 1, '2023-10-04 08:06:56', '1', '2023-10-04 08:06:56', '1', NULL),
(2, 2, 'a@a', '', '', '', '', 'a', 'a', 'India', '', 1, '2023-10-06 12:15:02', '1', '2023-10-06 12:15:02', '1', NULL),
(3, 3, 'capy@mailinator.com', 'Quam eius sed nemo p', 'In ex nulla temporib', 'Pariatur Aut labore', 'Ab quia consequatur', 'Minima perferendis a', 'Rerum elit rerum ha', 'India', 'Voluptas ratione qua', 1, '2023-10-16 07:24:58', '1', '2023-10-16 07:24:58', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `universities_courses`
--

CREATE TABLE `universities_courses` (
  `univ_course_id` int(11) NOT NULL,
  `university_id` int(11) NOT NULL,
  `univ_session_id` int(11) NOT NULL,
  `univ_course_name` varchar(255) NOT NULL,
  `univ_course_type` varchar(255) NOT NULL,
  `univ_course_total_semester` varchar(255) NOT NULL,
  `univ_course_total_year` varchar(255) NOT NULL,
  `univ_course_status` varchar(255) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `universities_courses`
--

INSERT INTO `universities_courses` (`univ_course_id`, `university_id`, `univ_session_id`, `univ_course_name`, `univ_course_type`, `univ_course_total_semester`, `univ_course_total_year`, `univ_course_status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 1, 'm.tech', 'Post Graduation', '4', '2', '1', '2023-10-04 08:07:32', '1', '2023-10-04 08:07:32', '1'),
(2, 1, 1, 'c.tech', 'Post Graduation', '4', '2', '1', '2023-10-04 08:09:03', '1', '2023-10-04 08:09:03', '1'),
(3, 2, 2, 'MBA', 'Post Graduation', '4', '2', '1', '2023-10-06 12:15:26', '1', '2023-10-06 12:15:26', '1');

-- --------------------------------------------------------

--
-- Table structure for table `universities_courses_specializations`
--

CREATE TABLE `universities_courses_specializations` (
  `univ_specialization_id` int(11) NOT NULL,
  `university_id` int(11) NOT NULL,
  `univ_session_id` int(255) NOT NULL,
  `univ_course_id` int(11) NOT NULL,
  `univ_course_specialization_name` varchar(255) NOT NULL,
  `univ_course_spec_status` varchar(255) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `universities_courses_specializations`
--

INSERT INTO `universities_courses_specializations` (`univ_specialization_id`, `university_id`, `univ_session_id`, `univ_course_id`, `univ_course_specialization_name`, `univ_course_spec_status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 1, 1, 'cse', '1', '2023-10-04 08:08:15', '1', '2023-10-04 08:08:15', '1'),
(2, 1, 1, 1, 'it', '1', '2023-10-04 08:08:15', '1', '2023-10-04 08:08:15', '1'),
(3, 2, 2, 3, 'Marketing', '1', '2023-10-06 12:15:55', '1', '2023-10-06 12:15:55', '1'),
(4, 2, 2, 3, 'HR', '1', '2023-10-06 12:15:55', '1', '2023-10-06 12:15:55', '1'),
(5, 2, 2, 3, 'Finance', '1', '2023-10-06 12:15:55', '1', '2023-10-06 12:15:55', '1'),
(6, 2, 2, 3, 'Operations', '1', '2023-10-06 12:15:55', '1', '2023-10-06 12:15:55', '1');

-- --------------------------------------------------------

--
-- Table structure for table `universities_courses_specializations_fees`
--

CREATE TABLE `universities_courses_specializations_fees` (
  `univ_courses_spec_fee_id` int(11) NOT NULL,
  `university_id` int(11) NOT NULL,
  `univ_session_id` int(11) NOT NULL,
  `univ_course_id` int(11) NOT NULL,
  `university_specialization_id` int(11) NOT NULL,
  `univ_course_spec_fee_mode_type` varchar(255) NOT NULL,
  `univ_course_spec_fee_name` varchar(255) NOT NULL,
  `univ_course_spec_fee_value` varchar(255) NOT NULL,
  `univ_course_spec_fee_sem_name` varchar(255) DEFAULT NULL,
  `univ_course_spec_fee_sem_value` varchar(255) DEFAULT NULL,
  `univ_course_spec_total_fee_value` varchar(255) DEFAULT NULL,
  `univ_courses_spec_fee_status` varchar(255) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `universities_courses_specializations_fees`
--

INSERT INTO `universities_courses_specializations_fees` (`univ_courses_spec_fee_id`, `university_id`, `univ_session_id`, `univ_course_id`, `university_specialization_id`, `univ_course_spec_fee_mode_type`, `univ_course_spec_fee_name`, `univ_course_spec_fee_value`, `univ_course_spec_fee_sem_name`, `univ_course_spec_fee_sem_value`, `univ_course_spec_total_fee_value`, `univ_courses_spec_fee_status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 1, 1, 1, 'Semesters Wise', '1,2,3,4', '600,600,600,600', NULL, NULL, NULL, '1', '2023-10-04 08:08:15', '1', '2023-10-04 08:08:15', '1'),
(2, 1, 1, 1, 1, 'Years Wise', '1,2', '1200,1200', '1,2,3,4', '600,600,600,600', NULL, '1', '2023-10-04 08:08:15', '1', '2023-10-04 08:08:15', '1'),
(3, 1, 1, 1, 1, 'One Time', 'One Time', '2400', '1,2,3,4', '600,600,600,600', NULL, '1', '2023-10-04 08:08:15', '1', '2023-10-04 08:08:15', '1'),
(4, 1, 1, 1, 2, 'Semesters Wise', '1,2,3,4', '600,600,600,600', NULL, NULL, NULL, '1', '2023-10-04 08:08:15', '1', '2023-10-04 08:08:15', '1'),
(5, 1, 1, 1, 2, 'Years Wise', '1,2', '1200,1200', '1,2,3,4', '600,600,600,600', NULL, '1', '2023-10-04 08:08:15', '1', '2023-10-04 08:08:15', '1'),
(6, 1, 1, 1, 2, 'One Time', 'One Time', '2400', '1,2,3,4', '600,600,600,600', NULL, '1', '2023-10-04 08:08:15', '1', '2023-10-04 08:08:15', '1'),
(7, 2, 2, 3, 3, 'Semesters Wise', '1,2,3,4', '40000,40000,40000,20200', NULL, NULL, NULL, '1', '2023-10-06 12:20:38', '1', '2023-10-06 12:20:38', '1'),
(8, 2, 2, 3, 3, 'Years Wise', '1,2', '70000,70200', '1,2,3,4', '35000,35000,35100,35100', NULL, '1', '2023-10-06 12:20:38', '1', '2023-10-06 12:20:38', '1'),
(9, 2, 2, 3, 3, 'One Time', 'One Time', '137200', '1,2,3,4', '34300,34300,34300,34300', NULL, '1', '2023-10-06 12:20:38', '1', '2023-10-06 12:20:38', '1'),
(10, 2, 2, 3, 4, 'Semesters Wise', '1,2,3,4', '40000,40000,40000,20200', NULL, NULL, NULL, '1', '2023-10-06 12:20:38', '1', '2023-10-06 12:20:38', '1'),
(11, 2, 2, 3, 4, 'Years Wise', '1,2', '70000,70200', '1,2,3,4', '35000,35000,35100,35100', NULL, '1', '2023-10-06 12:20:38', '1', '2023-10-06 12:20:38', '1'),
(12, 2, 2, 3, 4, 'One Time', 'One Time', '137200', '1,2,3,4', '34300,34300,34300,34300', NULL, '1', '2023-10-06 12:20:38', '1', '2023-10-06 12:20:38', '1'),
(13, 2, 2, 3, 5, 'Semesters Wise', '1,2,3,4', '40000,40000,40000,20200', NULL, NULL, NULL, '1', '2023-10-06 12:20:38', '1', '2023-10-06 12:20:38', '1'),
(14, 2, 2, 3, 5, 'Years Wise', '1,2', '70000,70200', '1,2,3,4', '35000,35000,35100,35100', NULL, '1', '2023-10-06 12:20:38', '1', '2023-10-06 12:20:38', '1'),
(15, 2, 2, 3, 5, 'One Time', 'One Time', '137200', '1,2,3,4', '34300,34300,34300,34300', NULL, '1', '2023-10-06 12:20:38', '1', '2023-10-06 12:20:38', '1'),
(16, 2, 2, 3, 6, 'Semesters Wise', '1,2,3,4', '40000,40000,40000,20200', NULL, NULL, NULL, '1', '2023-10-06 12:20:38', '1', '2023-10-06 12:20:38', '1'),
(17, 2, 2, 3, 6, 'Years Wise', '1,2', '70000,70200', '1,2,3,4', '35000,35000,35100,35100', NULL, '1', '2023-10-06 12:20:38', '1', '2023-10-06 12:20:38', '1'),
(18, 2, 2, 3, 6, 'One Time', 'One Time', '137200', '1,2,3,4', '34300,34300,34300,34300', NULL, '1', '2023-10-06 12:20:38', '1', '2023-10-06 12:20:38', '1');

-- --------------------------------------------------------

--
-- Table structure for table `universities_courses_specializations_tutition_fees`
--

CREATE TABLE `universities_courses_specializations_tutition_fees` (
  `univ_courses_spec_fee_id` int(11) NOT NULL,
  `university_id` int(11) NOT NULL,
  `univ_session_id` int(11) NOT NULL,
  `univ_course_id` int(11) NOT NULL,
  `university_specialization_id` int(11) NOT NULL,
  `univ_course_spec_fee_mode_type` varchar(255) NOT NULL,
  `univ_course_spec_fee_name` varchar(255) NOT NULL,
  `univ_course_spec_fee_value` varchar(255) NOT NULL,
  `univ_course_spec_fee_sem_name` varchar(255) DEFAULT NULL,
  `univ_course_spec_total_fee_value` varchar(255) DEFAULT NULL,
  `univ_courses_spec_fee_status` varchar(255) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `universities_courses_specializations_tutition_fees`
--

INSERT INTO `universities_courses_specializations_tutition_fees` (`univ_courses_spec_fee_id`, `university_id`, `univ_session_id`, `univ_course_id`, `university_specialization_id`, `univ_course_spec_fee_mode_type`, `univ_course_spec_fee_name`, `univ_course_spec_fee_value`, `univ_course_spec_fee_sem_name`, `univ_course_spec_total_fee_value`, `univ_courses_spec_fee_status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 1, 1, 1, 'Semesters Wise', '1,2,3,4', '400,400,400,400', NULL, NULL, '1', '2023-10-04 08:08:15', '1', '2023-10-04 08:08:15', '1'),
(2, 1, 1, 1, 1, 'Years Wise', '1,2', '800,800', '1,2,3,4', '400,400,400,400', '1', '2023-10-04 08:08:15', '1', '2023-10-04 08:08:15', '1'),
(3, 1, 1, 1, 1, 'One Time', 'One Time', '1600', '1,2,3,4', '400,400,400,400', '1', '2023-10-04 08:08:15', '1', '2023-10-04 08:08:15', '1'),
(4, 1, 1, 1, 2, 'Semesters Wise', '1,2,3,4', '400,400,400,400', NULL, NULL, '1', '2023-10-04 08:08:15', '1', '2023-10-04 08:08:15', '1'),
(5, 1, 1, 1, 2, 'Years Wise', '1,2', '800,800', '1,2,3,4', '400,400,400,400', '1', '2023-10-04 08:08:15', '1', '2023-10-04 08:08:15', '1'),
(6, 1, 1, 1, 2, 'One Time', 'One Time', '1600', '1,2,3,4', '400,400,400,400', '1', '2023-10-04 08:08:15', '1', '2023-10-04 08:08:15', '1');

-- --------------------------------------------------------

--
-- Table structure for table `universities_primary_details`
--

CREATE TABLE `universities_primary_details` (
  `university_id` int(11) NOT NULL,
  `university_name` varchar(255) NOT NULL,
  `university_phone_no` varchar(255) NOT NULL,
  `university_email_id` varchar(255) NOT NULL,
  `university_status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `universities_primary_details`
--

INSERT INTO `universities_primary_details` (`university_id`, `university_name`, `university_phone_no`, `university_email_id`, `university_status`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`) VALUES
(1, 'Linda Gordon', '+1 (568) 917-3925', 'qekesyzi@mailinator.com', 1, '2023-10-04 08:06:56', '1', '2023-10-04 08:06:56', '1', NULL),
(2, 'DY Patil', 'a', 'a@a', 1, '2023-10-06 12:15:02', '1', '2023-10-06 12:15:02', '1', NULL),
(3, 'Neve Bentley', '+1 (831) 217-1449', 'capy@mailinator.com', 1, '2023-10-16 07:24:58', '1', '2023-10-16 07:24:58', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `universities_session_years`
--

CREATE TABLE `universities_session_years` (
  `univ_session_id` int(11) NOT NULL,
  `university_id` int(11) NOT NULL,
  `univ_session_name` varchar(255) NOT NULL,
  `univ_session_status` varchar(255) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `universities_session_years`
--

INSERT INTO `universities_session_years` (`univ_session_id`, `university_id`, `univ_session_name`, `univ_session_status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 'session-23', '1', '2023-10-04 08:07:14', '1', '2023-10-04 08:07:14', '1'),
(2, 2, 'July-23', '1', '2023-10-06 12:15:26', '1', '2023-10-06 12:15:26', '1');

-- --------------------------------------------------------

--
-- Table structure for table `univ_session_course`
--

CREATE TABLE `univ_session_course` (
  `univ_session_course_id` int(11) NOT NULL,
  `univ_session_id` int(11) NOT NULL,
  `univ_course_id` int(11) NOT NULL,
  `university_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `univ_session_course`
--

INSERT INTO `univ_session_course` (`univ_session_course_id`, `univ_session_id`, `univ_course_id`, `university_id`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 1, 1, '2023-10-04 08:07:32', '1', '2023-10-04 08:07:32', '1'),
(2, 1, 2, 1, '2023-10-04 08:09:03', '1', '2023-10-04 08:09:03', '1'),
(3, 2, 3, 2, '2023-10-06 12:15:26', '1', '2023-10-06 12:15:26', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserId` int(100) NOT NULL,
  `UserSalutation` varchar(1000) NOT NULL,
  `UserFullName` varchar(500) NOT NULL,
  `UserPhoneNumber` varchar(100) NOT NULL,
  `UserEmailId` varchar(1000) NOT NULL,
  `UserPassword` varchar(500) NOT NULL,
  `UserCreatedAt` varchar(25) NOT NULL DEFAULT 'current_timestamp(6)',
  `UserUpdatedAt` varchar(25) NOT NULL DEFAULT 'current_timestamp(6)',
  `UserStatus` tinyint(1) NOT NULL DEFAULT 1,
  `UserNotes` longtext NOT NULL,
  `UserCompanyName` varchar(1000) NOT NULL,
  `UserDepartment` varchar(1000) NOT NULL,
  `UserDesignation` varchar(1000) NOT NULL,
  `UserWorkFeilds` varchar(1000) NOT NULL,
  `UserProfileImage` varchar(1000) NOT NULL DEFAULT 'default.png',
  `UserType` varchar(1000) NOT NULL,
  `UserDateOfBirth` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserId`, `UserSalutation`, `UserFullName`, `UserPhoneNumber`, `UserEmailId`, `UserPassword`, `UserCreatedAt`, `UserUpdatedAt`, `UserStatus`, `UserNotes`, `UserCompanyName`, `UserDepartment`, `UserDesignation`, `UserWorkFeilds`, `UserProfileImage`, `UserType`, `UserDateOfBirth`) VALUES
(1, 'Mr.', 'LEAD ADMIN', '9289330081', 'navix365@gmail.com', '9810', '0000-00-00 00:00:00.00000', '0000-00-00 00:00:00.00000', 1, 'YkVYdnY2YmtTdHBSRVkxbW95bFEyWTl6L2YxNUhpQ1NRK0FFR1BMRnpDN0JnUEdFTzNwb0NJaUptK2V6WDJUTQ==', 'Navix Consultancy Services', 'Sales &amp; Marketing', 'Sales Head', 'Information Technology', 'RoofnAssets_UID_1_Profile_16_Dec_2022_02_12_17_37598576944_.jpg', 'ACCOUNT', '2022-11-02'),
(3, 'Mr.', 'Gaurav Singh', '+919625454982', 'ravidangi1983@gmail.com', '155700', '0000-00-00 00:00:00.00000', '2023-02-21 04:02:17 PM', 1, '', '', '', '', '', 'default.png', 'TeamMember', '1983-04-03'),
(4, 'Mr.', 'Garima Chaudhary', '+918860412848', 'garimabaliyan702@gmail.com', '9810', '0000-00-00 00:00:00.00000', '2022-11-30 12:11:38.00000', 1, '', '', '', '', '', 'default.png', 'HR', '1990-01-20'),
(5, 'Mr.', 'Amit  Ahuja', '+918766369506', 'amitahuja2977@gmail.com', '827951', '0000-00-00 00:00:00.00000', '2022-10-16 06:04:39.56536', 1, '', '', '', '', '', 'default.png', 'TeamMember', '1977-03-29'),
(6, 'Mr.', 'Amit  Kumar', '+919811129700', 'amitngp1981@gmail.com', '7303068629', '0000-00-00 00:00:00.00000', '2022-10-16 06:44:04.49998', 1, '', '', '', '', '', 'default.png', 'TeamMember', '1981-06-02'),
(7, 'Mr.', 'Aakash  Bhardwaj', '+918587972276', 'aakashsharma00123@gmail.com', '9810', '0000-00-00 00:00:00.00000', '2022-10-16 07:05:35.76580', 1, '', '', '', '', '', 'default.png', 'TeamMember', '1984-12-25'),
(10, 'Mr.', 'Vishal  Sharma', '+919310695849', 'tauras.vishal83@gmail.com', 'kartik@10', '0000-00-00 00:00:00.00000', '2022-10-16 07:47:08.06214', 1, '', '', '', '', '', 'default.png', 'TeamMember', '1979-02-15'),
(11, 'Mr.', 'TH - Testing', '+917983973920', 'diwakardixit29@gmail.com', '6292160', '0000-00-00 00:00:00.00000', '2022-12-15 12:12:30.00000', 1, '', '', '', '', '', 'default.png', 'TeamMember', '1987-10-29'),
(13, 'Mrs.', 'DEEPSHIKHA CHANDOK', '+917006880077', 'deepshikha.ivori@gmail.com', '491500', '0000-00-00 00:00:00.00000', '2022-10-16 08:44:45.47482', 1, '', '', '', '', '', 'default.png', 'TeamMember', '1986-12-04'),
(14, 'Mr.', 'Hritik Sharma', '+919034115000', 'iamhritiksharma@gmail.com', '870287', '0000-00-00 00:00:00.00000', '2022-10-20 11:10:57.00000', 1, '', '', '', '', '', 'default.png', 'TeamMember', '1993-06-12'),
(15, 'Mr.', 'PRAFUL  MISHRA', '+918287582540', 'roofninfraacc@gmail.com', '145544', '0000-00-00 00:00:00.00000', '2022-10-16 09:03:13.16748', 1, '', '', '', '', '', 'default.png', 'TeamMember', '1989-06-07'),
(16, 'Mr.', 'SAMEER SAIFI', '+919310488275', 'the.creativemind.023@gmail.com', '9718831190', '0000-00-00 00:00:00.00000', '0000-00-00 00:00:00.00000', 1, '', '', '', '', '', 'default.png', 'TeamMember', '1998-08-17'),
(17, 'Miss', 'KASHISH SINGH', '+919599347340', 'singhkashish2329@gmail.com', 'aryansharma', '0000-00-00 00:00:00.00000', '0000-00-00 00:00:00.00000', 1, '', '', '', '', '', 'default.png', 'TeamMember', '2002-04-29'),
(18, 'Mr.', 'MOHD ADIL  SAIFI', '+918920597823', 'adil@roofandassets.com', 'Adil@123456', '0000-00-00 00:00:00.00000', '2022-12-02 12:12:09.00000', 0, '', '', '', '', '', 'MOHD_ADIL__SAIFI_UID_18_Profile_27_Oct_2022_03_10_26_92616926431_.jpg', 'TeamMember', '1997-03-28'),
(19, 'Mr.', 'Nitin  Kumar', '+918802104171', 'nitinsuhag3@gmail.com', 'suhag', '0000-00-00 00:00:00.00000', '2022-12-15 11:12:33.00000', 0, '', '', '', '', '', 'default.png', 'TeamMember', '1989-05-13'),
(20, 'Mr.', 'ADIL', '+917217627114', 'adilak242001@gmail.com', '9810', '0000-00-00 00:00:00.00000', '0000-00-00 00:00:00.00000', 1, '', '', '', '', '', 'Profile_Photo__UID_20_Profile_23_Feb_2023_03_02_15_39680275255_.jpeg', 'CRM', '1998-02-24'),
(21, 'Mr.', 'Atul  Verma', '+918076303542', 'Vatulk9@gmail.com', '24868', '0000-00-00 00:00:00.00000', '2022-10-16 11:34:16.17991', 1, '', '', '', '', '', 'default.png', 'TeamMember', '1998-05-29'),
(22, 'Mr.', 'Vikas  Tiwari', '+919358280508', 'tiwarivikas307@gmail.com', '280577', '0000-00-00 00:00:00.00000', '2022-12-02 12:12:45.00000', 0, '', '', '', '', '', 'default.png', 'TeamMember', '1977-05-28'),
(23, 'Mr.', 'Raja Singh', '+917042560512', 'rs4001724@gmail.com', '487926', '0000-00-00 00:00:00.00000', '2022-10-16 11:48:04.10168', 1, '', '', '', '', '', 'default.png', 'TeamMember', '1993-10-25'),
(24, 'Mr.', 'Ujjawal  Yadav', '+919311696969', 'ujjawalyadav2@gmail.com', 'Harshit@1984', '0000-00-00 00:00:00.00000', '0000-00-00 00:00:00.00000', 1, '', '', '', '', '', 'default.png', 'TeamMember', '1984-11-17'),
(25, 'Mr.', 'Vipin  Upreti', '+919310596285', 'vipinupreti8866@gmail.com', '8vdupreti', '0000-00-00 00:00:00.00000', '2022-10-16 12:05:05.35454', 1, '', '', '', '', '', 'default.png', 'TeamMember', '1987-11-08'),
(26, 'Mr.', 'Ravi Kumar Verma', '+918800906164', 'rvermas1977@gmail.com', '110477', '0000-00-00 00:00:00.00000', '2022-12-02 12:12:30.00000', 0, '', '', '', '', '', 'default.png', 'TeamMember', '1977-04-11'),
(27, 'Mr.', 'Ashok  Giri', '+919810017557', 'ashokgiri68@gmail.com', '996039', '0000-00-00 00:00:00.00000', '2022-12-02 12:12:11.00000', 0, '', '', '', '', '', 'default.png', 'TeamMember', '1968-07-27'),
(29, 'Mr.', 'Vishal  Goyal m', '+918059555554', 'goyal.vishal200@gmail.com', '411197', '0000-00-00 00:00:00.00000', '2022-12-08 01:12:07.00000', 0, '', '', '', '', '', 'default.png', 'TeamMember', '1993-07-29'),
(30, 'Mr.', 'Shivam Kumar', '+919818546368', 'shivamkumar9818546368@gmail.com', 'Rna@408', '0000-00-00 00:00:00.00000', '2022-10-16 12:42:49.22694', 1, '', '', '', '', '', 'default.png', 'TeamMember', '1999-04-15'),
(33, 'Mr.', 'Amarish  Tiwari', '+916304932310', 'amarishtiwari333@gmail.com', 'Viraj@12656', '0000-00-00 00:00:00.00000', '2022-12-01 11:12:47.00000', 0, '', '', '', '', '', 'default.png', 'TeamMember', '1992-12-01'),
(34, 'Mr.', 'Mayank Yadav', '+918920222195', 'mayanky0011@gmail.com', '798254', '0000-00-00 00:00:00.00000', '2022-12-01 11:12:31.00000', 0, '', '', '', '', '', 'default.png', 'TeamMember', '2000-06-01'),
(36, 'Miss', 'Radhika  Sharma', '+919588358043', 'rs9053472160@gmail.com', '1998', '0000-00-00 00:00:00.00000', '2022-10-16 13:22:29.05440', 1, '', '', '', '', '', 'default.png', 'TeamMember', '1998-08-16'),
(37, 'Mr.', 'Rakesh  Verma', '+919560476402', 'rakeshvermaaaa77@gmail.com', '648388', '0000-00-00 00:00:00.00000', '2022-12-06 05:12:58.00000', 0, '', '', '', '', '', 'default.png', 'TeamMember', '1970-11-25'),
(38, 'Mr.', 'Soma Roy', '+919599762115', 'soma.r1981@gmail.com', '4754640', '0000-00-00 00:00:00.00000', '2022-12-01 11:12:11.00000', 0, '', '', '', '', '', 'default.png', 'TeamMember', '1982-12-10'),
(39, 'Mr.', 'SM - Testing', '+917974193252', 'soni.saurabh22@yahoo.com', '6512960', '0000-00-00 00:00:00.00000', '2022-12-15 12:12:58.00000', 1, '', '', '', '', '', 'default.png', 'TeamMember', '1990-10-07'),
(40, 'Mr.', 'Rajeev  Kumar', '+918178276895', 'Rvini7@gmail.com', 'shiv@1988', '0000-00-00 00:00:00.00000', '2022-12-01 11:12:29.00000', 0, '', '', '', '', '', 'default.png', 'TeamMember', '1988-04-09'),
(41, 'Mr.', 'Pankaj Yadav', '+917017356817', 'wantedkrishna306@gmail.com', 'Wanted306@', '0000-00-00 00:00:00.00000', '2022-12-01 11:12:13.00000', 0, '', '', '', '', '', 'default.png', 'TeamMember', '1995-05-11'),
(42, 'Mr.', 'Nitin  Kumar', '+919588239187', 'nitinku98@gmail.com', '376782', '0000-00-00 00:00:00.00000', '2022-12-01 11:12:54.00000', 0, '', '', '', '', '', 'Nitin__Kumar_UID_42_Profile_20_Oct_2022_01_10_33_96395647499_.jpg', 'TeamMember', '1996-10-25'),
(44, 'Mr.', 'Rahul  Kumar', '+918700834496', 'rachitkumar877021@gmail.com', '995261', '0000-00-00 00:00:00.00000', '2022-12-01 11:12:52.00000', 0, '', '', '', '', '', 'Rahul__Kumar_UID_44_Profile_20_Oct_2022_01_10_25_73028695963_.jpg', 'TeamMember', '1998-04-10'),
(45, 'Mr.', 'Arif Ahmad', '+919528742042', 'arif_ahmad01@yahoo.com', '9810', '0000-00-00 00:00:00.00000', '2023-01-31 03:01:13.00000', 1, '', '', '', '', '', 'default.png', 'TeamMember', '1986-01-12'),
(46, 'Mr.', 'Dheeraj Kumar', '+916207822887', 'dheerajkumr02@gmail.com', '2345789', '0000-00-00 00:00:00.00000', '2022-12-01 11:12:19.00000', 0, '', '', '', '', '', 'default.png', 'TeamMember', '1991-02-02'),
(47, 'Mr.', 'Ashwani Athwal', '+919068478339', 'ashwaniathwal964@gmail.com', '382283', '0000-00-00 00:00:00.00000', '2022-10-18 05:35:47.81132', 1, '', '', '', '', '', 'default.png', 'TeamMember', '1995-12-10'),
(48, 'Mr.', 'GaganDeep Kadian', '+919306229438', 'gagan.kadyan639@gmail.com', 'Gagan@123', '0000-00-00 00:00:00.00000', '2022-12-15 11:12:06.00000', 0, '', '', '', '', '', 'default.png', 'TeamMember', '1999-03-01'),
(49, 'Mr.', 'Saurabh  Goyal', '9650348958', 'saurabhgoyal777@yahoo.com', '262120', '0000-00-00 00:00:00.00000', '2022-11-17 05:11:37.00000', 1, '', '', '', '', '', 'default.png', 'TeamMember', '1988-06-07'),
(50, 'Mr.', 'Neeraj Kumar', '+918810382034', 'bneeraj551@gmail.com', '305141', '0000-00-00 00:00:00.00000', '2022-11-17 06:11:08.00000', 1, '', '', '', '', '', 'default.png', 'TeamMember', '1989-02-01'),
(51, 'Mr.', 'Vijay Ambawat', '+919315363809', 'vijayambawat01@gmail.com', 'Mayank0012', '0000-00-00 00:00:00.00000', '2022-11-30 01:11:25.00000', 0, '', '', '', '', '', 'default.png', 'TeamMember', '1996-08-01'),
(52, 'Mr.', 'NAFE  SINGH', '+919711304011', 'nafeambawat07@gmail.com', '42224222', '0000-00-00 00:00:00.00000', '2022-11-30 01:11:47.00000', 0, '', '', '', '', '', 'default.png', 'TeamMember', '1991-04-07'),
(53, 'Mr.', 'ANKUR MEHNDIRATTA', '+919971034575', 'mehndiratta.ankur980@gmail.com', '275914', '0000-00-00 00:00:00.00000', '2022-12-15 11:12:56.00000', 0, '', '', '', '', '', 'default.png', 'TeamMember', '1991-04-13'),
(54, 'Mr.', 'Rahul Grover', '+919318449378', 'rahulgrover7705@gmail.com', '328064', '0000-00-00 00:00:00.00000', '2022-12-01 11:12:48.00000', 0, '', '', '', '', '', 'default.png', 'TeamMember', '1975-04-22'),
(56, 'Miss', 'Sana  Singh', '+919717592533', 'anikapns03@gmail.com', '93769', '0000-00-00 00:00:00.00000', '2022-11-10 07:22:50.30488', 1, '', '', '', '', '', 'default.png', 'TeamMember', '1993-03-10'),
(57, 'Miss.', 'Laxmi', '9891966025', 'laxmisng9213@gmail.com', '220823', '0000-00-00 00:00:00.00000', '2022-12-15 12:12:21.00000', 1, 'cnNrTE43UjdBNytJMlNNdTF2SGhBZz09', '', '', '', '', 'default.png', 'TeamMember', '1992-07-29'),
(58, 'Mr.', 'Sahil Rathee', '+917701826372', 'sahilrathee88@gmail.com', '557473', '0000-00-00 00:00:00.00000', '2022-12-01 11:12:05.00000', 0, '', '', '', '', '', 'default.png', 'TeamMember', '1996-08-16'),
(59, 'Mr.', 'Anil Kumar Jangir', '+918949193751', 'Kumar.anil23422@gmail.com', '728052', '0000-00-00 00:00:00.00000', '2022-11-15 02:11:47.00000', 1, '', '', '', '', '', 'default.png', 'TeamMember', '1991-11-20'),
(60, 'Mr.', 'Tushar Sharma', '+917840862249', 'sharesharma67@gmail.com', '709804', '0000-00-00 00:00:00.00000', '2022-11-17 12:27:42.15172', 1, '', '', '', '', '', 'default.png', 'TeamMember', '2000-07-10'),
(61, 'Mr.', 'Aditya Patil', '+918595204036', 'patil.aditya0486@gmail.com', 'patil.aditya0486', '0000-00-00 00:00:00.00000', '2022-11-24 05:47:03.96538', 1, '', '', '', '', '', 'Profile_Photo__UID_61_Profile_23_Feb_2023_03_02_42_44919965637_.jpeg', 'TeamMember', '1985-10-04'),
(62, 'Miss', 'Mansi Garg', '+918368429480', 'gargmansi243@gmail.com', '513525', '0000-00-00 00:00:00.00000', '2022-11-24 05:53:36.33109', 1, '', '', '', '', '', 'default.png', 'TeamMember', '1999-04-08'),
(63, 'Mr.', 'Javin Sahni', '+919815648088', 'javinsahni9@gmail.com', '332632', '0000-00-00 00:00:00.00000', '2022-12-15 11:12:27.00000', 0, '', '', '', '', '', 'default.png', 'TeamMember', '1998-12-21'),
(64, 'Mr.', 'Rohit Kuradiya', '+919953438006', 'rohit.kuradiya.rk@gmail.com', '989951', '0000-00-00 00:00:00.00000', '2022-11-24 07:12:59.35926', 1, '', '', '', '', '', 'default.png', 'TeamMember', '1992-08-04'),
(65, 'Mr.', 'Vedant  Singh', '+918871489875', 'vedantsingh1999@gmail.com', '887148', '0000-00-00 00:00:00.00000', '2022-11-30 02:11:28.00000', 1, '', '', '', '', '', 'default.png', 'TeamMember', '19999-04-03'),
(66, 'Miss', 'Priyanka  Sharma', '+917011314889', 'getaryankasharma1998@gmail.com', '19614', '0000-00-00 00:00:00.00000', '2022-12-02 06:05:11.57948', 1, '', '', '', '', '', 'default.png', 'TeamMember', '1998-12-11'),
(67, 'Mr.', 'Parul Dholiwal', '+917027923166', 'paruldholiwal45@gmail.com', '9810', '0000-00-00 00:00:00.00000', '2023-03-16 11:56:41 AM', 1, '', '', '', '', '', 'default.png', 'TeamMember', '1998-03-16'),
(68, 'Miss', 'Shivalika Devi', '+917807496870', 'shivalikashivu2001@gmail.com', '538324', '0000-00-00 00:00:00.00000', '2022-12-08 08:23:22.08767', 1, '', '', '', '', '', 'default.png', 'TeamMember', '2001-12-26'),
(69, 'Miss', 'Monika Pundir', '+918505844037', 'monikapundir84@gmail.com', 'monika2i11', '0000-00-00 00:00:00.00000', '0000-00-00 00:00:00.00000', 1, '', '', '', '', '', 'default.png', 'TeamMember', '1994-09-18'),
(70, 'Mr.', 'Asit Kumar   Banerjee', '+918448232874', 'Asitbanerjee81@gmail.com', '335213', '0000-00-00 00:00:00.00000', '2022-12-11 05:59:19.59954', 1, '', '', '', '', '', 'default.png', 'TeamMember', '1962-03-08'),
(71, 'Mr.', 'GOLD MANI CHAUBEY', '+919110027731', 'divyanshchaubey75@gmail.com', '9810', '0000-00-00 00:00:00.00000', '2022-12-22 11:12:23.00000', 1, '', '', '', '', '', 'default.png', 'Receptions', '2002-12-18'),
(72, 'Mr.', 'Umesh Gangadhar', '+918800614588', 'mnsd@gnmsbm.com', '9810', '0000-00-00 00:00:00.00000', '2023-02-23 12:08:44 PM', 1, '', '', '', '', '', 'default.png', 'Digital', '1981-11-04'),
(73, 'Mr.', 'Rahul Chechi', '+919899264441', 'gauravsinghigc@gmail.com', '9810', '0000-00-00 00:00:00.00000', '2023-02-23 02:15:02 PM', 1, '', '', '', '', '', 'default.png', 'TeamMember', '1993-12-27');

-- --------------------------------------------------------

--
-- Table structure for table `user_access`
--

CREATE TABLE `user_access` (
  `UserAccessId` int(100) NOT NULL,
  `UserAccessUserId` int(100) NOT NULL,
  `UserAccessName` varchar(100) NOT NULL,
  `UserAccessCreatedAt` datetime(6) NOT NULL,
  `UserAccessUpdatedAt` datetime(6) NOT NULL,
  `UserAccessStatus` varchar(10) DEFAULT 'true',
  `UserAccessNotes` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `UserAddressId` int(100) NOT NULL,
  `UserAddressUserId` int(100) NOT NULL,
  `UserStreetAddress` varchar(10000) NOT NULL,
  `UserLocality` varchar(200) NOT NULL,
  `UserCity` varchar(200) NOT NULL,
  `UserState` varchar(200) NOT NULL,
  `UserCountry` varchar(200) NOT NULL,
  `UserPincode` varchar(200) NOT NULL,
  `UserAddressType` varchar(100) NOT NULL,
  `UserAddressContactPerson` varchar(1000) NOT NULL,
  `UserAddressNotes` varchar(1000) NOT NULL,
  `UserAddressMapUrl` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` (`UserAddressId`, `UserAddressUserId`, `UserStreetAddress`, `UserLocality`, `UserCity`, `UserState`, `UserCountry`, `UserPincode`, `UserAddressType`, `UserAddressContactPerson`, `UserAddressNotes`, `UserAddressMapUrl`) VALUES
(47, 3, 'MjVONEVvZ0hBUXI1bThxTU5yelJzMlpTQzVabUtxdi9lNTMxbnRTMzVPST0=', 'Dolores iusto aliqui', 'Impedit libero nihi', 'Adipisicing quo et q', 'Excepturi consequunt', 'In lorem officiis de', 'Office Address', 'Temporibus ducimus ', '', ''),
(48, 4, 'G1/19 , Phase -1, New Palam Vihar, Gurugram', 'New Palam Vihar', 'Gurugram', 'Haryana', 'India', '122017', 'Home Address', 'Ankush Pillania', '', ''),
(49, 5, '207, pocket-3, sector _ 23, Rohini, New Delhi 110085', 'Sector-23', 'New Delhi', 'New Delhi', 'India', '110085', 'Home Address', '', '', ''),
(50, 6, '602, Experion Heartsong society,Sec-108,Dwarka Expressway, Gurugram ', 'Sector-108, Dwarka', 'Gurugram', 'Haryana', 'India', '122017', 'Home Address', '', '', ''),
(51, 7, '', '', '', 'Delhi', 'India', '', 'Home Address', '', '', ''),
(54, 10, '630A Shakti Khand Indirapuram, Ghaziabad', 'Shakti Khand', 'Indirapuram', 'Uttar Pradesh', 'India', '201014', 'Home Address', '630A Shakti Khand Indirapuram, Ghaziabad', '', ''),
(55, 11, 'J025, Andour Hights, Signature Global, Sector -71, Gurgaon', 'Sector - 71', 'Gurugram', 'Haryana', 'India', '122018', 'Home Address', '', '', ''),
(57, 13, 'C-555,Sushant Lok Phase-1, Gurugram ', 'SUSHANT LOK', 'GURUGRAM', 'HARYANA', 'INDIA', '122001', 'Home Address', '', '', ''),
(58, 14, 'H.No. 1212, sector 24, HUDA, Panipat -132103(HR)', 'SEC - 24, HUDA', 'PANIPAT', 'HARYANA', 'INDIA', '132103', 'Home Address', '', '', ''),
(59, 15, 'C 38 Balajipuram  Kuleshra Greater Noida ', 'Kuleshra', 'Greater Noida', 'Uttar Pradesh', 'India', '201306', 'Home Address', '', '', ''),
(60, 16, 'S-22 raajdhani park nangloi delhi 41.', 'Nangloi', 'Delhi', 'Delhi', 'India', '110041', 'Home Address', '', '', ''),
(61, 17, 'House g-1 /1157 fourth floor mansrovar park dharmsala near shiv mandir shahdara Delhi 32.', 'Shahdara', 'Delhi 32', 'Delhi', 'India', '110032', 'Home Address', '', '', ''),
(62, 18, 'C-55 Rajdhani park nangloi delhi 110041', 'Nangloi', 'Delhi 41', 'Delhi', 'India', '110041', 'Home Address', '', '', ''),
(63, 19, 'V+Po.- Matanhail, Distt.-Jhajjar, Haryana', 'Matanhail', 'Jhajjar', 'Haryana', 'India', '', 'Home Address', '', '', ''),
(64, 20, 'Maruti Kunj Sneh vihar bhondsi gurgaon ', 'Sneh Vihar', 'Gurgaon', 'Haryana', 'India', '122102', 'Home Address', '', '', ''),
(65, 21, '2951/220 vishram nagar tri nagar Delhi 110035', 'Tri Nagar', 'Delhi', 'Delhi', 'India', '110035', 'Home Address', '', '', ''),
(66, 22, '1209,2nd floor,sec 19, faridabad', 'Sec - 19', 'Faridabad', 'Haryana', 'India', '121002', 'Home Address', '', '', ''),
(67, 23, 'B-49 sector 23 Rohini GTB colony', 'Rohini', 'Delhi', 'Delhi', 'India', '110085', 'Home Address', '', '', ''),
(68, 24, 'D-25 Bhagawati Garden Extension Uttam Nagar New Delhi 110059', 'Uttam Nagar', 'New Delhi', 'Delhi', 'India', '110059', 'Home Address', '', '', ''),
(69, 25, 'C3/24, Mahavir Enclave, Palam, New Delhi ', 'Mahavir Enclave', 'New Delhi', 'Delhi', 'India', '110045', 'Home Address', '', '', ''),
(70, 26, 'E-209, Street no 2, Pandav Nagar New Delhi 110091', 'Pandav Nagar', 'New Delhi', 'Delhi', 'India', '110091', 'Home Address', '', '', ''),
(71, 27, 'Flat no 56 manzil apartment plot no 7 sector 9 Dwarka New delhi 110075.', 'Sec - 9', 'Dwarka', 'Delhi', 'India', '110075', 'Home Address', '', '', ''),
(73, 29, '843, sector -9 , Gurgaon', 'sec-09', 'Gurgaon', 'Haryana', 'India', '122001', 'Home Address', '', '', ''),
(74, 30, 'H NO-255, GALI NO-7 MANDOLI EXTENSION DELHI', 'Mandoli', 'Delhi', 'Delhi', 'India', '110093', 'Home Address', '', '', ''),
(77, 33, 'U-109 , sector 40', 'Sec - 40', 'Gurgaon', 'HARYANA', 'India', '110038', 'Home Address', '', '', ''),
(78, 34, 'House no.19 Street no. 3 sangam vihar new delhi 110062', 'Sangam Vihar', 'New Delhi', 'Delhi', 'India', '', 'Home Address', '', '', ''),
(80, 36, 'Quilla mahalla Bahadurgarh ', '', '', 'HARYANA', 'India', '', 'Home Address', '', '', ''),
(81, 37, 'f48 first floor sushant lok 2sec 57', 'SUSHANT LOK', 'Gurgaon', 'Haryana', 'India', '', 'Home Address', '', '', ''),
(82, 38, '3016/13 nai basti near kali mata mandir Gurgaon ', 'Nai Basti Near Kali Mandir', 'Gurgaon', 'Haryana', 'India', '122001', 'Home Address', '', '', ''),
(83, 39, 'Bijwasan New Delhi', '', '', 'Delhi', 'India', '', 'Home Address', '', '', ''),
(84, 40, 'H.no.-17pkt -p gurudwara road Vikas bagar ext. uttam nagar', 'Uttam Nagar', 'Delhi', 'Delhi', 'India', '110059', 'Home Address', '', '', ''),
(85, 41, '281A , shushant lok b block sec 55, Gurgaon', 'SUSHANT LOK', 'Gurgaon', 'Haryana', 'India', '122011', 'Home Address', '', '', ''),
(86, 42, '281A Sushant Lok sec. 55 Gurugram', 'SUSHANT LOK', 'Gurugram', 'Haryana', 'India', '122011', 'Home Address', '', '', ''),
(88, 44, 'C-8 Yadav park Nangloi kamruddin Nagar Delhi 41', 'Nangloi Kamruddin Nagar', 'Delhi 41', 'Delhi', 'India', '', 'Home Address', '', '', ''),
(89, 45, 'D-81 New Ashok Nager, Delhi-110096', 'Ashok Nagar', 'Delhi', 'Delhi', 'India', '', 'Home Address', '', '', ''),
(90, 46, 'B-144,new Ashok Nagar,delhi-96', 'Ashok Nagar', 'Delhi -96', 'Delhi', 'India', '110096', 'Office Address', '', '', ''),
(91, 47, 'Tikri ,  Vipul world , Gurugaon ', 'Vipul World', 'Gurgaon', 'Haryana', 'India', '122001', 'Home Address', '', '', ''),
(92, 48, 'H.N 746 sector -13, Bhiwani', 'Sector - 13', 'Bhiwani', 'Haryana', 'India', '', 'Home Address', '', '', ''),
(93, 49, 'Flat No. 311, D-96, Bhirkhe Ram Complex, Opp baraat Ghar, Munirka, New Delhi 110067', 'Munirka', 'New Delhi', 'Delhi', '', '', 'Home Address', '', '', ''),
(94, 50, '', '', '', '', '', '', 'Office Address', '', '', ''),
(95, 51, 'H.NO-83, SEC-61, GURGAON HARYANA', 'SECTOR - 61', '', 'HARYANA', 'INDIA', '', 'Home Address', '', '', ''),
(96, 52, 'H.NO - 185, SECTOR - 61, GURGAON', 'SECTOR - 61', '', 'HARYANA', 'INDIA', '', 'Home Address', '', '', ''),
(97, 53, 'H.NO -322 - A/21, STREET NO - 5 MADAN PURI, GURGAON', 'MADAN PURI', '', 'HARYANA', 'INDIA', '', 'Home Address', '', '', ''),
(98, 54, 'Flat no-77,Pocket-05, Sector-02, Rohini, New Delhi-110085', '', '', '', '', '', 'Home Address', '', '', ''),
(101, 56, 'Tower C, Flat No - 503, Shree Vardhman Mantra sec-67,Gurgaon', 'sector - 67', 'Gurgaon', 'Haryana', 'India', '', 'Home Address', '', '', ''),
(102, 57, 'H.No - 126, Mahipal Pur, Delhi', 'Mahipal Pur', '', 'New Delhi', 'India', '', 'Home Address', '', '', ''),
(103, 58, 'Du-136 pitampura delhi-110034', 'Pitampura', 'Delhi', 'Delhi', 'India', '', 'Home Address', '', '', ''),
(104, 59, '&quot;Plot no 105 TF 1 4th floor \r\nNaib sarai gali no 2 new delhi \r\n110068&quot;', 'Naib Sarai Gali No - 2', 'New Delhi', 'Delhi', 'India', '', 'Home Address', '', '', ''),
(105, 60, 'Hn.799 Street no. 2 Arjun Nagar Gurgaon Haryana ', 'Arjun Nagar', 'Gurgaon', 'Haryana', 'India', '', 'Home Address', '', '', ''),
(106, 61, 'I-192, 4th floor, south city-2 , hilton drive avenue , Gurgaon', 'South City', 'Gurgaon', 'Haryana', 'India', '122018', 'Home Address', '', '', ''),
(107, 62, 'VPO Kanhai, sec-45, Gurgaon ', 'Kanhai', 'Gurgaon', 'Haryana', 'India', '122003', 'Home Address', '', '', ''),
(108, 63, 'H.No - 243, Sec-18C, Chandigarh ', 'Sector - 18C', 'Chandigarh', 'Punjab', 'India', '160018', 'Home Address', '', '', ''),
(109, 64, '16/410- H Bapa Nagar Karol Bagh New Delhi ', 'Karol Bagh', '', 'New Delhi', 'India', '110005', 'Home Address', '', '', ''),
(110, 65, 'Veer Savarkar ward near city power house bina, sagar Madhya Pradesh 470113 ', 'Bina Sagar', '', 'Madhya Pradesh', 'India', '', 'Home Address', '', '', ''),
(111, 66, 'DLf Phase - 3 U-75/45, Gurgaon , Haryana 122010', 'DLf', '', 'Haryana', 'India', '', 'Home Address', '', '', ''),
(112, 67, 'Near By JMD Garden, Sec - 33 Subhash Chowk Gurgaon', 'Subhash Chowk', '', 'Haryana', 'India', '', 'Home Address', '', '', ''),
(113, 68, 'H.No - 01/48, Block - A, south city 2, sector-49, Gurgaon', 'Sector 49', 'Gurgaon', 'Haryana', 'India', '', 'Office Address', '', '', ''),
(114, 69, '218B,Rajeev Vihar, Khora colony,Ghaziabad', 'Ghaziabad', '', 'Uttar Pradesh', 'India', '', 'Home Address', '', '', ''),
(115, 70, 'B-40 vipin garden West Delhi ', '', '', '', '', '', 'Home Address', '', '', ''),
(116, 71, 'H.NO-178,BAROTA,MEWAT,SOHNA GURGAON', 'GURGAON', '', 'HARYANA', 'INDIA', '', 'Home Address', '', '', ''),
(117, 72, 'Blossom Zest Tower A - 1504, Sector - 143, Noida ', 'Noida', '', 'Uttar Oradesh', 'India', '', 'Home Address', '', '', ''),
(118, 73, 'Village Jharsa, Sector - 46, Gurgaon', 'Village Jharsa', 'Sector - 46', 'Haryana', 'India', '', 'Home Address', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_allowed_leaves`
--

CREATE TABLE `user_allowed_leaves` (
  `UserAllowedLeaveId` int(10) NOT NULL,
  `UserALMainUserId` int(10) NOT NULL,
  `UserAllowedLeaveYear` varchar(20) NOT NULL,
  `UserAllowedLeaveCreatedAt` varchar(25) NOT NULL,
  `UserAllowedLeaveCreatedBy` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_appraisals`
--

CREATE TABLE `user_appraisals` (
  `UserAppraisalId` int(10) NOT NULL,
  `UserAppraisalRefNo` varchar(100) NOT NULL,
  `UserAppraisalName` varchar(200) NOT NULL,
  `UserAppraisalMainUserId` int(10) NOT NULL,
  `UserAppraisalMessage` varchar(1000) NOT NULL,
  `UserAppraisalCreatedBy` varchar(10) NOT NULL,
  `UserAppraisalDate` varchar(40) NOT NULL,
  `UserAppraisalCreatedAt` varchar(40) NOT NULL,
  `UserAppraisalViewAt` varchar(100) NOT NULL,
  `UserAppraisalStatus` varchar(100) NOT NULL,
  `UserAppraisalUpdatedAt` varchar(100) NOT NULL,
  `UserAppraisalUpdatedBy` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_attandances`
--

CREATE TABLE `user_attandances` (
  `UserAttandanceId` int(100) NOT NULL,
  `UserAttandanceMainUserId` int(100) NOT NULL,
  `UserAttandanceStartDate` varchar(100) NOT NULL,
  `UserAttandanceStatus` varchar(100) NOT NULL,
  `UserAttandanceStartTime` varchar(100) NOT NULL,
  `UserAttandanceNotes` varchar(10000) NOT NULL,
  `UserAttandanceCreatedAt` varchar(1000) NOT NULL,
  `UserAttandanceCreatedBy` varchar(1000) NOT NULL,
  `UserAttandanceMonth` varchar(100) NOT NULL,
  `UserAttandanceEndDate` varchar(100) NOT NULL DEFAULT 'null',
  `UserAttandanceEndTime` varchar(100) NOT NULL DEFAULT 'null',
  `UserAttandanceStartIP` varchar(1000) NOT NULL,
  `UserAttandanceEndIP` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_attandances`
--

INSERT INTO `user_attandances` (`UserAttandanceId`, `UserAttandanceMainUserId`, `UserAttandanceStartDate`, `UserAttandanceStatus`, `UserAttandanceStartTime`, `UserAttandanceNotes`, `UserAttandanceCreatedAt`, `UserAttandanceCreatedBy`, `UserAttandanceMonth`, `UserAttandanceEndDate`, `UserAttandanceEndTime`, `UserAttandanceStartIP`, `UserAttandanceEndIP`) VALUES
(1, 39, '2022-11-30', 'PRESENT', '', '', '2022-11-30 02:11:39 PM', '4', 'Nov-2022', 'null', 'null', 'roofnassets.com', ''),
(2, 3, '2022-11-30', 'PRESENT', '14:10:52', '', '2022-11-30 02:11:54 PM', '4', 'Nov-2022', '2023-02-21', '', 'roofnassets.com', 'localhost'),
(3, 65, '2022-11-30', 'PRESENT', '14:10:56', '', '2022-11-30 02:11:57 PM', '4', 'Nov-2022', '2022-11-30', '14:12:13', 'roofnassets.com', 'roofnassets.com'),
(4, 72, '2023-02-14', 'PRESENT', '15:52', '', '2023-02-14 03:02:05 PM', '4', 'Feb-2023', '2023-02-14', '15:52', 'localhost', 'localhost'),
(5, 7, '2023-03-04', 'PRESENT', '14:36', '', '2023-03-04 02:36:09 PM', '1', 'Mar-2023', '2023-03-04', '14:36', 'localhost', 'localhost');

-- --------------------------------------------------------

--
-- Table structure for table `user_bank_details`
--

CREATE TABLE `user_bank_details` (
  `UserBankDetailsId` int(100) NOT NULL,
  `UserMainId` varchar(100) NOT NULL,
  `UserBankName` varchar(100) NOT NULL,
  `UserBankAccountNo` varchar(100) NOT NULL,
  `UserBankIFSC` varchar(100) NOT NULL,
  `UserBankAccoundHolderName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_documents`
--

CREATE TABLE `user_documents` (
  `UserDocsId` int(100) NOT NULL,
  `UserMainId` varchar(100) NOT NULL,
  `UserDocumentNo` varchar(100) NOT NULL,
  `UserDocumentName` varchar(100) NOT NULL,
  `UserDocumentFile` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_employment_details`
--

CREATE TABLE `user_employment_details` (
  `UserEmpDetailsId` int(100) NOT NULL,
  `UserMainUserId` varchar(10) NOT NULL,
  `UserEmpBackGround` varchar(100) NOT NULL,
  `UserEmpTotalWorkExperience` varchar(100) NOT NULL,
  `UserEmpPreviousOrg` varchar(100) NOT NULL,
  `UserEmpBloodGroup` varchar(100) NOT NULL,
  `UserEmpReraId` varchar(100) NOT NULL,
  `UserEmpReportingMember` varchar(100) NOT NULL,
  `UserEmpJoinedId` varchar(100) NOT NULL,
  `UserEmpCRMStatus` varchar(100) NOT NULL,
  `UserEmpVisitingCard` varchar(100) NOT NULL,
  `UserEmpWorkEmailId` varchar(100) NOT NULL,
  `UserEmpGroupName` varchar(100) NOT NULL,
  `UserEmpType` varchar(100) NOT NULL,
  `UserEmpLocations` varchar(100) NOT NULL,
  `UserEmpRoleStatus` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_emp_retentions`
--

CREATE TABLE `user_emp_retentions` (
  `EmployeeRetentionId` int(10) DEFAULT NULL,
  `EmployeeRetentionName` varchar(100) NOT NULL,
  `EmployeeRetentionDescription` varchar(10000) NOT NULL,
  `EmployeeRetentionCreatedAt` varchar(100) NOT NULL,
  `EmployeeRetentionUpdatedAt` varchar(100) NOT NULL,
  `EmployeeRetentionStatus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_emp_wages`
--

CREATE TABLE `user_emp_wages` (
  `EmployeeWagesId` int(100) NOT NULL,
  `EmployeeWageName` varchar(100) NOT NULL,
  `EmployeeWageType` varchar(100) NOT NULL,
  `EmployeeWageAmount` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_family_members`
--

CREATE TABLE `user_family_members` (
  `UserFamilyMemberId` int(10) NOT NULL,
  `UserFMMainUserId` int(10) NOT NULL,
  `UserFamilyMemberName` varchar(50) NOT NULL,
  `UserFamilyMemberRelation` varchar(50) NOT NULL,
  `UserFamilyMemberPhoneNumber` varchar(15) NOT NULL,
  `UserFamilyMemberDateOfBirth` varchar(25) NOT NULL,
  `UserFamilyMemberCreatedAt` varchar(25) NOT NULL,
  `UserFamilyMemberUpdatedBy` int(10) NOT NULL,
  `UserFamilyUpdatedAt` varchar(25) NOT NULL,
  `UserFamilyMemberStatus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_leaves`
--

CREATE TABLE `user_leaves` (
  `UserLeaveId` int(10) NOT NULL,
  `UserMainId` int(10) NOT NULL,
  `UserLeaveType` varchar(100) NOT NULL,
  `UserLeaveFrom` varchar(40) NOT NULL,
  `UserLeaveTo` varchar(40) NOT NULL,
  `UserLeaveReJoinDate` varchar(40) NOT NULL,
  `UserLeaveReason` varchar(1000) NOT NULL,
  `UserLeaveCreatedAt` varchar(40) NOT NULL,
  `UserLeaveCreatedBy` varchar(40) NOT NULL,
  `UserLeaveStatus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_leaves`
--

INSERT INTO `user_leaves` (`UserLeaveId`, `UserMainId`, `UserLeaveType`, `UserLeaveFrom`, `UserLeaveTo`, `UserLeaveReJoinDate`, `UserLeaveReason`, `UserLeaveCreatedAt`, `UserLeaveCreatedBy`, `UserLeaveStatus`) VALUES
(1, 56, 'FULL-DAY-LEAVE', '2023-03-14', '2023-03-15', '2023-03-15', 'VDFXQjlWOWpWeDlsQ2xoY1N2ZEh4Rm1EbzB3TnZpRGVzZHJQUHlMcjNnWUZJbU9wWEM4R2o2Mmhxd0xSTEFVNWlpWW0rY2pBUkZidDg3bVh2UWlEc1E9PQ==', '2023-03-14 03:21:41 PM', '56', 'NEW'),
(2, 56, 'FULL-DAY-LEAVE', '2023-03-14', '2023-03-15', '2023-03-15', 'VDFXQjlWOWpWeDlsQ2xoY1N2ZEh4Rm1EbzB3TnZpRGVzZHJQUHlMcjNnWUZJbU9wWEM4R2o2Mmhxd0xSTEFVNWlpWW0rY2pBUkZidDg3bVh2UWlEc1E9PQ==', '2023-03-14 03:22:26 PM', '56', 'NEW'),
(3, 56, 'FULL-DAY-LEAVE', '2023-03-14', '2023-03-15', '2023-03-16', 'QUg2b3ZkVi9veDFnb2pteGxMdUVnZDRzakFJVzk4UWdSTTlmZ2NwZEZVSzI4ZS9UVnhnMUZWSzNtTFhsN2Y1Lw==', '2023-03-14 03:23:01 PM', '56', 'NEW'),
(4, 56, 'FULL-DAY-LEAVE', '2023-03-14', '2023-03-19', '2023-03-16', 'QVlQZnBHZlNwb3UzSzQ3SHpmZFhHZz09', '2023-03-14 03:39:18 PM', '56', 'NEW'),
(5, 56, 'FULL-DAY-LEAVE', '2023-03-16', '2023-03-18', '2023-03-18', 'enZ1eCtiRC9PeGJWM29SRTlEU1dyUT09', '2023-03-15 02:35:04 PM', '56', 'APPROVED');

-- --------------------------------------------------------

--
-- Table structure for table `user_leave_attachments`
--

CREATE TABLE `user_leave_attachments` (
  `UserLeaveFileId` int(10) NOT NULL,
  `UserLeaveMainId` int(10) NOT NULL,
  `UserLeaveAttachedFile` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_leave_contact_nos`
--

CREATE TABLE `user_leave_contact_nos` (
  `UserLeaveContactId` int(10) NOT NULL,
  `UserLeaveMainId` int(10) NOT NULL,
  `UserLeaveContactPersonName` varchar(50) NOT NULL,
  `UserLeaveContactPersonPhoneNumber` varchar(15) NOT NULL,
  `UserLeaveContactPersonAddress` varchar(255) NOT NULL,
  `UserLeaveContactPersonRelation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_leave_status`
--

CREATE TABLE `user_leave_status` (
  `UserLeaveStatusId` int(10) NOT NULL,
  `UserLeaveMainId` int(10) NOT NULL,
  `UserLeaveStatus` varchar(30) NOT NULL,
  `UserLeaveStatusAddedBy` int(10) NOT NULL,
  `UserLeaveStatusAddedAt` varchar(40) NOT NULL,
  `UserLeaveStatusRemarks` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_password_change_requests`
--

CREATE TABLE `user_password_change_requests` (
  `PasswordChangeReqId` int(100) NOT NULL,
  `UserIdForPasswordChange` varchar(1000) NOT NULL,
  `PasswordChangeToken` varchar(1000) NOT NULL,
  `PasswordChangeTokenExpireTime` varchar(1000) NOT NULL,
  `PasswordChangeDeviceDetails` varchar(10000) NOT NULL,
  `PasswordChangeRequestStatus` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_password_change_requests`
--

INSERT INTO `user_password_change_requests` (`PasswordChangeReqId`, `UserIdForPasswordChange`, `PasswordChangeToken`, `PasswordChangeTokenExpireTime`, `PasswordChangeDeviceDetails`, `PasswordChangeRequestStatus`) VALUES
(1, '44', 'eURvRGJReHVEYVk4eStwQnNObE4zeFFGY201NGJpWHNNaVFTTkhtYUxwUUN1SlN6d0hiZkRlekxCb3BBbmh5Z3dtQXZUMlNsZzBNRjVxSS9BVTd2SDQxMkZtbzljbDlKZnhHYURpV3g4R0k9', '20-10-2022 13:26', 'ZTJEanRHQ0JZTjExY09OcGRUMERDaWdOMkFxUjFPNjM2MCtic2tOVW50TDAxSTJLY2NkZmd4WlUxbmczcEx6TWF2L01ERUtwZnFSNU04dkRMOU4vY2lUazZuQlNUc25LMmh2ZjFSQk1BcDJlRGUxQ1RTbjViS1FkdzR1dkcvdUFjSTQrNTQ3SmFQQytIYU4wa0RLYm1NT1ZwakxSRElwRDhIcGs5cU84ZmtxczUzVGVLcW1hbXpjanE4N2xseGE2MkVWZm5BV0Q1SEpkdjRHbGJvRG04cm50S0FhSVltZnZPc0FPbTVhZC8rL3VxalJLMWgvVDNlUU9DZWUzRHcrbnEzYVZVZGp1OGQ2blBaRldnM2VPZkR0djJTcVJLRjNZTXdrWW94VFZuNXF5UFJUcWh0OURlMDJ1ZnJ5bzNOVGkwRWFFNWUvU1ZncjFoWXUvTW05cUVXYUVVZ3JWVjd2eHc0dGp5TWFVaWhIMHN3YXV1UFJGdWgvUzEzTTJKenpLMXZNeC8vNVVUSVRlZ2IrQUFMaFZBZHdmTHhDS3NHckhEWWp0ZkQrU24yT2hmZHc2MXE1cWF1eXhEa1RSUjNWK3lCMjJlQUJxbmplVi9RenZsS3QvVW9lNmtiNzBQcE8wdlBsV1FCYTltdGJ5WVgzZEZrTGkwcHNhL1pxV3BmaWVGVmNULzNvaGxDbU9mL25VWnp3eE9ZdFVzZXRwRHgvWTY3K1R3bU9hL0wzNDdGRHlpdXozdE1kR0FxTW9EK1k1YXVYd3phR0ttc0xzZFdEUVVhYWNSSTlrSjhEUzFReUpCZUQ4eDlGeDdMeTJYZ0xJNVBrSDErNGhVUFIzY1dqOUJsOUZoYVVqRC9oQmt0V0pZN21jOGtzRjBNMUltZ0NuZmxJV0FlT2Z0UTJhcDhoZS90K1BINTVHeHdiYVAwOGRqL0dteE9RL2cyTWt5aG5JSkZNRzh1ZUZhN09QcXZBYm41VFdUQWpJUWdJWE1RSjJKdWhXVUs3UVg0eXNvSnlGZU9pL2tRVWUweUkxRUdUb3hDeWFQeEdJY2JCM1dDbUZhT0dSazVuUWtyWUdOZGFRV0hKNzJXQlZSaG5DVmNKRnhYNWxBS2RQNWhVNjlQVHNuU2RRNDM0c0QzTmxnczdmeVVPRjlUOUVUYkxibTBVTjJQaXRNUnRPOXRtbGtJNGdyOTlpRHhjdjRVdmtMc0p6VWVIdlBjYXppVm9IRzZvVDBkVHlnL1ZxK3d5RGJKVnE0a2lJb1l3OWFhZVFrM1NjUEt0b1RVZW5WMGZRRGRiNGpSMzRqMDVrK0ovNi9NS1hTNnNmcHcrajNzSXF1NG55MnB4Q1ZyMVNDL3VuYVNYVEJWRG9tSWttUXBhZ2RoL0REOEVkNzUxZlBtdlhGRVYwQVFOeGo1Z3NPdTg1S1RQUCtMSmI1K1lSZEVWNzZXcnFhZlAxL00zUkJSUm92QStUZU9LVVpVakpnRE9VajZmM0VldzYvQUF6WURuYkFhOGJlY1kxK1Q4d3dra2xyd1Y1OWpmVC9wbmhvZGx2NHl6YmtSOTFiaXNERG9aa090Vm80dVVWYUhsQUEyOElTbi9Md0pLUnJFSFpDUi83SlB4bjhrWUI0clZ6N0ZqZmtPWERFRml1MldPKzZyd3dMdWJSci9ZRVFNR2NOem1DWkE2YmJNcEs3czVFQjZjQ2ZhdnVHYkhjaWRXYWI0SFk5MXdONW5FYW9kM2pFLzRGUjFGYWlSNXNFUWdoZFhENzh5MVEwOGVEMklHekZuZnl4ZHpiTDRncUZsV0VIcGpSZzRKVDNKU1FabG1FWEVJQ0xYUFhtMUJ4dzQ5QysweHJnM0tZKytJZGRqUkkzOGltd050aWVHaHJJTkxWZ2NGQXJKMCt3cmQ5TXp3eDhFUCtjYWpkQ2VpNEMvSHl2TFJIM3oyNlhET2l6b1poWHZQQ0RuZG83WnNKNUFEZkl1WUtxdnZ4TmJ4RkhOVE9BNEVpb05VMjB1TnN1R2U2M0kyVkJONE1WQm92RytCaTQ4b0VVS01CSGkycnpoZmFuZFFVb25NekdoUnBMSS9FWnpncGNRcDRIQXVTa2NQdjArdGgxcUNSS3YrQmtQN1FuYzIyVm5sUA==', 'Active'),
(2, '44', 'U1NGQm9adW9GYXozdWNqY3B0NWp2bXhBNVoxUEViRFprWWJaUE9uaG1XRWpyanhZSXFNR3RoR3owaXNRcnlRYy9JalQzcUJ0WFdic1VES1JIZjM0eEV4Wng1TGZVY3NhQXExbXNWcHFCMXc9', '20-10-2022 14:51', 'ZTJEanRHQ0JZTjExY09OcGRUMERDaWdOMkFxUjFPNjM2MCtic2tOVW50TDAxSTJLY2NkZmd4WlUxbmczcEx6TXlPUmJoVDJMZUZqK2dwckFBL0trR0xBRXhPQUhLQ2c3YWxaTjZqWVFIOEVpMUlBaVIwNytRWVFvZ1lmZkJqNGdxL2FlamFYMmswNUpKWXRtaXJpdjV4Q2NlKytacUx5dW9uUEEyN0xTb2g5UEpGQ0ZpZnFoYW5SYk92ZDYya1B2UzlPWnFONHBqbnlRWXlVckV2VkcrYUw0TzZ4UkZoYVJGOU5pVS9vVUl0NmtEd0F1b2dIbkNSOHNOQldVZHlNMG9nYnp6WjM4eGVKeUN6N0VodkRhejRWVkQzZWRUNWp2KzV5KzRudmFDeXRZUmVHN2F1SmRqTVFMS1dTRDVkUnBLdm85UE5pbjh3c2cxem44S0F1VTF2U09FZUZoNVFDdDFpUzRhUVl3RlplUm02NktvMStRUEF4eERHOXBUekxZcVFqOGVIS21SZ2g0RGd5dUl1YzFrWHA5aWRwRi8vVHJFeDAwWUZkZ2VuR2FGNUZ4QXlGRzk4TFhwT1dkQlo0VW9sVDdTQ0E3ZWU5RVNNQmRaanE0UTlHdVd2V1gvR2d2dE1yUFdFQWxqWVorbC9Sa3d5eW4xRVJBMjVhdGlrR1pNbWUyYkpMUW1UVGpBdnZFQnhKTFZ0YTRzbkh3R3ZvQjFnVmI4NE91dURjL010dWNyaWJra1JESFRoSms5NElGa0FKNmNtQ0p3d3pkNFJlRnJJUzNJeXl3YVFXZUd1TFRMTFBHVGFSOVJBOHlnTGRLVG9MOVV6L3VlakErd3pFZkJMbXhDamVKOXFNTTU1RTg2VHB2Ky8yTkRnMU4wcDQwMWwwUnR4V3VzbjVpaGEzVER3czJJNkhTSnBSaVlramh4M3RMdzJndC83anRIVzdleEdHalBxcGlGdGtBZkdrRE80VHJTenVQYkxYWklmM0IyTFRQZTZUdHd6RzJnc251VVBsV1pyWjM0Mk1RWW9Bc1ZoVDJyQnZscUJwZWQvNUpMdWx0cEFCZk42Zkoxc3pqeWI0eHpUZzdlS2VXdUZNdlU1bytUQlJYVmpFbEI4aDdzc1dvYTRSeWtXazhhcWswcURWaW5Gem9mclVnazVGRXN5dXhQd3QvZ1UyeXRkVXFkRGJGTjNLbG1FOUVHRVpJK3lvMHpBWjhvbGlsRVBTN1g0blR6SytKSDYyRlJxNWxNQlg0TDdXWjdXQWZZd2dEMHFiNkNxRjF5d0ZpZ1NYUzNyU2EvT1dFQXByc0dQWi9sRndVVjFTa0l4Zk9RY2hUajF6eTdsdTdFeTFkZ0psWFM2U0YxTmpTQ0dnK3ptSU0xRGlKM08vTFZhNVFKWDNrd1VROWhIOHpTdC9aZC9BdmZjakRzWFRYeGdKQTVHK3p3TFh1RmU2ZTloY0IvS0pHSWNRU1h0WXVYTFVYdlJVajlIVGxrdFEweVdjd1cxS3RoN0lmNTBqTmFPTzlwY0FybndkK2RVQVhJdW5lOE56MmZUVDVJdWcxcGFxMjRCamh4SjVicmFubW83VEljQWdRVmkwMkxCamhJUTRKb3p2MXlwZ3JqanlzdDN3akZneVREVVNsMjhydy9PZVlHSCttdmcxZ0VTM3dzUmNmczd3Mi9CeC9qT1hvQ1NzbGJXRXczMHpSWDFVeGhsSUVINlYzdlR5OFU1NWV6aFNXbXNuNk1sL0JzaTIzT3JvTlMrRGV2WnNkOThTVytzdE5EenQ2bGQrZ1VBV0RRa1NGOGx2bkRxTE5XTjhlWVhPUzVlRXZnbkxRZ1VhVk9COGxacHQyQTJqcHF0d0RZeEhlMkVackxvdTNka0FFQzdQYjkveXdaR2xEK1R1TWYzOW92UGdxWmpyRWpwb25nVjFMRGRGaC95M3d2ZjdubHUzYXp5WFRXZHlrRU5Yc3ByQTl4ZzVldSt1bTViTjdlN0lobk1zblluYS83RDJEc1FSQVVpWjJoM3BzR1hvUDBJV1FPajhP', 'Active'),
(3, '40', 'WnlBdloxa25rSXUzYUFYR3ljRllPeU1velo1ZmFZQ1lZTkhXMlNaOTB2Qk94ZFlCS1lNNmRvRWVVSy9ueHlSNWM4OHhxOSs4RXZLc2NJdTdxSnUzUzhDelFUendwMkZIZ3VkVUpERDVyWFE9', '27-10-2022 16:13', 'ZTJEanRHQ0JZTjExY09OcGRUMERDaTI4OHVhNTFOcExWaC9zODR0ZnIzOFE5QWtGeTlJK2NFUEpudWYyWmwvczhMVmpFdmZIVE1PTGtUNjRENU9rREFoSGJlMXRpV3p3bVFnRnhDQUpaWVpQc3RNb2M0WTZ0MDByVkxhOWhMRDJvWiszSVc5cHNZTDVLaU0ySFd4RFpCbFptbVBYWExuUWEwb2RidDU4Y2JJczFkbXpvWHlmMTQxTURXemNYZlBCbS93aUdjVGhEZitqdHlPcVRHbWUvK0ljNXRxdFZwa3pxTnlpbU1Pek1DL1RuTjhMcE4wMDF0QUwvY3VnU0tma0xUKzE3ZmxINElGNkFzbGhuVWVkUmh3eWlMdjZiZWdQOWZKUEsrbnhoUUVFRThvOUYvM1g4THkyTTFmbDMrM1F2Z2tUR04wNGlaaWpKV0hTYitFWTJ0My8vVmYzcFU4Zk1YOGdsNmV5SEJFaEE5bDYwUFd3TjRQQW5yejhMejAyL3J1Tm5Ec0grb3V1bk1xZXUrNjlOaXlTNXREVmhSd3VhQy9vMTVXSGdRaTlLZkhKeDBlZitVL0xrTGVvaTNOSUZFdDlLeC9DbjVDYnRJME9EMzdUY0lYUWtvUUxjQ0NmcURiVlh0czNKWVRLRXZYUm00NTIzaG1tVVhob0ZaNHpHOStNTDhES3pCSmFmQmFicmxhT09uZXZsODRWb0p3a2hlYkdKbVJ3NVp5NXY3MTFvbWxMTEdEWmJlL3R4OENSblZLOU9La1NvdnRFM05ncnBtMDZja3Bhc2VuZGVMRkxLSHNBVkhwaUxldXJ0VVUvSnBIajJhdzdkeUUvTWZHMTdWdExxMjE1MUxoK25rbDRhblNLK3FBbWpMUEw1cGw3WThBR29jVENhUlRGMGEvQi9TS2VocXRmempHTHhZZGlsT2NmVEhoeDVTbUNhbXdseTBSTG40Z2pOVVFTWlR1MFlKSHd2WjR0cU9ZVWxRRVIrRXVLYm1QaWRacTIrbUdYQ2xpMnR6K2xMU0JPczBjand0NmVmd01UaUFLRVBSTDdwYnJXcXFBbWNILzhrR2sxaVY5c3ZtclJBczNnRXU4S0FBUkhFTG03a0I2eHZ6OC9DdWFONDFkVlVzVFNNQUwzZUhCM0hIbDFkemZMeCtrZGNFc3pHd2ZaTW03U3FGSXM5eUN3UlN5c3pZanBja3VWZmNkNzg3akZ6Wk1zSEIxWTVsNkZsR0daa2Z4RS9qZVZMY0ZYWDR3YUIyd2lQeHJvZkowaW9COStjamI4eHBGSnUrR0FQc2dXNUNwK1BJR3IvdFlBeWdrWStuTnRmSjNpUVppZ09sRVBiaG1WcU9Fd2ZKcEZvRnk1aG9wQUIvbno4UTAxR0R6NkN4dENwaXBnZmhPcnZQSkpXN0NJMWk0SXBMS0V0UXo5azllMVFWMzdlemcxZ1JSUDFiVXdEb0crU2RuRmtyYjN2SFFWL0RvdDllZW1FVExGY05ENWJSMmJJMm1wcEJwYUk0ZzBGZ0s5aWI2MFIvMDQ4T21SdzgrMTBGc0RoZG9lV0s2VFdOQjdOaG9MbTdkSC9sb3pTbHZDbGxUZlFDTnhjWVZCRE1qWFcrYkdreTBOcFZoUEhzclR2RW1lQUtVU1ovMlhrNHpYamFjNXc2WGNkTTY5cWVZUDNIR0JHMWZlMEs2TkNSNEZwdUF0Ky95VjQzMWU3Zm92ZmpKRmlkR29YSmVtb0VNbnBaN0lrejZLbXNPeFdsZGpjeXNuVDhBd2xrZ3dDd1liT3hyemhjVnZtNnRaZHJHUURra1k3enZZTVNaMUk4SXlodTlQNm1ZTy9OU1RtMHRYV3NSVlQvM2JIdXM5RVo5aUFFc3hjR1BOOXVENHZVL3VlYWN5R0g1cmFXSVJaQnc5OFo3Q0xDSFdZSVYzeEkyVGtjSnRIWVpqb1g2cWI2aTc5Z0JHeGlncFg0Nng2NlIzcXZBVkdwVUhYVHFDTWdpbTEzcU1iOEx5Tkh3RnJaK005MHZhdmFDNHYwNkV3MTliWS9yczM3NEFoa0gweVM5MmNheEpabmNnWW5lZWtPeDVza3BsTlBxQ0R2OEpFWVJmS3pmUG5BODNheEJqMGIrZWdSZUlVTkt1WWh0ZE4xL3ByTGV5QXhNNjVIajBoalNYbm03OVdOK1pyekk9', 'Active'),
(4, '25', 'cWgvbFVaZWVWQ3pIcXdhZVJIL2NJQUN2dU1VTFh1ZnRQczV3WDBkUG5iQ2p0UjdkZkdJVW5uS2RLbnJsSndHNWlSYkYwd1RPVUlzenV2OVVuRGlJcmp4WFE0ZmxRQWRlTE5JV21wQllBU0k9', '29-10-2022 11:23', 'ZTJEanRHQ0JZTjExY09OcGRUMERDcHI3bU1nRTI1NkdsKzgrWlZ1aTBReU9pbFBsYTFXdmNQM1FVOWhzV015Tk1LN1JVQ1Bzd3YvcUZHZHRiblpGM1V4NjRJQnplY2dHc2pkeCtNdXFXSVpkbFc2TzFTaXBHbVUwRU4wQWwrc3ZDY2kwN1pURjFXLzdMWkpRdWlnY2NLY0xPUkZRRzFiQ3A0alM1YkZ0TmVNczZxK2plZkJicHJpT2NlYW1UbGE3bTE4Tkh6cndROVpHcWh5R2Izc1dZSHhPanRPK1V6QVVvNEp0NE45cU5TQzZ2YlJtL2xPN2RyOG1VR0hEZ2gvK1FvNVRNRUl1bllYT2Nyeko5eWNLS2FmYkdLWGpaQ2NSUDFwbDdXOCtsTHdOU3dXeGdVMG5BTUdoQ2pGazBxTkVBVjhsSnRYWU9xa1I1YnhFNU85akdiK3BBK2FLTW1NSkRLZ3h0dmp3Z2x6eGdENHFmSHlvai8xbUZjVU90ZFAyc2VhTCtpVDhUTFpRTFQ4RTJhUHY3SHdjQncxcTdGZ1Vvd3JPSDRiajVrRWMxd3htOEd4KzlseURUTDdORWpQWSs4a2l1UHRETElPb2c1Z3BqM1lGdVpEQnBENE1Vd0hJcEUwRWJnUXcxbjFuVlhjZGgyMVdrRE5tWWxGblZVMldvQkh0VkNXbVZpdHJKTlJuTXN6di95dUp6bmQrdHR3TWdvRUZGOUtoa1MzeG1pc0wyVHdtZlRlUHJmdzFrNUdQL1RQVjhIcDV6OTdBMFFDeENSTXFZSmZlNXIvYjIyQTlMMVNrN2FSKzR2dXE1aU5mWkNIZmZrUzNqNkNQM0lBV2V5NEV4M29ldUV5ZUUzTXJ4Q3FYWlREalJmblVBQWZrWGh2SGFIcERUYzZXRnljRjJBMVZuWjB4TlNmTjVaQTJ6WVhYek5Jek9HWG5qRFhHZlNpeHJZcDdaRFhzR0hpTnBIa1FsanJuNWJuczZRUG9kV1RrMW5NUXFLV04zT2xLZTdwdUpiS05yR2xXQVkwNDYrSHBCMGo5cjdxMjNnaCtxb1Q3em9kMVZjazBScWV0Z1g3VXAyZDhZL3JkK0lwYk9qMUZGVXFjeVoxTWFNRE5kbnQxYXYwUjdBUVNZcVdINllVVWJLWE1ONHEyUjA0Q1FmbHJkSTNkaU1hK3U5cEhVZjJHaDI5c2ZJVDY2SzIzMzczY25pTjV1UHZMNm1MdEt2Z0xrZ2U4T1VMeHZBNC9lZ0pPeTBpR2lod0thYnJxNFNydmJxbzA2QXNrTis1ZTFkYXd2OEQ1L0FIL3kyV24zRmoxMFhYSVczeE1sZ3d4TG1KejYzdnZMVFVJSHF2bXdiSzBmU08xcjE1RjNDaDN2NHMvV0FsL3BiakpNbUNnNDY2MXZOVGJwbjJoeWM4VVIxLzYwRjZMUXc5TnV4WGx5VkV4RVdJZEcyc080cExFMnNlbEQ0Sm9zdTY1TElSWHNqVVNja2s2dmNJZUhTZnFIaGhhNHFKSnVmVnRzVWZTVi9LT2pxNm5NejQ5dnNxSUdCbWVwUUdXcmRVbkFUUlVUQkt4SnpKSnUyWmQrVTU1OTlXSno3Y2YvYWdpeDlQK2dvNTgrVytRK0xhbUNWTGYxZHhoMnlVM0FlV1NOL1hMQWtSTUtNelMxcVpWZlpmeWs2V1FoN1R2L3hyM09EOVZPc1ZtbXo2aWFXTHVvOE9ueWVhWldrUCtaL3BDWjZzT01KYW5DTjZUT3owNHZsd2lBMllJdzMyOE9sd1FVSWt2dnAzU1lCY1h4NW5UOVZpSGFQQ3JCMCs4YmhDQ1FHbW53WXhBbnlicjVyMTJPVm9qSGRWdm9lcjRNbEFNVHFySmNxdi9MUDdGaUhWRzZBd0NTNmw4cytGL1lhSHdPU1BtV3Fwck5ocVRNSnRnU1F6VXZxc2pGS3JiMmhYSjFKNERPaUtFd1hQTGtFU1hURGtLS241SytVUnRvL0prLzRTK3ZHZ2JVM1VXZ1orZnZVR1NvVU9QYW01WWRuTWtYaXgy', 'Active'),
(5, '10', 'NUtZZUptY2FKZ1BRRWFzUmJjQUcvcU1ucUlFTldhVmltRkNJUHZ0S0E5TVlXYzNQOG1wQ2RkQ2ZQclhRZC92eGRCVXlVVklCYlFqWjk2Z0pVRjRENVU3MHNTUy83eWVSTFExUmlWUVovQk09', '05-11-2022 15:55', 'ZTJEanRHQ0JZTjExY09OcGRUMERDaHJkalFOOEZ3RSt1SjhYOGJWMXBHRzJuOFVjcU5kZURVVmtBOFN0ekx6QmlNSldLU0VMTHZ0Q0VQM2pGS3IzbHM1dFk2cEhteVYrNWp1bFQ0WFZDV3FBdDRPRGtxc1M1UlhJWWpCaHdQNWtZNXg5eHk5clRjbHFwMHNrTzBNNnFiRndoNDIxZndYZkFMZE9RSXZxWHFFY2l5alJHOU12LzBtQWF5QnJXRElPQ0h5U0FQbm9nWGFxaDFBV1dSWVJYM1F6NS9LU05QZy9CY2RlTDVSb0kwbXhsNXFVU3JTdjRYUkFKZ2poYTM3aWJBOHJGY1FmampqUnBOalM1ZWRMMkt2QkVXUlpMcjd2eUdlRFVIc29yelZiaTIvUzhYU0pNT1dYbmJnUU9VRGM1ZnZ1Vk5aalk3emxRWVBVSEdOMW5HRDBCb2kwWTJsMnlUWW1KdHo5RzZIQ1pGeXRmQjkreUtaZFlIUVVoTkttR1J6cHpFajN6ckhqK29WRmJ6T1RZN1l2aS9wNHFka1ZneTROb1M4aTZLN3g4MndFWUl4dEtYOXBSRlhPdGkwakNMbnA0NFN0cFlUVytJd3BzTXRBYXlNUWN5emxiOTlKT1FQTzBFYU0rMjgycm44VXJMRlhISkJHNlNpWnh6bTdlOG9ZRytiWlpsOFBrZFFpdEk4VHRBMW1TdTJMdzJjellhMmwxNlFvRlRtb3YzQ2NGTUtnMzh1SlNTRnViNjJOdHM1VlkrRWU0RlE0OUtBempnejZlVHYrM0N4NXFCMWtrOWoyQ1hpWEF5ajVxTEdmdCthZUQvUFhseDJFdXdGZ0l5ZTkxcVdWM1E1ejRrVHV1cHpmYUp5dW5pWGhVWk5VdzdxTE9lbkZLTGZHNWh0ZjArbVNEaVkvLyszWnA2cGlTclczdUYwWWRqOEJtT0lQa3ExU3J4OGVMNXozaFRxd0I0cWhvTTcvSWRxQkdsSVRhbkxlQjRMbXhRTjkwVlkrSnJ4T2F3VTFvRkU3U3gyMXdLdkZoRDNhM0FtZFhacXFxdXJjeExaRHVrdnlYSTdBMUdEbVBwMEVuRHNZVTBDM2J4bCt5WnhGQUJYenVUOEVVcDhjQVpmb1ZieVhSQlNwdmRtT0ViTmFBbXFSMzVXcTFzZlBINDJEZkFLUW9Oc3ZnMStxVE1RcjhaVG1qcDZpbnA5Q1kwTE8rREpaekwyQTVBVmxyZGVoRFJyRFJYdVpZSDhtdkdaU051amhadUZid2ZyMVpSell1UVFFaUhrNzkyOEFyVDU0NTM5Qk13VmxYeHlaOS9SWWJmaUVnNTJnSTFVNUNHeTIrQVlFS29vbGlHcURNTnZ4Z05aNUJ5U0trNDd5cDdUTVhhMGhpTExzdHFGYUd2RGQweUU1SzZqVzREWTRvc2tSbko5ejhVVWNndDBacUtlTFVFQ0NPdERYNEErdWNCR3Zrcm4xOEpuOXp0S1hhanFocEpCQWQzNE5mK2llYmM2VVBMYzh0Qnk3QXp2N0Zvck1Oa3p0QmtBdE92cjVvWnE1NDgwelJNeGE5RitWNjdra1F1SFNDVG05VWF2WnZ2S05xcnR2bWVWMkI2bkNsQkh1bXZrQ3dtVjFZSXFpdXJRejRnQTQ0NkJSaUlhUUczb2RVcEZqanBQbDU1OHRaU1dVS3lmVXYzbUNKcmRJanI0Q3hTVk5qQ2xVbTFrS0NxeEowU05SblFYL3BzSTlxemNzczB0MmRUUXd1VG5Ya0RDUFBPTnV6aTJxZ1YvQWYwU0pUaWF6dzdvMHA3K0xNRXhOYitqMDRkVnpKb2hWRmZBQmp6NGpsQklOVmYyZFk4eEdjOGV2eFpyOHI4RGVkU1d2UUhVZlBKSENocjYzR29aZjVKc2NHaUpoRUF4dCtzOEpCRkZudzJVZXVTdTJ0c3FoS0hSRDFuS0ZTR3RkVkZCd2YrQ1pVd0MxR2hwb25UTmxRZ09oK1hqUno1UUhoTG1iMlhpY0twdTdvWTkyYktXMytoaGVEUURaU2dEaDFmSjBsc2FlcWliMHhsaFViU3RkTk9DUGIvMWYxTENBOEpGMGw2YVluVXptSXdUUjFsL0xKTllySDFlUWNFME82bXlVcm9EUHAwR3JubUowclZ2WXNJbmIvRlFjdTVoMnJPQklTS0lNTFd3NGFBQWNxemoyZVpzM21SQzJHZmlBaVp0NWRIcmdCN2M3NjR0WU93PT0=', 'Active'),
(6, '41', 'UXNxVTdMV2gzcmo1MHBUT2hkNVpnb3FURWhZZ0tXN21BZksyUFROM2MzOUdjQVBHUnVuaEMwdmNmai8yRVRJZTRDdE0xRlYzaW9KbjBLNWtyUktGY0M5bHNvMmtKZnNiTHJYd2RkZEtNYWM9', '21-11-2022 13:29', 'ZTJEanRHQ0JZTjExY09OcGRUMERDbmQ3cGFaM0p3Z3NmQzhmZmFBdGlLZlRBZ1lzc0RsQmJiUkRGNndOeUp1TWVQTlVUNElQcFoyeEUxaWZYWUxsWUdRdFIxQWNMckpDL1R3aERCelp5STVKK29TZWU5aFNva0hWUGx4VmpsWHIrWWNHTXlrNTFUNnFmbnU4K3NNbUIrZ0lTaHpiT0lhZXdqN2I4dEt3dExYNVFvczRwMkZBbFo3Z1lUVThLYitoNlI1cVVTbHBzalJEWFh1VC9pamVFUGdidEIxd1pXY2JodWRrZUljb3pRRythUVZER3RmYThXdSt3d2VOQmRPb1lPVllaV0JScTRRa09VRHhBc0VkSFZQNXd2clIrK1JaaEVZdDI2dmlPV0xoV3VvYkV3VXA5TXNjZm84SEtLek04VUhNc28vYUY2WFF0L3JIY1FUTnFLcEFGSHl5elFXbWxhRXkwZmxGaFU1blVZdytWaXFmbHJDQnoyZFhmcFEwQVpNMFAvQzh4d2lsOU1vNGtWdHZLbWQ0UVZYV0l1WHhqRGFMd1RLb0ZxZ1AvMXB5bHIyU0psVE90cGh4ZWRVUWhpQzdkK0hNWUordG9OMWUrYStjRERUc25kSzVEem5aOUdxREdaNGNlYzQzbFAyelMyK0E0RXVxZ3hZb3pvb0xXUmlYc0xCZ0dZanZpSloydUdnRGRRa1I0TzhYaWtpdEhUOENiWXBUc1k1cXRvZlJkMjVZTmU4bGpremoyN3hLRXNZT2cxUzlsMVlzMk9mdkZkOFF4My9hRlROemJqMWlINGpXdFpLNTJrTFU3SUJGQ0xvV0xDRE15bDVUWkpxT3RDb2lFd0JzQ1NzWU5KdUp6aVQvR05XNWdKV3pNR0V1bWlUbENBK09kUHo3YiswM3JIaCtPSHBkWGF3YzZqU3c3WVJsSyttRjh6Y3h3ZlVncE1sQVdtOUh5cy96NEoyL0dxOFhsTm0wajV0THFOMzY5WjBRT05GUitrVDMrSHF2eHJhemxiL0NoZDMxdFJNVHVNZmNSZTkwVGMvaGMzczJCZW5Fb201aVN3VGsrZG4veVhDRzVleUFQWFZaTmt5WVU1WUhWN0tsTWVxSW1BS0wveVJNUTYyTEQ1bERTZEJYeG1PUktjUHYvLy9lLzFZZ0xvRHdZZWMvSTVzSm5hZmxoQU01L1FkcTM2VDRHMGRlcUNSOXdKVXJCdnozMXhKUjdlVlBSOXNveHhwUHk2L3MrWjBSMU1iYTZ5ZjZJSUYwTFlTQXp3cUtmL01ZODdjbWVXMWc1aFB1RkYrQmVUdHlSYVc2cWZUSGoxdjBReXdIZ0p2VFFWRDJlZEdFYmlIMnc5ei94dFNjMGVTanA1VlpsY08vamtuNUx6UkQ1QUxzRjRRa09rUTdlczBVaGxQdzJoSGp6bTFBQVJHczE0cm84THpQUFd5TTc5dDJXM1RTc2tXc2Nwdkx0c0l4NHhUbExPVThJeVYwZjFPamRRQWVIVzZNT0hmejRldVNEK0w2Y2FHanRDL1M2UFQwYW9NMUJCMmh4eXRrUGRjY2pyY09vbURpOTZNWWZGKzRnejRRYk4zaExpcE1iclYrZkFWRGhPeFhBd2FlTXcrY3hQWUxTYks2US9aamZmVW5FTFlOMkNBL3M1NjV3UlVWelN3eG95UUs0Q0EybEFsZ2Fxalo5NytiUlRTcWpjNFJLaEd4WmN0QmJlSUhTUTh3dWRqVDZhTDZ5a0RYeWU0cjhtc2tuaDBhOU1NRGZiWWUxTmkyM0RYSnIwcFF5RWxrUjNlOWNndkRDdE92VjVKM2hMVkVOZ0tBci9Ra2s2dEpvOTNIbW1kQVVIQ0tlbHJUKytaWUJHbUJGNDUwa0Yyd05mbXdIRUhwMVArYnNYYTdtM3RxRnZTdWpaazlXcDJOTndzdkxyYkZKUTlTcU5JSWhWamRHSjl4NW41WUpYUjVMQkRjb3pqYVJJOGVCVXlMQTRWVjB4M2tDR0Z3ZE5XR0ZtWHpqaG5SdVhDc2p2TTh0UzVpVXlhbU53L1grTGJlK3JpOXpabmZxUE5Ca2YzRU1SR2oyNWw1S0hBQTErcWFVVjh4SDZwUGwweHJFYStDUVZiKzRPdTBaaUpZeXloUzMrS1RUcHp4dXBydkkzU2VwTXpINit4MzNXbTIwMnExVGVqeVh6Y1A5WHdyUlpDRktXeGpuNGpkWFgya2lNOEEzRG1XODdLZFpnPT0=', 'Active'),
(7, '67', 'WThiMWd6RjFocnZ4bnpVamFDRHU1TE1oTG5HOElUbm5Rcy9hdFBzZ3dHaTVidlpoOVJwWHN2MHZxR215VFNEbkY2b2pzNnRZdDFybklaazBVVDF5ekdpcGZvTHpCaDBDb0xkNW9yVkhOL1U9', '14-12-2022 11:18', 'ZTJEanRHQ0JZTjExY09OcGRUMERDdXBHcXp0VTBBVXppUng1SWh5MDhZV3d6aHdiWTdpdDJYV2VyNjU5K0QvNWpBNE5ic1JxSFZyV2s3S1pLQ29MUERrUGhrb3dQUnAvcTV3aHNQTjRVaU5HeVp4YkYzWG9xNnBjZ21kdm9UVCtuYkcvZ0Y0cW8yV3p4MW9ZQjdxTnpCZGFDYUxqQUJWaUluWEFxQlZkRm5SdmRqZmprbi9QRjhYMzV0QWk3M1lhc3g4azk0bXYvTjIwTUs1RlhpVjdOVTQ0aUw4MisvSnZtVG1DZnlMOWNVeURVVVdvOWVUbzVzZWxVaHhiWE4wOURQaXZTREIyWDlIbHA3dHorRWU3ZTBCa2NMN1dSNS92eUY3Mjhhd3BNVUFxeklrZE4wd1JOY0ZKZndSVjg1K1pXL2taaTIzWFFyWkhzeDRnaG1raXY3UnJRWnFzbzVLaG1RK0tFMkhPd0lqMmhvcFBicEN5Y2R2L0NFNFdpWWRXREZKYmhoUEFmbXd4VjU4b3V5Ymh3V3BKYStDUXVaVHN6cXQ2STlCTkRwYm9rUG8waTF1UnprMXQrdmMvZFBibS84NG0vaGpPOVltcGVUdnQ3QXRKdHNQY252U1J4cU1tTEV2L1A3NFRQc0lnQ3hPbHJ6TlMwb2tWL1MxakpEUUkvVWtuRlN3b2Y4THlyT2J4SWhzL1Jkby8yeE9iNzJRQ0pqV1JtRU9TWXc3WGRMeXpkSVlYNDVJQjlXSFQxYzRBTDNpWGpCcjhrWS84enVISy9TM1BFMHFpaHc4TS9ZcG9nTFhEM1YrRVFxSnUybllYcVBnbEwreU02Z2t6OEQzTDhsVVlITFJ2Ykg3ajlPaXlmN2R0bE9QZUlIdEVKRmdJMnQwUDdkV3hTdVltV3ZNckFSQ2pDQk41aUhheTZYU0I0TDZvc3dFZEd0dXR2T3YzQW9KR05QWTkyWlJXcy9tNFVvR045OXp6WmxFSFZzQWhUcTVIcTF6MFR1WG9hOTZQWHM4Q3lwZi9hYVVJK0JMMmhJT2tQa3dWSFFvUzZTZjFWek1HV3UrdXVyai9JYmFtbTBxU2h1dkMrRWlBMjFiNjVocFgxM2VNdG00YVRiT3FLVmFhZzI4MEJjZDhwT0ZzeWVlcjllWmR1MnB0Nk1qdmFKMGo5Z2taY2VURXlOUFhvYnVES25EWWFwTG5oR05aSUtROWJTcTNXQlNCMVZxKzQ0V21IN2R3ajJvcyt6TGlPODczQ3pLVEt0eEMyTnl1Y1JGNnlQT2dsOXBXOEhrUWxZazVXTWVjb1ZuUXh0cHhSQVRYTnYwY1R3b1pNQ2Q4SVRqSXl6NHM4RkJKYTNWSFQ1NWdzYzNZR0hDY0I2NlRoTzVESFBmdStlS0h5TnNPaldSai9GY1h1SERRSEdybnJ3NDJWSXVpOGNueU4ycmxYZ21DY0VlUU81NEVCcENrbC9ULzhqb3RCMCtwZC9SVXVidU53dEdqWE5EbkFPdi9sVjh2MmhDUkFaYmhPNnpiMlNJbjBsY1ZPRmhNeEZDd0Y4RE5iaktMc0JzOWtIeVdaUC9DeEpOVzUraFVReHNGZDQyMkVuZWx4Zkgwam9PVjZoTlJvR3k4Rm1VdXlOSHcxRHR6NUFLbkx5NlVFdzhBUERFVVVSN3RBSllDcjV0aVBFVWJWVWhjelNsRzZKQUVqclp1bmRKNDBOdjdHRUpwbVQ2dFRVYzdDRkY0ZDNBV0hGMVJ4aUJvdSsrZ1lYKzc3d21LQ3A0TjBWSXdTS01QK3hvSHIwdGFnWTN4Q0RPZllBcDliUkxEcnlFWElnL1NST1RzRUJEZHRkMGY2d2Y1c3dxelI3aXNtbXVWK0o0a0RJUzQ1MngxWTNqNURURktzVStmUkN5eStlcXU0dTFySmJsdFBuUllpSVlFYzNlZFpjd0VrcjEzcU1iaWVHU0xjWEk0V1puRmZDdGNmT25wQjJ2TlZ0b2NDUU9xc0FvTUZqMmpweDI0M0hFNzRRK3dSVjdZS2dMaDdhQnNHM0Q5TmV4SE4yNi9WQlhEYjZnKzdtWEp1eEt0dHppdFdseSs4WFdVSWZ0akJQYTFWUlhuUjdveFB4R3NxaE9JYTh1cU8xSXZJeUFBZnFDQ1IrclU3QVAwdlRYY3hrN2d2ME5wSnk2cFNqTWpnOTA9', 'Active'),
(8, '1', 'ZVFxTlNINU5ud2NEdndNTmNOaTl5MjU4cDNtTWgvbmtzVkNxb2JERVArd01tT2hUdlJSYlQzVmFSRnpXZXRFc2h1a05hNnVjdERMR2Q1UDliUm9veGJCSFk4TVVYTW5VSFdkTEJxRTJvS2s9', '24-12-2022 15:28', 'ZTJEanRHQ0JZTjExY09OcGRUMERDa3pwd2VCVmgxbG5KZHdNTFJ6TU50WHF6ZVIxb1l3MnlzWDYvK0tKc3dHMTNKblV3WURVTDVxVkxJb0YyaFpXUG0vVlp0TWkxWkpYZXU2MEFIWWJMU1hZclNoTUVhaGNlZm5vcU9ZTFF2dnJwaGZBeXpQVGZocWd4dFEwOTAzMm5KRlIzQTRxV0huYjNuYXBmL3l3Y1dJbmNVTDd1dWtvSVNzWFBNaUd5eDZkL2xoaHF6eUMzYnhNV2VqSDMrQVpFMTMwa3RDRHNjemdmR0NxSnpjVUlLS3JhU1pTZU1wREFJbXYxM3d2VFhLSHJmYWNSK0lGR1VLOEh0c0FGdDVlL0c3aWRCVUtiWDkyT0pvVlY0d2g0MUJTNzk5QWFyak5KVXNMNGpoSXpmZWJtNlF1M1VzRWQ4TGJSVXZmMFlZQjRBUWpLb2FoUCtTZWxvM0lWVG1DMmdpcDJVYlZraTk0VytSQW1YdGRSVCtseXZKRUcvdU9lQ0VSM3pmUnFENmFjN1RYT1JHRDdlNjQ1UVcveVBzemRrY3lDUnBYaTkraXRqbFhET2xPU2VnemJzbGR2dCtHMlRBejVaWitZN2JEZlgycldKdHp5ZHI4UGx1ZmJvQVlZSGFpaTNab3ZHSjlxb0g3cldHSXdZU25IRmpwR3FvK2FJV3BGNCtKZG5tSE9jL1V1R1o2a3dWSkgwSDRsS2Z6Vmd3MXB3cU16NHM3ellKS2E0L0VZa2xWWXNGUzgvakg2aHhSTisxdmJOVnVoWExzcGhmZFlEMVpBUVc3TVR2QVJmRzAwcFJna0JOdldGcmZxYWxZNXI1T2dEQWU1ZnNGVzM4V2l3QWExSTJ2bEkrQzVrK3EyQ1BUbGJEMHNsT3B4LzUzcjI3Q1prdXhKMjZvT0tBYk5SenNDNTJTYWt2c3ljK3NpL0QzajJqTUlIQ0kzbGxkTEtrUFZCYkVQQTVXMGJPbEhSbkg2VW12QVJzT0Q5S25LUGZtNzlaU1NnbUV5VXVMaldVOUNnbVBydHFVVWRnMkoxeFZHZTViQTF0dXhTa01iQ28zZWRHWEgwRForcytVVTRzUWFEUm1FNzlzVXdPUHlBVW15OE15blp2b0VYdE44eW9BaGZJbklhMWYvcC9SRUp3SnN2dGNHOHA1eWR6SlNkcTVhYkZ4MlhKZzg2VG1BQkRDcm8veFF5OEptOGRtNFl1Y2Z5RWU2TUhBMCtka0hMSElmNG1XL1kzajhCRUpWRlJna0cxb0FFU1lmWkhvRDR0QXdVd2phZ29XUlJxMVkvNXA3WmNzaGN6clBsZzRFQkIzSzRTOFRtczUwWjhtMVNhVk02VGg4U0V5RHBVamMwZXlQbnB3ZStjSWJzVnpuMlI5MTRPTkdFOUFDTXFEdE1sd2VzRkNkY05IV1ZrNURMMEY4K010aVg1MzUvY1NuN1NYZU13ZDFtdmIxL2wza2Z6bUZTb3F1czQxSzMrUzdHdWpQTGM1VUZGYkw1aVNlOFpEUElxZFFHcEx6N1hBT3pLbGJzRmJuam5uQjBPbkc3N1BoMmV0RW5WbG8rMjZCUU5nUVNRQTRRM1NlcFlUTFBKY0p6ajltTkFpS0U2Z3lIRE01U1lkU24vc0ErN3JHQzhVRkdLVWRYMk5ZcTlzVndhRmdYMlY4MWRieG1UZkE1cXRPcUhuNHZ3VDFvNFhMU1ltUE9EVXpmc3kyTjNoL0FXUUpxcmVaQjF2OVJQaVN3ZUFQMVNZY083WWdKcGlhamlB', 'Active'),
(9, '1', 'bE4vSjhad0ZqdVI3RUsvNEoxYnVKZjcwNU9SMGFaQmNGa25LSFVha3VNNjRaZWZBcFNuOVRTM2s4bXVMNEIvc2hHWTZkdGY5aXJjSzZkMjUyOEkwUU04T3JPTFNQVlZ3cTRuOUI4Mk9BNWM9', '24-12-2022 15:30', 'ZTJEanRHQ0JZTjExY09OcGRUMERDa3pwd2VCVmgxbG5KZHdNTFJ6TU50WHF6ZVIxb1l3MnlzWDYvK0tKc3dHMTJNNjNDZjIybGNTOXVlUDBpaEUzZkFFZ0VIR3NBTHJTK28zK1h0T0tVRjFlTnNUM1FCcS90LzdGWHZMMGxCcWx0d2hYNVhMS0MzY2U0bm1Zc2g0Mi9DTitMVURqNk0zVGZDZ1ZKMEhxWlZNSGQ1TlQrODBtS2cvZGJwbDVnRWpDZ2I3Z0VPd1ExQmlIMkppYU9tZTA2YWI0YVRKTnAyb20yWVkrUHJUdmxxd0VVWElzcDAzQzdGQVVDUFdUbTZFd3NYRllXTGRGS2RnN2ZxSlFlcUpmamdHMUJQVXJQOGFscnNmTzFCZnRYRTIwbW9kaXV1bWJ6aXFDYlpkVDd5TzBNQVJFMVVITE5pZDBwdGNEcXExcUVMZlZiY2EyT0FXSHFRSEpMS3kxcXF5WGFlbGNROWs4emFKTWdCNUhXbkFBb2MySnpHSWhDQTIzalBST3Q3bER5cnVJTG93cjZlUE90Mk9HWk8rWThwMzNCbHM4Z0haVHdkVEs0OVE3cW1MSStUS1BYMWhEWFhwTDQxOXNiUDdNb0txYW9Nd0RBRmxYWWhqaDJQUm8vVFYxeDRxZS9YR21aeXFGdDkydzhLZDVxc2Yvb1ZIemRDdTNZbGFWd2c4dHVTdnJOZGpNKy9tSmFjRVJFd0tGWXFtZVJaOXQxSnJwWkRXaURoUjNabFpTdlVxSjJ1WjU3UXFQS2ZNZmU0OU5sOUtadU1KZnlhQnQvZlZ4Zjd3SkJ6ZFNOZTdMTHczeGFsdmtRMUoxUkZyTWNwaEpJaUZFYzY2R1htQ3hwVDI5VWtFclFkaTU2MzhXSlZPRmIwNmhUZGg5YUpFV081OGM5Zkp4aTJIb1FCTXpBSHBUT1YwcHc0dExhdmE2dmN3SHJ0c09FYkh2bXVlbE9mMU9pS05XSUMzcDNDNnFKMFF3ek1kYnBlWXJpSkRMa1BvMVltVmtzdVRubkpkS0lBc043b0ZkR1dzT3phbzRDclpGUGgyc1hDRDkzSXpTZ3dBcXZ0MVVFM0JMVk1kZ0I4WWF0TWVMV0V0bnp1NnhTV1h0S3Y2bUMwSjkydzNhaldWeUVETDVOVm5PUjNmL2N3VXBPc1IzN09CNFRzcTZhVDdVNURWYmdwaEt3bGFyczhjb3JXbEFuNFBQWHE0S1Q3L1lkSjU0UnBkU0ZWbEJQNTRnc2thODNsZWpwWDBqOEVsMnY5T1BxZVllc3RvVjVpMXBBbmVXZUJQQ0toSWl4L3FBUTVSMkdXczg0dVJSLys4L1FMV1NodkhCRmhhWWhkaGlzNFlqaHBQUExDcUdmbmZjdG1QTkRtTy9CdU9mbmYyM2JHTGI2YnVjRzFTaEdEYWd0STg0WE9ZYzBoZFAwUE5IWEdLQmlBMFBwV2YwTFN2Nmlwa0J5b0owRUVUQnNOK2pUcGxvNkFDaFRhL3h6eE5WdHo3dVB1bFA2bFR0VmcwTmtIQUpuM1R5KzEveHlreStyRHY4VzhNSmxTeW5yYm1xTTZ1dTkzMUxUREtGSmZueVFQVXlIN0Q5d2QwQlBlcFpoN2o2Z2FTTDh6TE56UkphaENJUWpFVE1nMFdvcDNFMEEvUFZRTkdJZDNObHVPNERxbW5tUEdESmxiSmF4M25xaFEvVUFGRWV2MjI2MFhjSDJtSmQ2Z0c4NW5iQnVrRmlTM3pIVFFWYkMrWnppRUs0c2dwV281dllRM2J3', 'Active'),
(10, '1', 'N01PdkpFMjRKYWN0Qmx4OG1hYXBlc2F1UjkzUkNENVNjWXNnZEdjTDQrUlVDcDhqSnFjN0orT2NvajJEYjlpS0FEenF6TUpUSVN5YXVGUStHQUhxSnpiOTdseDFPYnFtQVZ4YTBpalZIb1U9', '24-12-2022 15:31', 'ZTJEanRHQ0JZTjExY09OcGRUMERDa3pwd2VCVmgxbG5KZHdNTFJ6TU50WHF6ZVIxb1l3MnlzWDYvK0tKc3dHMVNMMm5LbWtkdFBzWGRtVDFJckNGZnA1dzAycE9WOUgrTU5WVDl0aU5sN3plVUsrNDllL01RdlhjUHBMRTcwdEhwV0x0TU5xK09wcjJUcnZvVFlZTlQyam5lekZTRmVTZUVhUE5uR0VnK1NlcnEyMjNGQWMySzhLY3YrSG5wQUJYcUR4Q2srUFAvOFQ5U1FXQm1PdHVRRjNJNisveHYrdC80MVRVc3MyeU0rR3h5REpTYTYvVjhiMkJ3MU5ycHA4VlR4OFlyWFFYYnRTVGhjVUFOUC9rRmxUU2tBUDVIZDVEWURsVmFDUDhJYnhuMUdtNTFWclVvU1lnTW1zOUo0WStWNEJ3RmxoTGhVbEs3ZVV2dlhXL1lUcG9hczdUckFOLzUzR2hWOTBYUmVrOWtQSkRQYXpWMGMrYUdYazQ0UWFpaVhCd1pmVVJSaGF6MkMzaFR4bkFnTHB1QmU1ZlN1UTFTM3NZN283eU5nTWM2eHB0dUJaT3BjdkwxSytmbUVRenlBdjc0c2pJcXF3aklYc2VuaGp2VTZQZ0MzT25NcXJ6THRJR1F1ekNVbEY1M1FZMHR2QXV0M0Zhb0pXZnQvZmhSWE5wS2lMWHZTUld2emxwbFpEanNkaUhkYWpxZ2MwbWJRbGZXd0RQVmpDSFJYZFk4MDJaYjdoN0dhV0JDdmpvOHdTOTF6OFVMekYySGJxWGNaem91WFFROGhQeVhzbmVWNU5aZ24vcWNYeW95ZWhmOWovbVlXK3E1dktWWXpOSmh0cG1oR1hiRThWVGl3Y1Jxb2dhMDdaZFdJamlLYXNLeUJ1azM3bldJZGJnQksvNU5MaEs5TXJ4dHBwZmx1OWRBTmVscEJxeU8zaGN5dWNkeTQ4OU1KdmxXUVVZY3hHc005akdsSVRQd0pqcDBUYTkxVlNlMHhwUXFDZ05YVllkZ1BVWWFwU0taRlhSNlZlUUdrZWIvdkNGYVlXU1M0bzM1YUROTk9YTzdjYU1tT2NQV2d3ZDFndDF5WjZUYVNpNE9KT1lSdmE4eUV0bEYvSEdhT1gvZEJ3SGthNWN3dndGTldvVytzZ2czWTR6MHVvZ3B2TG1HMVA3VmJrb29qNkF2dHp2SkJaWmN6K1NpL3lUb1B4bjNwdWkzM0o5WE1WUXFJd0twVEp1clhvOVJqZlgxOGdsYklhVWc1UmZ3NUxJdEszakpZNnkvQUozL0NKOHVDbkRaWHYyL3pkNEdZbG9iY0E3WmxGb0M1RDhKUHk2SkhIUDFESkhzZm40cURib2E3VlB6VGJMaWRYbm5XMVBLYUh6Wm1NQmNEbFp6djNGZUk5Wmx0Q21LZVJyRFFlOGhVeFhrSGJ5My9EVFErektrTGdKMlVOcCtaMlpCeUJzcVYvVllVcUVkZHc3eno2R2JhNGU3K1F6c0tLT2RjcktNeCszYlR1WlFqd2thWENUckIvaTl2M3FtMVBzTnBnZ3U2b3lQUGh2TDg1dklDanlRL3VMZVM2Z25TN1dCdnNDVmVlcFV0YkNlazQzKzB3akVuWGxlcmoycFZsS1dFWDdZem9XYlhvWnNQR2FCMWRnWjI4M0dJb055RDYxM2E4ZDY5eTBNZUFhTGJzTnNZbVpKRGx3bEpQVVB0WUJKTzBCRVNGbEkyV1UwbDZ2dnJnU0VxVjV3L0NjK25Xd0JtYi9HaklOOHNCRWZBN3FrSFZC', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `user_permissions`
--

CREATE TABLE `user_permissions` (
  `UserPermissionsId` int(100) NOT NULL,
  `UserPermissionUserId` int(100) NOT NULL,
  `UserPermissionForAccess` varchar(500) NOT NULL,
  `UserPermissions` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_pips`
--

CREATE TABLE `user_pips` (
  `UserPipId` int(10) NOT NULL,
  `UserPIPRefNo` varchar(100) NOT NULL,
  `UserPIPMainUserId` varchar(10) NOT NULL,
  `UserPIPSubjectName` varchar(255) NOT NULL,
  `UserPIPMessage` longtext NOT NULL,
  `UserPIPCreatedAt` varchar(40) NOT NULL,
  `UserPIPUpdatedAt` varchar(40) NOT NULL,
  `UserPIPCreatedBy` varchar(10) NOT NULL,
  `UserPIPEmailStatus` varchar(10) NOT NULL,
  `UserPIPUpdatedBy` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_rewards`
--

CREATE TABLE `user_rewards` (
  `RewardsId` int(10) NOT NULL,
  `RewardRefNo` varchar(100) NOT NULL,
  `RewardName` varchar(1000) NOT NULL,
  `RewardMainUserId` int(10) NOT NULL,
  `RewardAttachedCreative` varchar(1000) NOT NULL,
  `RewardCreatedAt` varchar(40) NOT NULL,
  `RewardReceiveDate` varchar(40) NOT NULL,
  `RewardCreatedBy` varchar(10) NOT NULL,
  `RewardStatus` varchar(10) NOT NULL,
  `RewardMessage` longtext NOT NULL,
  `RewardUpdatedAt` varchar(100) NOT NULL,
  `RewardUpdatedBy` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `VisitorId` int(100) NOT NULL,
  `VisitorPersonName` varchar(100) NOT NULL,
  `VisitorPersonPhone` varchar(100) NOT NULL,
  `VisitorPersonEmailId` varchar(100) NOT NULL,
  `VisitPurpose` varchar(100) NOT NULL,
  `VisitPesonMeetWith` varchar(100) NOT NULL,
  `VisitPersonType` varchar(100) NOT NULL,
  `VisitPeronsDescription` varchar(10000) NOT NULL,
  `VisitPersonCreatedAt` varchar(100) NOT NULL,
  `VisitPersonUpdatedAt` varchar(100) NOT NULL,
  `VisitEnquiryStatus` varchar(50) NOT NULL,
  `VisitEntryCreatedBy` varchar(50) NOT NULL,
  `VisitorOutTime` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bdes_primary_details`
--
ALTER TABLE `bdes_primary_details`
  ADD PRIMARY KEY (`bdes_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`bookingId`);

--
-- Indexes for table `booking_refunds`
--
ALTER TABLE `booking_refunds`
  ADD PRIMARY KEY (`BookingRefundId`);

--
-- Indexes for table `booking_refund_documents`
--
ALTER TABLE `booking_refund_documents`
  ADD PRIMARY KEY (`BookingRefundDocId`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`ChatId`);

--
-- Indexes for table `chat_attachements`
--
ALTER TABLE `chat_attachements`
  ADD PRIMARY KEY (`ChatAttachId`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`ChatMessageId`);

--
-- Indexes for table `circulars`
--
ALTER TABLE `circulars`
  ADD PRIMARY KEY (`CircularId`);

--
-- Indexes for table `circular_files`
--
ALTER TABLE `circular_files`
  ADD PRIMARY KEY (`CircularFileId`);

--
-- Indexes for table `circular_status`
--
ALTER TABLE `circular_status`
  ADD PRIMARY KEY (`CircularStatusId`);

--
-- Indexes for table `comaigns`
--
ALTER TABLE `comaigns`
  ADD PRIMARY KEY (`ComaignId`);

--
-- Indexes for table `company_policies`
--
ALTER TABLE `company_policies`
  ADD PRIMARY KEY (`PolicyId`);

--
-- Indexes for table `company_policy_applicable_on`
--
ALTER TABLE `company_policy_applicable_on`
  ADD PRIMARY KEY (`ApplicableId`);

--
-- Indexes for table `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`ConfigsId`);

--
-- Indexes for table `configurations`
--
ALTER TABLE `configurations`
  ADD PRIMARY KEY (`configurationsid`);

--
-- Indexes for table `config_facebook_accounts`
--
ALTER TABLE `config_facebook_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config_holidays`
--
ALTER TABLE `config_holidays`
  ADD PRIMARY KEY (`ConfigHolidayid`);

--
-- Indexes for table `config_modules`
--
ALTER TABLE `config_modules`
  ADD PRIMARY KEY (`ConfigModuleId`);

--
-- Indexes for table `config_pgs`
--
ALTER TABLE `config_pgs`
  ADD PRIMARY KEY (`ConfigPgId`);

--
-- Indexes for table `config_values`
--
ALTER TABLE `config_values`
  ADD PRIMARY KEY (`ConfigValueId`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `creatives`
--
ALTER TABLE `creatives`
  ADD PRIMARY KEY (`CreativeId`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CustomerId`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`CustAddressId`);

--
-- Indexes for table `customer_co_address_details`
--
ALTER TABLE `customer_co_address_details`
  ADD PRIMARY KEY (`CustomerCoAddressId`);

--
-- Indexes for table `customer_co_details`
--
ALTER TABLE `customer_co_details`
  ADD PRIMARY KEY (`CustCoId`);

--
-- Indexes for table `customer_co_documents`
--
ALTER TABLE `customer_co_documents`
  ADD PRIMARY KEY (`CustomerCoDocId`);

--
-- Indexes for table `customer_documents`
--
ALTER TABLE `customer_documents`
  ADD PRIMARY KEY (`CustomerDocumentId`);

--
-- Indexes for table `customer_nominees`
--
ALTER TABLE `customer_nominees`
  ADD PRIMARY KEY (`CustNomineeId`);

--
-- Indexes for table `customer_notifications`
--
ALTER TABLE `customer_notifications`
  ADD PRIMARY KEY (`CustomerNotificationId`);

--
-- Indexes for table `expanses`
--
ALTER TABLE `expanses`
  ADD PRIMARY KEY (`ExpansesId`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`LeadsId`);

--
-- Indexes for table `lead_followups`
--
ALTER TABLE `lead_followups`
  ADD PRIMARY KEY (`LeadFollowUpId`);

--
-- Indexes for table `lead_requirements`
--
ALTER TABLE `lead_requirements`
  ADD PRIMARY KEY (`LeadRequirementID`);

--
-- Indexes for table `lead_uploads`
--
ALTER TABLE `lead_uploads`
  ADD PRIMARY KEY (`leadsUploadId`);

--
-- Indexes for table `marketing_collaterals`
--
ALTER TABLE `marketing_collaterals`
  ADD PRIMARY KEY (`MarketingCoId`);

--
-- Indexes for table `newspapercompaigns`
--
ALTER TABLE `newspapercompaigns`
  ADD PRIMARY KEY (`NewCompaignId`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`NotificationsId`);

--
-- Indexes for table `od_forms`
--
ALTER TABLE `od_forms`
  ADD PRIMARY KEY (`OdFormId`);

--
-- Indexes for table `od_form_attachements`
--
ALTER TABLE `od_form_attachements`
  ADD PRIMARY KEY (`OdFormAttachmentId`);

--
-- Indexes for table `od_form_status`
--
ALTER TABLE `od_form_status`
  ADD PRIMARY KEY (`OdFormStatuslId`);

--
-- Indexes for table `popups`
--
ALTER TABLE `popups`
  ADD PRIMARY KEY (`PopUpId`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`ProjectsId`);

--
-- Indexes for table `project_media_files`
--
ALTER TABLE `project_media_files`
  ADD PRIMARY KEY (`ProjectMediaFileId`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`RegistrationId`);

--
-- Indexes for table `registration_activities`
--
ALTER TABLE `registration_activities`
  ADD PRIMARY KEY (`RegActivityId`);

--
-- Indexes for table `registration_charges`
--
ALTER TABLE `registration_charges`
  ADD PRIMARY KEY (`RegChargeId`);

--
-- Indexes for table `registration_members`
--
ALTER TABLE `registration_members`
  ADD PRIMARY KEY (`RegMemberId`);

--
-- Indexes for table `registration_nominee_docs`
--
ALTER TABLE `registration_nominee_docs`
  ADD PRIMARY KEY (`RegNomDocId`);

--
-- Indexes for table `registration_nom_transfer`
--
ALTER TABLE `registration_nom_transfer`
  ADD PRIMARY KEY (`RegNomTransferId`);

--
-- Indexes for table `registration_nom_transfer_docs`
--
ALTER TABLE `registration_nom_transfer_docs`
  ADD PRIMARY KEY (`RegNomTranDocId`);

--
-- Indexes for table `registration_payments`
--
ALTER TABLE `registration_payments`
  ADD PRIMARY KEY (`RegPaymentId`);

--
-- Indexes for table `registration_payment_activities`
--
ALTER TABLE `registration_payment_activities`
  ADD PRIMARY KEY (`RegPayActivityId`);

--
-- Indexes for table `registration_refunds`
--
ALTER TABLE `registration_refunds`
  ADD PRIMARY KEY (`RegRefundId`);

--
-- Indexes for table `registration_refund_documents`
--
ALTER TABLE `registration_refund_documents`
  ADD PRIMARY KEY (`RegRefundDocId`);

--
-- Indexes for table `students_leadSource_and_bdeDetails`
--
ALTER TABLE `students_leadSource_and_bdeDetails`
  ADD PRIMARY KEY (`stud_bde_id`);

--
-- Indexes for table `students_primary_details`
--
ALTER TABLE `students_primary_details`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `students_registration_details`
--
ALTER TABLE `students_registration_details`
  ADD PRIMARY KEY (`stud_reg_id`);

--
-- Indexes for table `students_university_courses`
--
ALTER TABLE `students_university_courses`
  ADD PRIMARY KEY (`stud_university_courses_id`);

--
-- Indexes for table `students_university_course_discount_details`
--
ALTER TABLE `students_university_course_discount_details`
  ADD PRIMARY KEY (`discount_id`);

--
-- Indexes for table `student_fee_txns`
--
ALTER TABLE `student_fee_txns`
  ADD PRIMARY KEY (`stud_fee_txns_id`);

--
-- Indexes for table `stud_fees_modes`
--
ALTER TABLE `stud_fees_modes`
  ADD PRIMARY KEY (`stud_fee_mode_id`);

--
-- Indexes for table `stud_fee_collects`
--
ALTER TABLE `stud_fee_collects`
  ADD PRIMARY KEY (`stud_fee_collect_id`);

--
-- Indexes for table `systemlogs`
--
ALTER TABLE `systemlogs`
  ADD PRIMARY KEY (`LogsId`);

--
-- Indexes for table `trainings`
--
ALTER TABLE `trainings`
  ADD PRIMARY KEY (`TrainingId`);

--
-- Indexes for table `training_members`
--
ALTER TABLE `training_members`
  ADD PRIMARY KEY (`TrainingMemberId`);

--
-- Indexes for table `universities_billing_address`
--
ALTER TABLE `universities_billing_address`
  ADD PRIMARY KEY (`univ_billing_add_id`);

--
-- Indexes for table `universities_courses`
--
ALTER TABLE `universities_courses`
  ADD PRIMARY KEY (`univ_course_id`);

--
-- Indexes for table `universities_courses_specializations`
--
ALTER TABLE `universities_courses_specializations`
  ADD PRIMARY KEY (`univ_specialization_id`);

--
-- Indexes for table `universities_courses_specializations_fees`
--
ALTER TABLE `universities_courses_specializations_fees`
  ADD PRIMARY KEY (`univ_courses_spec_fee_id`);

--
-- Indexes for table `universities_courses_specializations_tutition_fees`
--
ALTER TABLE `universities_courses_specializations_tutition_fees`
  ADD PRIMARY KEY (`univ_courses_spec_fee_id`);

--
-- Indexes for table `universities_primary_details`
--
ALTER TABLE `universities_primary_details`
  ADD PRIMARY KEY (`university_id`);

--
-- Indexes for table `universities_session_years`
--
ALTER TABLE `universities_session_years`
  ADD PRIMARY KEY (`univ_session_id`);

--
-- Indexes for table `univ_session_course`
--
ALTER TABLE `univ_session_course`
  ADD PRIMARY KEY (`univ_session_course_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserId`);

--
-- Indexes for table `user_access`
--
ALTER TABLE `user_access`
  ADD PRIMARY KEY (`UserAccessId`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`UserAddressId`);

--
-- Indexes for table `user_allowed_leaves`
--
ALTER TABLE `user_allowed_leaves`
  ADD PRIMARY KEY (`UserAllowedLeaveId`);

--
-- Indexes for table `user_appraisals`
--
ALTER TABLE `user_appraisals`
  ADD PRIMARY KEY (`UserAppraisalId`);

--
-- Indexes for table `user_attandances`
--
ALTER TABLE `user_attandances`
  ADD PRIMARY KEY (`UserAttandanceId`);

--
-- Indexes for table `user_bank_details`
--
ALTER TABLE `user_bank_details`
  ADD PRIMARY KEY (`UserBankDetailsId`);

--
-- Indexes for table `user_documents`
--
ALTER TABLE `user_documents`
  ADD PRIMARY KEY (`UserDocsId`);

--
-- Indexes for table `user_employment_details`
--
ALTER TABLE `user_employment_details`
  ADD PRIMARY KEY (`UserEmpDetailsId`);

--
-- Indexes for table `user_emp_wages`
--
ALTER TABLE `user_emp_wages`
  ADD PRIMARY KEY (`EmployeeWagesId`);

--
-- Indexes for table `user_family_members`
--
ALTER TABLE `user_family_members`
  ADD PRIMARY KEY (`UserFamilyMemberId`);

--
-- Indexes for table `user_leaves`
--
ALTER TABLE `user_leaves`
  ADD PRIMARY KEY (`UserLeaveId`);

--
-- Indexes for table `user_leave_attachments`
--
ALTER TABLE `user_leave_attachments`
  ADD PRIMARY KEY (`UserLeaveFileId`);

--
-- Indexes for table `user_leave_contact_nos`
--
ALTER TABLE `user_leave_contact_nos`
  ADD PRIMARY KEY (`UserLeaveContactId`);

--
-- Indexes for table `user_leave_status`
--
ALTER TABLE `user_leave_status`
  ADD PRIMARY KEY (`UserLeaveStatusId`);

--
-- Indexes for table `user_password_change_requests`
--
ALTER TABLE `user_password_change_requests`
  ADD PRIMARY KEY (`PasswordChangeReqId`);

--
-- Indexes for table `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD PRIMARY KEY (`UserPermissionsId`);

--
-- Indexes for table `user_pips`
--
ALTER TABLE `user_pips`
  ADD PRIMARY KEY (`UserPipId`);

--
-- Indexes for table `user_rewards`
--
ALTER TABLE `user_rewards`
  ADD PRIMARY KEY (`RewardsId`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`VisitorId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bdes_primary_details`
--
ALTER TABLE `bdes_primary_details`
  MODIFY `bdes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `bookingId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_refunds`
--
ALTER TABLE `booking_refunds`
  MODIFY `BookingRefundId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_refund_documents`
--
ALTER TABLE `booking_refund_documents`
  MODIFY `BookingRefundDocId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `ChatId` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_attachements`
--
ALTER TABLE `chat_attachements`
  MODIFY `ChatAttachId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `ChatMessageId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `circulars`
--
ALTER TABLE `circulars`
  MODIFY `CircularId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `circular_files`
--
ALTER TABLE `circular_files`
  MODIFY `CircularFileId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `circular_status`
--
ALTER TABLE `circular_status`
  MODIFY `CircularStatusId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comaigns`
--
ALTER TABLE `comaigns`
  MODIFY `ComaignId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `company_policies`
--
ALTER TABLE `company_policies`
  MODIFY `PolicyId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `company_policy_applicable_on`
--
ALTER TABLE `company_policy_applicable_on`
  MODIFY `ApplicableId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `configs`
--
ALTER TABLE `configs`
  MODIFY `ConfigsId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `configurations`
--
ALTER TABLE `configurations`
  MODIFY `configurationsid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `config_facebook_accounts`
--
ALTER TABLE `config_facebook_accounts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `config_holidays`
--
ALTER TABLE `config_holidays`
  MODIFY `ConfigHolidayid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `config_modules`
--
ALTER TABLE `config_modules`
  MODIFY `ConfigModuleId` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `config_pgs`
--
ALTER TABLE `config_pgs`
  MODIFY `ConfigPgId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `config_values`
--
ALTER TABLE `config_values`
  MODIFY `ConfigValueId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `creatives`
--
ALTER TABLE `creatives`
  MODIFY `CreativeId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `CustomerId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `CustAddressId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_co_address_details`
--
ALTER TABLE `customer_co_address_details`
  MODIFY `CustomerCoAddressId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_co_details`
--
ALTER TABLE `customer_co_details`
  MODIFY `CustCoId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_co_documents`
--
ALTER TABLE `customer_co_documents`
  MODIFY `CustomerCoDocId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_documents`
--
ALTER TABLE `customer_documents`
  MODIFY `CustomerDocumentId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_nominees`
--
ALTER TABLE `customer_nominees`
  MODIFY `CustNomineeId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_notifications`
--
ALTER TABLE `customer_notifications`
  MODIFY `CustomerNotificationId` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expanses`
--
ALTER TABLE `expanses`
  MODIFY `ExpansesId` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `LeadsId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lead_followups`
--
ALTER TABLE `lead_followups`
  MODIFY `LeadFollowUpId` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lead_requirements`
--
ALTER TABLE `lead_requirements`
  MODIFY `LeadRequirementID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lead_uploads`
--
ALTER TABLE `lead_uploads`
  MODIFY `leadsUploadId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `marketing_collaterals`
--
ALTER TABLE `marketing_collaterals`
  MODIFY `MarketingCoId` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `newspapercompaigns`
--
ALTER TABLE `newspapercompaigns`
  MODIFY `NewCompaignId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `NotificationsId` bigint(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `od_forms`
--
ALTER TABLE `od_forms`
  MODIFY `OdFormId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `od_form_attachements`
--
ALTER TABLE `od_form_attachements`
  MODIFY `OdFormAttachmentId` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `od_form_status`
--
ALTER TABLE `od_form_status`
  MODIFY `OdFormStatuslId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `popups`
--
ALTER TABLE `popups`
  MODIFY `PopUpId` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `ProjectsId` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_media_files`
--
ALTER TABLE `project_media_files`
  MODIFY `ProjectMediaFileId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `RegistrationId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registration_activities`
--
ALTER TABLE `registration_activities`
  MODIFY `RegActivityId` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registration_charges`
--
ALTER TABLE `registration_charges`
  MODIFY `RegChargeId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `registration_members`
--
ALTER TABLE `registration_members`
  MODIFY `RegMemberId` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registration_nominee_docs`
--
ALTER TABLE `registration_nominee_docs`
  MODIFY `RegNomDocId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registration_nom_transfer`
--
ALTER TABLE `registration_nom_transfer`
  MODIFY `RegNomTransferId` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registration_nom_transfer_docs`
--
ALTER TABLE `registration_nom_transfer_docs`
  MODIFY `RegNomTranDocId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registration_payments`
--
ALTER TABLE `registration_payments`
  MODIFY `RegPaymentId` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registration_payment_activities`
--
ALTER TABLE `registration_payment_activities`
  MODIFY `RegPayActivityId` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registration_refunds`
--
ALTER TABLE `registration_refunds`
  MODIFY `RegRefundId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registration_refund_documents`
--
ALTER TABLE `registration_refund_documents`
  MODIFY `RegRefundDocId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students_leadSource_and_bdeDetails`
--
ALTER TABLE `students_leadSource_and_bdeDetails`
  MODIFY `stud_bde_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students_primary_details`
--
ALTER TABLE `students_primary_details`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students_registration_details`
--
ALTER TABLE `students_registration_details`
  MODIFY `stud_reg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students_university_courses`
--
ALTER TABLE `students_university_courses`
  MODIFY `stud_university_courses_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students_university_course_discount_details`
--
ALTER TABLE `students_university_course_discount_details`
  MODIFY `discount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_fee_txns`
--
ALTER TABLE `student_fee_txns`
  MODIFY `stud_fee_txns_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stud_fees_modes`
--
ALTER TABLE `stud_fees_modes`
  MODIFY `stud_fee_mode_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stud_fee_collects`
--
ALTER TABLE `stud_fee_collects`
  MODIFY `stud_fee_collect_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `systemlogs`
--
ALTER TABLE `systemlogs`
  MODIFY `LogsId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `trainings`
--
ALTER TABLE `trainings`
  MODIFY `TrainingId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `training_members`
--
ALTER TABLE `training_members`
  MODIFY `TrainingMemberId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `universities_billing_address`
--
ALTER TABLE `universities_billing_address`
  MODIFY `univ_billing_add_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `universities_courses`
--
ALTER TABLE `universities_courses`
  MODIFY `univ_course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `universities_courses_specializations`
--
ALTER TABLE `universities_courses_specializations`
  MODIFY `univ_specialization_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `universities_courses_specializations_fees`
--
ALTER TABLE `universities_courses_specializations_fees`
  MODIFY `univ_courses_spec_fee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `universities_courses_specializations_tutition_fees`
--
ALTER TABLE `universities_courses_specializations_tutition_fees`
  MODIFY `univ_courses_spec_fee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `universities_primary_details`
--
ALTER TABLE `universities_primary_details`
  MODIFY `university_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `universities_session_years`
--
ALTER TABLE `universities_session_years`
  MODIFY `univ_session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `univ_session_course`
--
ALTER TABLE `univ_session_course`
  MODIFY `univ_session_course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `user_access`
--
ALTER TABLE `user_access`
  MODIFY `UserAccessId` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `UserAddressId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `user_allowed_leaves`
--
ALTER TABLE `user_allowed_leaves`
  MODIFY `UserAllowedLeaveId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_appraisals`
--
ALTER TABLE `user_appraisals`
  MODIFY `UserAppraisalId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_attandances`
--
ALTER TABLE `user_attandances`
  MODIFY `UserAttandanceId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_bank_details`
--
ALTER TABLE `user_bank_details`
  MODIFY `UserBankDetailsId` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_documents`
--
ALTER TABLE `user_documents`
  MODIFY `UserDocsId` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_employment_details`
--
ALTER TABLE `user_employment_details`
  MODIFY `UserEmpDetailsId` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_emp_wages`
--
ALTER TABLE `user_emp_wages`
  MODIFY `EmployeeWagesId` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_family_members`
--
ALTER TABLE `user_family_members`
  MODIFY `UserFamilyMemberId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_leaves`
--
ALTER TABLE `user_leaves`
  MODIFY `UserLeaveId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_leave_attachments`
--
ALTER TABLE `user_leave_attachments`
  MODIFY `UserLeaveFileId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_leave_contact_nos`
--
ALTER TABLE `user_leave_contact_nos`
  MODIFY `UserLeaveContactId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_leave_status`
--
ALTER TABLE `user_leave_status`
  MODIFY `UserLeaveStatusId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_password_change_requests`
--
ALTER TABLE `user_password_change_requests`
  MODIFY `PasswordChangeReqId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_permissions`
--
ALTER TABLE `user_permissions`
  MODIFY `UserPermissionsId` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_pips`
--
ALTER TABLE `user_pips`
  MODIFY `UserPipId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_rewards`
--
ALTER TABLE `user_rewards`
  MODIFY `RewardsId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `VisitorId` int(100) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
