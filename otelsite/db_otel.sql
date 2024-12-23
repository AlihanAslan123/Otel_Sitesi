-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 23 Ara 2024, 13:09:34
-- Sunucu sürümü: 5.7.17
-- PHP Sürümü: 7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `db_otel`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `fiyatlar`
--

CREATE TABLE `fiyatlar` (
  `id` int(11) NOT NULL,
  `oda_tipi` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `fiyati` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `fiyatlar`
--

INSERT INTO `fiyatlar` (`id`, `oda_tipi`, `fiyati`) VALUES
(1, 'Tek Kişilik Oda', 3850),
(2, 'Çift Kişilik Oda', 4000),
(3, 'Kral Dairesi', 8900);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici`
--

CREATE TABLE `kullanici` (
  `kullaniciid` int(11) NOT NULL,
  `kullaniciadi` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `sifre` text COLLATE utf8_turkish_ci NOT NULL,
  `kullanicimail` varchar(100) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kullanici`
--

INSERT INTO `kullanici` (`kullaniciid`, `kullaniciadi`, `sifre`, `kullanicimail`) VALUES
(1, 'lale', '$2y$10$wtur70lcwp9a5dvqq864VulYOGi9m2Jl4u5zGNOfaJV/ZUakNNboG', 'lale@info.com');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `rezervasyonlar`
--

CREATE TABLE `rezervasyonlar` (
  `id` int(11) NOT NULL,
  `isim` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `telefon` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `oda_tipi` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `giris_tarihi` date NOT NULL,
  `cikis_tarihi` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `rezervasyonlar`
--

INSERT INTO `rezervasyonlar` (`id`, `isim`, `telefon`, `oda_tipi`, `giris_tarihi`, `cikis_tarihi`) VALUES
(3, 'Deneme', '5025456664879', 'Çift Kişilik Oda', '2024-12-21', '2024-12-22'),
(4, 'alex', '96332145', 'Tek Kişilik Oda', '2024-12-16', '2024-12-17');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_mesaj`
--

CREATE TABLE `tbl_mesaj` (
  `id` int(11) NOT NULL,
  `mesaj` text COLLATE utf8_turkish_ci NOT NULL,
  `isim` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `mail` varchar(60) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `tbl_mesaj`
--

INSERT INTO `tbl_mesaj` (`id`, `mesaj`, `isim`, `mail`) VALUES
(1, 'merhaba, oteliniz de havuz var mı?', 'mehmet', 'mehmet@info.net'),
(2, 'Otelinizde kampanyalar ne zaman?', 'çiğdem', 'cigdem@info.com');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_yonetici`
--

CREATE TABLE `tbl_yonetici` (
  `kullaniciid` int(11) NOT NULL,
  `kullaniciadi` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(5000) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `tbl_yonetici`
--

INSERT INTO `tbl_yonetici` (`kullaniciid`, `kullaniciadi`, `sifre`) VALUES
(1, 'admin', '$2y$10$OTKhaXsNNr.vKnVi8d0ZSuY/I81NTqy4gGccwEUOXgPXmi6.LOiiC');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorumlar`
--

CREATE TABLE `yorumlar` (
  `id` int(11) NOT NULL,
  `kullaniciid` int(11) NOT NULL,
  `yorum` text COLLATE utf8_turkish_ci NOT NULL,
  `tarih` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `yorumlar`
--

INSERT INTO `yorumlar` (`id`, `kullaniciid`, `yorum`, `tarih`) VALUES
(1, 1, 'Otelde 3 gün konakladım. Odaları çok konforlu. Yemekleri lezzetli', '2024-12-11');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `fiyatlar`
--
ALTER TABLE `fiyatlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kullanici`
--
ALTER TABLE `kullanici`
  ADD PRIMARY KEY (`kullaniciid`),
  ADD UNIQUE KEY `kullanicimail` (`kullanicimail`),
  ADD UNIQUE KEY `kullaniciadi` (`kullaniciadi`),
  ADD UNIQUE KEY `kullaniciadi_2` (`kullaniciadi`);

--
-- Tablo için indeksler `rezervasyonlar`
--
ALTER TABLE `rezervasyonlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_mesaj`
--
ALTER TABLE `tbl_mesaj`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_yonetici`
--
ALTER TABLE `tbl_yonetici`
  ADD PRIMARY KEY (`kullaniciid`);

--
-- Tablo için indeksler `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `fiyatlar`
--
ALTER TABLE `fiyatlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Tablo için AUTO_INCREMENT değeri `kullanici`
--
ALTER TABLE `kullanici`
  MODIFY `kullaniciid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Tablo için AUTO_INCREMENT değeri `rezervasyonlar`
--
ALTER TABLE `rezervasyonlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_mesaj`
--
ALTER TABLE `tbl_mesaj`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_yonetici`
--
ALTER TABLE `tbl_yonetici`
  MODIFY `kullaniciid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `yorumlar`
--
ALTER TABLE `yorumlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
