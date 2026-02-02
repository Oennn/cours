<?php
require_once 'Personne.php';
class CSVReader {
	private array $donnees=[];
	private string $url;
	private array $personnes=[];
	
	public function __construct(string $url){
		$this->url=$url;
		$this->lireCSV(); //pour lire la méthode quand on crée un objet CSVReader

	
	}

	
	private function lireCSV() : void  {
        $fichier = fopen($this->url, 'r');

        if ($fichier === false) {
            throw new Exception("Impossible d'ouvrir le fichier CSV.");
        }

        // Ignorer la première ligne (entêtes)
        fgets($fichier);

        while (($line = fgets($fichier)) !== false) {
            // enlever le caractère de fin de ligne
            $line = trim($line);
            $infos = explode(",", $line);
            
            // $infos est un tableau avec sexe, prénom, année, département, nombre
            // diviser la chaîne de caractères $line en un tableau, en utilisant
            // la virgule (,) comme délimiteur et remplir le tableau $this->donnees
            $this->donnees[] = $infos;
			$personne=new Personne($infos[0],(int)$infos[1],$infos[2]);
			$this->personnes[]=$personne;
            
        }

        // fermer le fichier
        fclose($fichier);
    }
    
	    // Créez les getters : getDonnees(), ...
	public function getDonnees(): array {
		return $this->donnees;

	}
	public function getPersonnes(): array {
        return $this->personnes;
    }
	public function getUrl():string{
		return $this->url;
	}


	    public function afficherStatistiques(): void {
	    $total = 0;
	    $totalGarcons = 0;
	    $totalFilles = 0;
	    $garcons2023 = 0;
	    $filles2023 = 0;

	    foreach ($this->donnees as $ligne) {
		$sexe = $ligne[0];
		$annee = (int)$ligne[1];
		$nombre = (int)$ligne[3]; 

		$total += $nombre;

		if ($sexe === "M") {
		    $totalGarcons += $nombre;
		    if ($annee === 2023) $garcons2023 += $nombre;
		} elseif ($sexe === "F") {
		    $totalFilles += $nombre;
		    if ($annee === 2023) $filles2023 += $nombre;
		}
	    }

	    $propGarcons = ($totalGarcons / $total) * 100 ;
	    $propFilles  = ($totalFilles  / $total) * 100 ;

	    echo "Nombre total de personnes : $total ($totalGarcons M + $totalFilles F)\n";
	    echo "Proportion de garçons :  $propGarcons % des naissances.\n";
	    echo "Proportion de filles :  $propFilles % des naissances.\n";
	    echo "Nombre de garçons nés en 2023 : $garcons2023\n";
	    echo "Nombre de filles nées en 2023 : $filles2023\n";
}

}



?>
