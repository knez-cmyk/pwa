-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2024 at 04:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `welt`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `korisnicko_ime` varchar(50) NOT NULL,
  `lozinka` varchar(255) NOT NULL,
  `ime` varchar(100) DEFAULT NULL,
  `prezime` varchar(100) DEFAULT NULL,
  `administratorska_prava` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `korisnicko_ime`, `lozinka`, `ime`, `prezime`, `administratorska_prava`) VALUES
(2, 'admin', '$2y$10$FelHGmEQTUxE1bqdRGPMQurttfMFmSkvShkmUJ39.nBesviObhi.6', 'ccc', 'ccc', 1),
(3, 'teo', '$2y$10$qz4R5otOF8I.Luf3vBA.OO70jSUpBJvXql85meifkfCGNJHNe2kxy', 'teo', 'teo', 0),
(4, 'krki', '$2y$10$wFUWQOIl3z.svB3duIEjlO7iUfVj9LFJLkjJtAMa8O4PkYA8yvtUG', 'krle', 'krle', 0),
(5, 'ss', '$2y$10$Juw5Z4BaB1dIH0xJszhhkulXDPxTSTMjEjC3w52jFdY8wzmG4Yjd2', 'ss', 'ss', 0),
(6, 'sss', '$2y$10$VJ6Oh58aXexzWLr2zkaNzOXMlVlb749kohOirXlHx7OBT/.GKzB2y', 'sss', 'sss', 0),
(7, 'ddd', '$2y$10$UjeU8r6EqDLOXcPFIF7wR.PTzw2fYoPza3MuYKzh.5SVcIdURpcla', 'ddd', 'ddd', 0),
(8, 'cc222', '$2y$10$pBwtfEN057/AOuEyIgoBi.ctXSgMSOwOPJVVkzBF5TcmSL8jISjEe', 'd', 'd', 0);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `naslov` varchar(255) NOT NULL,
  `sazetak` text NOT NULL,
  `tekst` text NOT NULL,
  `kategorija` varchar(100) NOT NULL,
  `prikaz` enum('Da','Ne') NOT NULL,
  `slika` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `naslov`, `sazetak`, `tekst`, `kategorija`, `prikaz`, `slika`, `created_at`) VALUES
(16, 'Nato beschließt Operationsplan', 'Die Nato will künftig Waffenlieferungen an die Ukraine international koordinieren.', 'Die Nato-Staaten haben einen sogenannten Operationsplan für den Ausbau der Unterstützung der Ukraine beschlossen. Bei dem Bündnisprojekt geht es insbesondere darum, dass die Nato künftig die internationale Koordinierung von Waffenlieferungen und Ausbildungsaktivitäten für die ukrainischen Streitkräfte übernehmen will.\r\n\r\n\r\nDas Dokument wurde am Donnerstag am Rande eines Verteidigungsministertreffens in einem schriftlichen Verfahren angenommen, wie die Deutsche Presse-Agentur von Diplomaten erfuhr. Die Einigung soll an diesem Freitag nach einer formellen Billigung durch die Minister öffentlich gemacht werden.\r\n\r\nDie Unterstützungsaufgaben werden bislang federführend von den Vereinigten Staaten wahrgenommen. Diese hatten dafür Ende 2022 im Europa-Hauptquartier der US-Streitkräfte im hessischen Wiesbaden eine rund 300 Soldaten starke Einheit mit dem Namen Security Assistance Group-Ukraine (SAG-U) aufgebaut. Die Nato-Mission soll nun mindestens die gleiche Personalstärke haben. Details des Operationsplans wurden vom Bündnis zunächst geheim gehalten.\r\n\r\nUngarn befürchtet Krieg und macht nicht mit\r\nDas Nato-Projekt gilt auch als Vorkehrung für den Fall einer möglichen Rückkehr von Donald Trump ins US-Präsidentenamt ab Januar 2025. Äußerungen des Republikaners hatten in der Vergangenheit Zweifel daran geweckt, ob die USA die Ukraine unter seiner Führung weiter so wie bisher im Abwehrkrieg gegen Russland unterstützen würden. Im Bündnis wird befürchtet, dass von einem politischen Kurswechsel in Washington auch die Koordinierung von Waffenlieferungen und Ausbildungsaktivitäten für die ukrainischen Streitkräfte betroffen sein könnte.', 'politika', 'Da', 'uploads/1.jpg', '2024-06-13 13:45:54'),
(17, 'Deutschland darf nicht', 'Die Türkei braucht mehr Demokratie, fordert Tülay Hatimogullari, Führungsfigur einer', 'Die Türkei braucht mehr Demokratie, fordert Tülay Hatimogullari, Führungsfigur einer wichtigen Oppositionspartei. Sie macht deutlich, warum sich Deutschland in der Migrationsfrage nicht erpressen lassen darf – und warnt vor einem Trick, den Präsident Erdogans immer wieder anwende.\r\nAnzeige\r\nWELT: Bei den Kommunalwahlen haben Ihre linksliberale DEM-Partei wie auch die sozialdemokratische CHP deutlich besser abgeschnitten als zuvor bei den Präsidenten- und Parlamentswahlen. Heißt das, die frühere Idee eines großen Bündnisses gegen Präsident Recep Tayyip Erdogan funktioniert nicht? Diesmal sind die Oppositionsparteien ja getrennt angetreten und waren erfolgreicher.\r\n\r\nTülay Hatimogullari: Tatsächlich waren wir ziemlich erfolgreich, aber wir haben durchaus stellenweise mit der CHP kooperiert, also der größten Oppositionspartei. Im Südosten der Türkei wollten wir jene Kommunen zurückerobern, in denen unsere Bürgermeister von der Regierung abgesetzt und die unter Zwangsverwaltung gestellt worden waren. Das ist gelungen. Insgesamt haben wir die Wahlen in 75 Städten und Gemeinden gewonnen. Im Westen des Landes haben wir in mehreren Städten Kompromisse mit der CHP geschlossen und keine Kandidaten aufgestellt, sodass deren Kandidaten dort siegen konnten. Aber wir haben auch dort gesellschaftliche Gruppen wie Frauen, Arbeiterinnen und Arbeiter mobilisiert. Die CHP hat auch mithilfe unserer Wähler mehrere Großstädte erobert. So konnte das faschistische Bündnis von Erdogans AKP und der nationalistischen MHP geschlagen werden.', 'politika', 'Da', 'uploads/2.jpg', '2024-06-13 13:50:52'),
(18, 'Geheimdienst der Bundeswehr', 'Verteidigungsminister Boris Pistorius ernennt Torsten Akmann zum zivilen Vizepräsidenten', 'In der Führung des Militärischen Abschirmdienstes (MAD) der Bundeswehr gibt es einen Personalwechsel: Der einstige Staatssekretär der Berliner Senatsverwaltung für Inneres, Torsten Akmann, agiert ab sofort als stellvertretender Leiter der Behörde. Laut Mitteilung des MAD ernannte Verteidigungsminister Boris Pistorius (SPD) den 59-Jährigen gebürtigen Niedersachsen am Donnerstag zum zivilen Vizepräsidenten.\r\n\r\nAkmann fungierte nach Stationen im Kanzleramt und im Bundesinnenministerium ab 2016 als Staatssekretär der Berliner Innenverwaltung. In der Amtszeit von Innensenator Andreas Geisel (SPD) war er unter anderem mit der Aufarbeitung des Behördenhandelns im Fall des Breitscheidplatz-Attentäters Anis Amri, sowie mit der Modernisierung der Sicherheitsgesetzgebung befasst. Nach einem Zerwürfnis mit Geisels Nachfolgerin, der bis heute amtierenden Innensenatorin Iris Spranger (SPD), wurde Akmann im Februar 2023 in den einstweiligen Ruhestand versetzt.\r\n\r\nBeim MAD bildet Akmann mit Präsidentin Martina Rosenberg und dem militärischen Vizepräsidenten Ralf Feldotto fortan die Amtsleitung. Ihm unterstehen vier Abteilungen. Zuständig ist er unter anderem für die Spionage- und Extremismusabwehr.', 'politika', 'Da', 'uploads/3.jpg', '2024-06-13 14:13:27'),
(19, 'Zehn Sommerdrinks niedrigem', 'Achtung vor dem Pornstar Martini: Er gilt als der Drink, der den schlimmsten Kater verursacht.', 'odka, Passionsfrucht und ein Schuss Prosecco – das ist der Mix, aus dem der Pornstar Martini ist, die aktuelle Nummer eins auf dem „Cocktail Hangover Index“. Laut dem Kater-Ranking, das der US-Getränkeshop onbuy.com erstellt hat, ist die Chance nach einem oder auch mehreren Pornstar Martinis, an Kopfschmerzen, Übelkeit und dem Verlangen nach Fettigem zu leiden, besonders hoch. Seinen Titel als Kater-Getränk verdankt der Pornstar Martini aber vor allem einer Kennzahl: Wer zu viel davon trinke, verbringe wahrscheinlich am darauffolgenden Tag bis zu elf Stunden im Bett, schätzen die Alkoholexperten.\r\n\r\nSie geben auch Tipps für Cocktails und Drinks, bei denen das Risiko, flachzuliegen, geringer ausfällt. Darunter sind zum Beispiel Mojito und Erdbeer-Daiquiri, die lediglich auf einer Spirituose, und zwar Rum, basieren. Rum-Cocktails können also eine gute Wahl sein, wenn man Kopfschmerzen und Übelkeit vermeiden möchte – unten finden Sie zum Beispiel ein Rezept für Célia Fizz. Und noch weiter unten verrät uns Marian Krause, der beim Cocktailwettbewerb „World Class 2021“ zum besten Bartender Deutschlands gekürt wurde, noch seinen liebsten Sommerdrink - und wie man ihn (nicht ganz einfach) zubereitet.', 'hrana', 'Da', 'uploads/4.jpg', '2024-06-13 14:15:25'),
(20, 'Osterhasens Pausenbrot', 'Karottenkuchen kann auch herzhaft: mit Kreuzkümmel, Fetakäse und Sesamsaat', 'Karottenkuchen kann auch herzhaft: mit Kreuzkümmel, Fetakäse und Sesamsaat. Das schmeckt nicht nur zur Osterzeit zum Brunch, zum Apéritif und in der Proviantbox.\r\nKarottenkuchen kann auch herzhaft: mit Kreuzkümmel, Fetakäse und Sesamsaat. Das schmeckt nicht nur zur Osterzeit zum Brunch, zum Apéritif und in der Proviantbox.\r\n', 'hrana', 'Da', 'uploads/5.jpg', '2024-06-13 14:16:23'),
(21, 'Ein Kuchen für das zu Gastbe', 'Natürlich gibt es ungefähr eine Million Rezepte für Apfelkuchen', 'Natürlich gibt es ungefähr eine Million Rezepte für Apfelkuchen, jedes von ihnen das einfachste oder das beste oder beides. Dieser ist intensiv apfelig, schnell angerührt und noch schneller aufgegessen. Muss ein Apfelkuchen mehr können?\r\nIm Herbst wird die Sehnsucht nach einem weichen Sofa, Kuscheldecke und heißen Getränken größer, erst recht wenn dann auch noch der Duft nach etwas frisch Gebackenem die Wohnung füllt. Der Kuchen, der zu so einer Stimmung passt, sollte weder beim Einkaufen noch beim Backen übermäßig viel Gedanken beanspruchen.\r\n\r\n', 'hrana', 'Da', 'uploads/6.jpg', '2024-06-13 14:17:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
