<?php
class Point{
    private float $x;
    private float $y;
    private string $couleur;

    public function __construct( float $x,float $y, string $couleur="noir")
    {
        $this->x=$x;
        $this->y=$y;
        $this->couleur=$couleur;
    }

    public function __toString() : string //quand on fait new Point(10, 10, 'rouge'); renvoie le return
    {
        return "($this->x, $this->y, $this->couleur)";
    }

    public function calculerDistance (Point $autrePoint) : float {
        $dx = $this->x - $autrePoint->x;
        $dy = $this->y - $autrePoint->y;
        return round(sqrt($dx * $dx + $dy * $dy),2); //formule de la dist euclidienne en 2 dimensions
    }


    public function getX(): float {
        return $this->x;
    }
    public function getY(): float {
        return $this->y;
    }
    public function getCouleur(): string {
        return $this->couleur;
    }
}
?>