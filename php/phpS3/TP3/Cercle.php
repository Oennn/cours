<?php
require_once 'Point.php';
class Cercle{
    private Point $centre;
    private float $rayon;

    public function __construct( Point $centre,float $rayon)
    {
        if($rayon <=0){
            throw new InvalidArgumentException(
                "Erreur : le rayon doit être strictement positif.");
        }
        $this->centre=$centre;
        $this->rayon=$rayon;
    }
    public function calculerPerimetre():float{
        $perimetre= $this->rayon*2  *pi(); //diametre * pi

        return round($perimetre,2);
    }
    public function calculerSurface():float{
        $surface= $this->rayon **2 *pi();

        return round($surface,2);
    }

    public function  __toString() : string {
        return "Centre : $this->centre\nRayon : $this->rayon\n";
    }






}
?>