<?php

class Personne{

    private string $sexe;
    private int $anneeNaissance;
    private string $prenom;


    public function __construct(string $sexe, int $anneeNaissance, string $prenom){
		$this->sexe = $sexe;
        $this->anneeNaissance = $anneeNaissance;
        $this->prenom = $prenom;
	
	}

    public function __toString(): string{


        return "C'est un(e) $this->sexe nommé(e) {$this->prenom}, né(e) en {$this->anneeNaissance}.";
    }

    public function getAnneeNaissance(): int {
        return $this->anneeNaissance;
    }

    public function getPrenom(): string {
        return $this->prenom;
    }
    public function getSexe(): string {
        return $this->sexe;
    }

}


?>