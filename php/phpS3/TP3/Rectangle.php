<?php 
require_once 'Point.php';
class Rectangle{
    private Point $coinSupGauche;
    private Point $coinInfDroit;

    public function __construct(Point $coinSupGauche,Point $coinInfDroit)
    {
        $this->coinSupGauche=$coinSupGauche;
        $this->coinInfDroit=$coinInfDroit;
    }

    public function calculerLongueur():float{
        return abs($this->coinInfDroit->getX() - $this->coinSupGauche->getX()); // |x2 - x1|
    }

    public function calculerLargeur():float{
        return abs($this->coinSupGauche->getY() - $this->coinInfDroit->getY()); // |y1 - y2|
    }

    public function calculerPerimetre():float{
        return ($this->calculerLargeur()+$this->calculerLongueur())*2;
    }
    public function __toString(): string {
        return "Rectangle[CoinSupGauche: {$this->coinSupGauche}, CoinInfDroit: {$this->coinInfDroit}]";
    }



}

?>