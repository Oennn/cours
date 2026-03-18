DROP TABLE IF EXISTS `Personne`;
CREATE TABLE Personne (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  nom VARCHAR(40) NOT NULL,
  prenom VARCHAR(40) NOT NULL,
  dateN DATE NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `Personne` (`id`, `nom`, `prenom`, `dateN`) VALUES
(1, 'Devignes','Michel','2001-01-20'),
(2, 'Chambeaux','Julie','2002-02-04'),
(3, 'Bernard','Bernadette','1998-03-20'),
(4, 'Dupont','Alain','1999-06-12'),
(5, 'Durand','Sophie','2000-03-15'),
(6, 'Martin','Paul','2001-08-18'),
(7, 'Lefevre','Lucie','2002-09-21'),
(8, 'Leroy','Jean','2003-10-24'),
(9, 'Moreau','Jacques','2004-11-27'),
(10, 'Lambert','Françoise','2005-12-30'),
(11, 'Fontaine','Claire','1997-02-11'),
(12, 'Rousseau','Marc','1996-04-09'),
(13, 'Vincent','Émilie','1999-05-14'),
(14, 'Fournier','Thomas','2000-07-19'),
(15, 'Girard','Camille','2001-03-08'),
(16, 'Andre','Nicolas','2002-06-22'),
(17, 'Mercier','Isabelle','1998-12-05'),
(18, 'Blanc','Julien','1997-11-16'),
(19, 'Guerin','Mathilde','2003-01-03'),
(20, 'Boyer','Antoine','2004-09-13');