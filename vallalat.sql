-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Ápr 13. 19:07
-- Kiszolgáló verziója: 10.4.28-MariaDB
-- PHP verzió: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `vallalat`
--
CREATE DATABASE IF NOT EXISTS `vallalat` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `vallalat`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `dolgozik`
--

DROP TABLE IF EXISTS `dolgozik`;
CREATE TABLE `dolgozik` (
  `ceges_azonosito` varchar(10) NOT NULL,
  `id` int(11) NOT NULL,
  `beszamolo` varchar(800) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `dolgozik`
--

INSERT INTO `dolgozik` (`ceges_azonosito`, `id`, `beszamolo`) VALUES
('adm4', 1, 'Az implementált biztonsági intézkedésekkel biztosítottuk, hogy az ügyfelek adatai teljesen védettek legyenek, és az ügyfélkapu megfeleljen a legfrissebb adatvédelmi előírásoknak. Az adatkezelési folyamatokat körültekintően terveztük meg, és a jogi előírásoknak való megfelelésre fokozott figyelmet fordítottunk.'),
('dol10', 2, 'Az innováció fókuszában az energiahatékonyság, a biztonság és a kényelem állt. A felhasználók mostantól egyetlen alkalmazás segítségével vezérelhetik világításukat, fűtésüket, biztonsági rendszereiket és egyéb okos eszközeiket.\r\n\r\nA fejlesztési folyamat során kiemelt figyelmet fordítottunk a felhasználói élményre és a rendszer megbízhatóságára. A beépített mesterséges intelligencia lehetővé teszi a rendszer számára, hogy idővel megtanulja a felhasználói szokásokat és optimalizálja az otthoni környezetet.'),
('dol4', 1, 'Örömmel tájékoztatjuk a vezetőséget és a résztvevőket, hogy sikeresen befejeződött az \"Online Ügyfélkapu Fejlesztése\" projekt. A kezdeti tervek és határidők betartása mellett a projektcsapat elkötelezett munkájával sikerült létrehoznunk egy modern, felhasználóbarát és kiterjeszthető ügyfélkaput.\r\n\r\nA projekt záró szakaszában a felhasználók részére tartott képzések segítették az átállást az új ügyfélkapu használatára. A felhasználók könnyen alkalmazkodtak az új rendszerhez, ami részben a csapat által kivitelezett hatékony kommunikációnak és dokumentációs rendszernek is köszönhető.\r\n\r\nTovábbi részletek és statisztikák a projekt eredményeiről hamarosan elérhetők lesznek. A projekt zárásával új lehetőségek és kihívások elé nézünk, és bizakodóan tekintünk a jövő felé.\r\n\r\nKöszönettel:\r\nNagy Zolt'),
('dol8', 5, 'A stratégiaalkotási folyamat során a csapat összpontosított a termékportfólió bővítésére, az új értékesítési csatornák feltárására és a nemzetközi piacokra való kiterjesztésre. A célkitűzéseink között szerepelt az ügyfélkapcsolatok megerősítése és az ügyfélszolgálati szolgáltatások további fejlesztése is.\r\n\r\nAz üzletfejlesztési terv kidolgozása mellett intenzív piacra lépési stratégiákat is megfogalmaztunk, különös figyelmet szentelve a versenytársak pozícióinak és a vállalati értékajánlatnak. A projekt során egyértelműen definiáltuk az értékesítési célokat és meghatároztuk a kulcsfontosságú mutatókat (KPI-ket) a siker méréséhez.');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `dolgozo`
--

DROP TABLE IF EXISTS `dolgozo`;
CREATE TABLE `dolgozo` (
  `ceges_azonosito` varchar(10) NOT NULL,
  `nev` varchar(100) DEFAULT NULL,
  `jelszo` varchar(100) DEFAULT NULL,
  `telefon` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `fizetes` int(11) DEFAULT NULL,
  `beosztas` varchar(100) DEFAULT NULL,
  `reszlegvezeto_e` tinyint(1) DEFAULT NULL,
  `osztalyvezeto_e` tinyint(1) DEFAULT NULL,
  `admin_e` tinyint(1) DEFAULT NULL,
  `reszleg_nev` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `dolgozo`
--

INSERT INTO `dolgozo` (`ceges_azonosito`, `nev`, `jelszo`, `telefon`, `email`, `fizetes`, `beosztas`, `reszlegvezeto_e`, `osztalyvezeto_e`, `admin_e`, `reszleg_nev`) VALUES
('adm1', 'Varga Bence', '$2y$10$NqstLqYdftuK20rAHxMq.OOW7pmeDuCzdw1inz7n9/WeIdXPdW1aK', '+36101234567', 'varga.bence@email.com', 430000, 'Osztályvezető', 0, 1, 1, 'Általános ügyfélszolgálat'),
('adm2', 'Molnár Szilvia', '$2y$10$FTr6mggmGIWWVJdeFnC.leg9htoVYX1zKkB9QDk52WWD00L/aww6.', '+36509487536', 'molnar.szilvia@email.com', 410000, 'Részlegvezető', 1, 0, 1, 'Adatbiztonság'),
('adm3', 'Tóth Áron', '$2y$10$/kYck98zWkJjASIyyva9cOR9mMbXxVkiJoI3dvb5PZ37npyaOpD/O', '+36309567325', 'toth.aron@email.com', 400000, 'Részlegvezető', 1, 0, 1, 'Értékesítés'),
('adm4', 'Szabó Gergő', '$2y$10$nsk4MZjZRsGCs4LQPdybZeT8GP0.QhCWcGhXFaBBH4i2UcU.kr9AC', '+36208749678', 'szabo.gergo@email.com', 390000, 'Részlegvezető', 1, 0, 1, 'Általános ügyfélszolgálat'),
('dol1', 'Kovács János', '$2y$10$0Z0AGc/EzH8S1twdrAHK7.sQIxdcnl9HibplNlOyvrUa89mY2gfpi', '+36401234567', 'kovacs.janos@email.com', 460000, 'Osztály- részlegvezető', 1, 1, 1, 'Alkalmazásfejlesztés'),
('dol10', 'Varga Petra', '$2y$10$/Rc438qSo2.MFZXKpPNbseKda5bAOkb9WNtFLJEsl0zbf3Q3O6CE6', '+36503459678', 'varga.petra@email.com', 400000, 'Projektvezető', 1, 0, 0, 'Könyvelés'),
('dol11', 'Papp Máté', '$2y$10$vV7JOI141yKC/4Sbx9we2O6PFWHi0651803P3gmAUo08Rry9l36G.', '+36302709864', 'papp.mate@email.com', 390000, 'Részlegvezető', 1, 0, 0, 'Marketingkommunikáció'),
('dol12', 'Fekete Bence', '$2y$10$nDQAgXU9WzJ0I4nXc8cU4Oy14144LXAbkXKLeZFrxHKTSknBNzRWu', '+36202978673', 'fekete.bence@email.com', 400000, 'Részlegvezető', 1, 0, 0, 'Technikai Támogatási Részleg'),
('dol2', 'Nagy Eszter', '$2y$10$lYjfkp.czxx0BsWZcYXZ8eV3kbswAnU4RQ/hyMZC3pOly9UA6N4ZO', '+36205698432', 'nagy.eszter@email.com', 450000, 'Osztály- részlegvezető', 1, 1, 0, 'Digitális Marketing'),
('dol3', 'Szabó Andrea', '$2y$10$aDNH5Bhjb4TTxF5l2b0q5eic6r5ZfhEYZS4mJueocgO9PzbMvr0u2', '+36301234567', 'szabo.andrea@email.com', 440000, 'Osztály- részlegvezető', 1, 1, 0, 'Adózás és Jogügy'),
('dol4', 'Nagy Zoltán', '$2y$10$u9RWqzrVG8H8VDmEU9mDXeO5jJgt5eWJNS5DY.Ludx7l9uKjsGABS', '+36204569321', 'nagy.zoltan@email.com', 460000, 'Osztály- részlegvezető', 1, 1, 0, 'Szoftverfejlesztés'),
('dol6', 'Tóth Gábor', '$2y$10$YemmMRDf5k5BFDZbPbIA5Oo3iPh45FyGBjDxvjUQH4K22mKCy0YM6', '+36307894561', 'toth.gabor@email.com', 400000, 'Projekt- részlegvezető', 1, 0, 0, 'Költségvetési és Pénzügyi Elemző'),
('dol7', 'Szabó Adrienn', '$2y$10$Ibr3e.1NEJLVcXJQ8cLrKuUgTd/zgz8U46CGeMsmZXF5Z8wEEI2pK', '+36405678912', 'szabo.addrienn@email.com', 450000, 'Projekt- részlegvezető', 1, 0, 0, 'Hálózat- és Rendszermenedzsment'),
('dol8', 'Mészáros Péter', '$2y$10$oPWb9/WkI02lXQ3qi6bW6uZv20lOe5yjFlIbbzmEIz4FPj4NzWMk.', '+36502345678', 'meszaros.peter@email.com', 420000, 'Projekt- részlegvezető', 1, 0, 0, 'Innováció'),
('dol9', 'Takács Lilla', '$2y$10$OJ7luN4pDFHZaILERBJBvOadNfdggbTtkmMI6aoZh6dts2NjqyzY6', '+36703489654', 'takacs.lilla@email.com', 420000, 'Részlegvezető', 1, 0, 0, 'Felhasználói képzés');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kik_dolgoznak_rajta`
--

DROP TABLE IF EXISTS `kik_dolgoznak_rajta`;
CREATE TABLE `kik_dolgoznak_rajta` (
  `id` int(11) NOT NULL,
  `ki_dolgozik_rajta` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `kik_dolgoznak_rajta`
--

INSERT INTO `kik_dolgoznak_rajta` (`id`, `ki_dolgozik_rajta`) VALUES
(1, 'adm1'),
(1, 'adm4'),
(1, 'dol1'),
(1, 'dol4'),
(2, 'adm2'),
(2, 'dol10'),
(2, 'dol5'),
(3, 'adm3'),
(3, 'dol11'),
(3, 'dol6'),
(4, 'dol12'),
(4, 'dol2'),
(4, 'dol7'),
(5, 'dol3'),
(5, 'dol8'),
(5, 'dol9');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `osztaly`
--

DROP TABLE IF EXISTS `osztaly`;
CREATE TABLE `osztaly` (
  `osztaly_nev` varchar(100) NOT NULL,
  `feladat` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `osztaly`
--

INSERT INTO `osztaly` (`osztaly_nev`, `feladat`) VALUES
('Fejlesztés', 'Ez az osztály felelős az új termékek és szolgáltatások tervezéséért és fejlesztéséért.'),
('Informatika', 'Ez az osztály felelős az informatikai rendszerek, számítógépes hálózatok és technológiai infrastruktúra kezeléséért.'),
('Marketing', 'A vállalat értékesítési és marketing tevékenységeit irányító osztály.'),
('Pénzügy', 'Az osztály, amely a vállalat pénzügyeinek és számvitelének kezeléséért felel.'),
('Ügyfélszolgálat', 'Az ügyfelekkel való kapcsolattartásért, panaszkezelésért és ügyfélszolgálati tevékenységekért felelős osztály.');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `projekt`
--

DROP TABLE IF EXISTS `projekt`;
CREATE TABLE `projekt` (
  `id` int(11) NOT NULL,
  `nev` varchar(100) DEFAULT NULL,
  `hatarido` date DEFAULT NULL,
  `leiras` varchar(200) DEFAULT NULL,
  `projektvezeto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `projekt`
--

INSERT INTO `projekt` (`id`, `nev`, `hatarido`, `leiras`, `projektvezeto`) VALUES
(1, 'Online Ügyfélkapu Fejlesztése', '2020-03-31', 'Új funkciók hozzáadása az online ügyfélkapuhoz a felhasználói élmény javítása érdekében.', 'Nagy Zoltán'),
(2, 'Termékinnováció - Okos Otthon Rendszer', '2023-06-15', 'Korszerű okos otthon rendszer fejlesztése, amely egyszerűen integrálható és vezérelhető.', 'Kovács Eszter'),
(3, 'Pénzügyi Folyamatok Optimalizációja', '2024-04-20', 'Automatizált pénzügyi folyamatok bevezetése a hatékonyság és pontosság növelése érdekében.', 'Tóth Gábor'),
(4, 'Intranet Portál Frissítése', '2023-12-10', 'Az intranet portál modernizálása, a belső kommunikáció és információáramlás javítása céljából.', 'Szabó Adrienn'),
(5, 'Üzletfejlesztési Stratégia Kidolgozása', '2023-08-31', 'Új piacok felderítése és üzletfejlesztési stratégia kidolgozása nemzetközi terjeszkedés céljából.', 'Mészáros Péter');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `reszleg`
--

DROP TABLE IF EXISTS `reszleg`;
CREATE TABLE `reszleg` (
  `reszleg_nev` varchar(100) NOT NULL,
  `feladat` varchar(200) DEFAULT NULL,
  `osztaly_nev` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `reszleg`
--

INSERT INTO `reszleg` (`reszleg_nev`, `feladat`, `osztaly_nev`) VALUES
('Adatbiztonság', 'Adatbiztonsági stratégiák kidolgozása, adatvédelmi intézkedések és monitorozás.', 'Informatika'),
('Adózás és Jogügy', 'Adózási ügyek kezelése, jogügyi dokumentációk előkészítése, pénzügyi jogi tanácsadás.', 'Pénzügy'),
('Alkalmazásfejlesztés', 'Alkalmazások tervezése és fejlesztése, alkalmazások karbantartása és frissítése.', 'Informatika'),
('Általános ügyfélszolgálat', 'Panaszok kezelése és ügyfélelégedettségi felmérések.', 'Ügyfélszolgálat'),
('Digitális Marketing', 'Online kampányok tervezése, weboldal és közösségi média kezelése, adatok elemzése és digitális marketingstratégia optimalizálása.', 'Marketing'),
('Értékesítés', 'Értékesítési stratégia kidolgozása, értékesítési riportok és elemzések.', 'Marketing'),
('Felhasználói képzés', 'Felhasználói képzések tervezése és szervezése, felhasználói dokumentációk elkészítése.', 'Ügyfélszolgálat'),
('Hálózat- és Rendszermenedzsment', 'Informatikai hálózatok kezelése, rendszerkarbantartás és frissítések.', 'Informatika'),
('Innováció', 'Új technológiák és trendek kutatása innovációs projektek kezelése, prototípusfejlesztés.', 'Fejlesztés'),
('Költségvetési és Pénzügyi Elemző', 'Költségvetés tervezés és követés, pénzügyi teljesítmény elemzése költség-haszon elemzések.', 'Pénzügy'),
('Könyvelés', 'Napi pénzügyi tranzakciók kezelése, számviteli dokumentumok előkészítése.', 'Pénzügy'),
('Marketingkommunikáció', 'Marketingkampányok tervezése és végrehajtása Reklám, PR és média kapcsolatok.', 'Marketing'),
('Szoftverfejlesztés', 'Szoftvertervezés és -fejlesztés, tesztelési és minőségellenőrzési részleg.', 'Fejlesztés'),
('Technikai Támogatási Részleg', 'Problémamegoldás és technikai segítségnyújtás.', 'Ügyfélszolgálat'),
('Termékfejlesztés', 'Termékmenedzsment Terméktervezés és design Termékfejlesztési projektek kezelése.', 'Fejlesztés');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `dolgozik`
--
ALTER TABLE `dolgozik`
  ADD PRIMARY KEY (`ceges_azonosito`,`id`),
  ADD KEY `fk_dolgozik_id` (`id`);

--
-- A tábla indexei `dolgozo`
--
ALTER TABLE `dolgozo`
  ADD PRIMARY KEY (`ceges_azonosito`),
  ADD KEY `fk_dolgozo_reszleg` (`reszleg_nev`);

--
-- A tábla indexei `kik_dolgoznak_rajta`
--
ALTER TABLE `kik_dolgoznak_rajta`
  ADD PRIMARY KEY (`id`,`ki_dolgozik_rajta`);

--
-- A tábla indexei `osztaly`
--
ALTER TABLE `osztaly`
  ADD PRIMARY KEY (`osztaly_nev`);

--
-- A tábla indexei `projekt`
--
ALTER TABLE `projekt`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `reszleg`
--
ALTER TABLE `reszleg`
  ADD PRIMARY KEY (`reszleg_nev`),
  ADD KEY `fk_reszleg` (`osztaly_nev`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `projekt`
--
ALTER TABLE `projekt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `dolgozik`
--
ALTER TABLE `dolgozik`
  ADD CONSTRAINT `fk_dolgozik` FOREIGN KEY (`ceges_azonosito`) REFERENCES `dolgozo` (`ceges_azonosito`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dolgozik_id` FOREIGN KEY (`id`) REFERENCES `projekt` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `dolgozo`
--
ALTER TABLE `dolgozo`
  ADD CONSTRAINT `fk_dolgozo_reszleg` FOREIGN KEY (`reszleg_nev`) REFERENCES `reszleg` (`reszleg_nev`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Megkötések a táblához `kik_dolgoznak_rajta`
--
ALTER TABLE `kik_dolgoznak_rajta`
  ADD CONSTRAINT `fk_kik_dolgoznak_rajta` FOREIGN KEY (`id`) REFERENCES `projekt` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `reszleg`
--
ALTER TABLE `reszleg`
  ADD CONSTRAINT `fk_reszleg` FOREIGN KEY (`osztaly_nev`) REFERENCES `osztaly` (`osztaly_nev`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
