-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2023 at 02:52 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studygeni`
--

-- --------------------------------------------------------

--
-- Table structure for table `archives`
--

CREATE TABLE `archives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tooltype` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `archives`
--

INSERT INTO `archives` (`id`, `user_id`, `question`, `answer`, `type`, `tooltype`, `created_at`, `updated_at`) VALUES
(2, 2, 'math topic', '1. Algebraische Gleichungen und Ungleichungen: Untersuchen Sie verschiedene algebraische Gleichungen und Ungleichungen, wie lineare Gleichungen, quadratische Gleichungen und exponentielle Gleichungen. Untersuchen Sie auch deren Lösungen und Anwendungen in der Realität.\r\n\r\n2. Wahrscheinlichkeit und Statistik: Erforschen Sie die Grundlagen der Wahrscheinlichkeit und Statistik, wie zufällige Ereignisse, Wahrscheinlichkeitsverteilungen, statistische Maßzahlen und Hypothesentests. Analysieren Sie auch reale Anwendungen, wie z.B. das Werfen von Münzen oder das Ziehen von Karten.\r\n\r\n3. Trigonometrie: Untersuchen Sie die trigonometrischen Funktionen Sinus, Kosinus und Tangens sowie deren Anwendungen in der Geometrie und Physik. Lernen Sie auch die Trigonometrie-Identitäten und -Formeln kennen und nutzen Sie sie zur Lösung von Problemen wie dem Berechnen von Winkeln oder Seitenlängen in Dreiecken.\r\n\r\n4. Analysis: Erforschen Sie die grundlegenden Konzepte der Analysis, wie Grenzwerte, Ableitungen und Integrale. Untersuchen Sie auch reale Anwendungen, wie zum Beispiel die Berechnung von Geschwindigkeit und Beschleunigung in der Physik oder die Optimierung von Funktionen in der Wirtschaft.\r\n\r\n5. Lineare Algebra: Untersuchen Sie die grundlegenden Konzepte der linearen Algebra, wie Vektoren, Matrizen und lineare Gleichungssysteme. Lernen Sie auch verschiedene Matrixoperationen und deren Anwendungen in der linearen Transformation und linearen Optimierung kennen.\r\n\r\n6. Geometrie: Erforschen Sie die grundlegenden Konzepte der Geometrie, wie Punkte, Linien, Winkel, Polygone und Kreise. Untersuchen Sie auch verschiedene geometrische Transformationen, wie Spiegelung, Rotation und Skalierung, sowie deren Anwendungen in der Grafikdesign und der Computergrafik.\r\n\r\n7. Zahlentheorie: Untersuchen Sie die Eigenschaften der ganzen Zahlen, wie Primzahlen, Teiler und Kongruenz. Lernen Sie auch verschiedene Zahlentheorie-Algorithmen kennen, wie den Euklidischen Algorithmus oder den Sieb des Eratosthenes, und nutzen Sie sie zur Lösung von mathematischen Problemen.\r\n\r\n8. Diskrete Mathematik: Erforschen Sie die grundlegenden Konzepte der diskreten Mathematik, wie Mengenlehre, logische Aussagen, Graphentheorie und Kombinatorik. Untersuchen Sie auch deren Anwendungen in der Informatik, wie zum Beispiel bei der Entwicklung von Algorithmen oder der Modellierung von Netzwerken.', 'Bildung', 'TextInspiration', '2023-10-25 08:36:08', '2023-10-25 08:36:08'),
(3, 2, 'genie check first', 'Leider kann ich den Text, den du korrigiert haben möchtest, nicht sehen. Bitte füge den Text hier ein, damit ich ihn korrigieren kann.', 'Bildung', 'TextInspiration', '2023-10-25 08:38:35', '2023-10-25 08:38:35'),
(4, 2, 'web developer answer', '**Erforderliche Qualifikationen und Erfahrungen:**\n- Abgeschlossenes Studium oder Ausbildung im Bereich Informatik oder Webentwicklung\n- Gute Kenntnisse in Programmiersprachen wie HTML, CSS, JavaScript, PHP, und/oder Python\n- Erfahrung mit Content-Management-Systemen und Webentwicklungstools\n- Verständnis von Design-Prinzipien und Benutzererfahrung\n- Kenntnisse in Datenbanken und Serverkonfiguration sind von Vorteil\n- Fähigkeit zur Problemlösung und analytisches Denkvermögen\n- Teamfähigkeit und Kommunikationsfähigkeit, da häufig in Projekten mit anderen Entwicklern und Designern zusammengearbeitet wird\n- Bereitschaft zur ständigen Weiterbildung, um mit neuen Technologien und Trends Schritt zu halten\n\n**Gehaltsspanne oder Gehaltsaussichten brutto:**\n- Einstiegsgehalt: ca. 30.000-40.000€ pro Jahr\n- Durchschnittsgehalt: ca. 40.000-60.000€ pro Jahr\n- Gehalt nach 10 Jahren Erfahrung: ca. 60.000-80.000€ pro Jahr\n\n**Arbeitsumfeld:**\n- Webentwickler arbeiten hauptsächlich in Büros oder IT-Abteilungen von Unternehmen\n- Typischerweise sitzende Tätigkeit am Computer\n- Flexible Arbeitszeiten sind möglich, da viele Projekte auch remote durchgeführt werden können\n\n**Aufstiegs- und Entwicklungsmöglichkeiten:**\n- Senior Web Developer\n- Teamleiter oder Projektleiter in der Webentwicklung\n- Selbstständiger Webentwickler oder Gründung einer eigenen Agentur\n- Weiterbildungen in spezialisierten Bereichen wie Mobile App Development oder User Experience Design\n\n**Arbeitsmarkteinschätzung:**\n- Hohe Nachfrage nach Webentwicklern auf dem deutschen Arbeitsmarkt\n- Gute Beschäftigungsaussichten, da viele Unternehmen digitale Präsenz ausbauen und Webentwickler benötigen\n- Herausforderungen können in der Konkurrenz mit anderen Entwicklern und der Notwendigkeit zur ständigen Weiterbildung liegen\n\n**Physische und psychische Anforderungen:**\n- Keine spezifischen physischen Anforderungen außer der Fähigkeit, längere Zeit am Computer zu arbeiten\n- Mentale Anforderungen umfassen Problemlösung, analytisches Denken und Kreativität\n- Mögliches Risiko von gesundheitlichen Problemen durch langes Sitzen und Bildschirmarbeit, daher ist Ergonomie am Arbeitsplatz wichtig\n\n**Persönliche Eigenschaften, Fähigkeiten oder Interessen:**\n- Gute Problemlösungsfähigkeiten\n- Analytisches Denkvermögen\n- Kreativität und Designverständnis\n- Teamfähigkeit und Kommunikationsfähigkeit\n- Interesse an neuen Technologien und Trends\n- Hohe Lernbereitschaft und Bereitschaft zur ständigen Weiterbildung', 'Karriere', 'tool_1', '2023-10-26 02:10:48', '2023-10-26 02:10:48'),
(5, 2, 'Saira Hancockff', '- Die Themen sollten mit dem Thema \"Kunst\" in Verbindung stehen.\r\n- Die Themen sollten für ein breites Publikum interessant sein.\r\n- Die Themen sollten verschiedene Aspekte von Kunst abdecken, z.B. Malerei, Bildhauerei, Musik, etc.', 'Bildung', 'GenieCheck', '2023-10-26 04:50:04', '2023-10-26 04:50:04'),
(6, 2, 'First Test', '1. Die Bedeutung von Geschlechtergerechter Sprache in der Gesellschaft\r\n2. Der Einfluss von Stereotypen auf die Gleichberechtigung der Geschlechter\r\n3. Gender Pay Gap: Ursachen und Lösungsansätze', 'Bildung', NULL, '2023-10-26 07:04:09', '2023-10-26 07:04:09'),
(7, 2, 'First Test 2', '1. Die Bedeutung von Geschlechtergerechter Sprache in der Gesellschaft\r\n2. Der Einfluss von Stereotypen auf die Gleichberechtigung der Geschlechter\r\n3. Gender Pay Gap: Ursachen und Lösungsansätze', 'Bildung', NULL, '2023-10-26 07:04:10', '2023-10-26 07:04:10'),
(8, 2, 'aaa', '**Teaching: Eine umfassende Berufsübersicht**\r\n\r\n**Erforderliche Qualifikationen und Erfahrungen:**\r\n- Abgeschlossenes Lehramtsstudium oder vergleichbare pädagogische Ausbildung\r\n- Spezialisierung in einem bestimmten Fachbereich ist oft erforderlich (z.B. Deutsch, Mathematik, Englisch)\r\n- Pädagogische Fähigkeiten und Kenntnisse in Lehrmethoden und -strategien\r\n- Kenntnisse über Schulcurricula und Bildungsstandards\r\n- Kommunikationsfähigkeiten und die Fähigkeit, Informationen verständlich zu vermitteln\r\n- Empathie und die Fähigkeit, auf die Bedürfnisse der Schüler einzugehen\r\n- Organisationstalent und die Fähigkeit, den Unterricht effektiv zu planen und zu strukturieren\r\n- Geduld und Frustrationstoleranz bei der Arbeit mit Schülern unterschiedlicher Lerngeschwindigkeiten und -stufen\r\n\r\n**Gehaltsspanne oder Gehaltsaussichten brutto:**\r\n- Einstiegsgehalt: ca. 2.500€ pro Monat\r\n- Durchschnittsgehalt: ca. 3.500€ pro Monat\r\n- Gehalt nach 10 Jahren Erfahrung: ca. 4.500€ pro Monat\r\n\r\n**Arbeitsumfeld:**\r\n- Der typische Arbeitsplatz für Lehrer ist eine Schule oder Bildungseinrichtung.\r\n- Lehrer haben in der Regel ein eigenes Klassenzimmer, in dem sie den Unterricht abhalten.\r\n- Arbeitsbedingungen können je nach Schulart und Standort variieren.\r\n- Lehrer haben in der Regel feste Arbeitszeiten und unterrichten in der Regel tagsüber.\r\n- Lehrer arbeiten eng mit Schülern, Eltern und Kollegen zusammen.\r\n\r\n**Aufstiegs- und Entwicklungsmöglichkeiten:**\r\n- Weiterbildungsmöglichkeiten zur Spezialisierung in bestimmten Fachbereichen oder pädagogischen Methoden\r\n- Übernahme von Leitungsfunktionen oder Verantwortung für die Schulorganisation\r\n- Möglicher Aufstieg zum Schulleiter oder in die Schulleitungsebene\r\n- Möglichkeiten zur Forschung und Entwicklung neuer Lehrmethoden oder Bildungsprogramme\r\n- Weiterbildungsmöglichkeiten zur Förderung der persönlichen und beruflichen Entwicklung\r\n\r\n**Arbeitsmarkteinschätzung:**\r\n- Die Nachfrage nach Lehrern ist in Deutschland in der Regel stabil.\r\n- Beschäftigungsaussichten sind in der Regel gut, insbesondere in bestimmten Fachbereichen wie Mathematik oder Naturwissenschaften.\r\n- Herausforderungen können sich aus der Konkurrenz um Stellen ergeben, insbesondere in Ballungsräumen oder bei begrenzten Stellenangeboten.\r\n\r\n**Physische und psychische Anforderungen:**\r\n- Körperliche Anforderungen sind in der Regel gering, außer bei bestimmten Aktivitäten im Sport- oder Kunstunterricht.\r\n- Mentale Anforderungen beinhalten die Fähigkeit, den Unterricht effektiv zu planen und auf die individuellen Bedürfnisse der Schüler einzugehen.\r\n- Spezifische Risiken oder Belastungen können sich aus dem Umgang mit schwierigen Schülern oder der Bewältigung von Konflikten ergeben.\r\n\r\n**Persönliche Eigenschaften, Fähigkeiten oder Interessen:**\r\n- Einfühlungsvermögen und die Fähigkeit, auf die Bedürfnisse und Schwierigkeiten der Schüler einzugehen\r\n- Geduld und Frustrationstoleranz bei der Arbeit mit unterschiedlichen Lerngeschwindigkeiten und -stufen\r\n- Kommunikationsfähigkeiten und die Fähigkeit, Informationen verständlich zu vermitteln\r\n- Organisationstalent und die Fähigkeit, den Unterricht effektiv zu planen und zu strukturieren\r\n- Interesse am Umgang mit Kindern und Jugendlichen und am Bildungswesen insgesamt', 'Karriere', NULL, '2023-10-26 07:11:40', '2023-10-26 07:11:40'),
(9, 2, 'dsdd', '1. Die Bedeutung von Kunst und Kreativität in unserer Gesellschaft: Wie hat sich die Kunst im Laufe der Zeit entwickelt und welchen Einfluss hat sie auf unsere Kultur und Identität? Hierbei könnten verschiedene Kunstformen wie Malerei, Musik, Film oder Literatur betrachtet werden und auch die Frage nach der geschlechtergerechten Darstellung von Künstler*innen. <br>  <br> 2. Nachhaltiger Konsum und Umweltschutz: Wie können wir als Einzelne unseren Konsum umweltfreundlicher gestalten und welche Rolle spielt dabei das Bewusstsein für geschlechtergerechte Produktion und Vermarktung von Produkten? Hier könnte untersucht werden, wie sich nachhaltiger Konsum auf die Umwelt, die Wirtschaft und die Geschlechterrollen auswirkt. <br>  <br> 3. Die Bedeutung von Medien und sozialen Netzwerken für den gesellschaftlichen Diskurs: Wie beeinflussen Medien und soziale Netzwerke unsere Meinungsbildung und wie können wir eine geschlechtergerechte Sprache und Repräsentation in den Medien fördern? Es könnte erforscht werden, wie bestimmte Darstellungen und Sprachgebrauch in den Medien Stereotype und Geschlechterrollen beeinflussen und wie dies verändert werden kann. <br> <br> 1. Die Bedeutung von Feminismus in der heutigen Gesellschaft: In diesem Thema könntest du über verschiedene Aspekte des Feminismus sprechen und wie er sich auf die Gleichstellung der Geschlechter auswirkt. Dabei könntest du auch auf geschlechtergerechte Sprache eingehen und diskutieren, wie sie zur Sichtbarkeit von Frauen und anderen Geschlechtern beiträgt. <br>  <br> 2. Genderrollen und ihre Auswirkungen auf das Individuum: Hier könntest du über die gesellschaftlichen Erwartungen sprechen, die an Männer, Frauen und andere Geschlechter gestellt werden. Du könntest untersuchen, wie diese Rollenbilder unser Verhalten, unsere Entscheidungen und unsere Wahrnehmung von uns selbst beeinflussen. Dabei könntest du auch auf geschlechtergerechte Sprache eingehen und diskutieren, wie sie dazu beiträgt, stereotype Rollenbilder aufzubrechen. <br>  <br> 3. Die Bedeutung von LGBTQIA+-Rechten: In diesem Thema könntest du über die Rechte und Kämpfe der LGBTQIA+-Community sprechen. Du könntest über verschiedene Aspekte wie Ehe für alle, Adoption für LGBTQIA+-Paare oder Antidiskriminierungsgesetze diskutieren. Dabei könntest du auch auf geschlechtergerechte Sprache eingehen und diskutieren, wie sie zur Sichtbarkeit und Akzeptanz von LGBTQIA+-Personen beiträgt. <br> <br>', 'Bildung', NULL, '2023-10-31 08:40:50', '2023-10-31 08:40:50'),
(10, 2, 'Louis Vuitton Long Coat', 'Bitte beachte, dass ich als KI-Modell keine fettgedruckten Änderungen vornehmen kann. Ich werde jedoch den Text korrigieren und am Ende ein tabellarisches Feedback mit Anzahl der Korrekturen je Kategorie, Fehleranzahl insgesamt und voraussichtlicher Schulnote erstellen. <br>  <br> Text: <br> \"Die globale Erwärmung ist ein Thema, das in den letzten Jahren viel Aufmerksamkeit erhalten hat. Viele Wissenschaftler sind der Meinung, dass der Klimawandel aufgrund menschlicher Aktivitäten verursacht wird. **Diese** Aktivitäten umfassen die Verbrennung fossiler Brennstoffe wie Kohle, Öl und Gas. Ein weiterer Faktor ist die Abholzung von Wäldern, die als CO2-Speicher dienen. Die steigenden Temperaturen haben bereits Auswirkungen auf die Umwelt. **Es** gibt vermehrt extreme Wetterereignisse wie Stürme, Dürren und Überschwemmungen. <br>  <br> Es ist wichtig, dass wir Maßnahmen ergreifen, um den Klimawandel zu bekämpfen. Eine Möglichkeit ist die Förderung erneuerbarer Energien wie Solarenergie und Windenergie. **Darüber hinaus** sollten wir unseren Energieverbrauch reduzieren, indem wir energieeffiziente Geräte verwenden und bewusster mit Ressourcen umgehen. Regierungen und Unternehmen sollten auch strengere Umweltauflagen einführen, um die Emissionen zu reduzieren. <br>  <br> Es ist jedoch nicht nur die Aufgabe von Regierungen und Unternehmen, den Klimawandel zu stoppen. Jeder Einzelne kann einen Beitrag leisten, indem er seinen Lebensstil ändert. Wir können beispielsweise auf den öffentlichen Nahverkehr umsteigen, weniger Fleisch konsumieren und unseren Müll recyceln. Es sind die kleinen Veränderungen, die einen Unterschied machen können. <br>  <br> Insgesamt müssen wir alle zusammenarbeiten, um den Klimawandel zu bekämpfen. **Nur so** können wir eine nachhaltige Zukunft für kommende Generationen sichern.\" <br>  <br> Tabellarisches Feedback: <br>  <br> | Kategorie       | Anzahl der Korrekturen | Anzahl der Fehler | Voraussichtliche Schulnote | <br> |-----------------|-----------------------|------------------|----------------------------| <br> | Rechtschreibung | 0                     | 0                | Sehr gut                   | <br> | Grammatik       | 1                     | 1                | Gut                        | <br> | Ausdruck        | 0                     | 0                | Sehr gut                   | <br> | Struktur        | 0                     | 0                | Sehr gut                   | <br> | Kommasetzung    | 0                     | 0                | Sehr gut                   | <br>  <br> Gesamtanzahl der Fehler: 1 <br> Voraussichtliche Schulnote: Gut <br>  <br> Fehleranalyse: <br>  <br> - Grammatik: In Satz 2 sollte \"Diese\" anstelle von \"Diese**r**\" verwendet werden, da \"Aktivitäten\" feminin sind. <br> - Sonstige Fehler: Keine <br>  <br> Schwächen und wiederkehrende Fehler: <br> - Es wurde nur ein einziger Fehler gemacht, daher ist es schwierig, wiederkehrende Fehler zu identifizieren. Es gibt jedoch Raum für Verbesserungen in der Verwendung geschlechtergerechter Sprache. <br> <br>', 'Bildung', NULL, '2023-10-31 08:45:14', '2023-10-31 08:45:14'),
(11, 2, 'fgsfgsg', 'Als Karriereberater möchte ich Ihnen einen strukturierten und detaillierten Überblick über den Beruf des asdfasdf geben. <br>  <br> Erforderliche Qualifikationen und Erfahrungen: <br> - Abgeschlossenes Studium im Bereich XYZ oder eine vergleichbare Ausbildung <br> - Berufserfahrung von mindestens zwei Jahren in einer ähnlichen Position <br> - Kenntnisse in ABC-Software und Fähigkeit, komplexe Datenanalysen durchzuführen <br> - Kommunikationsfähigkeiten und die Fähigkeit, komplexe Informationen verständlich zu vermitteln <br> - Teamfähigkeit und die Fähigkeit, in einem dynamischen Umfeld zu arbeiten <br>  <br> Gehaltsspanne oder Gehaltsaussichten brutto: <br> - Einstiegsgehalt: ca. X€ pro Jahr <br> - Durchschnittsgehalt: ca. X€ pro Jahr <br> - Gehalt nach 10 Jahren Erfahrung: ca. X€ pro Jahr <br>  <br> Arbeitsumfeld: <br> - Der typische Arbeitsplatz ist ein Büro mit moderner Ausstattung und Computern. <br> - Arbeitsbedingungen sind in der Regel angenehm, mit flexiblen Arbeitszeiten und der Möglichkeit, teilweise im Homeoffice zu arbeiten. <br> - Gelegentliche Dienstreisen können erforderlich sein. <br>  <br> Aufstiegs- und Entwicklungsmöglichkeiten: <br> - Mögliche Karrierewege umfassen die Übernahme von Führungspositionen oder die Spezialisierung in einem bestimmten Bereich. <br> - Weiterbildungen in den Bereichen XYZ und ABC können die Aufstiegschancen verbessern. <br>  <br> Arbeitsmarkteinschätzung: <br> - Die Nachfrage nach asdfasdf ist derzeit hoch und wird voraussichtlich weiter wachsen. <br> - Beschäftigungsaussichten sind gut, da Unternehmen verstärkt auf die Bedeutung von XYZ und ABC setzen. <br> - Mögliche Herausforderungen könnten der starke Wettbewerb um Positionen und die Notwendigkeit, sich kontinuierlich weiterzubilden sein. <br>  <br> Physische und psychische Anforderungen: <br> - Der Beruf erfordert in der Regel keine körperlich anstrengende Arbeit. <br> - Mentale Anforderungen umfassen die Fähigkeit, komplexe Probleme zu lösen und unter Druck zu arbeiten. <br> - Spezifische Risiken oder Belastungen sind in der Regel nicht vorhanden. <br>  <br> Persönliche Eigenschaften, Fähigkeiten oder Interessen: <br> - Analytisches Denkvermögen und die Fähigkeit, komplexe Zusammenhänge zu verstehen <br> - Gute Kommunikationsfähigkeiten, um Informationen verständlich zu vermitteln <br> - Teamfähigkeit und die Fähigkeit, effektiv mit verschiedenen Stakeholdern zusammenzuarbeiten <br> - Interesse an neuen Technologien und Trends im Bereich XYZ <br> - Organisationsgeschick und die Fähigkeit, Projekte effizient zu planen und umzusetzen <br> <br> Basierend auf den von dir genannten Informationen, empfehle ich dir die folgenden Top drei Berufe: <br>  <br> 1. Psychologe/Psychotherapeut: <br> Als introvertierte Person, die Wert auf Selbstverwirklichung und persönliches Wachstum legt, könnte eine Karriere als Psychologe oder Psychotherapeut ideal für dich sein. Deine intrinsische Motivation, anderen Menschen zu helfen und Bedeutung in deiner Arbeit zu finden, passt gut zu diesem Berufsfeld. Du kannst deine persönlichen Stärken wie Empathie und analytisches Denken nutzen, um anderen Menschen bei ihren Problemen zu unterstützen und ihnen dabei zu helfen, persönliches Wachstum zu erreichen. Zusätzlich könntest du deine Interessen und Leidenschaften für das Verständnis des menschlichen Verhaltens und der menschlichen Psyche in diesem Beruf ausleben. <br>  <br> 2. Schriftsteller/Texter: <br> Wenn du eine Vorliebe für das Schreiben hast, könntest du eine Karriere als Schriftsteller oder Texter in Erwägung ziehen. Als introvertierte Person kannst du dein Bedürfnis nach Selbstverwirklichung und persönlichem Wachstum in diesem Berufsfeld erfüllen, da du deinen eigenen Schreibstil entwickeln und dich kreativ ausdrücken kannst. Deine intrinsische Motivation und Leidenschaft für das Schreiben können dir helfen, Bedeutung und Zweck in deiner Arbeit zu finden. Du könntest auch deine Fähigkeiten und Kenntnisse im Schreiben weiterentwickeln und dich auf bestimmte Themen oder Genres spezialisieren, um deine langfristigen Ziele zu erreichen. <br>  <br> 3. Umweltschützer/Naturschützer: <br> Da du eine bevorzugte Arbeitsumgebung hast, die mit der Natur und Umwelt in Verbindung steht, könnte eine Karriere als Umweltschützer oder Naturschützer interessant für dich sein. Hier könntest du deine Interessen und Leidenschaften für den Schutz der Umwelt und Nachhaltigkeit einbringen. Als introvertierte Person könntest du in diesem Berufsfeld Bedeutung und Zweck finden, indem du dich aktiv für den Schutz der Natur einsetzt und dich für eine nachhaltige Zukunft einsetzt. Du könntest auch deine Fähigkeiten und Kenntnisse im Bereich Umweltschutz weiterentwickeln und dich auf spezifische Themen wie Klimawandel oder Artenschutz konzentrieren, um deine langfristigen Ziele zu erreichen. <br>  <br> Diese Top drei Berufe wurden basierend auf deinen persönlichen Stärken, Interessen, Leidenschaften, bevorzugter Arbeitsumgebung und Werten ausgewählt. Sie bieten dir die Möglichkeit, dich selbst zu verwirklichen, persönliches Wachstum zu erreichen und Bedeutung in deiner Arbeit zu finden. Dennoch ist es wichtig, dass du weitere Recherchen durchführst und dich möglicherweise mit Fachleuten in diesen Bereichen austauschst, um eine fundierte Entscheidung zu treffen. <br> <br>', 'Karriere', 'JobInsider', '2023-10-31 08:56:15', '2023-10-31 08:56:15'),
(12, 2, 'xvdfd', '**Beruf: dssfdsfsfs** <br>  <br> **Erforderliche Qualifikationen und Erfahrungen:** <br> - Abgeschlossene Ausbildung/Studium in einem relevanten Fachbereich (z.B. Informatik, Engineering, etc.) <br> - Erfahrung in der Arbeit mit [spezifischer Technologie, Programmiersprache o.ä.] <br> - Kenntnisse in [spezifischem Bereich der Branche] <br> - Gutes Verständnis für [relevante Konzepte, Methoden o.ä.] <br> - Teamfähigkeit und gute Kommunikationsfähigkeiten <br>  <br> **Gehaltsspanne oder Gehaltsaussichten brutto:** <br> - Einstiegsgehalt: X€ <br> - Durchschnittsgehalt: X€ <br> - Gehalt nach 10 Jahren Erfahrung: X€ <br>  <br> **Arbeitsumfeld:** <br> - Der typische Arbeitsplatz ist ein Büro oder ein Labor, je nach Spezialisierung. <br> - Es können flexible Arbeitszeiten und die Möglichkeit zum Homeoffice vorhanden sein. <br> - Arbeitsbedingungen können von hohem Zeitdruck und intensiver Zusammenarbeit mit anderen Fachleuten geprägt sein. <br>  <br> **Aufstiegs- und Entwicklungsmöglichkeiten:** <br> - Weiterbildungsmöglichkeiten in [spezifischem Bereich] oder Projektmanagement <br> - Beförderung zum [höheren Berufstitel] oder Teamleitung <br> - Möglichkeit, sich auf spezifischere Bereiche zu spezialisieren oder in eine Managementposition aufzusteigen <br>  <br> **Arbeitsmarkteinschätzung:** <br> - Die Nachfrage nach Fachkräften in diesem Bereich ist hoch und wird voraussichtlich weiter steigen. <br> - Beschäftigungsaussichten sind gut, da Unternehmen verstärkt auf [spezifische Technologie oder Know-how] angewiesen sind. <br> - Mögliche Herausforderungen können der schnelle technologische Fortschritt und der Wettbewerb um qualifizierte Fachkräfte sein. <br>  <br> **Physische und psychische Anforderungen:** <br> - Physische Anforderungen sind in der Regel gering, es sei denn, der Beruf erfordert körperliche Arbeit oder Reisen. <br> - Mentale Anforderungen können hohe Konzentration, analytisches Denken und Problemlösungsfähigkeiten beinhalten. <br> - Spezifische Risiken oder Belastungen hängen von der Spezialisierung ab, z.B. mögliche Gesundheitsrisiken bei bestimmten Laborarbeiten. <br>  <br> **Persönliche Eigenschaften, Fähigkeiten oder Interessen:** <br> - Analytisches Denken und Problemlösungsfähigkeiten <br> - Teamfähigkeit und gute Kommunikationsfähigkeiten <br> - Interesse an [spezifischem Bereich der Branche] <br> - Flexibilität und die Fähigkeit, sich schnell an neue Technologien oder Entwicklungen anzupassen <br> <br>', 'Karriere', 'JobInsider', '2023-11-13 05:31:29', '2023-11-13 05:31:29'),
(13, 2, 'asdsd', '<div class=\"right_box\">\r\n                                        <span> <img src=\"../asset/images/chatgeni.svg\" width=\"25\" height=\"30\" alt=\"logoContainer\"></span>\r\n                                        <span id=\"first_box\">Um Ihnen bei der Vorbereitung auf die Wissensprüfung zu helfen, benötige ich einige Informationen. Bitte geben Sie mir die folgenden Angaben:<br><br>1. Wann ist die Prüfung?<br>2. Um welches Fach handelt es sich bei der Prüfung?<br>3. Auf welchem Bildungsniveau findet die Prüfung statt?<br><br>Beispielhafte Eingabe: \"Die Prüfung ist am 15. Oktober. Es handelt sich um das Fach Mathematik auf Abiturniveau.\"<br><br>Sobald Sie mir diese Informationen gegeben haben, werde ich Ihre Antworten merken und Ihnen entsprechend angemessene Erklärungen zu Ihren Fragen liefern. Wenn Sie möchten, kann ich auch einen umfangreichen Test für Sie erstellen und Ihnen die Bedienung erklären. Nach jedem Test werde ich die wichtigsten Punkte zusammenfassen und Ihnen Ihre Schwachstellen aufzeigen, wobei ich Lösungen klar und schrittweise erklären werde. Zudem kann ich Ihnen Ihren Lernfortschritt anzeigen, indem ich die HotKeys w, a, s, d, t und x für die Navigation verwende.</span>\r\n\r\n                                    </div>\r\n                                    \r\n                                <div class=\"left_box\">\r\n                    <span>asdfasdfasf</span>\r\n                                        <span><img src=\"../asset/images/chatuser.svg\" width=\"25\" height=\"30\" alt=\"logoContainer\"></span>\r\n\r\n                                    </div><div class=\"right_box\">\r\n                                        <span><img src=\"../asset/images/chatgeni.svg\" width=\"25\" height=\"30\" alt=\"logoContainer\"></span>\r\n                                        <span>I\'m sorry, but I\'m not sure what you\'re asking or stating with \"asdfasdfasf\". Can you please provide more context or clarify your question?</span>\r\n                                    </div><div class=\"left_box\">\r\n                    <span>sadfsfaf</span>\r\n                                        <span><img src=\"../asset/images/chatuser.svg\" width=\"25\" height=\"30\" alt=\"logoContainer\"></span>\r\n\r\n                                    </div><div class=\"right_box\">\r\n                                        <span><img src=\"../asset/images/chatgeni.svg\" width=\"25\" height=\"30\" alt=\"logoContainer\"></span>\r\n                                        <span>I\'m sorry, but I\'m not able to understand what you\'re trying to say. Can you please provide more context or clarify your message?</span>\r\n                                    </div>', 'Bildung', 'genieTutor', '2023-11-13 06:36:25', '2023-11-13 06:36:25'),
(14, 2, 'Saira Hancock', '<div class=\"right_box\">\r\n                                        <span> <img src=\"../asset/images/chatgeni.svg\" width=\"25\" height=\"30\" alt=\"logoContainer\"></span>\r\n                                        <span id=\"first_box\">Natürlich! Als dein persönlicher Karriereberater bin ich hier, um dir zu helfen, deine Ängste und Unsicherheiten bezüglich des Vorstellungsgesprächs oder des Assessment Centers zu identifizieren und dir spezifische Informationen und Ratschläge zu geben, um diese Ängste zu überwinden.<br><br>Lass uns zuerst über deine Ängste und Unsicherheiten sprechen. Was sind die konkreten Dinge, die dich beunruhigen? Hast du Bedenken bezüglich deiner Fähigkeiten oder Erfahrungen? Bist du nervös wegen möglicher Fragen, die gestellt werden könnten? Oder fühlst du dich unsicher in Bezug auf deine Präsentations- oder Kommunikationsfähigkeiten?<br><br>Nachdem wir deine Ängste identifiziert haben, können wir gezielt daran arbeiten, sie zu überwinden. Hier sind einige allgemeine Ratschläge und Informationen, die dir helfen können:<br><br>1. Vorbereitung ist der Schlüssel: Investiere Zeit und Energie in die Vorbereitung auf das Vorstellungsgespräch oder das Assessment Center. Informiere dich über das Unternehmen, seine Mission und Werte, sowie über die Stellenanforderungen. Bereite Antworten auf häufig gestellte Fragen vor und übe mögliche Szenarien oder Aufgaben, die während des Assessment Centers auftreten könnten.<br><br>2. Stärken und Erfolge betonen: Identifiziere deine Stärken und Erfolge aus deiner bisherigen beruflichen Laufbahn und finde Möglichkeiten, diese während des Vorstellungsgesprächs oder des Assessment Centers zu betonen. Sei selbstbewusst und überzeuge den potenziellen Arbeitgeber davon, dass du die richtige Person für die Stelle bist.<br><br>3. Kommunikation und Körpersprache: Achte auf deine Kommunikation und Körpersprache während des Vorstellungsgesprächs oder des Assessment Centers. Sei klar und prägnant in deinen Antworten, aber vermeide es, zu überladen oder arrogant zu wirken. Zeige Interesse und stelle auch selbst Fragen, um dein Engagement zu demonstrieren. Achte auf eine aufrechte Haltung, angemessenen Augenkontakt und ein freundliches Lächeln.<br><br>4. Mentale Vorbereitung: Visualisiere dich selbst erfolgreich im Vorstellungsgespräch oder Assessment Center. Stelle dir vor, wie du selbstbewusst und kompetent auftrittst und positive Rückmeldungen erhältst. Positive Selbstgespräche und Entspannungstechniken wie tiefe Atmung oder Meditation können ebenfalls helfen, Nervosität zu reduzieren.<br><br>5. Feedback einholen: Bitte vertrauenswürdige Freunde, Familienmitglieder oder Mentoren um Feedback zu deinen Fähigkeiten und deinem Auftreten. Sie können dir hilfreiche Ratschläge geben und dir mögliche Verbesserungsbereiche aufzeigen.<br><br>Das sind nur einige allgemeine Ratschläge, die dir helfen können, Selbstvertrauen für das Vorstellungsgespräch oder das Assessment Center aufzubauen. Jetzt ist es an der Zeit, dass du mir sagst, ob es noch etwas gibt, was dich beunruhigt oder ob du weitere spezifische Fragen hast.</span>\r\n                                    </div>\r\n                                    \r\n                                <div class=\"left_box\">\r\n                    <span>Wie kann man das GPA-Niveau erhöhen?</span>\r\n                                        <span><img src=\"../asset/images/chatuser.svg\" width=\"25\" height=\"30\" alt=\"logoContainer\"></span>\r\n\r\n                                    </div><div class=\"right_box\">\r\n                                        <span><img src=\"../asset/images/chatgeni.svg\" width=\"25\" height=\"30\" alt=\"logoContainer\"></span>\r\n                                        <span>Es gibt verschiedene Möglichkeiten, das GPA-Niveau zu erhöhen:\r\n\r\n1. Prioritäten setzen: Setzen Sie klare Ziele und Prioritäten, um sich auf die wichtigsten Kurse und Aufgaben zu konzentrieren. Investieren Sie mehr Zeit und Energie in diese Bereiche, um bessere Noten zu erzielen.\r\n\r\n2. Effektive Zeitplanung: Erstellen Sie einen realistischen Zeitplan, der es Ihnen ermöglicht, genügend Zeit für das Studium und die Vorbereitung auf Prüfungen zu haben. Vermeiden Sie Prokrastination und nutzen Sie Ihre Zeit effizient.\r\n\r\n3. Aktive Teilnahme am Unterricht: Nehmen Sie aktiv am Unterricht teil, stellen Sie Fragen und nehmen Sie an Diskussionen teil. Dies hilft Ihnen, das Material besser zu verstehen und sich besser auf Prüfungen vorzubereiten.\r\n\r\n4. Effektive Lernstrategien: Finden Sie heraus, welche Lernstrategien für Sie am besten funktionieren und setzen Sie diese ein. Dies kann das Erstellen von Zusammenfassungen, das Lernen in kleinen Gruppen oder das Wiederholen des Materials durch Übungen beinhalten.\r\n\r\n5. Verbesserte Organisation: Organisieren Sie Ihre Notizen, Unterlagen und Aufgaben, um den Überblick zu behalten und effizienter zu lernen. Verwenden Sie Tools wie Kalender, To-Do-Listen oder digitale Organisations-Apps, um Ihre Aufgaben zu verwalten.\r\n\r\n6. Enger Kontakt zu Lehrern und Tutoren: Suchen Sie bei Schwierigkeiten oder Fragen den Kontakt zu Ihren Lehrern oder Tutoren. Sie können Ihnen zusätzliche Erklärungen oder Ressourcen geben, um Ihr Verständnis zu verbessern.\r\n\r\n7. Nutzen Sie zusätzliche Ressourcen: Nutzen Sie zusätzliche Ressourcen wie Nachhilfe, Lerngruppen oder Online-Kurse, um Ihr Wissen zu erweitern und zu vertiefen.\r\n\r\n8. Verbesserte Prüfungsvorbereitung: Bereiten Sie sich gründlich auf Prüfungen vor, indem Sie alte Prüfungen üben, Lerngruppen bilden oder mit Kommilitonen das Material wiederholen.\r\n\r\n9. Gesunde Lebensweise: Sorgen Sie für eine ausgewogene Ernährung, ausreichend Schlaf und regelmäßige Bewegung. Eine gesunde Lebensweise kann sich positiv auf Ihre kognitive Leistungsfähigkeit auswirken.\r\n\r\n10. Motivation und Durchhaltevermögen: Bleiben Sie motiviert und behalten Sie Ihr Ziel im Auge. Setzen Sie sich kleine Etappenziele und belohnen Sie sich selbst für erreichte Erfolge. Seien Sie geduldig und geben Sie nicht auf, auch wenn es schwierig wird.</span>\r\n                                    </div>', 'Karriere', 'GeniusInterview', '2023-11-13 08:41:04', '2023-11-13 08:41:04'),
(15, 2, 'asdfasdf adf as', 'Leider kann ich dir bei dieser Aufgabe nicht helfen, da ich als KI-Textmodell keine Texte korrigieren oder individuelles Feedback geben kann. Ich kann jedoch versuchen, dir einige allgemeine Tipps zur Verbesserung deines Schreibens zu geben: <br>  <br> 1. Grammatik: Achte auf die korrekte Verwendung von Zeiten, Subjekt-Verb-Kongruenz und Pronomen. Lies dir den Text nach dem Schreiben noch einmal gründlich durch und überprüfe, ob alle Sätze grammatisch korrekt sind. <br>  <br> 2. Rechtschreibung: Verwende eine Rechtschreibprüfung, um Tippfehler zu vermeiden. Lies den Text auch hier noch einmal sorgfältig durch, um sicherzustellen, dass alle Wörter korrekt geschrieben sind. <br>  <br> 3. Ausdruck: Verwende klare und präzise Ausdrücke. Achte darauf, dass deine Sätze gut strukturiert sind und einen logischen Zusammenhang haben. Vermeide unnötige Wiederholungen und verwende eine abwechslungsreiche Sprache. <br>  <br> 4. Struktur: Achte auf eine klare Gliederung deines Textes. Verwende Absätze, um verschiedene Themen oder Argumente voneinander abzugrenzen. Stelle sicher, dass dein Text eine Einleitung, einen Hauptteil und einen Schluss hat. <br>  <br> 5. Kommasetzung: Achte auf die korrekte Verwendung von Kommas. Setze Kommas, um Satzteile voneinander abzugrenzen oder um Aufzählungen zu kennzeichnen. Vermeide jedoch übermäßigen Gebrauch von Kommas, da dies den Lesefluss beeinträchtigen kann. <br>  <br> Um deine Schreibfähigkeiten weiter zu verbessern, empfehle ich dir, regelmäßig zu lesen und zu schreiben. Indem du dir Beispiele von gut geschriebenen Texten ansiehst und selbst schreibst, kannst du dein Sprachgefühl schärfen und deine Fehler reduzieren. <br>  <br> Wenn du spezifische Fragen zu Grammatik, Rechtschreibung oder Ausdruck hast, stehe ich dir gerne zur Verfügung. <br> <br>', 'Bildung', NULL, '2023-11-13 08:57:42', '2023-11-13 08:57:42'),
(16, 2, 'adfasfasf', 'Themenvorschläge: <br>  <br> 1. Die Bedeutung von Geschlechtergerechtigkeit in der Arbeitswelt: Wie kann man in verschiedenen Berufsfeldern eine geschlechtergerechte Sprache verwenden, um Diskriminierung zu vermeiden und ein inklusives Arbeitsumfeld zu schaffen? <br>  <br> 2. Feminismus und Medien: Eine Analyse der Darstellung von Frauen und Männern in Film, Fernsehen und Werbung. Wie kann man durch geschlechtergerechte Sprache und eine breitere Vielfalt an Rollenbildern Stereotypen aufbrechen und eine positivere Darstellung von Frauen in den Medien fördern? <br>  <br> 3. Gender und Sprache in der Politik: Wie beeinflusst die Verwendung von geschlechtergerechter Sprache die politische Kommunikation und den politischen Diskurs? Welche Auswirkungen hat eine inklusivere Sprache auf die Wahrnehmung von Politiker*innen und politischen Entscheidungen? <br> <br>', 'Bildung', NULL, '2023-11-13 08:58:09', '2023-11-13 08:58:09'),
(17, 2, 'naveebrain', '1. Die Bedeutung von gendergerechter Sprache in der heutigen Gesellschaft: In diesem Thema könntest du erklären, warum gendergerechte Sprache wichtig ist und wie sie dazu beitragen kann, eine inklusivere und gerechtere Gesellschaft zu schaffen. Du könntest auch darauf eingehen, wie verschiedene Sprachen mit diesem Thema umgehen und welche Herausforderungen es bei der Implementierung gendergerechter Sprache gibt. <br>  <br> 2. Genderstereotype in der Medienbranche: Hier könntest du erforschen, wie Geschlechterstereotype in der Medienbranche präsent sind und welche Auswirkungen sie haben. Du könntest Beispiele aus Film, Fernsehen und Werbung verwenden, um zu zeigen, wie bestimmte Geschlechterrollen und -bilder verstärkt oder aufgebrochen werden. Außerdem könntest du darauf eingehen, wie gendergerechte Sprache in der Medienberichterstattung und -darstellung verwendet werden kann, um Stereotype zu bekämpfen. <br>  <br> 3. Feminismus in der Literatur: In diesem Thema könntest du die Rolle des Feminismus in der Literatur untersuchen und wie Autor*innen ihr persönliches Interesse an feminismus in ihre Werke einfließen lassen. Du könntest verschiedene literarische Werke analysieren und zeigen, wie feministische Ideen und gendergerechte Sprache in der Literatur verwendet werden, um soziale Normen und Stereotype zu hinterfragen. <br> <br>', 'Bildung', 'TextInspiration', '2023-11-16 08:50:08', '2023-11-16 08:50:08');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_10_23_131908_create_subscriptions_table', 1),
(6, '2023_10_23_132442_create_archives_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mtype` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subscription_name` text COLLATE utf8mb4_unicode_ci DEFAULT 'silber',
  `expire_date` date DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `subscription_name`, `expire_date`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$4UGE9muYfQg3mIXPk.GD/.WzV08U78zsdN.hGKUoCoNJzvBNiv3pm', 'silber', NULL, NULL, '2023-10-23 08:53:45', '2023-10-23 08:53:45'),
(2, 'Naveed', 'naveed@gmail.com', NULL, '$2y$10$9tBck4CvUYidg2iQQwt93.2mxO04VhHuR3WjQRiG4yv5tzx1hJXNa', 'gold', '2023-11-30', NULL, '2023-10-24 02:40:30', '2023-11-14 05:52:44'),
(3, 'Muhammad Farooq', 'mfarooq012012@gmail.com', NULL, '$2y$10$8yTqbA1p6B9dX3yPSWWoK.1NZyEn3g0GMbFP8apNejd7W5r6tHH2e', 'silber', NULL, NULL, '2023-11-01 01:43:37', '2023-11-01 01:44:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archives`
--
ALTER TABLE `archives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archives`
--
ALTER TABLE `archives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
