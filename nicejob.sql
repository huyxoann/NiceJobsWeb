-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 13, 2022 lúc 02:45 PM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `nicejob`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `address` varchar(30) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`, `phone`, `address`, `created_at`) VALUES
(2, 'admin1', 'b5eb9363447ede36171a0be71cfc3614', NULL, NULL, NULL, '2022-11-13 09:41:32'),
(3, 'admin2', 'b5eb9363447ede36171a0be71cfc3614', NULL, NULL, NULL, '2022-11-13 09:47:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `career`
--

CREATE TABLE `career` (
  `career_id` int(11) NOT NULL,
  `career_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `career`
--

INSERT INTO `career` (`career_id`, `career_name`) VALUES
(1, 'An toàn lao động'),
(2, 'Bán hàng kỹ thuật'),
(3, 'Bán lẻ / bán sỉ'),
(4, 'Báo chí / Truyền hình'),
(5, 'Bảo hiểm'),
(6, 'Bảo trì / Sửa chữa'),
(7, 'Bất động sản'),
(8, 'Biên / Phiên dịch'),
(9, 'Bưu chính - Viễn thông'),
(10, 'Chứng khoán / Vàng / Ngoại tệ'),
(11, 'Cơ khí / Chế tạo / Tự động hóa'),
(12, 'Công nghệ cao'),
(13, 'Công nghệ Ô tô'),
(14, 'Công nghệ thông tin'),
(15, 'Dầu khí/Hóa chất'),
(16, 'Dệt may / Da giày'),
(17, 'Địa chất / Khoáng sản'),
(18, 'Dịch vụ khách hàng'),
(19, 'Điện / Điện tử / Điện lạnh'),
(20, 'Điện tử viễn thông'),
(21, 'Du lịch'),
(22, 'Dược phẩm / Công nghệ sinh học'),
(23, 'Giáo dục / Đào tạo'),
(24, 'Hàng cao cấp'),
(25, 'Hàng gia dụng'),
(26, 'Hàng hải'),
(27, 'Hàng không'),
(28, 'Hàng tiêu dùng'),
(29, 'Hành chính / Văn phòng'),
(30, 'Hoá học / Sinh học'),
(31, 'Hoạch định/Dự án'),
(32, 'In ấn / Xuất bản'),
(33, 'IT Phần cứng / Mạng'),
(34, 'IT phần mềm'),
(35, 'Kế toán / Kiểm toán'),
(36, 'Khách sạn / Nhà hàng'),
(37, 'Kiến trúc'),
(38, 'Kinh doanh / Bán hàng'),
(39, 'Logistics'),
(40, 'Luật/Pháp lý'),
(41, 'Marketing / Truyền thông / Quảng cáo'),
(42, 'Môi trường / Xử lý chất thải'),
(43, 'Mỹ phẩm / Trang sức'),
(44, 'Mỹ thuật / Nghệ thuật / Điện ảnh'),
(45, 'Ngân hàng / Tài chính'),
(46, 'Ngành nghề khác'),
(47, 'NGO / Phi chính phủ / Phi lợi nhuận'),
(48, 'Nhân sự'),
(49, 'Nông / Lâm / Ngư nghiệp'),
(50, 'Phi chính phủ / Phi lợi nhuận'),
(51, 'Quản lý chất lượng (QA/QC)'),
(52, 'Quản lý điều hành'),
(53, 'Sản phẩm công nghiệp'),
(54, 'Sản xuất'),
(55, 'Spa / Làm đẹp'),
(56, 'Tài chính / Đầu tư'),
(57, 'Thiết kế đồ họa'),
(58, 'Thiết kế nội thất'),
(59, 'Thời trang'),
(60, 'Thư ký / Trợ lý'),
(61, 'Thực phẩm / Đồ uống'),
(62, 'Tổ chức sự kiện / Quà tặng'),
(63, 'Tư vấn'),
(64, 'Vận tải / Kho vận'),
(65, 'Xây dựng'),
(66, 'Xuất nhập khẩu'),
(67, 'Y tế / Dược');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `certificate`
--

CREATE TABLE `certificate` (
  `certificate_id` int(11) NOT NULL,
  `certificate_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `corporation`
--

CREATE TABLE `corporation` (
  `id_corp` varchar(10) NOT NULL,
  `corp_name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `corp_mail` varchar(30) DEFAULT NULL,
  `image` varchar(300) DEFAULT NULL,
  `website` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `corp_field_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `corporation`
--

INSERT INTO `corporation` (`id_corp`, `corp_name`, `description`, `corp_mail`, `image`, `website`, `address`, `corp_field_id`) VALUES
('a1', 'TNHH MTV QUỐC TẾ CHAILEASE', '', 'service02@chailease.com.vn', 'CÔNG TY CHO THUÊ TÀI CHÍNH.jpg', 'https://www.chailease.com.vn/', 'Trụ sở chính 28fl, Saigon Trade Centre, 37 Ton Duc Thang str, Dist 1, Ho Chi Minh Cty', 6),
('a2', 'ISMART.ASIA TECHNOLOGY', 'Ismart.asia Technology Inc.', '', '1667790868.jpg', 'https://ismart.asia/', '147 Tran Hung Dao, Quan 5 ,Ho Chi Minh', 2),
('a5', 'FPT Software Đà Nẵng', '', 'recruitment@fsoft.com.vn', '1667791420.png', 'career.fpt-software.com', 'FPT Complex, Khu đô thị FPT City, Ngũ Hành Sơn, Đà Nẵng', 3),
('a6', 'LG VS DCV', '', 'duyen2.nguyen@lge.com', '1667791627.jpg', '', 'DITP Tower, Nam Ô 1, Liên Chiểu, Đà Nẵng', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `corp_field`
--

CREATE TABLE `corp_field` (
  `field_id` int(11) NOT NULL,
  `field_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `corp_field`
--

INSERT INTO `corp_field` (`field_id`, `field_name`) VALUES
(1, 'Agency (Design/Development)'),
(2, 'Agency (Marketing/Advertising)'),
(3, 'Bán lẻ - Hàng tiêu dùng - FMCG'),
(4, 'Bảo hiểm'),
(5, 'Bảo trì / Sửa chữa'),
(6, 'Bất động sản'),
(7, 'Chứng khoán'),
(8, 'Cơ khí'),
(9, 'Cơ quan nhà nước'),
(10, 'Du lịch'),
(11, 'Dược phẩm / Y tế / Công nghệ sinh học'),
(12, 'Điện tử / Điện lạnh'),
(13, 'Giải trí'),
(14, 'Giáo dục / Đào tạo'),
(15, 'In ấn / Xuất bản'),
(16, 'Internet / Online'),
(17, 'IT - Phần cứng'),
(18, 'IT - Phần mềm'),
(19, 'Kế toán / Kiểm toán'),
(20, 'Khác'),
(21, 'Logistics - Vận tải'),
(22, 'Luật'),
(23, 'Marketing / Truyền thông / Quảng cáo'),
(24, 'Môi trường'),
(25, 'Năng lượng'),
(26, 'Ngân hàng'),
(27, 'Nhà hàng / Khách sạn'),
(28, 'Nhân sự'),
(29, 'Nông Lâm Ngư nghiệp'),
(30, 'Sản xuất'),
(31, 'Tài chính'),
(32, 'Thiết kế / kiến trúc'),
(33, 'Thời trang'),
(34, 'Thương mại điện tử'),
(35, 'Tổ chức phi lợi nhuận'),
(36, 'Tự động hóa'),
(37, 'Tư vấn'),
(38, 'Viễn thông'),
(39, 'Xây dựng'),
(40, 'Xuất nhập khẩu');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cv`
--

CREATE TABLE `cv` (
  `cv_id` int(11) NOT NULL,
  `file_name` int(11) NOT NULL,
  `cv_name` varchar(40) NOT NULL,
  `certificate_id` int(11) NOT NULL,
  `user_id` varchar(8) NOT NULL,
  `career_id` int(11) NOT NULL,
  `exp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `fullname` varchar(40) NOT NULL,
  `gender` int(11) NOT NULL DEFAULT 0,
  `phone_number` varchar(12) NOT NULL,
  `avatar` varchar(300) NOT NULL,
  `id_user` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `employer`
--

CREATE TABLE `employer` (
  `id` int(11) NOT NULL,
  `fullname` varchar(40) NOT NULL,
  `gender` int(11) NOT NULL DEFAULT 0,
  `phone_number` varchar(12) NOT NULL,
  `situation` varchar(40) NOT NULL,
  `avatar` varchar(300) NOT NULL,
  `id_user` varchar(8) NOT NULL,
  `id_corp` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `experience`
--

CREATE TABLE `experience` (
  `exp_id` int(11) NOT NULL,
  `exp_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int(11) NOT NULL,
  `job_name` varchar(200) NOT NULL,
  `num_of_recruit` int(11) NOT NULL,
  `gender` int(11) NOT NULL,
  `work_address` text NOT NULL,
  `job_description` text NOT NULL,
  `corp_id` varchar(10) NOT NULL,
  `career_id` int(11) NOT NULL,
  `exp_id` int(11) NOT NULL,
  `employer_id` varchar(8) NOT NULL,
  `province_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `way_to_work_id` int(11) NOT NULL,
  `salary_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `level`
--

CREATE TABLE `level` (
  `level_id` int(11) NOT NULL,
  `level_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `level`
--

INSERT INTO `level` (`level_id`, `level_name`) VALUES
(1, 'Nhân viên'),
(2, 'Trưởng nhóm'),
(3, 'Trưởng/Phó phòng'),
(4, 'Quản lý / Giám sát'),
(5, 'Trưởng chi nhánh'),
(6, 'Phó giám đốc'),
(7, 'Giám đốc'),
(8, 'Thực tập sinh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `province`
--

CREATE TABLE `province` (
  `province_id` int(11) NOT NULL,
  `province_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `province`
--

INSERT INTO `province` (`province_id`, `province_name`) VALUES
(1, 'Hà Nội'),
(2, 'Hồ Chí Minh'),
(3, 'Bình Dương'),
(4, 'Bắc Ninh'),
(5, 'Đồng Nai'),
(6, 'Hưng Yên'),
(7, 'Hải Dương'),
(8, 'Đà Nẵng'),
(9, 'Hải Phòng'),
(10, 'An Giang'),
(11, 'Bà Rịa-Vũng Tàu'),
(12, 'Bắc Giang'),
(13, 'Bắc Kạn'),
(14, 'Bạc Liêu'),
(15, 'Bến Tre'),
(16, 'Bình Định'),
(17, 'Bình Phước'),
(18, 'Bình Thuận'),
(19, 'Cà Mau'),
(20, 'Cần Thơ'),
(21, 'Cao Bằng'),
(22, 'Cửu Long'),
(23, 'Đắk Lắk'),
(24, 'Đắc Nông'),
(25, 'Điện Biên'),
(26, 'Đồng Tháp'),
(27, 'Gia Lai'),
(28, 'Hà Giang'),
(29, 'Hà Nam'),
(30, 'Hà Tĩnh'),
(31, 'Hậu Giang'),
(32, 'Hoà Bình'),
(33, 'Khánh Hoà'),
(34, 'Kiên Giang'),
(35, 'Kon Tum'),
(36, 'Lai Châu'),
(37, 'Lâm Đồng'),
(38, 'Lạng Sơn'),
(39, 'Lào Cai'),
(40, 'Long An'),
(41, 'Miền Bắc'),
(42, 'Miền Nam'),
(43, 'Miền Trung'),
(44, 'Nam Định'),
(45, 'Nghệ An'),
(46, 'Ninh Bình'),
(47, 'Ninh Thuận'),
(48, 'Phú Thọ'),
(49, 'Phú Yên'),
(50, 'Quảng Bình'),
(51, 'Quảng Nam'),
(52, 'Quảng Ngãi'),
(53, 'Quảng Ninh'),
(54, 'Quảng Trị'),
(55, 'Sóc Trăng'),
(56, 'Sơn La'),
(57, 'Tây Ninh'),
(58, 'Thái Bình'),
(59, 'Thái Nguyên'),
(60, 'Thanh Hoá'),
(61, 'Thừa Thiên Huế'),
(62, 'Tiền Giang'),
(63, 'Toàn Quốc'),
(64, 'Trà Vinh'),
(65, 'Tuyên Quang'),
(66, 'Vĩnh Long'),
(67, 'Vĩnh Phúc'),
(68, 'Yên Bái'),
(69, 'Nước Ngoài');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `salary`
--

CREATE TABLE `salary` (
  `salary_id` int(11) NOT NULL,
  `salary_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `salary`
--

INSERT INTO `salary` (`salary_id`, `salary_name`) VALUES
(1, 'Dưới 3 triệu'),
(2, '3 - 5 triệu'),
(3, '5 - 7 triệu'),
(4, '7 - 10 triệu'),
(5, '10 - 12 triệu'),
(6, '12 - 15 triệu'),
(7, '15 - 20 triệu'),
(8, '20 - 25 triệu'),
(9, '25 - 30 triệu'),
(10, 'Trên 30 triệu'),
(11, 'Thoả thuận');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id_user` varchar(8) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `verify` int(11) NOT NULL DEFAULT 0,
  `verify_code` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `email`, `role`, `created_at`, `verify`, `verify_code`) VALUES
('NV588628', 'huyxoann', '6dbd248e3b5d6b915151f52dd0badc93', 'huytn.21it@vku.udn.vn', 0, '2022-11-11 14:38:51', 1, '625572'),
('TD413860', 'trafa2003', '6dbd248e3b5d6b915151f52dd0badc93', 'hirashihiro@gmail.com', 1, '2022-11-12 08:37:14', 1, '492510');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `way_to_work`
--

CREATE TABLE `way_to_work` (
  `way_to_work_id` int(11) NOT NULL,
  `way_to_work_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `way_to_work`
--

INSERT INTO `way_to_work` (`way_to_work_id`, `way_to_work_name`) VALUES
(1, 'Toàn thời gian'),
(2, 'Bán thời gian'),
(3, 'Thực tập'),
(4, 'Remote - Làm việc từ xa');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `career`
--
ALTER TABLE `career`
  ADD PRIMARY KEY (`career_id`);

--
-- Chỉ mục cho bảng `certificate`
--
ALTER TABLE `certificate`
  ADD PRIMARY KEY (`certificate_id`);

--
-- Chỉ mục cho bảng `corporation`
--
ALTER TABLE `corporation`
  ADD PRIMARY KEY (`id_corp`),
  ADD KEY `fk_corp_field` (`corp_field_id`);

--
-- Chỉ mục cho bảng `corp_field`
--
ALTER TABLE `corp_field`
  ADD PRIMARY KEY (`field_id`);

--
-- Chỉ mục cho bảng `cv`
--
ALTER TABLE `cv`
  ADD PRIMARY KEY (`cv_id`),
  ADD KEY `fk_cv_employee` (`user_id`),
  ADD KEY `fk_cv_carrer` (`career_id`),
  ADD KEY `fk_cv_certificate` (`certificate_id`),
  ADD KEY `fk_cv_exp` (`exp_id`);

--
-- Chỉ mục cho bảng `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_employee` (`id_user`);

--
-- Chỉ mục cho bảng `employer`
--
ALTER TABLE `employer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_employer` (`id_user`),
  ADD KEY `fk_employer_corp` (`id_corp`);

--
-- Chỉ mục cho bảng `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`exp_id`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`),
  ADD KEY `fk_jobs_corp` (`corp_id`),
  ADD KEY `fk_jobs_carrer` (`career_id`),
  ADD KEY `fk_jobs_employer` (`employer_id`),
  ADD KEY `fk_jobs_exp` (`exp_id`),
  ADD KEY `fk_jobs_province` (`province_id`),
  ADD KEY `fk_jobs_level` (`level_id`),
  ADD KEY `fk_jobs_salary` (`salary_id`),
  ADD KEY `fk_jobs_wtw` (`way_to_work_id`);

--
-- Chỉ mục cho bảng `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`level_id`);

--
-- Chỉ mục cho bảng `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`province_id`);

--
-- Chỉ mục cho bảng `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`salary_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Chỉ mục cho bảng `way_to_work`
--
ALTER TABLE `way_to_work`
  ADD PRIMARY KEY (`way_to_work_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `career`
--
ALTER TABLE `career`
  MODIFY `career_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT cho bảng `certificate`
--
ALTER TABLE `certificate`
  MODIFY `certificate_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `corp_field`
--
ALTER TABLE `corp_field`
  MODIFY `field_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT cho bảng `cv`
--
ALTER TABLE `cv`
  MODIFY `cv_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `employer`
--
ALTER TABLE `employer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `experience`
--
ALTER TABLE `experience`
  MODIFY `exp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `level`
--
ALTER TABLE `level`
  MODIFY `level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `province`
--
ALTER TABLE `province`
  MODIFY `province_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT cho bảng `salary`
--
ALTER TABLE `salary`
  MODIFY `salary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `way_to_work`
--
ALTER TABLE `way_to_work`
  MODIFY `way_to_work_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `corporation`
--
ALTER TABLE `corporation`
  ADD CONSTRAINT `fk_corp_field` FOREIGN KEY (`corp_field_id`) REFERENCES `corp_field` (`field_id`);

--
-- Các ràng buộc cho bảng `cv`
--
ALTER TABLE `cv`
  ADD CONSTRAINT `fk_cv_carrer` FOREIGN KEY (`career_id`) REFERENCES `career` (`career_id`),
  ADD CONSTRAINT `fk_cv_certificate` FOREIGN KEY (`certificate_id`) REFERENCES `certificate` (`certificate_id`),
  ADD CONSTRAINT `fk_cv_employee` FOREIGN KEY (`user_id`) REFERENCES `employee` (`id_user`),
  ADD CONSTRAINT `fk_cv_exp` FOREIGN KEY (`exp_id`) REFERENCES `experience` (`exp_id`);

--
-- Các ràng buộc cho bảng `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `fk_user_employee` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `employer`
--
ALTER TABLE `employer`
  ADD CONSTRAINT `fk_employer_corp` FOREIGN KEY (`id_corp`) REFERENCES `corporation` (`id_corp`),
  ADD CONSTRAINT `fk_user_employer` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `fk_jobs_carrer` FOREIGN KEY (`career_id`) REFERENCES `career` (`career_id`),
  ADD CONSTRAINT `fk_jobs_corp` FOREIGN KEY (`corp_id`) REFERENCES `corporation` (`id_corp`),
  ADD CONSTRAINT `fk_jobs_employer` FOREIGN KEY (`employer_id`) REFERENCES `employer` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_jobs_exp` FOREIGN KEY (`exp_id`) REFERENCES `experience` (`exp_id`),
  ADD CONSTRAINT `fk_jobs_level` FOREIGN KEY (`level_id`) REFERENCES `level` (`level_id`),
  ADD CONSTRAINT `fk_jobs_province` FOREIGN KEY (`province_id`) REFERENCES `province` (`province_id`),
  ADD CONSTRAINT `fk_jobs_salary` FOREIGN KEY (`salary_id`) REFERENCES `salary` (`salary_id`),
  ADD CONSTRAINT `fk_jobs_wtw` FOREIGN KEY (`way_to_work_id`) REFERENCES `way_to_work` (`way_to_work_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
