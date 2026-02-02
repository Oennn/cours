<?php 



class Polygone{
    private array $tabPoints;

    public function __construct(array $points)
    {
        $this->tabPoints =$points;
    }

    public function nombreSommets():int{
        return count($this->tabPoints);
    }

    public function __toString():string
    {
        $resultat="";
        foreach($this->tabPoints as $i => $point){
            $resultat= $resultat. "Sommet ". ($i+1). " : " . $point."\n";
        }
        return $resultat;
    }

    public function getSommets(): array //très utile pour se visualiser la forme du tableau !
    {
        return $this->tabPoints;
    }
        
/*

 Array
(
    [0] => Point Object
        (
            [x:Point:private] => 10
            [y:Point:private] => 10
            [couleur:Point:private] => rouge
        )

    [1] => Point Object
        (
            [x:Point:private] => 20
            [y:Point:private] => 20
            [couleur:Point:private] => bleu
        )

    [2] => Point Object
        (
            [x:Point:private] => 10
            [y:Point:private] => 20
            [couleur:Point:private] => vert
        )

)

$i représente [0], [1], [2]
$point représente Point Object
*/


}

?>