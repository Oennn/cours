<?php

require_once 'Personne.php';
require_once 'CSVReader.php';


$csv = new CSVReader("prenoms_paris/prenoms_Paris.csv");
$csv->afficherStatistiques();
$donnees = $csv->getDonnees();
echo "\n".$donnees[0][0]."\n";  // Affiche "M"


//cas 1
$personnes= $csv->getPersonnes();
foreach($personnes as $personne){
	if($personne->getSexe() ==='M' && $personne->getAnneeNaissance() ===2011 && $personne->getPrenom()[0]==='A'){
		echo $personne."\n" ;
	}
}
//cas 2


function arr_filter(Personne $personne):bool{
	return $personne->getSexe() ==='M' && $personne->getAnneeNaissance() ===2011 && $personne->getPrenom()[0]==='A';
};

echo"\n\n\navec array_filter : \n";
$personnes_filtrees=array_filter($personnes,'arr_filter');
foreach($personnes_filtrees as $personne){
	echo $personne."\n";
}
?>