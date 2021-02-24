DROP TABLE IF EXISTS `kts_en_interprestations`;
CREATE TABLE `kts_en_interprestations` (
    `symbol` char(4) NOT NULL,
    `id_temperament` int(11) NOT NULL,
    `short` varchar(30) NOT NULL,
    `description` text NOT NULL,
    `passion` text NOT NULL,
    `stress` text NOT NULL,
    PRIMARY KEY (`symbol`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `kts_en_interprestations` (`symbol`, `id_temperament`, `short`, `description`, `passion`, `stress`) VALUES
    ('ENFJ',1,'Teacher','description1','passion1','stress1'),
    ('INFP',1,'Healer','description2','passion2','stress2'),
    ('ENFP',1,'Champion','description3','passion3','stress3'),
    ('INFJ',1,'Counselor','description4','passion4','stress4'),
    ('ESTJ',2,'Supervisor','description5','passion5','stress5'),
    ('ISTJ',2,'Inspector','description6','passion6','stress6'),
    ('ESFJ',2,'Provider','description7','passion7','stress7'),
    ('ISFJ',2,'Protector','description8','passion8','stress8'),
    ('ESTP',3,'Promoter','description9','passion9','stress9'),
    ('ISTP',3,'Crafter','description10','passion10','stress10'),
    ('ESFP',3,'Performer','description11','passion11','stress11'),
    ('ISFP',3,'Composer','description12','passion12','stress12'),
    ('ENTJ',4,'Fieldmarshal','description13','passion13','stress13'),
    ('INTJ',4,'Mastermind','description14','passion14','stress14'),
    ('ENTP',4,'Inventor','description15','passion15','stress15'),
    ('INTP',4,'Architect','description16','passion16','stress16');

DROP TABLE IF EXISTS `kts_en_statements`;
CREATE TABLE `kts_en_statements` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `statement` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `type1` char(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `type2` char(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `kts_en_statements` (`id`, `statement`, `type1`, `type2`) VALUES
    (1,'statement1','1','2'),
    (2,'statement2','3','4'),
    (3,'statement3','3','4'),
    (4,'statement4','5','6'),
    (5,'statement5','5','6'),
    (6,'statement6','7','8'),
    (7,'statement7','7','8'),
    (8,'statement8','1','2'),
    (9,'statement9','3','4'),
    (10,'statement10','3','4'),
    (11,'statement11','5','6'),
    (12,'statement12','5','6'),
    (13,'statement13','7','8'),
    (14,'statement14','7','8'),
    (15,'statement15','1','2'),
    (16,'statement16','3','4'),
    (17,'statement17','3','4'),
    (18,'statement18','5','6'),
    (19,'statement19','5','6'),
    (20,'statement20','7','8'),
    (21,'statement21','7','8'),
    (22,'statement22','1','2'),
    (23,'statement23','3','4'),
    (24,'statement24','3','4'),
    (25,'statement25','5','6'),
    (26,'statement26','5','6'),
    (27,'statement27','7','8'),
    (28,'statement28','7','8'),
    (29,'statement29','1','2'),
    (30,'statement30','3','4'),
    (31,'statement31','3','4'),
    (32,'statement32','5','6'),
    (33,'statement33','5','6'),
    (34,'statement34','7','8'),
    (35,'statement35','7','8'),
    (36,'statement36','1','2'),
    (37,'statement37','3','4'),
    (38,'statement38','3','4'),
    (39,'statement39','5','6'),
    (40,'statement40','5','6'),
    (41,'statement41','7','8'),
    (42,'statement42','7','8'),
    (43,'statement43','1','2'),
    (44,'statement44','3','4'),
    (45,'statement45','3','4'),
    (46,'statement46','5','6'),
    (47,'statement47','5','6'),
    (48,'statement48','7','8'),
    (49,'statement49','7','8'),
    (50,'statement50','1','2'),
    (51,'statement51','3','4'),
    (52,'statement52','3','4'),
    (53,'statement53','5','6'),
    (54,'statement54','5','6'),
    (55,'statement55','7','8'),
    (56,'statement56','7','8'),
    (57,'statement57','1','2'),
    (58,'statement58','3','4'),
    (59,'statement59','3','4'),
    (60,'statement60','5','6'),
    (61,'statement61','5','6'),
    (62,'statement62','7','8'),
    (63,'statement63','7','8'),
    (64,'statement64','1','2'),
    (65,'statement65','3','4'),
    (66,'statement66','3','4'),
    (67,'statement67','5','6'),
    (68,'statement68','5','6'),
    (69,'statement69','7','8'),
    (70,'statement70','7','8');


DROP TABLE IF EXISTS `kts_en_temperaments`;
CREATE TABLE `kts_en_temperaments` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `temperament` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `code` char(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `overview` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `characteristic` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `finding` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
    `dealing` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `kts_en_temperaments` (`id`, `temperament`, `code`, `overview`, `characteristic`, `content`, `finding`, `dealing`) VALUES
    (1,'Idealists','NF','overview1','characteristic1','content1','finding1','dealing1'),
    (2,'Guardians','SJ','overview2','characteristic2','content2','finding2','dealing2'),
    (3,'Artisans','SP','overview3','characteristic3','content3','finding3','dealing3'),
    (4,'Rationals','NT','overview4','characteristic4','content4','finding4','dealing4');
    
DROP TABLE IF EXISTS `kts_en_types`;
CREATE TABLE `kts_en_types` (
    `id` int(11) NOT NULL,
    `code` char(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `kts_en_types` (`id`, `code`, `name`) VALUES
    (1,'E','Extravert'),
    (2,'I','Introvert'),
    (3,'S','Sensor'),
    (4,'N','iNtuitive'),
    (5,'T','Thinker'),
    (6,'F','Feeler'),
    (7,'J','Judger'),
    (8,'P','Perceiver');