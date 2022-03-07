-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 03 Oca 2022, 17:39:27
-- Sunucu sürümü: 10.4.21-MariaDB
-- PHP Sürümü: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `tinder`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `favourites`
--

CREATE TABLE `favourites` (
  `favourites_id` int(11) NOT NULL,
  `first_user` int(11) NOT NULL,
  `second_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `favourites`
--

INSERT INTO `favourites` (`favourites_id`, `first_user`, `second_user`) VALUES
(5, 7, 6),
(6, 5, 7),
(7, 7, 8),
(8, 7, 5);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `friendship`
--

CREATE TABLE `friendship` (
  `friendship_id` int(11) NOT NULL,
  `first_user` int(11) NOT NULL,
  `second_user` int(11) NOT NULL,
  `is_okey` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `friendship`
--

INSERT INTO `friendship` (`friendship_id`, `first_user`, `second_user`, `is_okey`, `created_date`) VALUES
(8, 8, 6, 'no', '2021-12-30 21:43:24'),
(9, 7, 5, 'yes', '2022-01-01 19:15:04'),
(10, 7, 8, 'yes', '2022-01-01 20:47:42'),
(11, 9, 7, 'yes', '2022-01-01 21:28:05'),
(12, 9, 4, 'no', '2022-01-01 21:32:52'),
(13, 9, 5, 'no', '2022-01-01 21:33:54'),
(14, 10, 5, 'no', '2022-01-02 21:49:42'),
(15, 10, 7, 'yes', '2022-01-02 21:50:12');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `title1` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `title2` varchar(250) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `slider`
--

INSERT INTO `slider` (`id`, `name`, `title1`, `title2`) VALUES
(1, 'ilk slider', 'Register site and use our features', 'Making friends'),
(2, 'name2', 'Social NETWORK', 'Chatting other people and start talking about ...'),
(3, 'name3', 'For those who want to meet new people', 'Expand your social circle ');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `user_surname` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `user_age` int(3) NOT NULL,
  `user_gender` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `user_email` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `user_password` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `user_picture` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `user_about` text COLLATE utf8_turkish_ci NOT NULL,
  `user_hobies` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `user_created_date` datetime NOT NULL,
  `log_in` varchar(7) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_surname`, `user_age`, `user_gender`, `user_email`, `user_password`, `user_picture`, `user_about`, `user_hobies`, `user_created_date`, `log_in`) VALUES
(2, 'Muhammed', 'Aydoğan', 22, 'Male', 'muhammetay651@gmail.com', '39282f24ae5d10dd38b04ed69d3de608cc323c7b2972f6518ee85b15f12052a5', 'uploads/no-avatar.jfif', '', '', '0000-00-00 00:00:00', ''),
(3, 'Yusuf ', 'Aydın', 18, 'Male', 'yusuf@gmail.com', '39282f24ae5d10dd38b04ed69d3de608cc323c7b2972f6518ee85b15f12052a5', 'uploads/patient.jpg', '', '', '0000-00-00 00:00:00', ''),
(4, 'Ahmet', 'Aydoğan', 21, 'Male', 'ahmet@gmail.com', '39282f24ae5d10dd38b04ed69d3de608cc323c7b2972f6518ee85b15f12052a5', 'uploads/patient9.jpg', 'about me yazısı gelecek', 'swim,read a book,trip\r\n', '0000-00-00 00:00:00', ''),
(5, 'elif', 'aslan', 18, 'Female', 'elif@gmail.com', '39282f24ae5d10dd38b04ed69d3de608cc323c7b2972f6518ee85b15f12052a5', 'uploads/patient7.jpg', '', '', '0000-00-00 00:00:00', 'Offline'),
(6, 'Büşra', 'Yılmaz', 28, 'Female', 'busra@gmail.com', '39282f24ae5d10dd38b04ed69d3de608cc323c7b2972f6518ee85b15f12052a5', 'uploads/patient6.jpg', '', '', '2021-12-28 19:09:29', ''),
(7, 'fatih', 'Koçak', 23, 'Male', 'fatih@gmail.com', 'dd6ef677d0ad4a60761885e11ccd82e3a63e37d47bb830a507b328bdb7cbb7e9', 'uploads/patient8.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec at metus eros. Sed semper lacus eros, sed sodales ex condimentum nec. Vestibulum sollicitudin sapien sem, dignissim condimentum urna tristique a. Aliquam in felis ipsum. Nulla facilisi. In iaculis dapibus diam, vestibulum eleifend diam ornare sed. Proin id viverra neque. Etiam a orci massa. Cras pellentesque lacus felis, sed cursus ligula convallis a. Donec dapibus purus eget bibendum mollis. Phasellus vulputate eros vel risus egestas placerat. Fusce non est velit. In dapibus nisi euismod turpis tempor, a ultricies turpis commodo.\r\n\r\nDuis odio erat, pulvinar id ligula eu, accumsan commodo nunc. Curabitur at magna vulputate, elementum risus mollis, ullamcorper lectus. Aenean maximus sollicitudin euismod. Ut imperdiet bibendum velit sit amet dignissim. Integer tincidunt fringilla tincidunt. Ut et semper purus, eu porta tortor. Nam vitae massa in elit convallis venenatis ac et dui. Donec condimentum orci id cursus auctor. Etiam iaculis libero vel mi vulputate pellentesque nec gravida sapien. Donec nibh erat, aliquet non quam nec, porta finibus quam. Integer hendrerit lectus vel posuere cursus.', 'cs go,fitness,body,party', '2021-12-28 19:12:56', 'Offline'),
(8, 'hakan', '', 18, 'Male', 'hakan@gmail.com', '39282f24ae5d10dd38b04ed69d3de608cc323c7b2972f6518ee85b15f12052a5', 'uploads/no-avatar.jfif', '', '', '2021-12-28 20:28:31', 'Offline'),
(9, 'Cafer Hakan', '', 18, 'Male', 'caa@gmail.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'uploads/no-avatar.jfif', '', '', '2022-01-01 21:24:05', 'Offline'),
(10, 'fatih', 'Koçak', 18, 'Male', 'fatihiki@gmail.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'uploads/no-avatar.jfif', 'fatih iki benim', 'pc games', '2022-01-02 21:49:16', 'Offline');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users_chat`
--

CREATE TABLE `users_chat` (
  `msg_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `msg_content` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `msg_status` text COLLATE utf8_turkish_ci NOT NULL,
  `msg_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `users_chat`
--

INSERT INTO `users_chat` (`msg_id`, `sender_id`, `receiver_id`, `msg_content`, `msg_status`, `msg_date`) VALUES
(149, 7, 5, 'Elif nasılsın?', 'read', '2022-01-02 14:35:14'),
(150, 5, 7, 'iyiyim Fatih sen', 'read', '2022-01-02 14:35:25'),
(151, 7, 5, 'Ben de iyiyim', 'read', '2022-01-02 14:35:37'),
(152, 7, 5, 'Cuma g&uuml;n&uuml; uygunsan okuldan sonra kahve i&ccedil;elim mi?', 'read', '2022-01-02 14:36:09'),
(153, 5, 7, 'Olur.', 'read', '2022-01-02 14:36:38'),
(154, 5, 7, 'Cuma g&uuml;n&uuml; g&ouml;r&uuml;ş&uuml;r&uuml;z.', 'read', '2022-01-02 14:36:49'),
(155, 7, 5, 'G&ouml;r&uuml;ş&uuml;r&uuml;z', 'unread', '2022-01-02 14:36:58'),
(156, 10, 7, 'fatih2den merhaba', 'read', '2022-01-02 18:50:56'),
(157, 7, 10, 'fatih1den de merhaba', 'read', '2022-01-02 18:51:09'),
(158, 7, 10, 'deneme 12 3', 'read', '2022-01-03 16:25:12'),
(159, 10, 7, 'fatih 2 den sa', 'read', '2022-01-03 16:26:38'),
(160, 7, 10, 'fatih1den as', 'read', '2022-01-03 16:28:06'),
(161, 7, 8, 'hakancığım nasılsın', 'unread', '2022-01-03 16:28:28');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`favourites_id`);

--
-- Tablo için indeksler `friendship`
--
ALTER TABLE `friendship`
  ADD PRIMARY KEY (`friendship_id`);

--
-- Tablo için indeksler `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Tablo için indeksler `users_chat`
--
ALTER TABLE `users_chat`
  ADD PRIMARY KEY (`msg_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `favourites`
--
ALTER TABLE `favourites`
  MODIFY `favourites_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `friendship`
--
ALTER TABLE `friendship`
  MODIFY `friendship_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Tablo için AUTO_INCREMENT değeri `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `users_chat`
--
ALTER TABLE `users_chat`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
