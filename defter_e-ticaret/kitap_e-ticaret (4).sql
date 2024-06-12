-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 11 Haz 2024, 18:36:58
-- Sunucu sürümü: 8.2.0
-- PHP Sürümü: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `kitap_e-ticaret`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `adminAdi` varchar(20) COLLATE utf8mb3_turkish_ci NOT NULL,
  `parola` varchar(255) COLLATE utf8mb3_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `admin`
--

INSERT INTO `admin` (`id`, `adminAdi`, `parola`) VALUES
(1, 'asuman', '123456'),
(2, 'gülbahar', '123456789'),
(3, 'Merve Nur', '12345');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `adresbilgileri`
--

DROP TABLE IF EXISTS `adresbilgileri`;
CREATE TABLE IF NOT EXISTS `adresbilgileri` (
  `Adres_ID` int NOT NULL AUTO_INCREMENT,
  `Kullanici_ID` int DEFAULT NULL,
  `Adres_basligi` varchar(100) COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `Siparis_Veren_AdiSoyad` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `Telefon` varchar(15) COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `Adres_Tanimi` text COLLATE utf8mb3_turkish_ci,
  PRIMARY KEY (`Adres_ID`),
  KEY `Kullanici_ID` (`Kullanici_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `favoriler`
--

DROP TABLE IF EXISTS `favoriler`;
CREATE TABLE IF NOT EXISTS `favoriler` (
  `Favori_ID` int NOT NULL AUTO_INCREMENT,
  `Kullanici_ID` int DEFAULT NULL,
  `Urun_ID` int DEFAULT NULL,
  PRIMARY KEY (`Favori_ID`),
  KEY `Kullanici_ID` (`Kullanici_ID`),
  KEY `Urun_ID` (`Urun_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `favoriler`
--

INSERT INTO `favoriler` (`Favori_ID`, `Kullanici_ID`, `Urun_ID`) VALUES
(30, 26, 9);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategori`
--

DROP TABLE IF EXISTS `kategori`;
CREATE TABLE IF NOT EXISTS `kategori` (
  `kategori_ID` int NOT NULL AUTO_INCREMENT,
  `kategoriAdi` varchar(100) COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`kategori_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `kategori`
--

INSERT INTO `kategori` (`kategori_ID`, `kategoriAdi`) VALUES
(1, 'Ajanda'),
(2, 'Defter');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kitap_ozellikleri`
--

DROP TABLE IF EXISTS `kitap_ozellikleri`;
CREATE TABLE IF NOT EXISTS `kitap_ozellikleri` (
  `KitOzellik_ID` int NOT NULL AUTO_INCREMENT,
  `Sayfa_Ozelligi` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `Kenar_Cesidi` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `Buyukluk` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`KitOzellik_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `kitap_ozellikleri`
--

INSERT INTO `kitap_ozellikleri` (`KitOzellik_ID`, `Sayfa_Ozelligi`, `Kenar_Cesidi`, `Buyukluk`) VALUES
(1, 'Düz', 'Spiralli', 'A4'),
(2, 'Düz', 'Spiralli', 'A5'),
(3, 'Düz', 'Spiralsiz', 'A4'),
(4, 'Düz', 'Spiralsiz', 'A5'),
(5, 'Çizgili', 'Spiralli', 'A4'),
(6, 'Çizgili', 'Spiralli', 'A5'),
(7, 'Çizgili', 'Spiralsiz', 'A4'),
(8, 'Çizgili', 'Spiralsiz', 'A5'),
(9, 'Kareli', 'Spiralli', 'A4'),
(10, 'Kareli', 'Spiralli', 'A5'),
(11, 'Kareli', 'Spiralsiz', 'A4'),
(12, 'Kareli', 'Spiralsiz', 'A5'),
(13, NULL, NULL, NULL),
(14, NULL, NULL, NULL),
(15, NULL, NULL, NULL),
(16, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici`
--

DROP TABLE IF EXISTS `kullanici`;
CREATE TABLE IF NOT EXISTS `kullanici` (
  `kullanici_ID` int NOT NULL AUTO_INCREMENT,
  `adSoyad` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `cep_telefonu` varchar(15) COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `sifre` text CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci,
  PRIMARY KEY (`kullanici_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `kullanici`
--

INSERT INTO `kullanici` (`kullanici_ID`, `adSoyad`, `email`, `cep_telefonu`, `sifre`) VALUES
(29, 'Gülbahar Elik', 'elikgulbahar@gmail.com', '05324123224', '123bahar'),
(28, 'asuman ', 'asuu@gmail.com', NULL, '1234'),
(26, 'Merve  Nur Yalçın', 'merve@gmail.com', '11111111111', '123456'),
(27, 'bahar elik', 'bahar@gmail.com', '11111111122', '123456');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sepetdetay`
--

DROP TABLE IF EXISTS `sepetdetay`;
CREATE TABLE IF NOT EXISTS `sepetdetay` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kullanici_id` int NOT NULL,
  `urun_id` int NOT NULL,
  `miktar` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kullanici_id` (`kullanici_id`),
  KEY `urun_id` (`urun_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `sepetdetay`
--

INSERT INTO `sepetdetay` (`id`, `kullanici_id`, `urun_id`, `miktar`) VALUES
(29, 25, 10, 1),
(34, 27, 1, 3),
(35, 27, 9, 5),
(38, 26, 9, 3),
(39, 26, 10, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

DROP TABLE IF EXISTS `urunler`;
CREATE TABLE IF NOT EXISTS `urunler` (
  `Urun_ID` int NOT NULL AUTO_INCREMENT,
  `UrunAdi` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `UrunFiyat` decimal(10,2) DEFAULT NULL,
  `uretimYili` int DEFAULT NULL,
  `Aciklama` text CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci,
  `stokMiktari` int DEFAULT NULL,
  `fotograf` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `kategori_ID` int DEFAULT NULL,
  `yildizOrani` float DEFAULT NULL,
  `kit_ozellik_id` int DEFAULT NULL,
  PRIMARY KEY (`Urun_ID`),
  KEY `kategori_ID` (`kategori_ID`),
  KEY `fk_kitOzellik` (`kit_ozellik_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`Urun_ID`, `UrunAdi`, `UrunFiyat`, `uretimYili`, `Aciklama`, `stokMiktari`, `fotograf`, `kategori_ID`, `yildizOrani`, `kit_ozellik_id`) VALUES
(1, 'Çiçek Motifli Ajanda', 350.00, 2023, 'Resim, kaliteli bir kağıt üzerinde yapılmıştır ve profesyonel bir yöntemle boyanmıştır. Pencere ve kapı açıkları, binanın içini gösterir ve bu da, daha fazla derinlik ve boyut kazandırır.', 10, '../image/kitap8.webp', 1, NULL, NULL),
(2, 'Modern Binası', 400.00, 2024, 'Bu eser, modern mimariyi ve güzel sanatları bir araya getiren bir şekilde yaratılmıştır. Resim, bir binanın görünümünü gösterir, bu binanın mimariyi modern, renkleri az, geometrik ve doğal estetiğe sahip bir şekilde tasarlanmıştır.', 10, '../image/kitap10.webp', 1, NULL, NULL),
(3, 'Sade Şık Ajanda', 250.00, 2024, 'Sade ve şıklığı arayanlar içindir.Renkleri canlı ve parlaktır. Resim, modern bir dekorasyon için idealdir.', 5, '../image/kitap1.jpg', 1, NULL, NULL),
(4, 'Modern Mimari Motiflerle Sürgün Defteri', 450.00, 2022, 'Modern Mimari Motiflerle Sürgün Defteri, günlük yaşamınızı keyifle ve estetik olarak zenginleştirecektir. Defter, kaliteli bir kağıt kullanılarak üretilmiştir ve modern mimari motiflerle dekoratif bir şekilde tasarlanmıştır.', 5, '../image/kitap5.webp', 1, NULL, NULL),
(5, 'Doğal Çiçek Desenli Kumaş Kapak Ajanda', 350.00, 2022, 'Bu eşsiz ajanda, doğal çiçek desenleriyle süslenmiş yeşil kumaş kapağıyla göz kamaştırıyor. El yapımı dokunuşlarla tasarlanan ajandamız, hem estetik hem de işlevsel özellikleriyle dikkat çekiyor.', 5, '../image/kitap21.webp', 1, NULL, NULL),
(6, '\r\nGotik Kafatası Temalı Deri Kapak Ajanda', 350.00, 2022, 'Bu eşsiz ajanda, gotik ve karanlık tasarımıyla dikkat çekiyor. El yapımı deri kapak, detaylı kafatası motifi ve çarpıcı dikişlerle süslenmiştir. Dayanıklı yapısı ve sağlam kilidi ile notlarınızı güvenle saklamanızı sağlar.', 5, '../image/kitap11.webp', 1, NULL, NULL),
(7, 'Güneşin Son Işığı', 250.00, 2024, 'Güneşin son ışıklarıyla yeni yıla hazırlanıyoruz. Yeni yıl yeni hedefler için.', 5, '../image/kitap22.webp', 1, NULL, NULL),
(8, 'Papatya Ajandası', 250.00, 2020, 'Yılın son ayında, papatya gibi güneşli anılar yaratmak için', 5, '../image/kitap20.webp', 1, NULL, NULL),
(9, 'İyi Şanslar', 200.00, 2020, 'Kedi severler için siyah renkli defter', 5, '../image/kitap24.webp', 2, NULL, NULL),
(10, 'Kova Listesi Kitabı', 200.00, 2020, 'Şık ve sadelikten yana olan Kova burcuna sahipler olanlar için ', 5, '../image/kitap13.png', 2, NULL, NULL),
(11, 'Tarihsiz Planlayıcı', 250.00, 2020, 'Planlamanın sınırı yok! UNDATE Planner ile hayatınızı organize edin. Tarih sınırı olmadan, istediğiniz şekilde planlayıp organize edin. Bu defter, günlük, haftalık veya aylık planlamalar için idealdir. ', 5, '../image/kitap3.webp', 2, NULL, NULL),
(12, 'Kahverengi Minimalist Tasarım Defter', 250.00, 2024, 'kahverengi kumaş kaplamasıyla zarif bir görünüm sunar. Esnek kapak, dayanıklılığı ve taşınabilirliği ile günlük kullanım için idealdir. İç sayfaları, notlarınızı, planlarınızı ve fikirlerinizi düzenlemenize yardımcı olacak şekilde tasarlanmıştır. ', 5, '../image/kitap2.jpg', 2, NULL, NULL),
(13, 'El Nakışı Kitap ve Kuş Temalı Defter', 350.00, 2024, 'Bu zarif defter, ön kapağında yer alan el nakışı kitap ve kuş deseni ile dikkat çekiyor. Yüksek kaliteli kumaş kapak, detaylı nakış işçiliği ile birleşerek deftere sanatsal bir dokunuş katıyor. İç sayfaları kaliteli kağıttan üretilmiş olup yazma ve çizim için idealdir.', 10, '../image/kitap15.webp', 2, NULL, NULL),
(14, 'Ay Işığı', 250.00, 2023, 'Ayın döngüsü gibi, hayatınızın döngüsünü yönetin. Düzenli not alma ve planlama ile başarıya ulaşın', 5, '../image/kitap25.webp', 2, NULL, NULL),
(15, 'Gül Defteri', 250.00, 2024, 'Gül Defteri, gülün doğasına ve güçlü sembolüne dayanarak tasarlanmış bir defterdir. Gül, doğa ve yaşamın simgesidir ve güçlü bir pozitif enerji kaynağıdır. Gül Defteri, bu pozitif enerjiyi hayatınızda aktarmak ve keyifle yaşamak için kullanılabilir. ', 5, '../image/kitap23.webp', 2, NULL, NULL),
(16, 'Mavi Çiçek Düşleri', 350.00, 2024, 'arı kapaklı bir defterdir ve onun üstüne mavi renkli çiçekler çizilmiştir. Bu defter, not alma, planlama ve kreatif yaratıcılığınızın harikasına imkan tanıyan bir ürünüdür. Mavi çiçekler, rahatlatıcı ve pozitif bir duygusal durumu oluşturan renklerden biridir. Bu defteri kullanarak, günlük yaşamınızın keyfini çıkarmak ve daha organizasyonlu yaşamak için kullanabilirsiniz.', 5, '../image/kitap3.jpg', 2, NULL, NULL),
(19, 'deneme', 250.00, 2024, 'keeeeeeekekkekekee', 10, 'Ekran görüntüsü 2024-01-09 183043.png', 1, NULL, NULL),
(20, 'deneme', 250.00, 2024, 'keeeeeeekekkekekee', 10, 'Ekran görüntüsü 2024-01-09 183043.png', 1, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
