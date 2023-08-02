-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 02, 2023 at 02:16 AM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myfirstblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `Category`
--

CREATE TABLE `Category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Category`
--

INSERT INTO `Category` (`id`, `name`) VALUES
(1, 'Développement Web'),
(2, 'Astuces Tech'),
(3, 'Sécurité Informatique');

-- --------------------------------------------------------

--
-- Table structure for table `Comment`
--

CREATE TABLE `Comment` (
  `id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `person_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `validate` tinyint(1) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `validate_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Comment`
--

INSERT INTO `Comment` (`id`, `comment`, `person_id`, `post_id`, `validate`, `create_date`, `validate_date`) VALUES
(30, 'Merci pour ce bon article!', 28, 19, 1, '2023-08-02 04:04:46', '2023-08-02 04:07:41'),
(31, 'C\'est intéressant!!', 29, 18, 1, '2023-08-02 04:07:11', '2023-08-02 04:07:45'),
(32, 'C\'est mon plaisir de partager <3', 27, 19, 1, '2023-08-02 04:08:52', '2023-08-02 04:08:52');

-- --------------------------------------------------------

--
-- Table structure for table `Person`
--

CREATE TABLE `Person` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Person`
--

INSERT INTO `Person` (`id`, `name`, `email`, `password`, `image`, `role_id`) VALUES
(27, 'Zita', 'zita@test.fr', '$2y$10$xL6NR9Xr8THggaXha04RPuhLqq8Ai8dMTcwrkKWmg7ySMsoeYWgWK', 'zita.jpg', 1),
(28, 'Maya', 'maya@test.fr', '$2y$10$N56702SJH4uTEo40Vm6cmuqetOEoHEFhhlFacryQwluhkk9kWSAza', '64c9b98a59424_girl.png', 2),
(29, 'Mika', 'mika@test.fr', '$2y$10$v5BdkbQSTNEj0RlfR5i.ueHtIsW7xLG72TxVhEZ/8R.UCfb1A7Xf2', '64c9ba23d6964_profile.png', 2),
(31, 'Nam', 'nam@test.fr', '$2y$10$i5xifKTOi18/MVWWxGhSVOY2zt0IXGWuWpxgDf/olklNANXFNXj.q', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `Post`
--

CREATE TABLE `Post` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `excerpt` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `person_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Post`
--

INSERT INTO `Post` (`id`, `title`, `excerpt`, `content`, `person_id`, `category_id`, `image`, `create_date`, `modify_date`) VALUES
(16, 'Qu\'est-ce que le framework Symfony?', 'Un framework PHP \"open source\" qui permet de créer des applications web \"haut de gamme\" et évolutives', 'Qu\'est-ce que Symfony ?\r\nSymfony est un framework PHP \"open source\", un ensemble d\'outils structurés, réutilisables et maintenables, qui permet de créer des applications web \"haut de gamme\" et évolutives. Symfony n\'est pas seulement un outil ; c\'est une boîte à outils complète remplie de tout ce dont vous avez besoin pour faire de votre création d\'application et de sites web un jeu d\'enfant.\r\n\r\nL\'histoire et l\'évolution de Symfony\r\nChaque superhéros a une histoire, et Symfony ne fait pas exception. Fruit du travail de Fabien Potencier, Symfony est né en 2005 dans le cadre du projet SensioLabs, une agence web française. Le \"premier cri\" a été entendu en 2007 lorsque Symfony 1.0 a été présenté au monde. Depuis, comme un bon vin, Symfony n\'a fait que s\'améliorer avec l\'âge.\r\n\r\nSymfony2 est apparu en 2011, introduisant une toute nouvelle façon de développer des applications web en utilisant des composants réutilisables. C\'est comme si l\'on passait de la préparation de marshmallow grillé sur un feu de camp à un barbecue équipé. Soudain, tout est à portée de main, facile à utiliser et facile à mettre à jour (En fait Symfony 1 et Symfony 2 sont très différents, les versions récentes de Symfony ont encore des bases qui ont été posées à Symfony2, Symfony2 est l\'époque ou votre serviteur s\'y est m\'y d\'ailleurs).\r\n\r\nEnsuite, Symfony 3 est arrivé en 2015, amenant l\'efficacité à un autre niveau, un peu comme si vous échangiez votre voiture manuelle contre une automatique. Symfony 4 est arrivé en 2017, Symfony 5 en 2019, suivi de Symfony 6 en 2021.\r\n\r\nChaque version offrant des processus plus rationalisés, des interfaces conviviales et un plus grand nombre de possibilités d\'application. C\'est comme si quelqu\'un avait pris un \"bon framework\" et avait continué à appuyer sur le bouton \"mise à niveau\" jusqu\'à ce qu\'il devienne \"génial\".\r\n\r\nLes principaux composants de Symfony\r\nJetons maintenant un coup d\'œil dans la boîte à outils de ce superhéros. Symfony est principalement composé de trois parties principales : les \"Bundles\", les \"Components\" et les \"Bridges\" :\r\n\r\n\"Bundles\" : Les bundles sont des bouts de code prêts à être réutilisés pour différents projets. Ils sont similaires aux \"plugins\" dans d\'autres écosystèmes. Vous avez besoin d\'ajouter l\'authentification de l\'utilisateur ? Il existe un \"bundle\" pour ça. Vous voulez gérer facilement votre contenu ? Oui, il y a un un \"bundle\" pour ça aussi.\r\n\r\n\"Components\" : Les \"components\" (ou composants en français) sont comme les Lego de Symfony. Ce sont des bibliothèques PHP autonomes et réutilisables que vous pouvez utiliser pour exécuter des fonctions spécifiques, comme la création de formulaires, la sécurité, le templating, etc. Ce sont des briques que vous pouvez assembler pour créer le château ou le vaisseau spatial de vos rêves... enfin, je veux dire, une superbe application web.\r\n\r\n\"Bridges\" : Avez-vous déjà essayé de connecter deux systèmes qui refusent tout simplement de se parler, comme deux chèvres têtues sur un pont étroit ? (bizarre, cette référence…) C\'est là que les \"bridges\" (pont en français) Symfony entrent en jeu. Ils connectent Symfony avec d\'autres bibliothèques logicielles, réglant les problèmes d\'incompatibilité. Pas besoin de traducteur, les \"bridges\" Symfony font tout le travail.\r\n\r\nEn résumé, Symfony est votre boîte à outils tout-en-un, une symphonie de codes qui rationalisent et simplifient votre parcours de développement web. C\'est le chef personnel dont vous ne saviez pas que vous aviez besoin, le superhéros que vous attendiez...\r\n\r\nComment fonctionne Symfony ?\r\nLa réponse à cette question est similaire à la façon dont un orchestre crée une symphonie. Vous avez toutes les parties - le violon, le violoncelle, la flûte, le tambour - chacune jouant son rôle spécifique, culminant dans une mélodie qui laisse le public sous le charme. Voyons donc comment Symfony, notre chef d\'orchestre, aide toutes ces parties à jouer en harmonie.\r\n\r\nLa structure de Symfony\r\nSi vous avez déjà essayé de construire quelque chose de complexe, comme une maquette de vaisseau spatial, vous savez qu\'il faut suivre les instructions, une étape à la fois, avec patience. Dans Symfony, les \"instructions\" sont un ensemble de bonnes pratiques que vous pouvez voir ici.\r\n\r\nRevenons aux trois éléments que nous avons vu précédemment, les \"bundles\", les \"components\" et les \"bridges\" :\r\n\r\nVous vous souvenez de notre ami le \"Bundle\" ? Chaque bundle dans Symfony est un bout de code autonome avec une tâche spécifique. Pensez-y comme un musicien dans notre orchestre, avec sa propre partition et son propre instrument. Les \"bundles\" interagissent de manière transparente avec d\'autres \"bundles\", ce qui les rend incroyablement modulaires. Cela signifie que vous pouvez les ajouter, les supprimer ou les remplacer sans perturber la mélodie générale de votre application.\r\nLes \"components\", nos Lego, offrent différentes fonctionnalités. Cela peut aller du traitement des messages HTTP à la gestion des fichiers, en passant par la traduction des langues, et bien d\'autres choses encore. C\'est comme si chaque Lego apportait une fonctionnalité unique à votre projet, et qu\'il vous suffisait de les assembler dans le bon ordre pour que votre vision prenne vie. Vous pouvez d\'ailleurs retrouver des composants (oui, cette fois je le mets en français) de Symfony dans d\'autres projets.\r\n\r\nEnfin, les \"Bridges\" servent de chefs d\'orchestre, connectant différentes bibliothèques logicielles à Symfony, s\'assurant que la performance se déroule sans accroc. Ils s\'assurent que votre batteur et votre violoniste (différentes couches logiciels) sont sur la même longueur d\'onde, même s\'ils n\'ont jamais joué ensemble auparavant.\r\n\r\nSimplifier le processus de développement web\r\nAvec Symfony, vous n\'avez pas besoin d\'écrire des systèmes d\'authentification complexes à partir de zéro pour chaque nouveau projet. Au lieu de cela, vous utilisez simplement un bundle conçu spécifiquement à cette fin (avant c\'était le FoSUserBundle, et maintenant c\'est directement dans le MakerBundle). C\'est comme acheter une étagère prête à monter au lieu d\'abattre un arbre pour en construire une (après, si vous ne savez pas quoi faire de vos week-ends...).\r\n\r\nVous économisez beaucoup de temps et d\'efforts, et vous êtes libre de vous concentrer sur les aspects uniques et passionnants de votre projet.\r\n\r\nDe plus, l\'architecture MVC (Modèle-Vue-Contrôleur) de Symfony sépare la logique, l\'interface utilisateur et le flux de contrôle de votre application. Imaginez que vous soyez un peintre et qu\'au lieu d\'avoir toutes vos couleurs mélangées, elles soient soigneusement séparées sur une palette, prêtes à être utilisées pour créer votre chef-d\'œuvre. C\'est ce que la structure MVC de Symfony fait à votre code - elle l\'organise proprement pour faciliter la gestion et l\'amélioration.\r\n\r\nBien que le framework soit historiquement basé sur le modèle MVC, qui est toujours utilisé aujourd\'hui, notamment si vous utilisez Stimulus et Turbo, il est bien sûr possible de créer uniquement une API avec Symfony, notamment via API Platform.', 27, 1, '64c9b0f4af3be_website-design.png', '2023-08-02 03:27:16', '2023-08-02 03:27:16'),
(17, 'Symfony et les workflows', 'Un composant de Symfony', 'C’est quoi un workflow ?\r\nCe principe c’est le workflow. Si vous avez l’habitude de travailler dans un contexte anglophone, un workflow est tout simplement un ensemble d’étapes sur un projet ou une tâche donné, avec un ordre précis et défini.\r\n\r\nC’est exactement la même chose ici, nous allons voir comment définir des étapes prédéterminées dans le flow d’un système.\r\n\r\nDans quel cas ça s’applique ?\r\nJe m’explique avec un exemple concret :\r\nVous travaillez sur un e-commerce et vous avez des commandes qui sont envoyées par colis aux quatre coins du monde.\r\n\r\nCela va sans dire que vos colis sont tous dans plusieurs “états” différents. Ceux en préparation, ceux prêts à être emportés, ceux en cours de livraison et ceux livrés.\r\n\r\nC’est ici que le workflow va prendre tout son sens. Votre contrainte principale au niveau du code est simple : un colis ne peut pas sauter une étape, et ne peut pas non plus reculer.\r\n\r\nDans un scénario standard, il faudrait gérer ça avec tout un tas de conditions, pour vérifier qu’à chaque modification d’un colis son état est toujours cohérent par rapport au précédent.\r\n\r\nCeux qui voient de quoi je parle vous devez avoir une multitude de “if” qui clignotent devant vos yeux.\r\n\r\nLe Workflow de Symfony va donc vous être d’une grande aide !\r\n\r\nL’implémentation dans Symfony\r\nBon, avant de vous expliquer en détails, je vais déjà vous renvoyer vers la documentation de Symfony qui est très bien faite à ce sujet :\r\n\r\nLe Workflow est donc un composant de Symfony qui s’installe et se configure comme n’importe quel package/library via Composer et un fichier yaml.\r\n\r\nComme présenté dans la doc on va donc définir des “places” qui vont correspondre à nos différents états de colis puis il faut aussi créer des “transitions” qui comme son nom l’indique vont permettre de passer d’un état à un autre.\r\n\r\nEnsuite ? Et bien grâce aux interactions entre les getters/setters de votre entité et la configuration précédemment définie, Symfony va automatiquement vérifier que ce que vous (ou votre système) essayez de faire est bien possible et autorisé.\r\n\r\nIl rejettera donc un passage d’un colis de l’état “en préparation” à l’état “livré”. Il faudra d’abord passer les étapes de “prêt à être emporté” puis “en livraison”.\r\n\r\nEn allant encore plus loin dans la configuration, vous pouvez également ajouter une notion de droits utilisateurs. Est-ce que seul un administrateur du site est en mesure de dire qu’un colis a bien été livré ? Dans ce cas seuls ceux ayant ce rôle pourront passer cette étape du workflow.\r\n\r\nL’utilité finale\r\nÉvidemment, comme bon nombre d’outils proposés par Symfony, l’utilité principale est le gain de temps. Comme je le disais en introduction, fini les multitudes de if ou de if imbriqués pour gérer tel ou tel cas d’usage. Un fichier de configuration simple et une notion d’event listeners suffisent désormais à gérer toutes les sécurités basiques.\r\n\r\nCela ajoute donc aussi une certaine robustesse à votre application et à votre système tout entier. Si les règles changent au cours du cycle de vie de votre projet, il sera facile de réadapter votre workflow. Idem si de nouveaux types d’utilisateurs sont créés, leurs droits pourront être facilement affectés sur chaque point précis. Mais ça, vous devriez déjà le savoir parce que c’est le cœur du composant de sécurité dans Symfony.', 27, 1, '64c9b26f576b9_developer.png', '2023-08-02 03:33:35', '2023-08-02 03:33:35'),
(18, 'Ubuntu Pro - sécurité pour vos serveurs', 'Ubuntu Pro permet désormais d\'avoir des patchs de sécurité pendant une période de 10 ans', 'Un nouveau venu dans les OS maintenus 10 ans\r\n\r\nDepuis, janvier 2023, Ubuntu, via son offre Ubuntu Pro permet désormais d\'avoir des patchs de sécurité pendant une période de 10 ans, et le plus beau dans tout ça ? C’est gratuit jusqu\'a 5 machines...\r\n\r\nComment obtenir Ubuntu Pro\r\nPour cela il faudra se rendre sur la page Ubuntu Pro\r\n\r\nPlus bas dans la page vous pourrez voir \"free for personnal use\"\r\n\r\nUne fois vos choix effectués vous aurez accès à l\'interface Ubuntu Pro\r\n\r\nVous y découvrirez votre « token » que vous pourrez activer via la commande \"sudo pro attach\", à noter que la commande \"pro\" est dans le paquet \"ubuntu-advantage-tools\"\r\n\r\nCela aura pour effet d\'activer les repository ESM et de vous donner accès au livepatching... mais attention .\r\n\r\nIl est important de comprendre que le paquet mis à jour sont ceux fournis par Ubuntu et non pas ceux de parties tierces, par exemple pour docker, n\'utilisez pas les repository \"docker-ce\", mais plutôt la version disponible dans les repository Ubuntu.\r\n\r\nLes limites de la version gratuite\r\n\r\nLe livepatching de la version gratuite vous met sur le canal \"beta\".\r\nC\'est-à-dire que les patchs à chaud appliqué sur le noyau, après avoir été testé chez Ubuntu, sont directement déployés sur vos machines, vous en conviendrez pour de la production, c\'est une mauvaise idée.\r\n\r\nMettre à jour le kernel (noyau) avec la version gratuite\r\n\r\nSi vous utilisez la version gratuite, le mieux selon moi est de désactiver le livepatching avec la commande \"sudo pro disable livepatch\".\r\n\r\nUne fois cela fait, je vous invite à vérifier que quand la machine redémarre, tous les services qu\'elle assure redémarrent également sans problème particulier.\r\n\r\nUne fois cela fait, vous pouvez utiliser le paquet \"unattended-upgrades\" pour appliquer en heure creuse les patchs de sécurité.\r\nPour cela : \"sudo apt install unattended-upgrades\" puis \"sudo dpkg-reconfigure unattended-upgrades\".\r\n\r\nUne fois « unattended-upgrades » installé, je vous conseille de définir quand chaque action doit être effectuée, afin d\'éviter les mauvaises surprises...\r\n\r\nRedémarrer un serveur ?\r\n\r\nLa stabilité de GNU/Linux n\'est plus a prouvé, je sais très bien qu\'il peut tourner des années sans reboot, du coup, me concernant, s\'il redémarre de temps en temps, ça ne me pause aucun souci (enfin pas en heure d’utilisation intensive bien sûr).\r\n\r\nJe préfère savoir immédiatement qu\'il y a un souci et qu\'une machine ne redémarre pas plutôt que de le découvrir, « contraint et forcé », dans un moment  de rush « chaud ».', 27, 3, '64c9b417d4255_coding.png', '2023-08-02 03:40:39', '2023-08-02 03:40:39'),
(19, 'Qu\'est-ce qu\'un bon développer?', 'Ce qu\'est un bon développeur, mais, pas de la manière dont vous l\'imaginiez', 'Qu\'est-ce que fait un développeur, réellement ?\r\nBeaucoup voient le dev comme quelqu\'un qui passe son temps à écrire du code, ce n\'est pas tout à fait vrai.\r\n\r\nLa question est, pourquoi écrit-on ce code ?\r\nPour résoudre des problèmes, et pour répondre à des besoins.\r\n\r\nLe code seul n\'a absolument aucune utilité, le code est un outil qui permet d\'atteindre des objectifs.\r\n\r\nCertes, dans ma vie de développeur indépendant, je passe du temps à écrire du code, mais le moment où je me trouve le plus productif, c\'est quand je suis perdu dans mes pensées à réfléchir à une situation à laquelle je suis confronté.\r\n\r\nCela m\'est encore arrivé plusieurs fois, la semaine dernière, dans un projet sur lequel je travaille actuellement, l\'expérience utilisateur n\'était pas suffisamment satisfaisante à mon gout, j\'ai mis le problème de côté et j\'ai continué à avancer sur le projet... et puis j\'ai été prendre l\'air.\r\n\r\nPlus tard en marchant comme j\'ai souvent l\'habitude de le faire, j\'étais perdu dans mes pensées dans un parc bien connu de Nancy, au bou d\'une dizaine de minutes de marche, la solution a mon problème d\'interface m\'est apparu comme ça... en réfléchissant.\r\n\r\nEn rentrant, j\'ai donc éprouvé mon idée et écrit les quelques lignes de code pour la mettre en œuvre, ça se résumait à une 20aines de ligne de code (dans un contrôleur stimulus pour les connaisseurs).\r\n\r\nVoilà, 30 lignes... mais ce n\'est pas ces lignes qui ont de la valeur, c\'est l\'idée sous jasaient m\'ayant permis de trouver la solution au problème qui a de la valeur.\r\n\r\n(je vous reparle du projet en question dans un futur article, ça avance bien)\r\n\r\nComprendre son client et ses besoins\r\nPensez que son boulot est uniquement de \"venir, coder un truc et repartir\", est une erreur.\r\nEn fait dans le processus il y a tout un travail à comprendre son client, son univers et ses besoins, et il est même possible de découvrir des besoins qu\'il ignore avoir.\r\n\r\nJe m\'explique, dans ma clientèle, il y a des petites et moyennes entreprises, des grands groupes ou encore des entrepreneurs qui se lancent dans une nouvelle aventure.\r\n\r\nCe paragraphe est un clin d\'œil à ces derniers.\r\n\r\nJ\'ai eu il y a quelque temps un projet, ou il était question de lancer un \"nouveau média\" (pareil, on en reparle plus tard) lors de nos échanges, je comprends bien de quoi il est question, mais je vois déjà plus loin.\r\n\r\nÀ la base, le média était disponible en français et en anglais, sauf qu’en écrivant le CMS (basé sur Ludo Dev CMS) pour ce projet, il paraissait bon d\'anticipé certaines choses comme le fait que ce comme toute entreprise, ce média évoluera avec le temps (une entreprise : soit elle croit, soit elle meure, il n\'y a pas d\'entre deux).\r\n\r\nDu coup, le module linguistique a été pensé pour l\'avenir, certes il supporte le français et l\'anglais, mais il est déjà compatible avec toutes les langues, en fait il n\'y a pas de limite technique, juste de fichiers de traduction à ajouter.\r\n\r\nEnfin, sur ce même projet, malgré que le client voulait au départ 4 catégories bien définies. Il fallait aller à contre-pied et permettre autant de catégories que nécessaire, qu\'il puisse ajouter autant de choses qui le souhaitait avec le temps.\r\n\r\nAu début, c\'était compliqué, car le client n\'étant pas dans la tech, lui il voyait que les catégories sur le site de test étaient des \"test 1\", \"test 2\" ... etc.\r\n\r\nPuis quand il a compris ce qui avait été fait, il a juste dit \"Merci\".\r\n\r\nL\'idée ici, c\'est de comprendre les besoins de son client, mais aussi de lui proposer des choses et pour cela, il faut entrer dans son univers et ne pas se contenter de faire de \"l\'exécution\".', 27, 2, '64c9b52ed6eae_brainstorm.png', '2023-08-02 03:45:18', '2023-08-02 03:45:18');

-- --------------------------------------------------------

--
-- Table structure for table `Role`
--

CREATE TABLE `Role` (
  `id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Role`
--

INSERT INTO `Role` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Comment`
--
ALTER TABLE `Comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `person_id` (`person_id`);

--
-- Indexes for table `Person`
--
ALTER TABLE `Person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `Post`
--
ALTER TABLE `Post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `person_id` (`person_id`);

--
-- Indexes for table `Role`
--
ALTER TABLE `Role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Category`
--
ALTER TABLE `Category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Comment`
--
ALTER TABLE `Comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `Person`
--
ALTER TABLE `Person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `Post`
--
ALTER TABLE `Post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `Role`
--
ALTER TABLE `Role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Comment`
--
ALTER TABLE `Comment`
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `Post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_3` FOREIGN KEY (`person_id`) REFERENCES `Person` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Person`
--
ALTER TABLE `Person`
  ADD CONSTRAINT `person_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `Role` (`id`);

--
-- Constraints for table `Post`
--
ALTER TABLE `Post`
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `Category` (`id`),
  ADD CONSTRAINT `post_ibfk_3` FOREIGN KEY (`person_id`) REFERENCES `Person` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
