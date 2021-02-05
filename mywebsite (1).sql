-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2021 at 12:46 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mywebsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `images_upload`
--

CREATE TABLE `images_upload` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `size` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images_upload`
--

INSERT INTO `images_upload` (`id`, `user_id`, `name`, `size`) VALUES
(17, 79, '2017 Mercedes Benz Concept A Sedan5967014032.jpg', '1.255756'),
(18, 79, 'golf.JPG', '0.125952'),
(19, 79, 'rdr2 3.jpg', '0.350139'),
(118, 80, 'f38dff67z66f.jpg', '4.792269'),
(119, 80, 'Mulder_Smoking_Man.jpg', '0.678303'),
(121, 80, '2017 Mercedes Benz Concept A Sedan5967014032.jpg', '1.255756'),
(122, 226, '2017 Mercedes Benz Concept A Sedan5967014032.jpg', '1.255756'),
(123, 226, '100_best_nature_full_hd_wallpapers_1920x1080p-51-jpg_wallpaper_1080p_59.jpg', '1.345152'),
(125, 226, 'Mulder_Smoking_Man.jpg', '0.678303'),
(126, 226, '6848424-nature-wallpaper.jpg', '0.469755'),
(128, 226, 'alpha_stmoritz_mountain.jpg', '1.370617'),
(130, 226, 'Legion desktop.jpg', '0.792991'),
(131, 226, 'golf.JPG', '0.125952'),
(132, 2, '601px-Contract-to-Kill-RC-FAMAS.jpg', '0.050628');

-- --------------------------------------------------------

--
-- Table structure for table `mesaje`
--

CREATE TABLE `mesaje` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `titlu` text NOT NULL,
  `mesaj` text NOT NULL,
  `data` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mesaje`
--

INSERT INTO `mesaje` (`id`, `id_user`, `titlu`, `mesaj`, `data`) VALUES
(218, 80, 'Just a quote', 'Today quote', '2020-12-18 13:13:51'),
(221, 80, 'Rock\'n\'Roll', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/f8Vfin7mqdw\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2020-12-18 13:16:10'),
(396, 80, ' Nu vezi şi te-ncrezi', 'Nu vezi şi te-ncrezi,\r\nCe văd eu tu greu vezi, nu\r\nCă nu-i ce crezi când vezi să nu\r\nStai în rânduri nemiscate\r\nDe oameni obsedati de branduri frate\r\nEsti sedat să ai sentimente-n toate\r\nCă cei ce-ti plănuiesc nimicirea\r\nNu-şi doreste decât nemurirea.\r\nDar no să aiba parte frate\r\nDecât de iluzia trăirii deşarte.\r\nAscultă ce-ţi zic bro,\r\nCăci nu te iau la mişto,\r\nTot ce pot sa-ţi zic e să ai demnitate\r\nŞi să nu te-ncrezi nici-într-un frate\r\nCăci toţi te sapă, toţi te-alungă\r\nDemonii ăstia ce le cântă în strună.\r\nTrag de fiare, ca nişte fiare\r\nLe cresc ghiare,\r\nCa la o bestie , Infiorătoare.\r\nMulţi sunt controlaţi,ei nu ştiu\r\nLi s-a pus pe creier câte un djin\r\nCe-i controleaza de unde vin\r\nCe să faca, ce sa duca, pe cine să distruga\r\nTrăiesc în iluzia zilei de mâine\r\nMai mult pe amfetamine sau în prostime.\r\nScufundă-te-n mediocritate frate\r\nŞi stai ascuns cât se mai poate.\r\nAsta am scris-o pt. tine Maestre\' sa nu zici ca-i plagiata, pace.', '2020-12-23 00:12:29'),
(397, 80, ' 37 de paşi care te călăuzesc spre Iluminare', ' 37 de paşi care te călăuzesc spre Iluminare\r\n\"A fi fericit nu este mâna destinului, este mai degrabă consecinţa opţiunilor tale de a te comporta cu cei din jur.\"\r\nDalai Lama\r\n\r\n1\r\nFiind de acum pe această corabie rară a libertătii şi şansei,\r\nAscultă, gândeste şi meditează fără ezitare zi şi noapte\r\nPentru a te elibera pe tine şi pe ceilalţi\r\nDin oceanul existenţei ciclice\r\n-Aceasta este practica Bodhisattva\r\n\r\n2\r\nAtaşat de cei pe care-i iubeşti, eşti tulburat ca o apă.\r\nUrându-ţi duşmanii, arzi ca o flacără.\r\nÎn întunericul confuziei uiţi ce să alegi şi ce să indepărtezi.\r\nRenunţă la patria ta.\r\n-Aceasta este practica Bodhisattva\r\n\r\n3\r\nEvitând preocupările rele, emoţiile perturbatoare vor scădea treptat.\r\nÎn lipsa tulburărilor, îndeletnicirile virtuoase vor spori în mod natural.\r\nCu mintea limpede, credinţa în învăţături creşte.\r\nCultivaţi izolarea.\r\n-Aceasta este practica Bodhisattva\r\n\r\n4\r\nCei dragi care ne-au ţinut companie vor muri.\r\nAvuţia obţinută cu atâta greutate va fi lăsată în urmă.\r\nConştiinţa oaspete va părăsi casa-gazdă a corpului.\r\nRenunţă la această viaţă\r\n-Aceasta este practica Bodhisattva\r\n\r\n5\r\nCând rămâneţi în compania lor, cele trei otrăvuri sporesc,\r\nAcţiunile voastre de a asculta, a gândi şi a medita descresc.\r\nIar ei vă vor face să vă pierdeţi dragostea şi compasiunea.\r\nRenunţaţi la prietenii răi\r\n-Aceasta este practica Bodhisattva\r\n\r\n6\r\nCând vă bazaţi pe ei, greşelile voastre se sfarşesc,\r\nIar calităţile voastre bune cresc precum luna de pe cer.\r\nPreţuiţi-va maeştrii spirituali\r\nMai mult chiar decât propriul corp\r\n-Aceasta este practica Bodhisattva\r\n\r\n7\r\nPrins el însuşi într-o temniţă a existenţei ciclice,\r\nCe zeu lumesc vă poate oferi ocrotire?\r\nAşadar, când vrei ocrotire, caut-o în\r\nCele Trei Nestemate, care nu te vor trăda\r\n-Aceasta este practica Bodhisattva\r\n\r\n8\r\nBiruitorul a spus că toată suferinţa greu de îndurat\r\nA renaşterilor rele este rodul fărădelegilor.\r\nPrin urmare, chiar cu preţul vieţii,\r\nSă nu faceţi niciodata rău\r\n-Aceasta este practica Bodhisattva\r\n\r\n9\r\nCa roua de pe vârful unui fir de iarbă, plăcerile celor trei lumi\r\nDureaza puţin şi apoi dispar.\r\nAspiră la starea care nu se schimbă niciodată,\r\nStarea supremă a eliberării\r\n-Aceasta este practica Bodhisattva\r\n\r\n10\r\nCând mamele voastre care v-au iubit din vremuri fără de-nceput\r\nSunt în suferinţă, ce folos mai are propria voastră fericire?\r\nDe aceea, pentru a elibera nenumăratele fiinţe vii,\r\nÎmbogăţiţi intenţia altruistă\r\n-Aceasta este practica Bodhisattva\r\n\r\n11\r\nToată suferinţa vine din dorinţa pentru propria fericire.\r\nIluminarea perfectă se naşte din gândul de a-i ajuta pe alţii.\r\nDe aceea dă la schimb propria fericire\r\nPe suferinţa altora\r\n-Aceasta este practica Bodhisattva\r\n\r\n12\r\nChiar dacă cineva, dintr-o puternică dorinţă,\r\nVă fură tot avutul sau îi pune pe alţii să vi-l fure,\r\nOferiţi-i lui corpul, averile\r\nŞi puritatea voastră, trecute, prezente şi viitoare\r\n-Aceasta este practica Bodhisattva\r\n\r\n13\r\nChiar dacă cineva încearcă să-ţi taie capul\r\nCând n-ai făcut nici cel mai mic rău,\r\nDin compasiune, preia şi toate greşelile lui\r\nAsupra ta\r\n-Aceasta este practica Bodhisattva\r\n\r\n14\r\nChiar dacă cineva împrăştie tot felul de bârfe jenante\r\nDespre tine în toate cele trei mii de lumi,\r\nÎn schimb, cu o minte iubitoare,\r\nTu vorbeşte despre calităţile sale\r\n-Aceasta este practica Bodhisattva\r\n\r\n15\r\nChiar dacă cineva te batjocoreşte şi spune vorbe grele\r\nDespre tine în adunările publice,\r\nPriveşte-l ca pe un maestru spiritual,\r\nApleacă-te cu respect în faţa lui\r\n-Aceasta este practica Bodhisattva\r\n\r\n16\r\nChiar dacă o persoană de care ai avut grijă\r\nCa de propriul tău copil te priveşte ca pe un duşman,\r\nIngrijeşte-l cu bunăvoinţă, ca o mamă\r\nAl cărei copil este lovit de o boală\r\n-Aceasta este practica Bodhisattva\r\n\r\n17\r\nDacă o persoană egală sau inferioară\r\nVă preţuieşte greşit, călcându-vă mândria în picioare,\r\nAşezaţi-l, aşa cum aţi face-o cu maestrul vostru spiritual,\r\nCu respect pe coroana de pe capul vostru\r\n-Aceasta este practica Bodhisattva\r\n\r\n18\r\nChiar dacă aveţi lipsuri şi sunteţi mereu umiliţi,\r\nChinuiţi de boli grave şi de spirite,\r\nFără să vă descurajaţi, luaţi asupra voastră fărădelegile\r\nŞi suferinţele tuturor fiinţelor vii\r\n-Aceasta este practica Bodhisattva\r\n\r\n19\r\nChiar dacă eşti faimos şi mulţi se înclină în faţa ta\r\nŞi ai câştigat averi ajungându-l pe Vishravana,\r\nPriveşte norocul lumesc ca fiind fără substanţă\r\nŞi fii modest\r\n-Aceasta este practica Bodhisattva\r\n\r\n20\r\nCât timp duşmanul propriei tale mânii este de neînfrânt,\r\nChiar dacă învingi inamicii din preajmă, ei doar se vor înmulţi.\r\nDe aceea, cu ajutorul oştirii de dragoste şi compasiune,\r\nSupune-ţi propria minte\r\n-Aceasta este practica Bodhisattva\r\n\r\n21\r\nPlăcerile simţurilor sunt ca apa sărată:\r\nCu cât înghiţi mai multă, cu atât ţi se face mai sete.\r\nRenunţaţi imediat la acele lucruri care dau naştere\r\nAtaşamentului puternic\r\n-Aceasta este practica Bodhisattva\r\n\r\n22\r\nOrice apare este propria voastră minte.\r\nLa început, mintea voastră era liberă de limite născocite.\r\nPricepând acest lucru, nu daţi atenţie\r\nSemnelor [proprii] ale subiectului şi obiectului\r\n-Aceasta este practica Bodhisattva\r\n\r\n23\r\nCând întâlniţi obiecte atrăgătoare,\r\nChiar dacă par frumoase\r\nCa un curcubeu vara, nu le priviţi ca pe ceva real\r\nŞi nu vă ataşaţi de ele\r\n-Aceasta este practica Bodhisattva\r\n\r\n24\r\nToate formele de suferinţă sunt ca moartea unui copil într-un vis.\r\nA lua aparenţa iluzorie drept adevărată duce la istovire.\r\nPrin urmare, când vă întâlniţi cu împrejurări neplăcute,\r\nPriviţi-le ca fiind închipuiri\r\n-Aceasta este practica Bodhisattva\r\n\r\n25\r\nCând cei ce vor iluminarea trebuie să-şi dea chiar şi trupul,\r\nNu mai e nevoie să pomenim de lucrurile ce ne înconjoară.\r\nPrin urmare, fără speranţa vreunui beneficiu sau al vreunui câştig,\r\nDăruiţi-l cu generozitate\r\n-Aceasta este practica Bodhisattva\r\n\r\n26\r\nFără morală nu-ţi poţi desăvârşi propria bunăstare,\r\nAşa că a vrea s-o desăvârşeşti pe a altora e ceva de râs.\r\nPrin urmare, fără a avea aspiraţii lumeşti,\r\nProtejează-ţi disciplina morală\r\n-Aceasta este practica Bodhisattva\r\n\r\n27\r\nPentru acei Bodhisattva care doresc bogăţia virtuţii\r\nCei care rănesc sunt o comoară preţioasă.\r\nPrin urmare, daţi dovada de răbdare faţă de toţi,\r\nFără ostilitate\r\n-Aceasta este practica Bodhisattva\r\n\r\n28\r\nVăzându-i chiar şi pe Ascultătorii şi Înfăptuitorii solitari care îşi desăvârşesc\r\nDoar propriul lor bine, străduindu-se de parcă ar trebui să-şi stingă un foc de pe cap,\r\nDe dragul tuturor fiinţelor vii, faceţi efortul entuziast,\r\nSursa tuturor calităţilor\r\n-Aceasta este practica Bodhisattva\r\n\r\n29\r\nÎnţelegând că emoţiile perturbatoare sunt distruse\r\nDe o cunoaştere aparte, cu calm perseverent,\r\nCultivaţi concentrarea care depăşeşte\r\nCele patru absorbţii fără formă\r\n-Aceasta este practica Bodhisattva\r\n\r\n30\r\nÎntrucât cele cinci perfecţiuni fără înţelepciune\r\nNu pot aduce iluminarea,\r\nÎmpreună cu mijloacele iscusite, cultivaţi înţelepciunea\r\nCare nu concepe cele trei sfere (ca fiind reale)\r\n-Aceasta este practica Bodhisattva\r\n\r\n31\r\nDacă nu îţi cercetezi propriile greşeli,\r\nPoţi arăta ca un practicant, dar nu poţi acţiona ca unul,\r\nPrin urmare cercetează-ţi întotdeauna propriile greşeli,\r\nDespovărează-te de ele\r\n-Aceasta este practica Bodhisattva\r\n\r\n32\r\nDacă prin influenţa emoţiilor perturbatoare\r\nArăţi spre greşelile altui Bodhisattva,\r\nTu însuţi eşti micşorat, aşa că nu mai vorbi despre greşelile\r\nCelor care au intrat în Marele vehicul\r\n-Aceasta este practica Bodhisattva\r\n\r\n33\r\nRecompensa şi respectul ne dau motive de ceartă\r\nŞi produc declinul ascultării, gândirii şi al meditaţiei.\r\nDin acest motiv renunţă la ataşamentul faţă de\r\nFamiliile prietenilor, cunoştinţe şi binefăcători\r\n-Aceasta este practica Bodhisattva\r\n\r\n34\r\nCuvintele aspre perturbă minţile celorlalţi\r\nŞi pricinuiesc o deteriorare în conduita unui Bodhisattva.\r\nDe aceea renunţaţi la cuvintele aspre\r\nCare sunt neplăcute celorlalţi\r\n-Aceasta este practica Bodhisattva\r\n\r\n35\r\nEmoţiile perturbatoare obişnuite sunt greu de oprit prin contra-acţiuni.\r\nÎnarmaţi cu antidoturi, gardienii atenţiei şi vigilenţei mentale\r\nDistrug emoţiile perturbatoare, precum ataşamentul,\r\nDintr-odată, imediat ce ele apar\r\n-Aceasta este practica Bodhisattva\r\n\r\n36\r\nÎn concluzie, indiferent ce faci,\r\nÎntreabă-te:\"Care este starea minţii mele?\"\r\nCu atenţie constantă şi vigilenţă mentală\r\nDesăvârşeşte binele altora\r\n-Aceasta este practica Bodhisattva\r\n\r\n37\r\nPentru a înlătura suferinţa nenumăratelor fiinţe vii,\r\nÎnţelegând puritatea celor trei sfere,\r\nDedică-ţi iluminării\r\nMeritele astfel dobândite\r\n-Aceasta este practica Bodhisattva\r\n ***\r\n             Pentru toţi cei care doresc să se instruiască pe calea Bodhisattva,\r\n             Am scris Iluminarea. 37 de trepte,\r\n             Ca urmare a celor spuse de cei evlavioşi \r\n             Despre înţelesul sutrelor, tantrelor şi tratatelor.\r\n             Deşi nu sunt poetic plăcute discipolilor\r\n             Din pricina bietei mele inteligenţe şi a lipsei de cunoştinţe,\r\n             M-am bazat pe sutre si pe vorbele celor evlavioşi,\r\n             De aceea cred că aceste practici Bodhisattva sunt fără greşeală.\r\n             Totuşi, deoarece marile fapte ale unui Bodhisattva \r\n             Sunt greu de pătruns pentru mintea mea slabă,\r\n             Îi rog pe cei desăvârşiţi să-mi ierte toate greşelile,\r\n             Cum ar fi contradicţiile şi argumentele non sequitur.\r\n             Prin virtutea acestui lucru toate fiinţele vii ar putea \r\n             Câştiga intenţia altruistă convenţională sau finală\r\n             Şi astfel să devină ca un Protector Chenrezig\r\n             Care nu locuieşte în  nicio extremă - nici în lume, nici în odihnă.\r\n             Acesta a fost scris pentru beneficiul propriu şi al altora de Togmay călugărul, un exponent al scripturii şi înţelepciunii, în peştera din Ngülchu Rinchen.\r\n\r\n Învăţăturile lui Geshe Sonam Rinchen (sec. XIV-lea) aşternute pe hârtie de Geylsay Togmai Sangpo.\r\n', '2020-12-23 00:14:07'),
(402, 80, 'Acesta este titlul la test', 'Acesta este continutul textului', '2020-12-23 01:46:48'),
(412, 80, 'Shaolin Kung-Fu Documentary', ' Secrets of the Warrior\'s Power - Discovery Channel Kung Fu\r\nPart1\r\n<iframe width=\"420\" height=\"315\" src=\"https://www.youtube.com/embed/0xWnHxbt0Qw\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>\r\n\r\nPart2\r\n<iframe width=\"420\" height=\"315\" src=\"https://www.youtube.com/embed/tUTal_I0f0o\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2020-12-23 13:36:34'),
(414, 80, 'Mircea Eliade și redescoperirea sacrului (1987) ', '<iframe width=\"686\" height=\"549\" src=\"https://www.youtube.com/embed/maGAYlSeLzA\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2020-12-23 13:40:13'),
(415, 80, 'Mircea Eliade și redescoperirea sacrului (1987) ', 'Part 2\r\n<iframe width=\"686\" height=\"549\" src=\"https://www.youtube.com/embed/dEh2sYPl8z4\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2020-12-23 13:41:29'),
(416, 80, 'Mircea Eliade și redescoperirea sacrului (1987) part 3', '<iframe width=\"686\" height=\"549\" src=\"https://www.youtube.com/embed/lLhJK1sxlj4\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2020-12-23 13:42:08'),
(418, 79, 'Mircea Eliade și redescoperirea sacrului (1987)  part4', 'Part 4\r\n<iframe width=\"686\" height=\"549\" src=\"https://www.youtube.com/embed/emK17UbEmJk\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2020-12-23 13:45:19'),
(421, 0, '', '', '2020-12-31 02:10:29'),
(422, 0, '', '', '2020-12-31 02:10:55'),
(423, 0, '', '', '2020-12-31 02:11:00'),
(424, 226, 'test', 'test', '2021-01-23 08:25:13'),
(425, 226, 'test2', 'test2', '2021-01-23 08:25:45'),
(427, 226, 'fsdfsd', 'sdfsdgfdgdf', '2021-01-23 08:25:56'),
(428, 226, 'fsdfsd', 'gfdgdf', '2021-01-23 08:26:01'),
(429, 226, 'gfdgdf', 'sfsdgfdh', '2021-01-23 08:26:06'),
(433, 226, 'Test titlu', 'Test continut', '2021-01-30 14:22:11'),
(434, 2, 'ddsa', 'saddsadsa', '2021-01-31 15:52:55');

-- --------------------------------------------------------

--
-- Table structure for table `useri`
--

CREATE TABLE `useri` (
  `id` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `prenume` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `useri`
--

INSERT INTO `useri` (`id`, `userName`, `password`, `name`, `prenume`) VALUES
(79, 'doubller', '21b72c0b7adc5c7b4a50ffcb90d92dd6', 'Doubller', 'IronTwist'),
(80, 'razvan', 'cc03e747a6afbbcbf8be7668acfebee5', 'Fratean', 'Razvan'),
(226, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin surname');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images_upload`
--
ALTER TABLE `images_upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mesaje`
--
ALTER TABLE `mesaje`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `useri`
--
ALTER TABLE `useri`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images_upload`
--
ALTER TABLE `images_upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `mesaje`
--
ALTER TABLE `mesaje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=435;

--
-- AUTO_INCREMENT for table `useri`
--
ALTER TABLE `useri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
